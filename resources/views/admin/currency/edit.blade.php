@extends('admin.shared.main')

@section('content')
    <div class="pagetitle">
        <h1>Dashboard</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('admin_dashboard') }}">Home</a></li>
                <li class="breadcrumb-item"><a href="{{ route('kurs.index') }}">Currency</a></li>
                <li class="breadcrumb-item active">Edit Kurs</li>
            </ol>
        </nav>
    </div>

    <section class="section dashboard">
        <div class="row card p-2">

            <div class="col-lg-12">
                <form enctype="multipart/form-data" class="row g-3" method="POST"
                    action={{ route('kurs.update', $currency->id) }}>
                    @method('PUT')
                    @csrf

                    <div class="col-md-12">
                        <label for="inputName5" class="form-label">
                            Kode Negara
                        </label>
                        <br>
                        <img style="width: 50px; padding-bottom:10px" src="{{ asset("flags/$currency->url") }}"
                            alt="">

                        <input type="text" class="form-control" name="name" id="inputName5" required
                            value="{{ $currency->name }}" disabled>
                    </div>

                    <div class="col-md-12">
                        <label for="inputName7" class="form-label">Jual</label>
                        <input type="text" class="form-control" name="jual" id="inputName7" required
                            value="{{ $currency->jual }}">
                    </div>

                    <div class="col-md-12">
                        <label for="inputName6" class="form-label">Beli</label>
                        <input type="text" class="form-control" name="beli" id="inputName6" required
                            value="{{ $currency->beli }}">
                    </div>

                    <div class="col-md-4">
                        <label for="inputState" class="form-label">No Urutan</label>
                        <select id="inputState" class="form-select" name="display_number" required>
                            @forelse ($displayNumbers as $item)
                                <option value="{{ $item }}"
                                    {{ $item == $currency->display_number ? 'selected' : '' }}>
                                    {{ $item }}</option>
                            @empty
                                <option value="">Data Kosong</option>
                            @endforelse
                        </select>
                    </div>

                    <div class="col-md-12">
                        <fieldset class="row mb-3">
                            <legend class="col-form-label col-sm-2 pt-0">Tampilkan</legend>
                            <div class="col-sm-10">
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="show" id="gridRadios1"
                                        value="1" {{ $currency->show ? 'checked' : '' }}>
                                    <label class="form-check-label" for="gridRadios1">
                                        yes
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="show" id="gridRadios2"
                                        value="0" {{ !$currency->show ? 'checked' : '' }}>
                                    <label class="form-check-label" for="gridRadios2">
                                        no
                                    </label>
                                </div>
                            </div>
                        </fieldset>
                    </div>

                    <div class="text-center">
                        <button type="submit" class="btn btn-primary">Submit</button>
                        <button type="reset" class="btn btn-secondary">Reset</button>
                    </div>
                </form><!-- End Multi Columns Form -->

            </div>
        </div>
    </section>
@endsection
