<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=minimum-scale, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

        <style>
          
            body{
                font-size: small;
            }
            .blank{
                height: 50px;
            }
            .page-break{
                page-break-after: always;
            }
            .logo{
                margin-bottom: 0px;
                padding: 0px;

            }
            .address{
                margin-bottom: 0px;
                padding: 0px;
            }
            .heading{
                font-family: Verdana;
                 color: sienna;
                text-decoration: underline;
                text-align: center;
    
            }
            .td{
               width:110px;
              
            }
            .heading-box{
                margin-top: 20px;
                margin-bottom: 35px;
            }
            .date{
                font-size: smaller;    
                font-family:'Lucida Sans';
                text-align: right;
            }
            #customers {
  font-family: Arial, Helvetica, sans-serif;
  border-collapse: collapse;
  width: 100%;
}

#customers td, #customers th {
  border: 1px solid #ddd;
  padding: 8px;
}

#customers tr:nth-child(even){background-color: #f2f2f2;}

#customers tr:hover {background-color: #ddd;}

#customers th {
  padding-top: 12px;
  padding-bottom: 12px;
  text-align: left;
  background-color: #04AA6D;
  color: white;
}

.bl-requests {
  font-family: arial, sans-serif;
  border-collapse: collapse;
  width: 100%;
}

.bl-requests td, th {
  border: 1px solid #dddddd;
  text-align: left;
  padding: 4px;
}
.bl-requests-head{
    font-size: smaller;
}
.bl-requests tr:nth-child(even) {
  background-color: #dddddd;
}
        </style>

</head>

<body>
<div class="blank"></div>
<header>
    <div class="logo text-center">
        <h3>BDMS</h3>
        
    </div>
    <div class="d-flex flex-column address text-center">
        <span>bdms@info.com</span><br>
        <span >A/06, Sector-6, Uttara, Dhaka</span>
    </div>
    <hr>
</header>



    <div class="container">
        
        <div class="container-fluid">
            <div class="heading-box">
                <h6 class="heading text-center">Report Of {{$lastYear}} </h6>
            </div>
            <div class="date">
               <span>{{\Carbon\Carbon::now()->format('d/m/y g:i A')}}</span>
            </div>
        </div>
        <div class="container-fluid">
            <span>Short Breif:</span>
            <table id="customers">
                <tr>
                  <th>Blood Request</th>
                  <th>Donor Request</th>
                  <th>Events</th>
                </tr>
                <tr>
                    <td>{{count($bloodReports)}}</td>
                    <td>{{count($donorReports)}}</</td>
                    <td>{{count($eventReports)}}</</td>
                </tr>
             
              </table>
              
        </div>
        <br><br><br>
        <div class="container-fluid">
            <span>Blood Requests (all)</span>
            <table class="bl-requests">
                <tr class="bl-requests-head">
                    <th>#</th>
                  <th>Area</th>
                  <th>Blood Group</th>
                  <th>Require Date</th>
                  <th>Donated By</th>
                  <th>Not Donated reason</th>
                </tr>
                
                    @foreach ($bloodReports as $request)
                    <tr>
                        <td>{{$loop->iteration}}</td>
                        <td>{{$request->district}}</td>
                        <td>{{$request->blood_group}}</td>
                        <td>{{$request->require_date}}</td>
                        <td>{{$request->donorId->name ?? 'n/a' }}</td>
                        <td>{{$request->not_donated_reason ?? ''}}</td>
                      </tr>
                    @endforeach
                 
                
              </table>
        </div>
       
        <div class="page-break"></div>
        <header>
            <div class="logo text-center">
                <h3>BDMS</h3>
                
            </div>
            <div class="d-flex flex-column address text-center">
                <span>bdms@info.com</span>
                <span >A/06, Sector-6, Uttara, Dhaka</span>
            </div>
            <hr>
        </header>

       
        <br><br><br>
        <div class="container-fluid">
            <span>Donor Signup (all)</span>
            <table class="bl-requests">
                <tr class="bl-requests-head">
                    <th>#</th>
                    <th>Name</th>
                  <th>Area</th>
                  <th>Blood Group</th>
                  <th>Total Donated</th>
                  <th>Last Donated</th>
         
                </tr>
                @foreach ($donorReports as $donor)
                <tr>
                    <td>{{$loop->iteration}}</td>
                  <td>{{$donor->name}}</td>
                  <td>{{$donor->district}}s</td>
                  <td>{{$donor->blood_group}}</td>
                  <td>{{$donor->total_donated ?? '0'}}</td>
                  <td>{{$donor->last_donated ?? 'n/a'}}</td>
                </tr> 
                @endforeach
               
                
              </table>
        </div>
      <br><br><br>
        <div class="container-fluid">
            <span>Events (all)</span>
            <table class="bl-requests">
                <tr class="bl-requests-head">
                    <th>#</th>
                    <th>Title</th>
                  <th>Area</th>
                  <th>Posted at</th>
                  <th>Approved</th>
                <th>Rejected</th>
         
                </tr>
                @foreach ($eventReports as $event)
                <tr>
                    <td>{{$loop->iteration}}</td>
                  <td>{{$event->title}}</td>
                  <td>{{$event->district}}s</td>
                  <td>{{$event->created_at}}</td>
                  <td>
                  @if ($event->approved_by)
                        <span class="badge bg-success" >True</span>        
                    @endif
                  </td>
                  <td>
                    @if ($event->rejected_by)
                          <span class="badge bg-success" >True</span>        
                      @endif
                    </td>
      
                </tr> 
                @endforeach
               
                
              </table>
        </div>
    </div>
    


</body>

</html>