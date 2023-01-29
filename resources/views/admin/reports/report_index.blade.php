@extends('admin.shared.main')

@section('content')
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h3 class="h3 mb-0 text-gray-800"> <a href="{{ route('admin_dashboard') }}"> Dashboard </a> > Master Bank</h3>
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
                                   value='{{ old('code') }}'>
                        </div>
                        <div class="col-auto">
                            <label for="inputname" class="visually-hidden">Name</label>
                            <input type="text" name="name" class="form-control" id="inputname" placeholder="Bank Name"
                                   value='{{ old('name') }}'>
                        </div>
                        <div class="col-auto">
                            <label for="inputaddress" class="visually-hidden">Address</label>
                            <input type="text" name="address" class="form-control" id="inputaddress"
                                   placeholder="Bank Address" value='{{ old('address') }}'>
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
                    <table class="table table-striped" id="report">
                        <thead>
                        <tr>
                            <th>No</th>
                            <th>Bank Code</th>
                            <th>Bank Name</th>
                            <th>Bank Address</th>
                            <th>Action</th>
                        </tr>
                        </thead>

                        <tbody>
                        </tbody>
                    </table>

                </div>
                <div class="card-header py-3">
                </div>
            </div>

        </div>
    </div>

    <script>
        $(document).ready(function() {
            $('#report').DataTable( {
                dom: 'Bfrtip',
                buttons: [
                    'copy', 'csv', 'excel', 'pdf', 'print'
                ]
            } );
        } );
    </script>
@endsection
