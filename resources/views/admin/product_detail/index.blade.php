@extends('admin.shared.main')

@section('content')
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('admin_dashboard') }}">Dashboard</a></li>
                <li class="breadcrumb-item active" aria-current="page"><a href="{{ route('admin.product.index') }}">Produk</a>
                </li>
                <li class="breadcrumb-item active" aria-current="page">Detail</li>
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
                        <select class="form-select" aria-label="Default select example" id="selectProduct">
                            <option selected>-- Pilih Product --</option>
                            @foreach ($products as $item)
                                <option value="{{ $item->id }}">{{ $item->name }}</option>
                            @endforeach
                        </select>
                        <hr>
                        <h6 class="m-0 font-weight-bold text-primary">Tambah Detail
                            <a href="{{ route('admin.product_detail.create') }}" class="btn btn-outline-success">
                                <i class="fa fa-plus" aria-hidden="true"></i></a>
                        </h6>
                    </div>

                    <table class="table table-striped" id="detailProducts">
                        <colgroup>
                            <col span="1" style="width: 10%;">
                            <col span="1" style="width: 60%;">
                            <col span="1" style="width: 20%;">
                            <col span="1" style="width: 10%;">
                        </colgroup>
                        <thead>
                            <tr>
                                <th>Nomor Urut</th>
                                <th>Value</th>
                                <th>Suku Bunga</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <script>
        $(document).ready(function() {
            $('select#selectProduct').on('change', function() {
                $.get("{{ route('admin.product_detail.show', '') }}" + '/' + this.value, {},
                    function(data, textStatus, jqXHR) {
                        $("table#detailProducts").find("tbody").html(data.data);
                    },
                    "Json"
                );
            });

            var id = {!! $id !!};
            if (!$.isEmptyObject(id.id)) {
                $("select#selectProduct").val(id.id).change();
            }
        });
    </script>
@endsection
