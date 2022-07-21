<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Image;
use Alert;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view('auth.register');
    }

    /**
     * Handle an incoming registration request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request)
    {
        $default_role = 3;
        $requestData = $request->all();

        if ($request->hasFile('profile_image') && $request->hasFile('nid_image')) {
            
            $profile_image = $request->file('profile_image');
            $nid_image = $request->file('nid_image');


            $nid_image_Name = time() . '.' . $nid_image->getClientOriginalExtension();
            $profile_image_Name = time() . '.' . $profile_image->getClientOriginalExtension();
            Image::make($request->file('profile_image'))
            ->resize(300, 200)
            ->save(storage_path() . '/app/public/users/profile/' . $profile_image_Name);
            
            Image::make($request->file('nid_image'))
                ->resize(300, 200)
                ->save(storage_path() . '/app/public/users/nid/' . $nid_image_Name);
            $requestData['profile_image'] = $profile_image_Name;
            $requestData['nid_image'] = $nid_image_Name;
        }

    $request->validate([
        'name' => 'required|string|max:255',
        'email' => 'required|string|email|max:255|unique:users',
        'password' => ['required', 'confirmed', Rules\Password::defaults()],
        'blood_group' =>'required',
        'nid_number'=>'required|numeric|unique:users',

        'dob'=> 'required|date|before:18 years ago',
        'gender'=>'required',
        'division'=>'required',
        'district'=>'required',
        'thana'=>'required',
        'postOffice'=>'required',
        'terms'=>'required',
        'profile_image' => 'required|mimes:jpg,png|min:5|max:2048',
        
        'nid_image' => 'required|mimes:jpg,png|min:5|max:512',
    ]);

    $user = User::create([
        'name' => $request->name,
        'email' => $request->email,
        'password' => Hash::make($request->password),
        'blood_group'=> $request->blood_group,
        'role_id' => 3,
        'nid_number' => $request->nid_number,
        'total_donated'=> 0,

    ]);
    $user->profile()->create([
        'phone' => $request->phone,
        'phone2' =>$request->phone2,
        'father'=> $request->father,
        'mother'=> $request->mother,
        'dob'=> $request->dob,
        'gender'=> $request->gender,
        'division'=> $request->division,
        'district'=> $request->district,
        'thana'=> $request->thana,
        'postOffice'=> $request->postOffice,
        'postCode' => $request->postCode,
        'profile_image' => $requestData['profile_image'],
        'nid_image' => $requestData['nid_image'],
    ]);  
    // if ($user) {
    //     Alert::success('Submitted', 'Your donor signup request is waiting for approval');
    //     return back();
    // }
    event(new Registered($user));
    auth()->login($user);
    Auth::login($user);
    return redirect('verify-email');
    return redirect()->back()->withMessage('Your signup request is submitted! We will mail you soon');
    //   return redirect()->route('verification.notice');
    }
}
