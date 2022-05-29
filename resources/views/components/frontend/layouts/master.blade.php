@include('sweetalert::alert')

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>BDMS</title>
    <!-- bootstrap css link start-->
    
 <link rel=”stylesheet”
 href=" https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">
    <!-- bootstrap css link end-->
    <!-- footer css here -->

    <!-- footer css end  -->
</head>

<body>
    <!-- Nav bar start -->
    <div class="p-5 bg-warning">
        <h4>Blood Donation Management System</h4>
    </div>
    <x-frontend.layouts.partials.header />

    <!-- nav bar end     -->


    <main>
        {{$slot}}
    </main>









    <!-- footer -->

    <section>




        {{-- footer --}}

        <!-- Footer -->
        <x-frontend.layouts.partials.footer />
        <!-- Footer -->
        {{-- footer end --}}
        <!-- bootstrap js cdn -->
        <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.js"></script>
        <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
        <script src="{{asset('division-json/division-load.js')}}"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
                integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous">
        </script>
</body>

</html>
