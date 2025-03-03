@extends('admin.shared.main')

@section('content')
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('admin_dashboard') }}">Dashboard</a></li>
                <li class="breadcrumb-item active" aria-current="page">Currency</li>
            </ol>
        </nav>
    </div>

    <!-- Content Row -->
    <div class="row">
        <!-- Content Column -->
        <div class="col-lg-12 mb-4">

            <div class="card shadow mb-4">
                <div class="card-body">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Bendera</th>
                                <th>Kode Negara</th>
                                <th>Jual</th>
                                <th>Beli</th>
                                <th>Tampilkan</th>
                                <th>Action</th>
                            </tr>
                        </thead>

                        <tbody>
                            @forelse ($curencies as $kurs)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td><img style="width: 50px" src="{{ asset("flags/$kurs->url") }}" alt=""></td>
                                    <td>{{ $kurs->name }}</td>
                                    <td>{{ $kurs->jual }}</td>
                                    <td>{{ $kurs->beli }}</td>
                                    <td>
                                        @if ($kurs->show == '0')
                                            <span class="badge bg-danger">No</span>
                                        @else
                                            <span class="badge bg-success">Yes</span>
                                        @endif
                                    </td>
                                    <td>
                                        <div class="d-flex flex-row bd-highlight">
                                            <div class="bd-highlight"><a type="button"
                                                    class="btn btn-info btn-sm btn-block"
                                                    href="{{ route('kurs.edit', $kurs->id) }} "><i class="fa fa-pencil"
                                                        aria-hidden="true"> Edit</i></a>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="6">Data Kosong</td>
                                </tr>
                            @endforelse

                        </tbody>
                    </table>

                </div>
                <div class="card-header py-3">
                    {{ $curencies->links('vendor.pagination.bootstrap-5') }}
                </div>
            </div>

        </div>
    </div>
@endsection
