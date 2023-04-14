@extends('admin.shared.main')

@section('content')
<!-- Page Heading -->
<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('admin_dashboard') }}">Dashboard</a></li>
            <li class="breadcrumb-item active" aria-current="page">Users</li>
        </ol>
    </nav>
</div>

<!-- Content Row -->
<div class="row">
    <!-- Content Column -->
    <div class="col-lg-12 mb-4">

        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Users <a href="{{ route('user.create') }}"
                        class="btn btn-outline-success">
                        <i class="fa fa-plus" aria-hidden="true"></i></a></h6>

            </div>
            <div class="card-body">
                <table class="table table-striped" id="user">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama</th>
                            <th>Email</th>
                            <th>Role</th>
                            <th>Unit</th>
                            <th>Action</th>
                        </tr>
                    </thead>

                    <tbody>
                        @forelse ($users as $user)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $user->name }}</td>
                            <td>{{ $user->email }}</td>
                            <td><span class="badge bg-{{ $user->roleName() == 'admin' ? 'success' : 'info' }}">
                                    {{ $user->roleName() }} </span></td>
                            <td>{{ $user->unit->name ?? '-' }}</td>
                            <td>
                                <a class="btn btn-primary" href="{{ route('user.show', $user->id) }}"><i
                                        class="fa fa-pencil" aria-hidden="true"></i></a>
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
    $('#user').DataTable({
            dom: 'frtip',
        });
</script>
@endsection