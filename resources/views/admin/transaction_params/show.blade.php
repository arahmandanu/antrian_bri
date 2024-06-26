@extends('admin.shared.main')

@section('content')
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('admin_dashboard') }}">Dashboard</a></li>
                <li class="breadcrumb-item"><a href=" {{ route('unit_codes.index') }} ">Type Transactions</a></li>
                <li class="breadcrumb-item active" aria-current="page">Edit Transactions</li>
            </ol>
        </nav>
    </div>

    <!-- Content Row -->
    <div class="row">
        <!-- Content Column -->
        <div class="col-lg-12 mb-4">

            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Type Transactions</h6>
                    <hr>
                </div>
                <div class="card-body">
                    @include('admin.shared.error_validation')
                    <form action="{{ route('admin.transactionParams.update', $transactionParams->id) }}" method="POST">
                        @csrf
                        @method('PUT')

                        <div class="mb-3">
                            <label for="exampleFormControlInput1" class="form-label">Unit Service</label>
                            <select name="unit_code_id" class="form-control" id="" required disabled>
                                @forelse ($unitCodes as $item)
                                    <option value="{{ $item->id }}" @if ($transactionParams->unit_code_id == $item->id ? 'selected' : '')  @endif>
                                        {{ $item->name }}</option>
                                @empty
                                    <option>DATA UNIT KOSONG</option>
                                @endforelse
                            </select>
                        </div>

                        <div class="mb-3">
                            <label for="exampleFormControlInput1" class="form-label">Transactions Code</label>
                            <input type="text" name="code" class="form-control" placeholder="Unit Code" disabled
                                value='{{ $transactionParams->code }}' min="4" max="4">
                        </div>

                        <div class="mb-3">
                            <label for="exampleFormControlInput1" class="form-label">Transactions Name</label>
                            <input type="text" name="name" class="form-control" placeholder="Unit name"
                                value='{{ $transactionParams->name }}'>
                        </div>

                        <button type="submit" class="btn btn-primary">Save</button>
                    </form>
                </div>
            </div>

        </div>
    </div>
@endsection
