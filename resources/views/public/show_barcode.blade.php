@extends('shared.main_2')

@section('content')
<div class="position-relative">
    <div class="position-absolute top-0 start-50 translate-middle-x mt-5">
        <table>
            <tr id="mycanvas">
                <td class="text-center">
                    <h2>Nomor Antrian - {{ $unitCode.$numberQueue }}</h2>
                    <strong class="text-center"> {{ $bankCode }} / {{ $dateQueue }}</strong>
                    <div class="row justify-content-center p-5">
                        {!! $barcode !!}
                    </div>
                    <h6>Kode Antrian - {{ $id }}</h6>
                </td>
            </tr>
            <tr>
                <td class="text-center">
                    <h4>Silahkan simpan QrCode ini atau Download</h4>
                    <button onclick="download()"
                        class="btn btn-dark btn-xl shadow me-3 rounded-pill my-2">Download</button>
                </td>
            </tr>
        </table>
    </div>
</div>

<script>
    function download() {
            domtoimage.toJpeg(document.getElementById('mycanvas'), {
                    quality: 1,
                    bgcolor: 'white',
                    width: 290,
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