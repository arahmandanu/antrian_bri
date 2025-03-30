@extends('admin.shared.main')

@section('content')
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('admin_dashboard') }}">Dashboard</a></li>
                <li class="breadcrumb-item active" aria-current="page">Produk</li>
            </ol>
        </nav>
    </div>

    <!-- Content Row -->
    <div class="row">
        <!-- Content Column -->
        <div class="col-lg-12 mb-4">

            <div class="card shadow mb-4">
                <div class="card-body">
                    @include('admin.shared.error_validation')
                    <form action="{{ route('admin.product_detail.update', $productDetail->id) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="mb-3">
                            <label for="inputCity" class="form-label">Name Product: <b>{{ $masterProduct }}</b></label>
                        </div>

                        <div class="mb-3">
                            <label for="inputCity" class="form-label">Value</label>
                            <input type="text" class="form-control" id="inputCity" name="value" required
                                value="{{ $productDetail->value }}">
                        </div>

                        <div class="mb-3">
                            <label for="inputCity" class="form-label">Suku Bunga</label>
                            <input type="text" class="form-control" id="inputCity" name="suku_bunga" required
                                value="{{ $productDetail->suku_bunga }}">
                        </div>

                        <div class="mb-3">
                            <label for="inputState" class="form-label">Nomor Tampilan</label>
                            <select id="inputState" class="form-select" required name="display_number">
                                <option value="" selected>Choose...</option>
                                @foreach ($displayNumber as $item)
                                    <option @if ($item == $productDetail->display_number) selected @endif value="{{ $item }}">
                                        {{ $item }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="mb-1">
                            <button type="submit" class="btn btn-primary">Simpan</button>
                        </div>
                    </form>
                </div>
            </div>

        </div>
    </div>

    <script>
        $(document).ready(function() {

        });
    </script>
@endsection
