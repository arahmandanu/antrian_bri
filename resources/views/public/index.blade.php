@extends('shared.main')

@section('content')
    <div class="row col align-self-center">
        <div class="position-absolute top-50 start-50 translate-middle">

            <div class=" row justify-content-md-center">
                <div class="col col-lg-6">
                    <marquee direction="left" scrollamount="2" align="center" style="font-size: 50px">Selamat datang di aplikasi
                        antrian online BRI
                    </marquee>
                </div>
            </div>

            <div class="d-flex justify-content-center" style="text-align: center;">
                <h3 class="lead" style="font-weight: bold;">Silahkan klik tombol di bawah untuk mendapatkan antrian
                    anda</h3>
            </div>

            <div class="d-flex justify-content-center">
                <a href="{{ route('barcode.show_form') }}"
                    class="btn new-btn-custom-secondary new-btn-gradient rounded-pill">Generate
                    Barcode
                    Antrian</a>
            </div>
        </div>
    </div>
    <script>
        const successCallback = (position) => {
            // console.log(position);
        };

        const errorCallback = (error) => {
            // console.log(error);
        };

        navigator.geolocation.getCurrentPosition(successCallback, errorCallback, {
            enableHighAccuracy: true,
            maximumAge: 2000,
            timeout: 5000
        });
    </script>
@endsection
