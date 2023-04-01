<!doctype html>
<html class="h-100" lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width,initial-scale=1,shrink-to-fit=no">
    <meta name="description" content="System antrian BRI">
    <meta name="HandheldFriendly" content="true">
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <script src="{{ asset('js/app.js') }}"></script>

    <style>
        h6.font-call {
            color: white;
        }
    </style>

</head>

<body>
    <div class="container">
        <div class="row justify-content-md-center">
            <div class="col-md-auto mt-5" style="text-align: center;">
                <img src="{{ asset('images/bri-logo.png') }}" alt="">
            </div>
        </div>
        <div class="row">
            @yield('content')
        </div>

    </div>
</body>

</html>