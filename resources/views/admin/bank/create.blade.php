@extends('admin.shared.main')

@section('content')
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('admin_dashboard') }}">Dashboard</a></li>
                <li class="breadcrumb-item"><a href="{{ route('banks.index') }}">Master
                        Bank</a></li>
                <li class="breadcrumb-item active" aria-current="page">Create New Bank</li>
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
                    <form action="{{ route('banks.store') }}" method="POST">
                        @csrf

                        <div class="mb-3">
                            <label for="exampleFormControlInput1" class="form-label">Branch Code</label>
                            <select name="KC_Code" class="form-control">
                                <option value="">-- Branch --</option>
                                @forelse ($bankBranches as $bankBranch)
                                    <option {{ old('KC_Code') == $bankBranch->code ? 'selected' : '' }}
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
                                class="form-control {{ $errors->has('code') ? 'is-invalid' : '' }}"
                                placeholder="Bank Unit Code" value='{{ old('code') }}'>
                            @error('code')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="exampleFormControlInput1" class="form-label">Name</label>
                            <input type="text" name="name"
                                class="form-control {{ $errors->has('name') ? 'is-invalid' : '' }}" placeholder="Bank Name"
                                value='{{ old('name') }}'>
                            @error('name')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="exampleFormControlInput1" class="form-label">City</label>
                            <input type="text" name="city"
                                class="form-control {{ $errors->has('city') ? 'is-invalid' : '' }}" placeholder="City"
                                value='{{ old('city') }}'>
                            @error('city')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="exampleFormControlTextarea1" class="form-label">Address</label>
                            <textarea placeholder="Bank Address" class="form-control  {{ $errors->has('address') ? 'is-invalid' : '' }}"
                                name="address" rows="3">{{ old('address') }}</textarea>
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
                                placeholder="latitude" value='{{ old('latitude') }}'>
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
                                placeholder="longitude" value='{{ old('longitude') }}'>
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
