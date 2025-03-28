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
                    <div class="card-header py-3">
                        <h6 class="m-0 font-weight-bold text-primary">Tambah Product
                            <a href="{{ route('admin.product.create') }}" class="btn btn-outline-success">
                                <i class="fa fa-plus" aria-hidden="true"></i></a>
                        </h6>
                    </div>

                    <table class="table table-striped">
                        <colgroup>
                            <col span="1" style="width: 5%;">
                            <col span="1" style="width: 70%;">
                            <col span="1" style="width: 15%;">
                            <col span="1" style="width: 10%;">
                        </colgroup>

                        <thead>
                            <tr>
                                <th>Tampilan</th>
                                <th>Nama Produk</th>
                                <th>Ditampilkan?</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>

                        <tbody>
                            @forelse ($masterProducts as $product)
                                <tr>
                                    <td>{{ $product->display_number }}</td>
                                    <td>{{ $product->name }}</td>
                                    <td>
                                        @if ($product->show)
                                            <span class="badge bg-success">Yes</span>
                                        @else
                                            <span class="badge bg-danger">No</span>
                                        @endif
                                    </td>
                                    <td>
                                        <div class="btn-group btn-group-sm" role="group"
                                            aria-label="Basic mixed styles example">
                                            <a href="{{ route('admin.product.edit', $product->id) }}" type="button"
                                                class="btn btn-warning">Edit</a>
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="4">No Data</td>
                                </tr>
                            @endforelse

                        </tbody>
                    </table>

                </div>
            </div>

        </div>
    </div>

    <script>
        $(document).ready(function() {

        });
    </script>
@endsection
