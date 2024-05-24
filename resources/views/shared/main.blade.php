<!doctype html>
<html class="h-100" lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width,initial-scale=1,shrink-to-fit=no">
    <meta name="description" content="System antrian BRI">
    <meta name="HandheldFriendly" content="true">
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <link rel="stylesheet" href="{{ asset('vendor/leaflet/leaflet.css') }}">
    <script src="{{ asset('js/app.js') }}"></script>
    <script src="{{ asset('vendor/leaflet/leaflet.js') }}"></script>
    <style>
        body {
            background-image: linear-gradient(to bottom, rgba(255, 0, 0, 0), rgb(12, 14, 145));
        }

        p.font-call {
            color: white;
            font-size: 0.675em;
        }

        img#call_bri {
            width: 80px;
        }

        img#mobile_queue {
            width: 90px;
        }
    </style>

</head>

<body>
    <input type="hidden" name='latitude' id="local_latitude">
    <input type="hidden" name='longitude' id="local_longitude">

    <div class="container">
        <div class="row justify-content-md-center">
            <div class="col-md-auto mt-3" style="text-align: center;">
                <a href="{{ url('/') }}">
                    <img src="{{ asset('images/bri-logo.png') }}" alt="">
                    <br>
                    <img src="{{ asset('images/eBiru.png') }}" alt="" id="mobile_queue">
                </a>

            </div>
        </div>

        @yield('content')

        <div class="position-absolute bottom-0 start-50 translate-middle-x mb-2 rounded-circle">
            <div class="row justify-content-md-center">
                <img src="{{ asset('images/CALL_BRI.png') }}" class="img-responsive center-block d-block mx-auto"
                    alt="" id="call_bri">
            </div>
            <div class="row justify-content-md-center">
                <p class="font-call text-center">Powered by Bank Rakyat Indonesia <br> Apllication Version EMQ 23.1
                </p>
            </div>
        </div>
    </div>
</body>

<script>
    $(document).ready(function() {
        if (navigator.geolocation) {
            navigator.geolocation.getCurrentPosition(assignData);
        } else {
            false;
        }
    });

    function assignData(position) {
        $('input#local_latitude').val(position.coords.latitude);
        $('input#local_longitude').val(position.coords.longitude);
    }
</script>

</html>
