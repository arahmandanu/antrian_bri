@extends('admin.shared.main')

@section('content')
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h3 class="h3 mb-0 text-gray-800"> <a href="{{ route('admin_dashboard') }}"> Dashboard </a> > <a
                href=" {{ route('banks.index') }} "> Master
                Bank </a> > {{ $bankBranch->name }} </h3>
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
                    <form action="{{ route('admin.bank_branches.update', $bankBranch->id) }}" method="POST">
                        @method('PUT')
                        @csrf

                        <div class="mb-3">
                            <label for="exampleFormControlInput1" class="form-label">Area Code</label>
                            <select name="area_code" class="form-control">
                                <option value="">-- Area --</option>
                                @forelse ($bankAreas as $bankArea)
                                    <option {{ $bankBranch->area_code == $bankArea->code ? 'selected' : '' }}
                                        value="{{ $bankArea->code }}">{{ $bankArea->name }} - {{ $bankArea->code }}
                                    </option>
                                @empty
                                    <option value="" selected>No Data Found</option>
                                @endforelse
                            </select>

                            @error('area_code')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="exampleFormControlInput1" class="form-label">Branch Code</label>
                            <input type="text" name="code" placeholder="Branch Code"
                                class="form-control {{ $errors->has('code') ? 'is-invalid' : '' }} "
                                value="{{ $bankBranch->code }}">

                            @error('code')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="exampleFormControlInput1" class="form-label">Branch Name</label>
                            <input type="text" name="name" placeholder="Branch Name"
                                class="form-control {{ $errors->has('name') ? 'is-invalid' : '' }}"
                                value="{{ $bankBranch->name }}">

                            @error('name')
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