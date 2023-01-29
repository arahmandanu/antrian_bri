@extends('admin.shared.main')

@section('content')
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Over Sla</h1>
    </div>

    <div class="row">

        <!-- Area Chart -->
        <div class="col-xl-10">

            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Tahun {{ now()->year }}</h6>
                    <hr>
                    <form class="row g-3" method="GET" action="{{ route('admin.over_sla') }}">
                        @csrf
                        <div class="col-4">
                            <label for="inputcode" class="visually-hidden">Code</label>
                            <select type="text" name="month" class="form-control" required id="month" placeholder="Bank Code">
                                <option value="">Pilih Bulan</option>
                                <option value="1" {{ old('month') == 1 ? 'selected' : '' }}>Januari</option>
                                <option value="2" {{ old('month') == 2 ? 'selected' : '' }}>Februari</option>
                                <option value="3" {{ old('month') == 3 ? 'selected' : '' }}>Maret</option>
                                <option value="4" {{ old('month') == 4 ? 'selected' : '' }}>April</option>
                                <option value="5" {{ old('month') == 5 ? 'selected' : '' }}>Mei</option>
                                <option value="6" {{ old('month') == 6 ? 'selected' : '' }}>Juni</option>
                                <option value="7" {{ old('month') == 7 ? 'selected' : '' }}>Juli</option>
                                <option value="8" {{ old('month') == 8 ? 'selected' : '' }}>Agustus</option>
                                <option value="9" {{ old('month') == 9 ? 'selected' : '' }}>September</option>
                                <option value="10" {{ old('month') == 10 ? 'selected' : '' }}>Oktober</option>
                                <option value="11" {{ old('month') == 11 ? 'selected' : '' }}>November</option>
                                <option value="12" {{ old('month') == 12 ? 'selected' : '' }}>Desember</option>
                            </select>
                        </div>
                        <div class="col-4">
                            <label for="inputcode" class="visually-hidden">Bank</label>
                            <select type="text" required name="bank_code" class="form-control" id="inputcode" placeholder="Bank Code">
                                @forelse($banks as $bank)
                                    <option value="{{ $bank->code }}"
                                            @if(old('bank_code') == $bank->code)
                                                selected
                                            @endif
                                    >{{ $bank->name }}</option>
                                @empty
                                    <option>No Data Found</option>
                                @endforelse
                            </select>
                        </div>
                        <div class="col-auto">
                            <button type="submit" class="btn btn-success mb-3">Search</button>
                        </div>
                    </form>
                </div>
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Chart</h6>
                </div>
                <div class="card-body">
                    <canvas id="doughnut-chartcanvas-1"></canvas>
                </div>
            </div>
        </div>
    </div>

    <script>
        var ctx1 = $("#doughnut-chartcanvas-1");
        var cs = @json($cs);
        var csover = @json($csover);
        var teller = @json($teller);
        var tellerover = @json($tellerover);
        var namemonth = "Over SlA Bulan ";
        if ($('select#month option:selected').val()){
            namemonth = namemonth+ $('select#month option:selected').text();
        }

        var data1 = {
            labels: ["CS Over SLA", "CS Not Over SLA", "TELLER Over SLA" , "Teller Not Over SLA"],
            datasets: [
                {
                    label: "TeamA Score",
                    data: [csover, cs, tellerover, teller],
                    backgroundColor: [
                        "#DC143C",
                        "#2E8B57",
                        "#CDA776",
                        "#989898"
                    ],
                    borderColor: [
                        "#CDA776",
                        "#989898"
                    ],
                    borderWidth: [1, 1, 1, 1]
                }
            ]
        };

        var options = {
            responsive: true,
            title: {
                display: true,
                position: "top",
                text: namemonth,
                fontSize: 18,
                fontColor: "#111"
            },
            legend: {
                display: true,
                position: "bottom",
                labels: {
                    fontColor: "#333",
                    fontSize: 16
                }
            }
        };

        var chart1 = new Chart(ctx1, {
            type: "doughnut",
            data: data1,
            options: options
        });

    </script>
@endsection
