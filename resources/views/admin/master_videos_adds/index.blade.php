@extends('admin.shared.main')

@section('content')
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('admin_dashboard') }}">Dashboard</a></li>
                <li class="breadcrumb-item active" aria-current="page">Iklan Video</li>
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
                        <h6 class="m-0 font-weight-bold text-primary">Tambah Iklan Video
                            <a href="{{ route('admin.video_adds.create') }}" class="btn btn-outline-success">
                                <i class="fa fa-plus" aria-hidden="true"></i></a>
                        </h6>
                    </div>

                    <table class="table table-striped">
                        <colgroup>
                            <col span="1" style="width: 5%;">
                            <col span="1" style="width: 70%;">
                            <col span="1" style="width: 15%;">
                        </colgroup>

                        <thead>
                            <tr>
                                <th>Video</th>
                                <th>Nama Video</th>
                                <th>Type</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>

                        <tbody>
                            @forelse ($videoAdds as $video_adds)
                                <tr>
                                    <td>
                                        <video width="250" height="auto" controls>
                                            <source src="{{ asset($video_adds->url) }}">
                                            Your browser does not support the video tag.
                                        </video>
                                    </td>
                                    <td>
                                        {{ $video_adds->title }}
                                    </td>
                                    <td>
                                        {{ $video_adds->type ?? '-' }}
                                    </td>
                                    <td>
                                        <div class="btn-group btn-group-sm" role="group"
                                            aria-label="Basic mixed styles example">
                                            <form action="{{ route('admin.video_adds.destroy', $video_adds->id) }}"
                                                method="post">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-warning">Hapus</button>
                                            </form>

                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="3">No Data</td>
                                </tr>
                            @endforelse

                        </tbody>
                    </table>

                </div>
            </div>

        </div>
    </div>

    <script>
        $(document).ready(function() {

        });
    </script>
@endsection
