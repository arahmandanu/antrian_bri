@extends('admin.shared.main')

@section('content')
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h3 class="h3 mb-0 text-gray-800"> <a href="{{ route('admin_dashboard') }}"> Dashboard </a> > <a
                href=" {{ route('banks.index') }} "> Master
                Bank </a> > {{ $bank->name }} </h3>
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
                            <input type="text" name="Area_Code" class="form-control" placeholder="Area Bank Code"
                                   value="{{ $bank->Area_Code }}">
                        </div>
                        <div class="mb-3">
                            <label for="exampleFormControlInput1" class="form-label">KC Code</label>
                            <input type="text" name="KC_Code" class="form-control" placeholder="KC Code"
                                   value="{{ $bank->KC_Code }}">
                        </div>
                        <div class="mb-3">
                            <label for="exampleFormControlInput1" class="form-label">Code</label>
                            <input type="text" name="code" class="form-control" placeholder="Bank Code"
                                value="{{ $bank->code }}">
                        </div>
                        <div class="mb-3">
                            <label for="exampleFormControlInput1" class="form-label">Name</label>
                            <input type="text" name="name" class="form-control" placeholder="Bank Name"
                                value="{{ $bank->name }}">
                        </div>
                        <div class="mb-3">
                            <label for="exampleFormControlTextarea1" class="form-label">Address</label>
                            <textarea placeholder="Bank Address" class="form-control" name="address" rows="3">{{ $bank->address }}</textarea>
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
