@extends('admin.shared.main')

@section('content')
<!-- Page Heading -->
<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ route('admin_dashboard') }}">Dashboard</a></li>
        <li class="breadcrumb-item"><a href="{{ route('banks.index') }}">Master
                Bank</a></li>
        <li class="breadcrumb-item active" aria-current="page">{{ $bank->name }}</li>
    </ol>
</div>

<!-- Content Row -->
<div class="row">
    <!-- Content Column -->
    <div class="col-lg-12 mb-4">
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Show</h6>
                <hr>
            </div>
            <div class="card-body">
                <form action="{{ route('banks.update', $bank->id) }}" method="POST">
                    @method('PUT')
                    @csrf
                    <div class="mb-3">
                        <label for="exampleFormControlInput1" class="form-label">Area Code</label>
                        <input disabled type="text" class="form-control" placeholder="Area Bank Code"
                            value="{{ $bank->Area_Code }}">
                    </div>

                    <div class="mb-3">
                        <label for="exampleFormControlInput1" class="form-label">Branch Code</label>
                        <select name="KC_Code" class="form-control">
                            <option value="">-- Cabang --</option>
                            @forelse ($bankBranches as $bankBranch)
                            <option {{ $bank->KC_Code == $bankBranch->code ? 'selected' : '' }}
                                value="{{ $bankBranch->code }}">{{ $bankBranch->name }} -
                                {{ $bankBranch->code }}
                            </option>
                            @empty
                            <option value="" selected>No Data Found</option>
                            @endforelse
                        </select>

                        @error('KC_Code')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="exampleFormControlInput1" class="form-label">KC/KCP/KK/Unit Code (5 digit)</label>
                        <input type="text" name="code"
                            class="form-control {{ $errors->has('code') ? 'is-invalid' : '' }}" placeholder="Bank Code"
                            value="{{ $bank->code }}">
                    </div>
                    <div class="mb-3">
                        <label for="exampleFormControlInput1" class="form-label">Name</label>
                        <input type="text" name="name"
                            class="form-control {{ $errors->has('name') ? 'is-invalid' : '' }}" placeholder="Bank Name"
                            value="{{ $bank->name }}">
                    </div>
                    <div class="mb-3">
                        <label for="exampleFormControlTextarea1" class="form-label">Kota</label>
                        <input placeholder="Bank Address" type="text"
                            class="form-control {{ $errors->has('city') ? 'is-invalid' : '' }}" name="city" rows="3"
                            value="{{ $bank->city }}">
                    </div>
                    <div class="mb-3">
                        <label for="exampleFormControlTextarea1" class="form-label">Alamat</label>
                        <textarea placeholder="Bank Address"
                            class="form-control  {{ $errors->has('address') ? 'is-invalid' : '' }}" name="address"
                            rows="3">{{ $bank->address }}</textarea>
                        @error('name')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="exampleFormControlInput1" class="form-label">Latitude</label>
                        <input type="text" name="latitude"
                            class="form-control {{ $errors->has('latitude') ? 'is-invalid' : '' }}"
                            placeholder="latitude" value='{{ $bank->latitude }}'>
                        @error('latitude')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="exampleFormControlInput1" class="form-label">Longitude</label>
                        <input type="text" name="longitude"
                            class="form-control {{ $errors->has('longitude') ? 'is-invalid' : '' }}"
                            placeholder="longitude" value='{{ $bank->longitude }}'>
                        @error('longitude')
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