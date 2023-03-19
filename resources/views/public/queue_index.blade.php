@extends('shared.main')

@section('content')
<div class="row col align-self-center">
    <div class="position-absolute top-50 start-50 translate-middle">

        <div class="row justify-content-md-center">
            <div class="col-md-4 bg-body rounded-3 p-3">
                <div class="mb-3 row">
                    <form action="{{ route('public.queue.index') }}" method="GET">
                        @csrf

                        <div class="row">
                            <div class="col-lg-10 mt-1">
                                <input type="text" class="form-control" id="inputPassword" name="id"
                                    value="{{ old('id') }}" placeholder="Kode Antrian">
                            </div>
                            <div class="col-lg-2 mt-1">
                                <button class="btn btn-primary form-control">Cari</button>
                            </div>
                        </div>
                    </form>
                </div>

                <div class="mb-3 row align-self-center">
                    <hr>
                    @if ($data['withData'] == true)
                    @if ($data['found'] === false)
                    <span class="text-center"> {{ $data['message'] }}</span>
                    @else

                    <table class="table caption-top">
                        <col style="width: 40%;" />
                        <col style="width: 60%;" />
                        <tr>
                            <td>Antrian saat ini: </td>
                            <td>{{ $data['currentQueue'] ?? '' }}</td>
                        </tr>
                        <tr>
                            <td>Pesan: </td>
                            <td>{{ $data['message'] ?? '' }}</td>
                        </tr>
                    </table>

                    @endif
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection