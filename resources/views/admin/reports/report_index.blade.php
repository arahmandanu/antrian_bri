@extends('admin.shared.main')

@section('content')
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('admin_dashboard') }}">Dashboard</a></li>
                <li class="breadcrumb-item active" aria-current="page">Reports</li>
            </ol>
        </nav>
    </div>

    <!-- Content Row -->
    <div class="row">
        <!-- Content Column -->
        <div class="col-lg-12 mb-4">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Reports Que</h6>
                    <hr>
                    <h6><span class="badge bg-success fst-italic">Please choose one of filter by Area / Cabang /
                            Unit</span>
                    </h6>

                    @if ($errors->has('area_code') || $errors->has('bank_code') || $errors->has('branch_code'))
                        <span class="fst-italic">filter by area / branch / unit</span>
                    @endif

                    <form class="row g-3" method="GET" action="{{ route('admin.reports') }}">
                        <p>
                            <button class="btn btn-primary" onclick="collapse('byAreaBank')" type="button"
                                data-bs-toggle="collapse" data-bs-target="#byAreaBank" aria-expanded="false"
                                aria-controls="byAreaBank">
                                Area
                            </button>
                            <button class="btn btn-primary" onclick="collapse('byCabangBank')" type="button"
                                data-bs-toggle="collapse" data-bs-target="#byCabangBank" aria-expanded="false"
                                aria-controls="byCabangBank">
                                Branch
                            </button>
                            <button class="btn btn-primary" onclick="collapse('byUnitBank')" type="button"
                                data-bs-toggle="collapse" data-bs-target="#byUnitBank" aria-expanded="false"
                                aria-controls="byUnitBank">
                                Unit
                            </button>
                        </p>

                        <div class="collapse" id="byAreaBank">
                            <div class="card card-body">
                                <label for="inputname" class="visually-hidden">Area</label>
                                <select type="text" name="area_code" class="form-control" id="byAreaBankSelect">
                                    <option value="">Choose Area</option>
                                    @forelse($bankAreas as $bankArea)
                                        <option {{ Request::input('area_code') == $bankArea->code ? 'selected' : '' }}
                                            value="{{ $bankArea->code }}">{{ $bankArea->name }} - {{ $bankArea->code }}
                                        </option>
                                    @empty
                                        <option value="">No Data Found</option>
                                    @endforelse
                                </select>
                            </div>
                        </div>

                        <div class="collapse" id="byCabangBank">
                            <div class="card card-body">
                                <label for="inputname" class="visually-hidden">Bank Branch</label>
                                <select type="text" name="branch_code" class="form-control" id="byCabangBankSelect">
                                    <option value="">Choose Branch</option>
                                    @forelse($bankBranches as $bankBranch)
                                        <option {{ Request::input('branch_code') == $bankBranch->code ? 'selected' : '' }}
                                            value="{{ $bankBranch->code }}">{{ $bankBranch->name }} -
                                            {{ $bankBranch->code }}</option>
                                    @empty
                                        <option value="">No Data Found</option>
                                    @endforelse
                                </select>
                            </div>
                        </div>

                        <div class="collapse" id="byUnitBank">
                            <div class="card card-body">
                                <label for="inputname" class="visually-hidden">Bank Unit</label>
                                <select type="text" name="bank_code" class="form-control" id="byUnitBankSelect">
                                    <option value="">Choose Unit</option>
                                    @forelse($banks as $bank)
                                        <option {{ Request::input('bank_code') == $bank->code ? 'selected' : '' }}
                                            value="{{ $bank->code }}">{{ $bank->name }}</option>
                                    @empty
                                        <option value="">No Data Found</option>
                                    @endforelse
                                </select>
                            </div>
                        </div>
                        {{--
                        <div class="col-md-4">
                            <label for="userIdFilter" class="visually-hidden">User</label>
                            <select type="text" name="UserId" class="js-example-theme-single form-control"
                                id="userIdFilter" placeholder="Bank Name">
                                <option></option>
                            </select>
                        </div> --}}

                        <div class="col-auto">
                            <label for="inputname" class="visually-hidden">Unit Code</label>
                            <select name="unit_code" class="form-control" id="inputname" placeholder="Bank Name">
                                <option value="">Unit Service</option>
                                <option value="B" {{ old('unit_code') == 'B' ? 'selected' : '' }}>CS</option>
                                <option value="A" {{ old('unit_code') == 'A' ? 'selected' : '' }}>TELLER</option>
                            </select>
                        </div>

                        <div class="col-auto">
                            <label for="inputname" class="visually-hidden">SLA</label>
                            <select name="sla" class="form-control" id="inputname" placeholder="Bank Name">
                                <option value="">-- SLA SERVICE --</option>
                                <option value="1" {{ old('sla') == '1' ? 'selected' : '' }}>Over Sla</option>
                                <option value="2" {{ old('sla') == '2' ? 'selected' : '' }}>Not Over Sla</option>
                            </select>
                        </div>

                        <div class="col-auto">
                            <input name="queue_for" type="text"
                                class="form-control {{ $errors->has('queue_for') ? 'is-invalid' : '' }}"
                                id="exampleInputPassword1" required placeholder="Date Range"
                                value="{{ old('queue_for') }}">
                            @error('queue_for')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <div class="col-auto">
                            <button type="submit" class="btn btn-success mb-3">Search</button>
                        </div>
                    </form>
                </div>

                <div class="card-body table-responsive">
                    <table class="table table-striped" id="report">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>BR Code</th>
                                <th>Date</th>
                                <th>Queue Number</th>
                                <th>Time Ticket</th>
                                <th>Time Call</th>
                                <th>Time End</th>
                                <th>Cust Wait Duration</th>
                                <th>Serv Wait Duration</th>
                                <th>Time Serv Duration</th>
                                <th>Unit Service</th>
                                <th>Counter</th>
                                <th>Employee</th>
                                <th>TRX Code</th>
                                <th>T SLA Service</th>
                                <th>Time Over SLA</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($transactions as $transaction)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $transaction->br_code }}</td>
                                    <td>{{ $transaction->BaseDt }}</td>
                                    <td>{{ $transaction->SeqNumber ?? '-' }}</td>
                                    <td>{{ $transaction->TimeTicket ?? '-' }}</td>
                                    <td>{{ $transaction->TimeCall }}</td>
                                    <td>{{ $transaction->TimeEnd }}</td>
                                    <td>{{ $transaction->CustWaitDuration }}</td>
                                    <td>{{ !isset($transaction->TWservice) ? '-' : $transaction->TWservice }}</td>
                                    <td>{{ $transaction->Tservice }}</td>
                                    <td>{{ $transaction->UnitServe }}</td>
                                    <td>{{ $transaction->CounterNo }}</td>
                                    <td>{{ $transaction->UserId }}</td>
                                    <td>{{ $transaction->TrxDesc }}</td>
                                    <td>{{ !isset($transaction->TSLAservice) ? '-' : $transaction->TSLAservice }}
                                    </td>
                                    <td>
                                        @php
                                            $overSla = !isset($transaction->TOverSLA)
                                                ? '00:00:00'
                                                : $transaction->TOverSLA;
                                            if ($overSla == '00:00:00') {
                                                echo "<span class='badge bg-success'>$overSla</span>";
                                            } else {
                                                echo "<span class='badge bg-danger'>$overSla</span>";
                                            }
                                        @endphp
                                    </td>
                                </tr>
                            @empty
                                {{-- No Data Found --}}
                            @endforelse
                        </tbody>
                    </table>

                </div>
                <div class="card-header py-3">
                </div>
            </div>
        </div>
    </div>

    <script>
        function collapse(data) {
            colls = ['byAreaBank', 'byCabangBank', 'byUnitBank'];
            close = colls.filter(e => e !== data);
            close.forEach(element => {
                $("div.collapse#" + element).collapse('hide');
                console.log("select#" + element + "Select");
                $("select#" + element + "Select").val('');
            });
        }

        $(document).ready(function() {
            //callSelectUserId(@json($actor));
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

            $('#report').DataTable({
                dom: 'Brtip',
                buttons: [
                    'csv', 'excel'
                ]
            });

            if (@Json(Request::input('bank_code')) !== null) {
                $("div.collapse#byUnitBank").collapse('show');
            } else if (@Json(Request::input('branch_code')) !== null) {
                $("div.collapse#byCabangBank").collapse('show');
            } else if (@Json(Request::input('area_code')) !== null) {
                $("div.collapse#byAreaBank").collapse('show');
            }
        });

        // function callSelectUserId(defaultValue) {
        //     $('select#userIdFilter').select2({
        //         data: defaultValue,
        //         placeholder: 'Silahkan pilih User',
        //         allowClear: true,
        //         ajax: {
        //             url: "{{ route('admin.get_actors') }}",
        //             dataType: 'json',
        //             data: function(params) {
        //                 var query = {
        //                     name: params.term,
        //                     type: 'select'
        //                 }
        //                 return query;
        //             },
        //             processResults: function(data, params) {
        //                 return {
        //                     results: data,
        //                 };
        //             },
        //             cache: true
        //         }
        //     });
        // }
    </script>
@endsection
