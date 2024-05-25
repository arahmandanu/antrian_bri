@extends('admin.shared.main')

@section('content')
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('admin_dashboard') }}">Dashboard</a></li>
                <li class="breadcrumb-item active" aria-current="page">Map</li>
            </ol>
        </nav>
    </div>

    <!-- Content Row -->
    <div class="row">
        <!-- Content Column -->
        <div class="col-lg-12 mb-4">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Lokasi Bank</h6>
                    <hr>

                    <div style="height: 70vh" id="map"></div>
                </div>
            </div>
        </div>
    </div>

    <script>
        $(document).ready(function() {
            var marker = {!! json_encode($banks) !!};
            var map = L.map('map').setView([51.505, -0.09], 12);
            L.tileLayer('https://tile.openstreetmap.org/{z}/{x}/{y}.png', {
                maxZoom: 19,
                attribution: '&copy; <a href="http://www.openstreetmap.org/copyright">OpenStreetMap</a>'
            }).addTo(map);

            $.each(marker, function(i, v) {
                var marker = L.marker([v.latitude, v.longitude]).addTo(map);
                marker.bindPopup("<span>" + v.name + "</span><br>" + v.address).openPopup();
            });

        });
    </script>
@endsection
