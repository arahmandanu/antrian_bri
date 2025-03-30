@extends('admin.shared.main')

@section('content')
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('admin_dashboard') }}">Dashboard</a></li>
                <li class="breadcrumb-item active" aria-current="page">Produk Details</li>
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
                    <form action="{{ route('admin.product_detail.store') }}" method="post">
                        @csrf
                        <div class="mb-3">
                            <label for="inputCity" class="form-label">Nama Product</label>
                            <select id="chooseProduct" class="form-select" required name="master_product_id">
                                <option value="" selected>Choose...</option>
                                @foreach ($products as $product)
                                    <option value="{{ $product->id }}">{{ $product->name }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="mb-3">
                            <label for="inputCity" class="form-label">Value</label>
                            <input type="text" class="form-control" id="inputCity" name="value" required
                                value="">
                        </div>

                        <div class="mb-3">
                            <label for="inputCity" class="form-label">Suku Bunga</label>
                            <input type="text" class="form-control" id="inputCity" name="suku_bunga" required
                                value="">
                        </div>

                        <div class="mb-3">
                            <label for="inputState" class="form-label">Nomor Tampilan</label>
                            <select id="display_number" class="form-select" required name="display_number">
                                <option value="">--Silahkan Pilih Product--</option>
                            </select>
                        </div>

                        <div class="mb-3">
                            <button type="submit" class="btn btn-primary">Simpan</button>
                        </div>
                    </form>
                </div>
            </div>

        </div>
    </div>

    <script>
        $(document).ready(function() {
            $('select#chooseProduct').on('change', function() {
                $.get("{{ route('admin.product_detail.displayNumberByProductId', ['productId']) }}"
                    .replace('productId', this.value), {},
                    function(data, textStatus, jqXHR) {
                        console.log(data.data)
                        $("select#display_number").html(data.data);
                    },
                    "Json"
                );
            });
        });
    </script>
@endsection
