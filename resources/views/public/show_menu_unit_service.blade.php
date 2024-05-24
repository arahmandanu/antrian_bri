@extends('shared.main')

@section('content')
    <div class="row justify-content-md-center mt-3">
        <div class="col-lg-6">
            <div class="container-fluid" style="height: 60vh">
                <div class="d-grid gap-1 col-12 mx-auto h-100 d-inline-block" id="divElement">

                    @forelse ($unitCodes as $item)
                        @if ($item->code == 'A')
                            <button onclick="nextMenu('{{ $item->code }}')"
                                style="
                            border: 0;
                            background: none;
                            box-shadow: none;
                            border-radius: 0px;
                            margin: 0;
                            border-bottom:none;
                            background:linear-gradient(#faa901,#faa901) bottom /* left or right or else */ no-repeat;
                            background-size:50% 2px">
                                <h1 class="display-2 text-black" style="font-family: 'boxicons'; color:">
                                    <span>{{ $item->name }}</span>
                                </h1>
                            </button>
                        @else
                            <button onclick="nextMenu('{{ $item->code }}')"
                                style="
                            border: 0;
                            background: none;
                            box-shadow: none;
                            border-radius: 0px;  margin: 0">
                                <h1 class="display-2 text-black" style="font-family: 'boxicons';">
                                    {{ $item->name }}</h1>
                            </button>
                        @endif
                    @empty
                    @endforelse
                    </button>
                </div>
            </div>
        </div>
    </div>

    <script>
        function nextMenu(type) {
            var latitude = document.getElementById('local_latitude').value;
            var longitude = document.getElementById('local_longitude').value;
            var query = "?type=" + type + "&latitude=" + latitude + "&longitude=" + longitude;
            window.location.href = "{{ route('barcode.newBarcode') }}" + query;
        }
    </script>
@endsection
