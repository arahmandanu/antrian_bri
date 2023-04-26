@extends('admin.shared.main')

@section('content')
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('admin_dashboard') }}">Dashboard</a></li>
                <li class="breadcrumb-item active" aria-current="page">Master Bank</li>
            </ol>
        </nav>
    </div>

    <!-- Content Row -->
    <div class="row">
        <!-- Content Column -->
        <div class="col-lg-12 mb-4">

            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Bank</h6>
                    <hr>
                    <form class="row g-3" method="GET" action="{{ route('banks.index') }}">
                        <div class="col-auto">
                            <label for="inputcode" class="visually-hidden">Code</label>
                            <input type="text" name="code" class="form-control" id="inputcode" placeholder="Bank Code"
                                value='{{ old(' code') }}'>
                        </div>
                        <div class="col-auto">
                            <label for="inputname" class="visually-hidden">Name</label>
                            <input type="text" name="name" class="form-control" id="inputname" placeholder="Bank Name"
                                value='{{ old(' name') }}'>
                        </div>
                        <div class="col-auto">
                            <label for="inputaddress" class="visually-hidden">Address</label>
                            <input type="text" name="address" class="form-control" id="inputaddress"
                                placeholder="Bank Address" value='{{ old(' address') }}'>
                        </div>
                        <div class="col-auto">
                            <button type="submit" class="btn btn-primary mb-3">Search</button>
                        </div>
                        <div class="col-auto">
                            <a type="submit" href="{{ route('banks.create') }}" class="btn btn-success mb-3">Add Bank</a>
                        </div>
                    </form>
                </div>
                <div class="card-body">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th class="col-1">No</th>
                                <th class="col-2">Bank Code</th>
                                <th class="col-2">Bank Name</th>
                                <th>Bank Address</th>
                                <th>Action</th>
                            </tr>
                        </thead>

                        <tbody>
                            @forelse ($banks as $bank)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $bank->code }}</td>
                                    <td>{{ $bank->name }}</td>
                                    <td>{{ $bank->address }}</td>
                                    <td>
                                        <div class="d-flex flex-row bd-highlight">
                                            <div class="bd-highlight"><a type="button"
                                                    class="btn btn-info btn-sm btn-block"
                                                    href="{{ route('banks.show', $bank->code) }} "><i class="fa fa-pencil"
                                                        aria-hidden="true"></i></a>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="5">No Data</td>
                                </tr>
                            @endforelse

                        </tbody>
                    </table>

                </div>
                <div class="card-header py-3">
                    {{ $banks->links('vendor.pagination.bootstrap-5') }}
                </div>
            </div>

        </div>
    </div>
@endsection
