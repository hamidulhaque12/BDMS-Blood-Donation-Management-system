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
        body {
            font-size: small;
        }

        .blank {
            height: 50px;
        }

        .page-break {
            page-break-after: always;
        }

        .logo {
            margin-bottom: 0px;
            padding: 0px;

        }

        .address {
            margin-bottom: 0px;
            padding: 0px;
        }

        .heading {
            font-family: Verdana;
            color: sienna;
            text-decoration: underline;
            text-align: center;

        }

        .td {
            width: 110px;

        }

        .d-flex {
            display: flex;
            flex-flow: row wrap;
        }

        .heading-box {
            margin-top: 20px;
            margin-bottom: 35px;
        }

        .date {
            font-size: smaller;
            font-family: 'Lucida Sans';
            text-align: right;
        }

        #customers {
            font-family: Arial, Helvetica, sans-serif;
            border-collapse: collapse;
            width: 100%;
        }

        #customers td,
        #customers th {
            border: 1px solid #ddd;
            padding: 8px;
        }

        #customers tr:nth-child(even) {
            background-color: #f2f2f2;
        }

        #customers tr:hover {
            background-color: #ddd;
        }

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
.text-center{
  text-align: center !important;
}
        .bl-requests td,
        th {
            border: 1px solid #dddddd;
            text-align: left;
            padding: 4px;
        }

        .bl-requests-head {
            font-size: smaller;
        }

        .bl-requests tr:nth-child(even) {
            background-color: #dddddd;
        }

        .center {
            display: block;
            margin-left: auto;
            margin-right: auto;
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
            <span>A/06, Sector-6, Uttara, Dhaka</span>
        </div>
        <hr>
    </header>



    <div class="container">

        <div class="container-fluid">
            <div class="heading-box" style="margin:0px">
                <h6 class="heading text-center">Report Of {{ $user->name }} </h6>
            </div>
            <div class="text-center">
                <img style="width: 100px; height:100px; border-radius: 4px; " class="center"
                    src="{{ asset('storage/users/profile/' . $user->profile->profile_image) }}" alt="Your Image">
            </div>
            <div class="date">
                <span>Date:{{ \Carbon\Carbon::now()->format('d/m/y g:i A') }}</span>
                <br>
            </div>
        </div>
        <div class="container-fluid">
            <div class="d-flex">
                <div class="profile">
                    <span>Name:{{ $user->name }} </span>
                    <br>
                    <span>Age:{{ $user->age($user->profile->dob) }} </span>
                    <br>
                    <span>Blood Group: <span class="badge bg-danger">{{ $user->blood_group }}</span> </span>
                    <br>
                </div>
                <div class="profile">
                    <span>Total Donated:{{ $user->total_donated }}</span>
                    <br>
                    <span>Last Donated:{{ $user->last_donated }}</span>
                    <br>
                    <span>Status:
                        @if ($user->approved_by)
                            <span class="badge bg-success">Verified</span>
                        @endif
                        @if (!$user->approved_by)
                            <span class="badge bg-info">Not yet</span>
                        @endif
                    </span>
                    <br>

                </div>


            </div>
            <span>Phone:{{ $user->profile->phone }}</span>
            <br>
            <span>Email:{{ $user->email }}</span>
            <br>
            <span>Address:{{ $user->profile->thana }},{{ $user->profile->postOffice }},{{ $user->profile->postCode }},{{ $user->profile->district }},{{ $user->profile->division }}</span>




        </div>
        <br><br><br>
        <div class="container-fluid">
            <span>Blood Donated (all)</span>
            <table class="bl-requests">
                <tr class="bl-requests-head">
                    <th>#</th>
                    <th>Name</th>
                    <th>Hospital name</th>
                    <th>Area</th>
                    <th>Reason</th>
                    <th>Date</th>

                </tr>

                @foreach ($donations as $request)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $request->patient_name }}</td>
                        <td>{{ $request->hospital_name }}</td>
                        <td>{{ $request->district }}</td>
                        <td>{{ $request->reason }}</td>
                        <td>{{ $request->completed_at }}</td>
                    </tr>
                @endforeach


            </table>
        </div>
        <br><br><br>
        <div width="300px" class="text-center">
            <span class="text-center ending">Thanks</span>
            <br>
            <hr>
            <span class="text-center">Copyright Reserved <b>@BDMS</b></span>
            <br>
            <span class="text-center">info@bdms.com</span>
        </div>
    </div>
    </div>



</body>

</html>
