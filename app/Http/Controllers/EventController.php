<?php

namespace App\Http\Controllers;

use App\Http\Requests\EventRequest;
use App\Models\Event;
use App\Http\Requests\StoreEventRequest;
use App\Http\Requests\UpdateEventRequest;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Auth;
use Image;

class EventController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $status=null;
        $events = Event::where('status',$status)->get();
        return view('backend/events',compact('events'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */





    public function create()
    {
        return view('backend/events-create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreEventRequest  $request
     * @return \Illuminate\Http\Response
     */




    public function store(EventRequest $request)
    {
        $requestData = $request->all();
        try {
            if ($request->hasFile('image')) {
                Artisan::call('storage:link',[] );
                $file = $request->image;
                $path = "/app/public/events/";
                $filename = time() . '.' . $file->getClientOriginalExtension();
                Image::make($file)->resize(300, 200)->save(storage_path() . $path . $filename);
                $requestData['image'] = $filename;
            }

            // $requestData['created_by']=Auth::user()->id;

            Event::create($requestData);

            return redirect()->route('dashboard.events')->with('message', 'Event Uploaded Successfully!');
        } catch (QueryException $e) {
            return redirect()->back()->withInput()->withErrors($e->getMessage());
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Event  $event
     * @return \Illuminate\Http\Response
     */


    public function show($id)
    {
        $status=null;
        $events = Event::where('status',$status)->where('id',$id)->first();
        return view('backend/event-show',compact('event'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Event  $event
     * @return \Illuminate\Http\Response
     */


    public function edit(Event $event)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateEventRequest  $request
     * @param  \App\Models\Event  $event
     * @return \Illuminate\Http\Response
     */


    public function update(EventRequest $request, Event $event)
    {
        try {

            $requestData = $request->all();
            $requestData['updated_by']=Auth::user()->id;
            if ($request->hasFile('image')) {

                $file = $request->image;
                $filename = time() . '.' . $file->getClientOriginalExtension();
                Image::make($file)->resize(300, 200)->save(storage_path() . '/app/public/events/' . $filename);
                $requestData['image'] = $filename;
            } else {
                $requestData['image'] = $event->image;
            }
         
            $event->update($requestData);
            // $event = event::findOrFail($id);
            // $event->update($request->all());
            return redirect()->route('events.index')->with('message', 'Successfully Upadated!');
        } catch (QueryException $e) {
            return redirect()->back()->withInput()->withErrors($e->getMessage());
        }

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Event  $event
     * @return \Illuminate\Http\Response
     */


    public function destroy(Event $event)
    {
        // $this->authorize('events-delete', $event);
        // $event= Event::findOrFail($id);
        $event->update(['deleted_by'=>auth()->id()]);

        $event->delete();

        return redirect()->back()->withMessage('Successfully Deleted !');

    }


    public function trash(){
        return view('backend/events-trash');
    }
}
