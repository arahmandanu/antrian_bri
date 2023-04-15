@extends('admin.shared.main')

@section('content')
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('admin_dashboard') }}">Dashboard</a></li>
                <li class="breadcrumb-item"><a href="{{ route('operator.button.index') }}">Button</a></li>
                <li class="breadcrumb-item active" aria-current="page">Create New Button</li>
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
                    <form action="{{ route('operator.button.store') }}" method="POST">
                        @csrf
                        <div class="mb-3">
                            <label for="exampleFormControlInput1" class="form-label">User</label>
                            <select name="actor_code"
                                class="js-example-theme-single form-control {{ $errors->has('actor_code') ? 'is-invalid' : '' }}"
                                id="actor_codeFilter" placeholder="Bank Name">
                                <option></option>
                            </select>

                            @error('actor_code')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror

                        </div>

                        <div class="mb-3">
                            <label for="exampleFormControlInput1" class="form-label">Tombol</label>
                            <select name="button" class="form-control {{ $errors->has('button') ? 'is-invalid' : '' }}">
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

    <script>
        $(document).ready(function() {
            callSelectUserId(@json($actor));
        });

        function callSelectUserId(defaultValue) {
            $('select#actor_codeFilter').select2({
                data: [{
                        id: 0,
                        text: 'enhancement'
                    },
                    {
                        id: 1,
                        text: 'bug'
                    },
                    {
                        id: 2,
                        text: 'duplicate'
                    },
                    {
                        id: 3,
                        text: 'invalid'
                    },
                    {
                        id: 4,
                        text: 'wontfix'
                    }
                ],
                placeholder: 'Silahkan pilih User',
                ajax: {
                    url: "{{ route('admin.get_actors') }}",
                    dataType: 'json',
                    data: function(params) {
                        var query = {
                            name: params.term,
                            type: 'public'
                        }
                        return query;
                    },
                    processResults: function(data, params) {
                        return {
                            results: data,
                        };
                    },
                    cache: true
                }
            });
        }
    </script>
@endsection
