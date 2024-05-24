@extends('shared.main')

@section('content')
    <div class="row justify-content-md-center mt-3">
        <div class="col-lg-6">
            <div class="container-fluid" style="height: 60vh">
                <div class="d-grid gap-1 col-12 mx-auto h-100 d-inline-block" id="divElement">
                    <button onclick="nextMenu('A')"
                        style="
                            border: 0;
                            background: none;
                            box-shadow: none;
                            border-radius: 0px;
                            margin: 0;
                            border-bottom:none;
                            background:linear-gradient(#faa901,#faa901) bottom /* left or right or else */ no-repeat;
                            background-size:50% 2px">
                        <h1 class="display-1 text-black" style="font-family: 'boxicons'; color:"><span>Teller</span></h1>
                    </button>

                    <button onclick="nextMenu('B')"
                        style="
                            border: 0;
                            background: none;
                            box-shadow: none;
                            border-radius: 0px;  margin: 0">
                        <h1 class="display-2 text-black" style="font-family: 'boxicons';">Customer Service</h1>
                    </button>
                </div>
            </div>
        </div>
    </div>

    <script>
        function nextMenu(type) {
            var latitude = document.getElementById('local_latitude').value;
            var longitude = document.getElementById('local_longitude').value;
            var query = "?latitude=" + latitude + "&longitude=" + longitude;
            window.location.href = "{{ route('barcode.newBarcode', '') }}" + "/" + type + query;
        }
    </script>
@endsection
