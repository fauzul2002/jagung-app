@extends('dashboard.layouts.main')

@section('content')
    <div class="row">
        <div class="col-sm-6 col-md">
            @if (session()->has('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @elseif (session()->has('failed'))
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    {{ session('failed') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif
        </div>
    </div>

    <button class="btn btn-primary fs-5 fw-normal mt-2" id="predict"><i
            class="fa-solid fa-magnifying-glass fs-5 me-2"></i>Prediksi</button>
    <div class="row mt-3">
        <div class="col">
            <h4>Data Prediksi</h4>
        </div>
        <div class="col  pe-5">
            <h5><b>MAPE : <span id="mape"></span></b></h5>
        </div>
    </div>
    <div class="row mb-3">
        <div class="col">
            <div class="card mt-2">
                <div class="card-body">
                    <table id="myTable" class="table responsive nowrap table-bordered table-striped align-middle"
                        style="width:100%">
                        <thead>
                            <tr>
                                <th>NO</th>
                                <th>Tahun</th>
                                <th>Prediksi Produksi</th>
                                <th>Produksi Actual</th>
                            </tr>
                        </thead>
                        <tbody id="tbody">

                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <h4>Grafik Predict</h4>
    <div class="row">
        <div class="col">
            <div class="card">
                <div class="card-body">
                    <canvas id="myChart"></canvas>
                </div>
            </div>
        </div>
    </div>


@section('script')
    <script>
        const predictBtn = document.getElementById('predict');
        const url = 'http://127.0.0.1:5000/fuzzy';

        predictBtn.addEventListener('click', async function(event) {
            event.preventDefault();

            const response = await fetch(url, {
                method: 'GET',
            });

            const data = await response.json();
            console.log(data)

            if (data) {
                const hasilPrediksi = data.data_train;
                const hasilPrediksi2 = data.prediction_results;
                const actual = data.data_train; // Data aktual
                let tbody = '';

                // Iterasi melalui objek data dan buat baris HTML untuk setiap entri
                hasilPrediksi.forEach((item, index) => {
                    tbody += `
        <tr>
            <td>${index + 1}</td>
            <td>${item.key}</td>
            <td>${item.predicted}</td>
            <td>${item.value}</td>
        </tr>`;
                });
                $('#tbody').html(tbody);
                hasilPrediksi2.forEach((item, index) => {
                    tbody += `
        <tr>
            <td>${index + 18}</td>
            <td>${item.Tahun}</td>
            <td>${item.Prediksi}</td>
            <td>null</td>
        </tr>`;
                });
                $('#tbody').html(tbody);

                const mape = data.evaluation_metrics.afer;
                const mapeAsNumber = parseFloat(mape);

                // Mengambil empat angka setelah titik desimal
                const mapeFormatted = mapeAsNumber.toFixed(2);

                // Menampilkan nilai mape yang sudah diformat di dalam elemen HTML dengan ID 'mape'
                document.getElementById('mape').innerText = mapeFormatted + "%";

                const ctx = document.getElementById('myChart');

                new Chart(ctx, {
                    type: 'line',
                    data: {
                        labels: hasilPrediksi.map(item => item.key),
                        datasets: [{
                                label: 'Prediksi',
                                borderColor: "#8f44fd",
                                backgroundColor: "#8f44fd",
                                data: hasilPrediksi.map(item => item.predicted),
                                borderWidth: 1
                            },
                            {
                                label: 'Actual',
                                borderColor: "#44a8fd",
                                backgroundColor: "#44a8fd",
                                data: actual.map(item => item.value),
                                borderWidth: 1
                            }
                        ]
                    },
                    options: {
                        scales: {
                            y: {
                                suggestedMin: 0,
                                suggestedMax: 50,
                                grid: {
                                    display: true,
                                    drawBorder: true,
                                    drawOnChartArea: true,
                                    drawTicks: true,
                                    color: "rgba(255, 255, 255, 0.08)",
                                    borderColor: "transparent",
                                    borderDash: [5, 5],
                                    borderDashOffset: 2,
                                    tickColor: "transparent"
                                },
                                beginAtZero: true
                            }
                        },
                        tension: 0.3,
                        elements: {
                            point: {
                                radius: 8,
                                hoverRadius: 12,
                                backgroundColor: "#9BD0F5",
                                borderWidth: 0,
                            },
                        },
                    }
                });
            }
        })
    </script>
@endsection
@endsection
