@extends('admin.shared.main')

@section('content')
<!-- Page Heading -->
<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('admin_dashboard') }}">Dashboard</a></li>
            <li class="breadcrumb-item active" aria-current="page">Employees</li>
        </ol>
    </nav>
</div>

<!-- Content Row -->
<div class="row">
    <!-- Content Column -->
    <div class="col-lg-12 mb-4">

        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">CS/TELLER Name</h6>
                <hr>
                <form class="row g-3" method="GET" action="{{ route('operator.button_actor.index') }}">
                    @csrf
                    <div class="col-auto">
                        <label for="inputname" class="visually-hidden">Name</label>
                        <input type="text" name="name" class="form-control" id="inputname" placeholder="Name"
                            value='{{ old(' name') }}'>
                    </div>

                    <div class="col-auto">
                        <button type="submit" class="btn btn-primary mb-3">Search</button>
                    </div>

                    <div class="col-auto">
                        <a type="submit" href="{{ route('operator.button_actor.create') }}"
                            class="btn btn-success mb-3">Add
                            Employee</a>
                    </div>
                </form>
            </div>
            <div class="card-body">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>NPK</th>
                            <th>Name</th>
                            <th>Action</th>
                        </tr>
                    </thead>

                    <tbody>
                        @forelse ($actors as $actor)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $actor->code }}</td>
                            <td>{{ $actor->name }}</td>
                            <td>
                                <div class="d-flex flex-row bd-highlight">
                                    <div class="bd-highlight"><a type="button" class="btn btn-info btn-sm btn-block"
                                            href="{{ route('operator.button_actor.show', $actor->id) }} "><i
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
                {{ $actors->links('vendor.pagination.bootstrap-5') }}
            </div>
        </div>

    </div>
</div>
@endsection