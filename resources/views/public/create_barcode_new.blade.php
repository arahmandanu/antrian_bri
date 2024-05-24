@extends('shared.main')

@section('content')
    <div class="row justify-content-md-center mt-3">
        <div class="col-lg-6">
            @include('shared.alert')
            <form action="{{ route('barcode.post_form') }}" method="POST">
                @csrf
                @method('POST')
                <input type="hidden" name="unit_code" value="{{ $unitCode }}">
                <div class="col-12">
                    <div class="container">
                        <div id="map" style="height: 30vh;"></div>
                    </div>
                </div>
                <hr>
                <div class="mb-3 text-center">
                    <label for="form bank" class="fw-bold form-label">Bank (Terdekat)</label>
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
                    <button type="submit"
                        class="btn new-btn-custom-secondary rounded-pill new-btn-gradient">Submit</button>
                </div>
            </form>
        </div>
    </div>

    <script>
        $(document).ready(function() {
            var marker = {!! json_encode($nearestBank) !!};
            var map = L.map('map').setView([51.505, -0.09], 14);
            L.tileLayer('https://tile.openstreetmap.org/{z}/{x}/{y}.png', {
                maxZoom: 19,
                attribution: '&copy; <a href="http://www.openstreetmap.org/copyright">OpenStreetMap</a>'
            }).addTo(map);

            $.each(marker, function(i, v) {
                var marker = L.marker([v.latitude, v.longitude]).addTo(map);
                marker.bindPopup("<span>" + v.name + "</span><br>" + v.address).openPopup();
            });

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
                options: @json($nearestBank),
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
    </script>
@endsection
