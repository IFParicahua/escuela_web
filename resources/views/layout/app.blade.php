<style>body {
        background-image: url({{'O6VPZL0.jpg'}});
        background-repeat: no-repeat;
        background-attachment: fixed;
        background-size: cover;
        background-color: #464646;
    }
</style>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="{{ asset('css/login.css') }}"/>
    <link rel="stylesheet" href="{{ asset('style.css') }}"/>
    <link rel="stylesheet" href="{{ asset('boostrap/css/bootstrap.min.css') }}"/>
    <link rel="stylesheet" href="{{ asset('boostrap/js/bootstrap.min.js') }}"/>
    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <title>dashboard</title>
</head>
<body>


<div class="container">
    <!--vertical align on parent using my-auto, horizontal align on self mx-auto-->
    @yield('content')
</div>

<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"
        integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q"
        crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"
        integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl"
        crossorigin="anonymous"></script>
</body>
</html>
