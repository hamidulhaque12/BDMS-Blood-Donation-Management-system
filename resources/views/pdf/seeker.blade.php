<!doctype html>
<html lang="en">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

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
    
            }
            .td{
               width:110px;
              
            }
            .heading-box{
                margin-top: 20px;
                margin-bottom: 35px;
            }
            img{
                padding: 5px !important;
                width: 300px !important;
                max-height:400px !important;
            }
        </style>

</head>

<body>
<div class="blank"></div>
    <div class="container">
        <div class="logo text-center">
            <h3>BDMS</h3>
            
        </div>
        <div class="d-flex flex-column address text-center">
            <div>
                <span>bdms@info.com</span>
            </div>
            <div>
                <span >A/06, Sector-6, Uttara, Dhaka</span>
            </div>
        </div>
        <hr>
        <div class="heading-box">
            <h5 class="heading text-center">Blood Seeker Details</h5>
            <h6 class="text-center">{{$profile->request_no}}</h6>
        </div>
        <div class="container">
            <div class="row">
                <div class="col-md-4">
                    <span class="lead" >Patient details</span>
                    
                    <table class="table">
                    
                        <tbody>
                            <tr>
                                <th class="td" >Name</th>
                                <td>:</td>
                                <td>{{$profile->patient_name}}</td>
                            </tr>
                            <tr>
                                <th>Gender</th>
                                <td>:</td>
                                <td>{{$profile->gender}}</td>
                            </tr>
                            <tr>
                                <th>Blood Group</th>
                                <td>:</td>
                                <td><span class="badge bg-danger">{{$profile->blood_group}}</span></td>
                            </tr>
                            
        
                        </tbody>
                    </table>
                </div>
                <div class="col-md-8">
                    <span class="lead" >Contact Informations</span>
                    
                    <table class="table">
                    
                        <tbody>
                            <tr>
                                <tr>
                                    <th class="td" >Require Date</th>
                                    <td>:</td>
                                    <td>{{$profile->require_date}}</td>
                                </tr> 
                            </tr>
                            <tr>
                                <th class="td" >Contact Name</th>
                                <td>:</td>
                                <td>{{$profile->contact_name}}</td>
                            </tr>
                            <tr>
                                <th>Hospital</th>
                                <td>:</td>
                                <td>{{$profile->hospital_name}}</td>
                            </tr>
                            <tr>
                                <th>Phone</th>
                                <td>:</td>
                                <td>{{$profile->phone}}</td>
                            </tr>
                            <tr>
                                <th>
                                    Phone 2
                                </th>
                                <td>:</td>
                                <td>{{$profile->phone2 ?? ''}}</td>
                            </tr>
                            <tr>
                                <th>Email</th>
                                <td>:</td>
                                <td>{{$profile->email}}</td>
                            </tr>
                            <tr>
                                <th>Address</th>
                                <td>:</td>
                            <td>{{$profile->hospital_name}},{{$profile->thana}},{{$profile->postOffice}},{{$profile->postCode}},{{$profile->district}},{{$profile->division}}</td>
                            </tr>
                            
        
                        </tbody>
                    </table>
                </div>
             
            </div>
            <div class="row">
                <div class="d-flex">
                    <table>
                        <tr>
                            <th width="110px">Blood seeking reason:</th>
                            <td>{{$profile->reason}}</td>
                        </tr>
                        <tr>
                            <th>Additional Informartions:</th>
                            <td>{{$profile->additional ?? ''}}</td>
                        </tr>
                    </table>
                </div>
              
            </div>
            
        
        </div>
        
    </div>
    
    
    <div class="page-break"></div>

    <div class="container">
        <div class="logo text-center">
            <h3>BDMS</h3>
            
        </div>
        <div class="d-flex flex-column address text-center">
            <span>bdms@info.com</span>
            <span >A/06, Sector-6, Uttara, Dhaka</span>
        </div>
        <hr>
        <div class="heading-box">
            <h5 class="heading text-center">Blood Seeker Details</h5>
            <h6 class="text-center">Request No:</h6>
        </div>
        <div class="container">
            <div><span class="lead">Doccument:</span></div>
        <div class="text-center">
            <img style="height: 85%;" src="{{asset('storage/requests/'.$profile->official_report)}}" alt="Report image">

        </div>
        
        </div>
        
    </div>
  


</body>

</html>