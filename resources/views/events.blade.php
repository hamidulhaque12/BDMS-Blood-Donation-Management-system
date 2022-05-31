<x-frontend.layouts.master>
    {{-- ongoing events --}}
{{-- <section>
    <div class="container p-2 ">
        <h1 class="lead text-uppercase">Ongoing Events</h1>
    </div>
    <div class="container py-3 pb-3">
        <div class="row">
            <div class="col-md-3">
                <div class="card" style="max-width:200px; margin-right:auto; margin-left:auto;  margin-bottom:1rem;">
                    <div class="card-body text-center p-1">
                        <h4 class=" fs-5 card-title">Title</h4>

                        <p class="">Lorem ipsum dolor sit amet consectetur adipisicing elit.</p>
                        
                            <p class="my-0">Area: Dhaka-1230</p>
                            <p class="my-0">Date: 17 mar,2022</p>
                    </div>
                        
                        <a href="see_event.html" class="btn btn-primary w-100">See Event</a>
                    </div>
                    
                </div>
            </div>
           
        </div>
        <hr>

    </div>
</section> --}}
{{-- ongoing end --}}


{{-- upcoming events --}}
{{-- <section>
    <div class="container p-2 ">
        <h1 class="lead text-uppercase">Upcoming Events</h1>
    </div>
    <div class="container py-3 pb-3">
        <div class="row">
            <div class="col-md-3">
                <div class="card" style="max-width:200px; margin-right:auto; margin-left:auto;  margin-bottom:1rem;">
                    <div class="card-body text-center p-1">
                        <h4 class=" fs-5 card-title">Title</h4>

                        <p class="">Lorem ipsum dolor sit amet consectetur adipisicing elit.</p>
                        
                            <p class="my-0">Area: Dhaka-1230</p>
                            <p class="my-0">Date: 17 mar,2022</p>
                    </div>
                        
                        <a href="see_event.html" class="btn btn-primary w-100">See Event</a>
                    </div>
                    
                </div>
            </div>
           
        </div>
        <hr>

    </div>
</section> --}}


{{-- upcoming events end --}}




    <section>
        <div class="container p-2 ">
            <h1 class="lead text-uppercase">RECENT EVENTS</h1>
        </div>


<div class="container py-3 pb-3">
    <div class="row">
        @foreach ($events as $event)
        <div class="col-md-3">
            <div class="card" style="max-width:300px; margin-right:auto; margin-left:auto;  margin-bottom:1rem;">
                <img class="card-img-top" src="{{asset('storage/events/'.$event->image)}}" alt="Card image" style="width:100%"
                    height="200px">
                <div class="card-body">
                    <h4 class="card-title">{{$event->name}}</h4>

                    <p class="card-text">{{ Str::limit( $event->description,30, '...')}}</p>
                    <p>Organized By: {{$event->organized_by}}</p>
                    <p>Date: {{$event->event_date}}</p>
                    <a href="{{route('guest-events.view',$event->id)}}" class="btn btn-primary w-100">See Event</a>
                </div>
            </div>
        </div>
       
@endforeach
    </div>
    <hr>

</div>

     
    </section>

</x-frontend.layouts.master>
