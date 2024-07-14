@extends('dashboard.layouts.main')

@section('content')
    <div class="containter">
        <div class="row g-3">

            <div class="col-sm-6 col-md-4 col-lg">
                <div class="card">
                    <div class="card-body d-flex align-items-center">
                        <i class="fa-duotone fa-industry-windows fa-3x text-dark"></i>
                        <div class="d-flex flex-column ms-3">
                            <h5 class="card-title fs-6 mb-0">Produksi Jagung</h5>
                            <p class="card-text fs-4 fw-semibold"></p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-sm-6 col-md-4 col-lg">
                <div class="card">
                    <div class="card-body d-flex align-items-center">
                        <i class="fa-duotone fa-users fa-3x text-primary"></i>
                        <div class="d-flex flex-column ms-3">
                            <h5 class="card-title fs-6 mb-0">User</h5>
                            <p class="card-text fs-4 fw-semibold"></p>
                        </div>
                    </div>
                </div>
            </div>

        </div>
        <h2 class="mt-3 fw-bold">Laporan</h2>
        <div class="row mt-3">
            <div class="col">
                <div class="card mt-2">
                    <div class="card-body">
                        {{-- Tabel Data User --}}
                        <table id="myTable" class="table responsive nowrap table-bordered table-striped align-middle"
                            style="width:100%">
                            <thead>
                                <tr>
                                    <th>NO</th>
                                    <th>PRIODE</th>
                                    <th>TOTAL PRODUKTIVITAS</th>
                                    <th>TOTAL PRODUKSI (Ton)</th>
                                    <th>TOTAL AREA PANEN (ha)</th>
                                    <th>TOTAL AREA LAHAN (ha)</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($dataPeriode as $produksi)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $produksi->priode }}</td>
                                        <td>{{ $produksi->totalProduktivitas }}</td>
                                        <td>{{ $produksi->totalProduksi }} </td>
                                        <td>{{ $produksi->totalAreaPanen }} </td>
                                        <td>{{ $produksi->totalAreaLahan }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                        {{-- / Tabel Data ... --}}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
