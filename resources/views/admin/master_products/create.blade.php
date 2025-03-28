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
                    <form action="{{ route('admin.product.store') }}" method="post">
                        @csrf
                        <div class="col-md-6">
                            <label for="inputCity" class="form-label">Nama Product</label>
                            <input type="text" class="form-control" id="inputCity" name="name" required>
                        </div>
                        <div class="col-md-4">
                            <label for="inputState" class="form-label">Nomor Tampilan</label>
                            <select id="inputState" class="form-select" required name="display_number">
                                <option value="" selected>Choose...</option>
                                @foreach ($display as $item)
                                    <option value="{{ $item }}">{{ $item }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-12">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" id="gridCheck"name="show" value="1">
                                <label class="form-check-label" for="gridCheck">
                                    Ditampilkan ?
                                </label>
                            </div>
                        </div>
                        <div class="col-12">
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
