@extends('admin.shared.main')

@section('content')
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h3 class="h3 mb-0 text-gray-800"> <a href="{{ route('admin_dashboard') }}"> Dashboard </a> > Tombol </h3>
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
                    <form action="{{ route('operator.button.update', $buttonBranch->id) }}" method="POST">
                        @method('PUT')
                        @csrf
                        <div class="mb-3">
                            <label for="exampleFormControlInput1" class="form-label">User</label>
                            <select name="actor_code" class="form-control">
                                <option value="">-- Silahkan Pilih User --</option>
                                @forelse ($actors as $actor)
                                    <option {{ $buttonBranch->actor_code == $actor->code ? 'selected' : '' }}
                                        value="{{ $actor->code }}">{{ $actor->name }} -
                                        {{ $actor->code }}
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
                                    <option {{ $buttonBranch->button == $button ? 'selected' : '' }}
                                        value="{{ $button }}"> {{ $button }} </option>
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
