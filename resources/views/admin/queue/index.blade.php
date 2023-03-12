@extends('admin.shared.main')

@section('content')
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800"> <a href="{{ route('admin_dashboard') }}"> Dashboard </a> > Queue Online</h1>
    </div>

    <!-- Content Row -->
    <div class="row">
        <!-- Content Column -->
        <div class="col-lg-12 mb-4">

            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <form method="GET" action="{{ route('queue_logs.index') }}">
                        <div class="row">
                            <div class="col">
                                <label for="bank">Bank</label>
                                <select name="bank"
                                    class="js-data-example-ajax form-control {{ $errors->has('bank') ? 'is-invalid' : '' }}"
                                    id="bank">
                                </select>

                                @error('bank')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>

                            <div class="col">
                                <label for="unit_code">Kode Unit</label>
                                <select name="unit_code"
                                    class="js-example-placeholder-single js-states form-control {{ $errors->has('unit_code') ? 'is-invalid' : '' }}"
                                    id="unit">
                                    <option value="">-- All --</option>
                                    @forelse ($unitCodes as $unitCode)
                                        <option {{ Request::input('unit_code') == $unitCode->code ? 'selected' : '' }}
                                            value="{{ $unitCode->code }}">
                                            {{ $unitCode->code }}</option>
                                    @empty
                                        <option>-- No Data Found --</option>
                                    @endforelse
                                </select>

                                @error('unit_code')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                        </div>

                        <div class="row">
                            <div class="col">
                                <label for="inputcode">Tanggal Antrian</label>
                                <input type="text" name="queue_for" class="form-control"
                                    value="{{ old('queue_for') }}" />
                            </div>
                            <div class="col">
                                <label for="inputcode">Tanggal Buat</label>
                                <input type="text" name="created_at" class="form-control"
                                    value="{{ old('created_at') }}" />
                            </div>
                        </div>

                        <div class="row">
                            <div class="col mt-1">
                                <button type="submit" class="btn btn-primary mb-3">Search</button>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="card-body">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Kode Antrian</th>
                                <th>Kode Unit</th>
                                <th>Alamat Bank</th>
                                <th>Tanggal Antrian</th>
                                <th>Tanggal Buat</th>
                            </tr>
                        </thead>

                        <tbody>
                            @forelse ($queues as $queue)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $queue->id }}</td>
                                    <td>{{ $queue->unit_code }}</td>
                                    <td>{{ $queue->bank_address }}</td>
                                    <td>{{ $queue->queue_for }}</td>
                                    <td>{{ $queue->created_at }}</td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="8">No Data</td>
                                </tr>
                            @endforelse

                        </tbody>
                    </table>

                </div>

                <div class="card-header py-3">
                    {{ $queues->links('vendor.pagination.bootstrap-5') }}
                </div>
            </div>

        </div>
    </div>

    <script>
        $(document).ready(function() {
            $('input[name="queue_for"]').daterangepicker({
                opens: 'left',
                autoUpdateInput: false,
                locale: {
                    cancelLabel: 'Clear'
                }
            });

            $('input[name="queue_for"]').on('apply.daterangepicker', function(ev, picker) {
                $(this).val(picker.startDate.format('YYYY-MM-DD') + '/' + picker.endDate.format(
                    'YYYY-MM-DD'));
            });

            $('input[name="queue_for"]').on('cancel.daterangepicker', function(ev, picker) {
                $(this).val('');
            });


            $('input[name="created_at"]').daterangepicker({
                opens: 'left',
                autoUpdateInput: false,
                locale: {
                    cancelLabel: 'Clear'
                }
            });

            $('input[name="created_at"]').on('apply.daterangepicker', function(ev, picker) {
                $(this).val(picker.startDate.format('YYYY-MM-DD') + '/' + picker.endDate.format(
                    'YYYY-MM-DD'));
            });

            $('input[name="created_at"]').on('cancel.daterangepicker', function(ev, picker) {
                $(this).val('');
            });

            $('select#unit').select2({
                placeholder: 'Silahkan pilih Unit',
                minimumResultsForSearch: Infinity,
                allowClear: true,
            });

            $('select#bank').select2({
                placeholder: 'Silahkan pilih Bank',
                minimumInputLength: 0,
                dataType: 'json',
                delay: 250,
                templateResult: formatBankView,
                templateSelection: formatBankSelection,
                allowClear: true,
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
