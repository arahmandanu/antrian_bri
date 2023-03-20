@extends('admin.shared.main')

@section('content')
<!-- Page Heading -->
<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h3 class="h3 mb-0 text-gray-800"> <a href="{{ route('admin_dashboard') }}"> Dashboard </a> > All Antrian</h3>
</div>

<!-- Content Row -->
<div class="row">
    <!-- Content Column -->
    <div class="col-lg-12 mb-4">
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Bank</h6>
                <hr>
                <h6><span class="badge bg-success fst-italic">Silahkan pilih salah satu filter berdasar Area / Cabang /
                        Unit</span>
                </h6>

                @if ($errors->has('area_code') || $errors->has('bank_code') || $errors->has('branch_code'))
                <span class="fst-italic">Anda hanya bisa memilih satu dianatara filter area / cabang /
                    unit</span>
                @endif

                <form class="row g-3" method="GET" action="{{ route('admin.reports') }}">
                    <p>
                        <button class="btn btn-primary" onclick="collapse('byAreaBank')" type="button"
                            data-bs-toggle="collapse" data-bs-target="#byAreaBank" aria-expanded="false"
                            aria-controls="byAreaBank">
                            Area Bank
                        </button>
                        <button class="btn btn-primary" onclick="collapse('byCabangBank')" type="button"
                            data-bs-toggle="collapse" data-bs-target="#byCabangBank" aria-expanded="false"
                            aria-controls="byCabangBank">
                            Kantor Cabang
                        </button>
                        <button class="btn btn-primary" onclick="collapse('byUnitBank')" type="button"
                            data-bs-toggle="collapse" data-bs-target="#byUnitBank" aria-expanded="false"
                            aria-controls="byUnitBank">
                            Kantor Unit
                        </button>
                    </p>

                    <div class="collapse" id="byAreaBank">
                        <div class="card card-body">
                            <label for="inputname" class="visually-hidden">Bank</label>
                            <select type="text" name="area_code" class="form-control" id="byAreaBankSelect">
                                <option value="">Silahkan Pilih Area</option>
                                @forelse($bankAreas as $bankArea)
                                <option {{ Request::input('area_code')==$bankArea->code ? 'selected' : '' }} value="{{
                                    $bankArea->code }}">{{ $bankArea->name }} - {{ $bankArea->code }}
                                </option>
                                @empty
                                <option value="">No Data Found</option>
                                @endforelse
                            </select>
                        </div>
                    </div>

                    <div class="collapse" id="byCabangBank">
                        <div class="card card-body">
                            <label for="inputname" class="visually-hidden">Bank</label>
                            <select type="text" name="branch_code" class="form-control" id="byCabangBankSelect">
                                <option value="">Silahkan Pilih Kantor Cabang</option>
                                @forelse($bankBranches as $bankBranch)
                                <option {{ Request::input('branch_code')==$bankBranch->code ? 'selected' : '' }}
                                    value="{{
                                    $bankBranch->code }}">{{ $bankBranch->name }} -
                                    {{ $bankBranch->code }}</option>
                                @empty
                                <option value="">No Data Found</option>
                                @endforelse
                            </select>
                        </div>
                    </div>

                    <div class="collapse" id="byUnitBank">
                        <div class="card card-body">
                            <label for="inputname" class="visually-hidden">Bank</label>
                            <select type="text" name="bank_code" class="form-control" id="byUnitBankSelect">
                                <option value="">Silahkan Pilih Kantor Unit</option>
                                @forelse($banks as $bank)
                                <option {{ Request::input('bank_code')==$bank->code ? 'selected' : '' }} value="{{
                                    $bank->code }}">{{ $bank->name }}</option>
                                @empty
                                <option value="">No Data Found</option>
                                @endforelse
                            </select>
                        </div>
                    </div>

                    <div class="col-auto">
                        <label for="inputname" class="visually-hidden">User</label>
                        <select type="text" name="UserId" class="form-control" id="inputname" placeholder="Bank Name">
                            <option value="">-- User --</option>
                            @forelse ($actors as $actor)
                            <option {{ old('UserId')==$actor->code ? 'selected' : '' }}
                                value="{{ $actor->code }}">{{ $actor->name }}</option>
                            @empty
                            <option value="">No Data Found</option>
                            @endforelse
                        </select>
                    </div>

                    <div class="col-auto">
                        <label for="inputname" class="visually-hidden">Unit Code</label>
                        <select type="text" name="unit_code" class="form-control" id="inputname"
                            placeholder="Bank Name">
                            <option value="">Unit Code</option>
                            <option value="B" {{ old('unit_code')=='B' ? 'selected' : '' }}>CS</option>
                            <option value="A" {{ old('unit_code')=='A' ? 'selected' : '' }}>TELLER</option>
                        </select>
                    </div>

                    <div class="col-auto">
                        <label for="inputname" class="visually-hidden">SLA</label>
                        <select type="text" name="sla" class="form-control" id="inputname" placeholder="Bank Name">
                            <option value="">SLA</option>
                            <option value="1" {{ old('sla')=='1' ? 'selected' : '' }}>Over Sla</option>
                            <option value="2" {{ old('sla')=='2' ? 'selected' : '' }}>Not Over Sla</option>
                        </select>
                    </div>

                    <div class="col-auto">
                        <input name="queue_for" type="text"
                            class="form-control {{ $errors->has('queue_for') ? 'is-invalid' : '' }}"
                            id="exampleInputPassword1" required placeholder="Date Range" value="{{ old('queue_for') }}">
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
                            <th>User ID</th>
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
                            <td>{{ $transaction->SeqNumber }}</td>
                            <td>{{ $transaction->TimeTicket }}</td>
                            <td>{{ $transaction->TimeCall }}</td>
                            <td>{{ $transaction->TimeEnd }}</td>
                            <td>{{ $transaction->CustWaitDuration }}</td>
                            <td>{{ !isset($transaction->TWservice) ? '-' : $transaction->TWservice }}</td>
                            <td>{{ $transaction->Tservice }}</td>
                            <td>{{ $transaction->UnitServe }}</td>
                            <td>{{ $transaction->CounterNo }}</td>
                            <td>{{ $transaction->UserId }}</td>
                            <td>{{ $transaction->Trx_Desc }}</td>
                            <td>{{ !isset($transaction->TSLAservice) ? '-' : $transaction->TSLAservice }}
                            </td>
                            <td>{{ !isset($transaction->TOverSLA) ? '-' : $transaction->TOverSLA }}</td>
                        </tr>
                        @empty
                        No Data Found
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

        if(@Json(Request::input('bank_code')) !== null) {
            $("div.collapse#byUnitBank" + element).collapse('show');
        } else if(@Json(Request::input('branch_code')) !== null){
            $("div.collapse#byCabangBank").collapse('show');
        } else if (@Json(Request::input('area_code')) !== null) {
            $("div.collapse#byAreaBank").collapse('show');
        }
    });
</script>
@endsection