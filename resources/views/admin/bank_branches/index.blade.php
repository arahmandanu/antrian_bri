@extends('admin.shared.main')

@section('content')
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('admin_dashboard') }}">Dashboard</a></li>
                <li class="breadcrumb-item active" aria-current="page">Master Bank Branches</li>
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
                    <form class="row g-3" method="GET" action="{{ route('admin.bank_branches.index') }}">
                        @csrf
                        <div class="col-auto">
                            <label for="inputname" class="visually-hidden">Name</label>
                            <input type="text" name="name" class="form-control" id="inputname"
                                placeholder="Branch Name" value='{{ old(' name') }}'>
                        </div>

                        <div class="col-auto">
                            <button type="submit" class="btn btn-primary mb-3">Search</button>
                        </div>

                        <div class="col-auto">
                            <a type="submit" href="{{ route('admin.bank_branches.create') }}"
                                class="btn btn-success mb-3">Add
                                Branch</a>
                        </div>
                    </form>
                </div>
                <div class="card-body">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Area Name</th>
                                <th>Branch Code</th>
                                <th>Branch Name</th>
                                <th>Action</th>
                            </tr>
                        </thead>

                        <tbody>
                            @forelse ($bankBranches as $bank)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $bank->area->name }}</td>
                                    <td>{{ $bank->code }}</td>
                                    <td>{{ $bank->name }}</td>
                                    <td>
                                        <div class="d-flex flex-row bd-highlight">
                                            <div class="bd-highlight"><a type="button"
                                                    class="btn btn-info btn-sm btn-block"
                                                    href="{{ route('admin.bank_branches.show', $bank->code) }} "><i
                                                        class="fa fa-pencil" aria-hidden="true"></i></a>
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
                    {{ $bankBranches->links('vendor.pagination.bootstrap-5') }}
                </div>
            </div>

        </div>
    </div>
@endsection
