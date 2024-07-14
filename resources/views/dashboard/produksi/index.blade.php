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

    <button class="btn btn-primary fs-5 fw-normal mt-2" data-bs-toggle="modal" data-bs-target="#tambahProduksi"><i
            class="fa-solid fa-square-plus fs-5 me-2"></i>Tambah</button>
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
                                <th>KECAMATAN</th>
                                <th>AREA LAHAN (ha)</th>
                                <th>AREA PANEN (ha)</th>
                                <th>PRIODE</th>
                                <th>TOTAL PRODUKTIVITAS</th>
                                <th>TOTAL PRODUKSI (Ton)</th>
                                <th>ACTION</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($produksis as $produksi)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $produksi->Kecamatan->nama }}</td>
                                    <td>{{ $produksi->areaLahan }} </td>
                                    <td>{{ $produksi->areaPanen }} </td>
                                    <td>{{ $produksi->priode }}</td>
                                    <td>{{ $produksi->totalProduktivitas }}</td>
                                    <td>{{ $produksi->totalProduksi }} </td>
                                    <td>
                                        <button type="button" class="btn btn-sm btn-warning" data-bs-toggle="modal"
                                            data-bs-target="#editProduksi{{ $loop->iteration }}">
                                            <i class="fa-solid fa-pen-to-square"></i>
                                        </button>
                                        <button type="button" class="btn btn-sm btn-danger" data-bs-toggle="modal"
                                            data-bs-target="#hapusProduksi{{ $loop->iteration }}">
                                            <i class="fa-solid fa-trash"></i>
                                        </button>
                                    </td>
                                </tr>

                                {{-- Modal Edit Produksi --}}

                                <div class="modal fade" id="editProduksi{{ $loop->iteration }}" tabindex="-1"
                                    aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-scrollable" role="document">
                                        <div class="modal-content ">
                                            <div class="modal-header">
                                                <h5 class="modal-title">Edit Data Produksi</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                    aria-label="Close"></button>
                                            </div>
                                            <form action="{{ route('produksi.update', $produksi->id) }}" method="post"
                                                enctype="multipart/form-data">
                                                @method('put')
                                                @csrf
                                                <div class="modal-body">
                                                    <div class="mb-3">
                                                        <label for="kecamatan" class="form-label">Kecamatan</label>
                                                        <select class="form-select" id="kecamatan" name="kecamatan">
                                                            @foreach ($kecamatans as $kecamatan)
                                                                @if (old('kecamatan', $produksi->kecamatan) == $kecamatan->id)
                                                                    <option value="{{ $kecamatan->id }}" selected>
                                                                        {{ $kecamatan->nama }}</option>
                                                                @else
                                                                    <option value="{{ $kecamatan->id }}">
                                                                        {{ $kecamatan->nama }}</option>
                                                                @endif
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                    <div class="mb-3">
                                                        <label for="areaLahan" class="form-label">Area Lahan (ha)</label>
                                                        <input type="number"
                                                            class="form-control @error('areaLahan') is-invalid @enderror"
                                                            id="areaLahan" name="areaLahan"
                                                            value="{{ old('areaLahan', $produksi->areaLahan) }}" autofocus
                                                            required>
                                                        @error('areaLahan')
                                                            <div class="invalid-feedback">
                                                                {{ $message }}
                                                            </div>
                                                        @enderror
                                                    </div>
                                                    <div class="mb-3">
                                                        <label for="areaPanen" class="form-label">Area Panen (ha)</label>
                                                        <input type="number"
                                                            class="form-control @error('areaPanen') is-invalid @enderror"
                                                            id="areaPanen" name="areaPanen"
                                                            value="{{ old('areaPanen', $produksi->areaPanen) }}" autofocus
                                                            required>
                                                        @error('areaPanen')
                                                            <div class="invalid-feedback">
                                                                {{ $message }}
                                                            </div>
                                                        @enderror
                                                    </div>
                                                    <div class="mb-3">
                                                        <label for="priode" class="form-label">Priode</label>
                                                        <input type="number"
                                                            class="form-control @error('priode') is-invalid @enderror"
                                                            id="priode" name="priode"
                                                            value="{{ old('priode', $produksi->priode) }}" autofocus
                                                            required>
                                                        @error('priode')
                                                            <div class="invalid-feedback">
                                                                {{ $message }}
                                                            </div>
                                                        @enderror
                                                    </div>
                                                    <div class="mb-3">
                                                        <label for="totalProduktivitas" class="form-label">Total
                                                            Produktivitas</label>
                                                        <input type="number"
                                                            class="form-control @error('totalProduktivitas') is-invalid @enderror"
                                                            id="totalProduktivitas" name="totalProduktivitas"
                                                            value="{{ old('totalProduktivitas', $produksi->totalProduktivitas) }}"
                                                            autofocus step="0.01" required>
                                                        @error('totalProduktivitas')
                                                            <div class="invalid-feedback">
                                                                {{ $message }}
                                                            </div>
                                                        @enderror
                                                    </div>
                                                    <div class="mb-3">
                                                        <label for="totalProduksi" class="form-label">Total Produksi (Ton)</label>
                                                        <input type="number"
                                                            class="form-control @error('totalProduksi') is-invalid @enderror"
                                                            id="totalProduksi" name="totalProduksi"
                                                            value="{{ old('totalProduksi', $produksi->totalProduksi) }}"
                                                            autofocus step="0.01" required>
                                                        @error('totalProduksi')
                                                            <div class="invalid-feedback">
                                                                {{ $message }}
                                                            </div>
                                                        @enderror
                                                    </div>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary"
                                                        data-bs-dismiss="modal">Batal</button>
                                                    <button type="submit"
                                                        class="btn btn-outline-warning">Perbaharui</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                                {{-- / Modal Edit Produksi --}}

                                {{-- Modal Hapus Produksi --}}
                                <div class="modal fade " id="hapusProduksi{{ $loop->iteration }}" tabindex="-1"
                                    aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-scrollable" role="document">
                                        <div class="modal-content ">
                                            <div class="modal-header">
                                                <h5 class="modal-title">Hapus Data Produksi</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                    aria-label="Close"></button>
                                            </div>
                                            <form action="{{ route('produksi.destroy', $produksi->id) }}" method="post"
                                                enctype="multipart/form-data">
                                                @method('delete')
                                                @csrf
                                                <div class="modal-body">
                                                    <p class="fs-5">Apakah anda yakin akan menghapus data produksi
                                                        <b>{{ $produksi->Kecamatan->nama }}</b>?
                                                    </p>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary"
                                                        data-bs-dismiss="modal">Batal</button>
                                                    <button type="submit" class="btn btn-outline-danger">Hapus</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                                {{-- / Modal Hapus Produksi  --}}
                            @endforeach
                        </tbody>
                    </table>
                    {{-- / Tabel Data ... --}}
                </div>
            </div>
        </div>
    </div>


    <!-- Modal Tambah Produksi -->
    <div class="modal fade" id="tambahProduksi" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Tambah Produksi</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="{{ route('produksi.store') }}" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="modal-body">
                        <div class="row">
                            <div class="mb-3">
                                <label for="kecamatan" class="form-label">Kecamatan</label>
                                <select class="form-select" id="kecamatan" name="kecamatan">
                                    @foreach ($kecamatans as $kecamatan)
                                        <option value="{{ $kecamatan->id }}">
                                            {{ $kecamatan->nama }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="mb-3">
                                <label for="areaLahan" class="form-label">Area Lahan (ha)</label>
                                <input type="number" class="form-control @error('areaLahan') is-invalid @enderror"
                                    id="areaLahan" name="areaLahan" value="{{ old('areaLahan') }}"
                                    autofocus required>
                                @error('areaLahan')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label for="areaPanen" class="form-label">Area Panen (ha)</label>
                                <input type="number" class="form-control @error('areaPanen') is-invalid @enderror"
                                    id="areaPanen" name="areaPanen" value="{{ old('areaPanen') }}"
                                    autofocus required>
                                @error('areaPanen')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label for="priode" class="form-label">Priode</label>
                                <input type="number" class="form-control @error('priode') is-invalid @enderror"
                                    id="priode" name="priode" value="{{ old('priode') }}"
                                    autofocus required>
                                @error('priode')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label for="totalProduktivitas" class="form-label">Total Produktivitas</label>
                                <input type="number"
                                    class="form-control @error('totalProduktivitas') is-invalid @enderror"
                                    id="totalProduktivitas" name="totalProduktivitas"
                                    value="{{ old('totalProduktivitas') }}" autofocus
                                    step="0.01" required>
                                @error('totalProduktivitas')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label for="totalProduksi" class="form-label">Total Produksi (Ton)</label>
                                <input type="number" class="form-control @error('totalProduksi') is-invalid @enderror"
                                    id="totalProduksi" name="totalProduksi"
                                    value="{{ old('totalProduksi') }}" autofocus step="0.01"
                                    required>
                                @error('totalProduksi')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Batal</button>
                        <button type="submit" class="btn btn-primary">Tambah</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- Akhir Modal Tambah Produksi -->
@endsection
