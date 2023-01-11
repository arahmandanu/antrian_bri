@extends('shared.main')

@section('content')
    <div class="w-100 overflow-hidden bg-gray-100" id="top">

        <div class="container position-relative">
            <div class="row  py-vh-6">
                <div class="col-lg-12 position-relative" data-aos="fade-right" id="mycanvas">
                    <h2 class="mt-5">Nomor Antrian - {{ $numberQueue }}</h2>
                    {!! $barcode !!}
                    <strong> {{ $dateQueue }}</strong>
                </div>
                <div class="col-lg-12 py-vh-3" data-aos="fade-right">
                    <h2>Silahkan simpan url ini atau Download</h2>
                    <button onclick="download()" class="btn btn-dark btn-xl shadow me-3 rounded-0 my-2">Download</button>
                </div>
            </div>
        </div>

    </div>

    <script>
        function download() {
            domtoimage.toJpeg(document.getElementById('mycanvas'), {
                    quality: 1,
                    bgcolor: 'white',
                    width: 500,
                    height: 500
                })
                .then(function(dataUrl) {
                    var link = document.createElement('a');
                    link.download = '{{ $nameQueue }}.jpeg';
                    link.href = dataUrl;
                    link.click();
                });
        }
    </script>
@endsection
