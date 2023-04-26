@extends('shared.main')

@section('content')
    <div class="row justify-content-md-center mt-3">
        <input type="hidden" name='latitude' id="latitude">
        <input type="hidden" name='longitude' id="longitude">
        <div class="col-lg-6">
            @include('shared.alert')
            <form action="{{ route('barcode.post_form') }}" method="POST">
                @csrf
                @method('POST')
                <div class="mb-3 text-center">
                    <label for="unit_code" class="fw-bold form-label">Unit</label>
                    <select name="unit_code"
                        class="js-example-placeholder-single js-states form-control {{ $errors->has('unit_code') ? 'is-invalid' : '' }}"
                        id="unit" required>
                        <option value=""></option>
                        @forelse ($unitCodes as $unitCode)
                            <option value="{{ $unitCode->code }}"
                                @if (old('unit_code') == $unitCode->code) {{ 'selected' }} @endif>
                                {{ Str::upper($unitCode->name) }}</option>
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
                <div class="mb-3 text-center">
                    <label for="form queue_for" class="fw-bold form-label">Tanggal
                        Antrian</label>
                    <input name="queue_for" type="date"
                        class="form-control {{ $errors->has('queue_for') ? 'is-invalid' : '' }}" id="exampleInputPassword1"
                        value="{{ old('queue_for') }}" required>
                    @error('queue_for')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
                <div class="mb-3 text-center">
                    <label for="form bank" class="fw-bold form-label">Bank</label>
                    <select name="bank"
                        class="js-data-example-ajax form-control {{ $errors->has('bank') ? 'is-invalid' : '' }}" required
                        id="bank">
                        <option value="">Silahkan Pilih Bank</option>
                    </select>

                    @error('bank')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
                <div class="mb-3 text-center">
                    <button type="submit"
                        class="btn new-btn-custom-secondary rounded-pill new-btn-gradient">Submit</button>
                </div>
            </form>
        </div>
    </div>
    <script>
        $(document).ready(function() {
            if (navigator.geolocation) {
                navigator.geolocation.getCurrentPosition(assignData);
            } else {
                false;
            }

            Selectize.define('no_results', function(options) {
                var self = this;

                options = $.extend({
                    message: 'No results found.',

                    html: function(data) {
                        return (
                            '<div class="selectize-dropdown ' + data.classNames + '">' +
                            '<div class="selectize-dropdown-content">' +
                            '<div class="no-results">' + data.message + '</div>' +
                            '</div>' +
                            '</div>'
                        );
                    }
                }, options);

                self.displayEmptyResultsMessage = function() {
                    this.$empty_results_container.css('top', this.$control.outerHeight());
                    this.$empty_results_container.css('width', this.$control.outerWidth());
                    this.$empty_results_container.show();
                    this.$control.addClass("dropdown-active");
                };

                self.refreshOptions = (function() {
                    var original = self.refreshOptions;

                    return function() {
                        original.apply(self, arguments);
                        if (this.hasOptions || !this.lastQuery) {
                            this.$empty_results_container.hide()
                        } else {
                            this.displayEmptyResultsMessage();
                        }
                    }
                })();

                self.onKeyDown = (function() {
                    var original = self.onKeyDown;

                    return function(e) {
                        original.apply(self, arguments);
                        if (e.keyCode === 27) {
                            this.$empty_results_container.hide();
                        }
                    }
                })();

                self.onBlur = (function() {
                    var original = self.onBlur;

                    return function() {
                        original.apply(self, arguments);
                        this.$empty_results_container.hide();
                        this.$control.removeClass("dropdown-active");
                    };
                })();

                self.setup = (function() {
                    var original = self.setup;
                    return function() {
                        original.apply(self, arguments);
                        self.$empty_results_container = $(options.html($.extend({
                            classNames: self.$input.attr('class')
                        }, options)));
                        self.$empty_results_container.insertBefore(self.$dropdown);
                        self.$empty_results_container.hide();
                    };
                })();
            });

            $('select#unit').selectize();

            $('select#bank').selectize({
                create: false,
                valueField: 'id',
                labelField: 'name',
                searchField: ['name'],
                options: @json($banks),
                plugins: ["clear_button", 'no_results'],
                render: {
                    item: function(item, escape) {
                        return (
                            "<div>" +
                            '<span class="name">' + escape(item.name) + "</span>" +
                            "</div>"
                        );
                    },
                    option: function(item, escape) {
                        var label = item.name;
                        var caption = item.name;
                        return (
                            "<div class='container'>" +
                            "<div class='row'>" +
                            "<div class='col-10'>" +
                            "<div class='text-start'>" + escape(item.name) + "</div>" +
                            "<div class='text-start fst-italic'><em>" + escape(item.address) +
                            "</em></div>" +
                            "</div>" + "</div>"
                        );
                    },
                },
                load: function(query, callback) {
                    if (query.length > 1) {
                        $.get({
                            url: "{{ route('barcode.get_bank') }}",
                            type: 'GET',
                            dataType: 'json',
                            data: {
                                latitude: $('input#latitude').val(),
                                longitude: $('input#longitude').val(),
                                search: query,
                            },
                            error: function() {
                                callback();
                            },
                            success: function(res) {
                                callback(res);
                            }
                        });
                    }
                },
                onInitialize: function() {

                }
            });

        });

        function assignData(position) {
            $('input#latitude').val(position.coords.latitude);
            $('input#longitude').val(position.coords.longitude);
        }
    </script>
@endsection
