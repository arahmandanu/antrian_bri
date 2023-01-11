@extends('shared.main')

@section('content')
    <div class="w-100 overflow-hidden" id="top">

        <div class="container position-relative">
            <div class="row">
                <div class="col-lg-12 py-vh-6 position-relative" data-aos="fade-right">
                    <div class="py-vh-6 bg-primary text-light w-100 my-border" id="workwithus">
                        <div class="row d-flex justify-content-center">
                            <div class="row d-flex justify-content-center text-center">
                                <div class="col-lg-8 text-center" data-aos="fade">
                                    @include('shared.alert')
                                    <form action="{{ route('barcode.post_form') }}" method="POST">
                                        @csrf
                                        @method('POST')
                                        <div class="mb-3">
                                            <label for="unit_code" class="form-label">Unit</label>
                                            <select name="unit_code"
                                                class="js-example-placeholder-single js-states form-control {{ $errors->has('unit_code') ? 'is-invalid' : '' }}"
                                                id="unit" required>
                                                <option value=""></option>
                                                @forelse ($unitCodes as $unitCode)
                                                    <option value="{{ $unitCode->id }}"
                                                        @if (old('unit_code') == $unitCode->id) {{ 'selected' }} @endif>
                                                        {{ Str::upper($unitCode->code) }}</option>
                                                @empty
                                                    <option> No Data Found</option>
                                                @endforelse
                                            </select>

                                            @error('unit_code')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                        <div class="mb-3">
                                            <label for="queue_for" class="form-label">Tanggal
                                                Antrian</label>
                                            <input name="queue_for" type="date"
                                                class="form-control {{ $errors->has('queue_for') ? 'is-invalid' : '' }}"
                                                id="exampleInputPassword1" value="{{ old('queue_for') }}" required>
                                            @error('queue_for')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                        <div class="mb-3">
                                            <label for="bank" class="form-label">Bank</label>
                                            <select name="bank"
                                                class="js-data-example-ajax form-control {{ $errors->has('bank') ? 'is-invalid' : '' }}"
                                                required id="bank">
                                            </select>

                                            @error('bank')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                        <button type="submit"
                                            class="btn new-btn-custom-secondary new-btn-gradient">Submit</button>
                                    </form>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
        $(document).ready(function() {
            $('select#unit').select2({
                placeholder: 'Silahkan pilih Unit',
                minimumResultsForSearch: Infinity
            });

            $('select#bank').select2({
                placeholder: 'Silahkan pilih Bank',
                minimumInputLength: 0,
                dataType: 'json',
                delay: 250,
                templateResult: formatBankView,
                templateSelection: formatBankSelection,
                allowClear: false,
                ajax: {
                    url: "{{ route('barcode.get_bank') }}",
                    dataType: 'json',
                    data: function(params) {
                        var query = {
                            search: params.term,
                            type: 'public'
                        }

                        return query;
                    },
                    processResults: function(data) {
                        return {
                            results: data
                        };
                    },
                    cache: true
                }
            });
        });

        function formatBankView(data) {
            if (data.loading) {
                return data.text;
            }
            var $container = $(
                "<div class='select2-result-repository clearfix'>" +
                "<div class='select2-result-repository__meta'>" +
                "<div class='select2-result-repository__title'>" + data.name + "</div>" +
                "<div class='select2-result-repository__description'>" + data.address + "</div>" +
                "</div>" +
                "</div>"
            );

            return $container;
        }

        function formatBankSelection(data) {
            if (data.code) {
                return data.name;
            } else {
                return data.text;
            }
        }
    </script>
@endsection
