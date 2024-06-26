@extends('admin.shared.main')

@section('content')
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('admin_dashboard') }}">Dashboard</a></li>
                <li class="breadcrumb-item active" aria-current="page">Transactions</li>
            </ol>
        </nav>
    </div>

    <!-- Content Row -->
    <div class="row">
        <!-- Content Column -->
        <div class="col-lg-12 mb-4">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Type Transactions</h6>
                    <hr>
                    <div class="col-auto">
                        <a type="submit" href="{{ route('admin.transactionParams.create') }}"
                            class="btn btn-success mb-3">Add Type
                            Transactions</a>
                    </div>
                </div>

                <div class="card-body">
                    <table class="table table-striped" id="jenis_transaksi">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Unit</th>
                                <th>Transactions Code</th>
                                <th>Transactions Name</th>
                                <th>Action</th>
                            </tr>
                        </thead>

                        <tbody>
                            @forelse ($transactionParams as $item)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $item->unitCode->name }}</td>
                                    <td>{{ $item->code }}</td>
                                    <td>{{ Str::Upper($item->name) }}</td>
                                    <td>
                                        <div class="d-flex flex-row bd-highlight">
                                            <div class="bd-highlight"><a class="btn btn-info btn-sm"
                                                    href="{{ route('admin.transactionParams.show', $item->id) }}">
                                                    <i class="fa fa-pencil" aria-hidden="true"></i>
                                                </a>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                            @empty
                            @endforelse

                        </tbody>
                    </table>

                </div>
            </div>

        </div>
    </div>

    <script>
        $(document).ready(function() {
            $('#jenis_transaksi').DataTable();
        });
    </script>
@endsection
