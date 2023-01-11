@extends('shared.main')

@section('content')
    <div class="w-100 overflow-hidden bg-gray-100" id="top">

        <div class="container position-relative">
            <div class="row">

                <div class="col-lg-12 py-vh-6 position-relative" data-aos="fade-right"></div>

                <marquee direction="left" scrollamount="2" align="center" style="font-size: 50px">Selamat datang di aplikasi
                    antrian online BRI
                </marquee>

                <div class="d-flex justify-content-center" style="text-align: center;">
                    {{-- <h2 class="display-1 fw-bold mt-5">Selamat datang di aplikasi antrian online BRI</h2> --}}
                    <h3 class="lead">Silahkan klik tombol di bawah untuk mendapatkan antrian anda</h3>
                </div>

                <div class="d-flex justify-content-center">
                    <a href="{{ route('barcode.show_form') }}"
                        class="btn new-btn-custom-secondary new-btn-gradient">Generate
                        Barcode
                        Antrian</a>
                </div>
            </div>
        </div>

    </div>
    <script>
        const successCallback = (position) => {
            console.log(position);
        };

        const errorCallback = (error) => {
            console.log(error);
        };

        navigator.geolocation.getCurrentPosition(successCallback, errorCallback, {
            enableHighAccuracy: true,
            maximumAge: 2000,
            timeout: 5000
        });
    </script>
@endsection
