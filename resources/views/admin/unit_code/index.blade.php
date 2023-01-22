@extends('admin.shared.main')

@section('content')
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800"> <a href="{{ route('admin_dashboard') }}"> Dashboard </a> > Unit Codes</h1>
    </div>

    <!-- Content Row -->
    <div class="row">
        <!-- Content Column -->
        <div class="col-lg-12 mb-4">

            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Unit Code</h6>
                    <hr>
                    <form class="row g-3" method="GET" action="{{ route('unit_codes.index') }}">
                        <div class="col-auto">
                            <label for="inputcode" class="visually-hidden">Code</label>
                            <input type="text" name="code" class="form-control" id="inputcode" placeholder="Bank Code"
                                value='{{ old('code') }}'>
                        </div>
                        <div class="col-auto">
                            <button type="submit" class="btn btn-primary mb-3">Search</button>
                        </div>
                        <div class="col-auto">
                            <a type="submit" href="{{ route('unit_codes.create') }}" class="btn btn-success mb-3">Add
                                Unit Code</a>
                        </div>
                    </form>
                </div>
                <div class="card-body">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Unit Code</th>
                                <th>Name Code</th>
                                <th>Action</th>
                            </tr>
                        </thead>

                        <tbody>
                            @forelse ($unitCodes as $unitCode)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $unitCode->code }}</td>
                                    <td>{{ $unitCode->name }}</td>
                                    <td>
                                        <div class="d-flex flex-row bd-highlight">
                                            <div class="p-2 bd-highlight"><a class="btn btn-info btn-sm"
                                                    href="{{ route('unit_codes.show', $unitCode->id) }}">
                                                    <i class="fa fa-pencil" aria-hidden="true"></i>
                                                </a></div>
                                            <div class="p-2 bd-highlight">
                                                <form class='form'
                                                    action="{{ route('unit_codes.destroy', $unitCode->id) }}"
                                                    method="POST">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-danger btn-sm"><i
                                                            class="fa fa-trash-o" aria-hidden="true"></i></button>
                                                </form>
                                            </div>
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

                <div class="card-header py-3">
                    {{ $unitCodes->links('vendor.pagination.bootstrap-5') }}
                </div>
            </div>

        </div>
    </div>
@endsection
