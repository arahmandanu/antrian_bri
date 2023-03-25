@extends('admin.shared.main')

@section('content')
<!-- Page Heading -->
<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Dashboard</h1>
</div>

<!-- Content Row -->
<div class="row">

    <div class=" card col-xl-12 col-md-6 mb-4 text-center ">
        <div class="card-body">
            <h3 class="card-title">Selamat datang {{ auth()->user()->name }}</h3>
            <h5 class="card-text">Anda terdaftar sebagai operator.</h5>
            <h5 class="card-text">Unit {{ auth()->user()->unit->code }} - {{ auth()->user()->unit->name }}</h5>
        </div>
    </div>
    @endsection