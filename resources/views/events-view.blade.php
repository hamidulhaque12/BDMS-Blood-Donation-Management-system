<x-frontend.layouts.master>
    <main>
        <section>
          <div class="container pt-2 px-5">
           <div class="row">
             <div class="col-md-4 ms-5">
               <p><b>Area: Uttara, Dhaka-1230</b></p>
             </div>
             <div class="col-md-3 ms-5">
              <p><b>Date: 19 Mar,2022</b></p>
            </div>
            <div class="col-md-3 ms-5">
              <p><b>Posted By: Nur Islam</b></p>
            </div>
           </div>
          </div>
          <hr>
        </section>
        <section>
          <div class="container  h-100">
             <div class="row p-0  justify-content-center align-items-center h-100" style="width: 100%">
                 <div class="col-12 col-md-8 col-lg-6 col-xl-8 p-0" style="width: 100%">
                   <div class="card-body p-5 ">   
                    <div class="mb-md-5 md-4 pb-5"> 
                     <h1 class="lead" style="text-align: center;">Events</h1> <hr>
                     
                       <div >
                         <form action="">
                           <img src="{{asset('storage/events/'.$event->image)}}" alt="" width="100%" height="350px">
                           <div> <br>
                           <h4>{{$event->title}}</h4>
                           </div>
                          
                          <div class="">
                          <hr>
                            <p style="text-align: justify;">  {{$event->description}}</p>
                          </div>
                         
                         </form>
  
  
  
                       </div>
                    
                    </div>
                   </div>
                 </div> 
              </div>
          </div><br>
      </section>
  
   </main>
</x-frontend.layouts.master>