@extends('admin.shared.main')

@section('content')
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h3 class="h3 mb-0 text-gray-800"> <a href="{{ route('admin_dashboard') }}"> Dashboard </a> > <a
                href=" {{ route('banks.index') }} "> Master
                Bank </a> > Create New Bank </h3>
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
                            <label for="exampleFormControlInput1" class="form-label">Area Code</label>
                            <input type="text" name="Area_Code"
                                class="form-control {{ $errors->has('Area_Code') ? 'is-invalid' : '' }}"
                                placeholder="Area Code" value='{{ old('Area_Code') }}'>
                            @error('Area_Code')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="exampleFormControlInput1" class="form-label">KC Code</label>
                            <input type="text" name="KC_Code"
                                class="form-control {{ $errors->has('KC_Code') ? 'is-invalid' : '' }}" placeholder="KC Code"
                                value='{{ old('KC_Code') }}'>
                            @error('KC_Code')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="exampleFormControlInput1" class="form-label">Code</label>
                            <input type="text" name="code"
                                class="form-control {{ $errors->has('code') ? 'is-invalid' : '' }}" placeholder="Bank Code"
                                value='{{ old('code') }}'>
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
                            <label for="exampleFormControlInput1" class="form-label">Kota</label>
                            <input type="text" name="city"
                                class="form-control {{ $errors->has('city') ? 'is-invalid' : '' }}" placeholder="Kota"
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
