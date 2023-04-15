@extends('admin.shared.main')

@section('content')
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('admin_dashboard') }}">Dashboard</a></li>
                <li class="breadcrumb-item active" aria-current="page">Button</li>
            </ol>
        </nav>
    </div>

    <!-- Content Row -->
    <div class="row">
        <!-- Content Column -->
        <div class="col-lg-12 mb-4">

            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Unit {{ Auth::user()->unit->name ?? '' }} </h6>
                    <hr>
                    <form class="row g-3" method="GET" action="{{ route('operator.button.index') }}">
                        @csrf
                        <div class="col-auto">
                            <label for="inputname" class="visually-hidden">Button</label>
                            <input type="text" name="button" class="form-control" id="inputname" placeholder="Button"
                                value='{{ old(' name') }}'>
                        </div>

                        <div class="col-auto">
                            <button type="submit" class="btn btn-primary mb-3">Search</button>
                        </div>

                        <div class="col-auto">
                            <a type="submit" href="{{ route('operator.button.create') }}" class="btn btn-success mb-3">Add
                                Buttton</a>
                        </div>
                    </form>
                </div>
                <div class="card-body">
                    <div class="container">
                        <div class="row">
                            @forelse ($buttonBranchs as $buttonBranch)
                                <div class="col m-2">
                                    <div class="card" style="width: 18rem;">
                                        <img src="{{ asset('images/avatar-male.png') }}" class="card-img-top"
                                            alt="...">
                                        <div class="card-body">
                                            <h5 class="card-title text-center">Tombol <span
                                                    class="fw-bold">{{ $buttonBranch->button }}</span></h5>
                                            <p class="card-text">{{ $buttonBranch->actor->code }} -
                                                {{ $buttonBranch->actor->name }}</p>
                                            <a href="{{ route('operator.button.show', ['button' => $buttonBranch->id]) }} "
                                                class="btn btn-primary"><i class="fa fa-pencil" aria-hidden="true"></i>
                                                Edit</a>
                                        </div>
                                    </div>
                                </div>
                            @empty
                                <div class="col">No Data Found</div>
                            @endforelse
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
@endsection
