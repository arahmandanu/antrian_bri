@extends('shared.main')

@section('content')
    <div class="row col align-self-center">
        <div class="position-absolute top-50 start-50 translate-middle">

            <div class=" row justify-content-md-center">
                <div class="col col-lg-6">
                    <div class="container">
                        <div id="map" style="height: 30vh;"></div>
                    </div>
                </div>
            </div>

            <div class="d-flex justify-content-center pt-5" style="text-align: center;">
                <h3 class="lead" style="font-weight: bold;">Silahkan klik tombol di bawah untuk mendapatkan antrian
                    anda</h3>
            </div>

            <div class="d-flex justify-content-center m-3">
                <a href="{{ route('barcode.showUnitServiceMenu') }}"
                    class="btn new-btn-custom-secondary new-btn-gradient rounded-pill" style="width: 400px">Ambil Antrian
                    Baru</a>
            </div>

            <div class="d-flex justify-content-center m-3">
                <a href="{{ route('public.queue.index') }}"
                    class="btn new-btn-custom-secondary new-btn-gradient rounded-pill" style="width: 400px">Lihat
                    Antrian</a>
            </div>

        </div>
    </div>

    <script>
        $(document).ready(function() {
            var marker = {!! json_encode($markerMap) !!};
            var map = L.map('map').setView([51.505, -0.09], 9);
            L.tileLayer('https://tile.openstreetmap.org/{z}/{x}/{y}.png', {
                maxZoom: 19,
                attribution: '&copy; <a href="http://www.openstreetmap.org/copyright">OpenStreetMap</a>'
            }).addTo(map);

            $.each(marker, function(i, v) {
                var marker = L.marker([v.latitude, v.longitude]).addTo(map);
                marker.bindPopup("<span>" + v.name + "</span><br>" + v.address).openPopup();
            });
        });

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
