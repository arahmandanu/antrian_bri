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
                    <form action="{{ route('admin.video_adds.store') }}" method="post">
                        @csrf
                        <div class="col-12">
                            <div class="mb-3">
                                <label for="formFile" class="form-label">File Name</label>
                                <label for="formFile" class="form-label">Tambahkan extension dibelakang nya</label>
                                <input class="form-control" type="text" id="formFile" name="title" required
                                    placeholder="tes.mp4">
                            </div>
                        </div>

                        <div class="col-12">
                            <div class="mb-3">
                                <label for="formFile" class="form-label">Type</label>
                                <label for="formFile" class="form-label">Type must have prefix kcp_ or unit_</label>
                                <select class="form-control" id="formFile" name="type" required>
                                    @foreach ($types as $key => $value)
                                        <option value="{{ $key }}">{{ $value }}</option>
                                    @endforeach
                                </select>
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
