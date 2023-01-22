@extends('shared.main')

@section('content')
    <div class="w-100 overflow-hidden" id="top">

        <div class="container position-relative">
            <div class="row">
                <input type="hidden" name='latitude' id="latitude">
                <input type="hidden" name='longitude' id="longitude">

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
                                                <option value="">Silahkan Pilih Bank</option>
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
                options: [],
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
                            "</div>" +
                            "<div class='col-2'>10 Km</div>" +
                            "</div>" + "</div>"
                        );
                    },
                },
                load: function(query, callback) {
                    console.log(latitude);
                    if (query.length > 1) {
                        $.get({
                            url: "{{ route('barcode.get_bank') }}",
                            type: 'GET',
                            dataType: 'json',
                            data: {
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
                }
            });

        });

        function assignData(position) {
            $('input#latitude').val(position.coords.latitude);
            $('input#longitude').val(position.coords.longitude);

            defineBankOption(position.coords.latitude, position.coords.longitude);
        }

        function defineBankOption(latitude, longitude) {
            $.ajax({
                type: "get",
                url: "{{ route('barcode.get_bank') }}",
                data: {
                    'latitude': latitude,
                    'longitude': longitude,
                    "_token": "{{ csrf_token() }}"
                },
                dataType: "json",
                success: function(response) {
                    console.log(response);
                }
            });
        }
    </script>
@endsection
