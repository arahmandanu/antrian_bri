@extends('admin.shared.main')

@section('content')
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h3 class="h3 mb-0 text-gray-800"> <a href="{{ route('admin_dashboard') }}"> Dashboard </a> > <a
                href=" {{ route('banks.index') }} "> Settings </a> > Tombol </h3>
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
                    <form action="{{ route('operator.button.store') }}" method="POST">
                        @csrf
                        <div class="mb-3">
                            <label for="exampleFormControlInput1" class="form-label">User</label>
                            <select name="actor_code"
                                class="form-control  {{ $errors->has('actor_code') ? 'is-invalid' : '' }}">
                                <option value="">-- Silahkan Pilih User --</option>
                                @forelse ($actors as $actor)
                                    <option value="{{ $actor->code }}">{{ $actor->name }} - {{ $actor->code }}
                                    </option>
                                @empty
                                    <option value="">No Data Found</option>
                                @endforelse
                            </select>

                            @error('actor_code')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="exampleFormControlInput1" class="form-label">Tombol</label>
                            <select name="button" class="form-control">
                                <option value="">-- Silahkan Pilih Tombol --</option>
                                @forelse ($buttons as $button)
                                    <option value="{{ $button }}"> {{ $button }} </option>
                                @empty
                                    <option value="">No Data Found</option>
                                @endforelse
                            </select>

                            @error('button')
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
