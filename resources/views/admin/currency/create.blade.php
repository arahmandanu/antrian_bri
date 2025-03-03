@extends('admin.shared.main')

@section('content')
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('admin_dashboard') }}">Dashboard</a></li>
                <li class="breadcrumb-item"><a href="{{ route('kurs.index') }}">Currency</a></li>
                <li class="breadcrumb-item active" aria-current="page">Tambah Kurs</li>
            </ol>
        </nav>
    </div>

    <!-- Content Row -->
    <div class="row">
        <!-- Content Column -->
        <div class="col-lg-12 mb-4">

            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">New</h6>
                    <hr>
                </div>
                <div class="card-body">
                    <form action="{{ route('admin.bank_branches.store') }}" method="POST">
                        @csrf

                        <div class="mb-3">
                            <label for="exampleFormControlInput1" class="form-label">Negara</label>
                            <select name="name" class="form-control">
                                <option value="">-- Area --</option>
                                {{-- @forelse ($bankAreas as $bankArea)
                                    <option value="{{ $bankArea->code }}">{{ $bankArea->name }} - {{ $bankArea->code }}
                                    </option>
                                @empty
                                    <option value="" selected>No Data Found</option>
                                @endforelse --}}
                            </select>

                            @error('name')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="exampleFormControlInput1" class="form-label">Jual</label>
                            <input type="text" name="jual"
                                class="form-control {{ $errors->has('jual') ? 'is-invalid' : '' }}"
                                placeholder="Branch Code" value='{{ old(' jual') }}'>

                            @error('jual')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="exampleFormControlInput1" class="form-label">Beli</label>
                            <input type="text" name="beli"
                                class="form-control {{ $errors->has('beli') ? 'is-invalid' : '' }}"
                                placeholder="Branch Name" value='{{ old(' beli') }}'>
                            @error('beli')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <button type="submit" class="btn btn-primary">Save</button>
                    </form>
                </div>
            </div>

        </div>
    </div>
@endsection
