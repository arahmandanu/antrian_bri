@extends('admin.shared.main')

@section('content')
<!-- Page Heading -->
<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item active" aria-current="page">Dashboard</li>
        </ol>
    </nav>
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