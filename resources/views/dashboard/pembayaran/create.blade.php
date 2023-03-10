@extends('dashboard.layout')

@section('content')
<main class="main-content position-relative border-radius-lg ">
    <!-- Navbar -->
    <nav class="navbar navbar-main navbar-expand-lg px-0 mx-4 shadow-none border-radius-xl " id="navbarBlur" data-scroll="false">
        <div class="container-fluid py-1 px-3">
            <nav aria-label="breadcrumb">
                <h6 class="font-weight-bolder text-white mt-4 mb-0">Create Data Pembayaran</h6>
            </nav>
        </div>
    </nav>
    <!-- End Navbar -->
    <div class="container-fluid py-4">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body">
                        <form class="forms-sample" method="post" action="{{ route('dataPembayaran.store') }}">
                            @csrf
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="example-text-input" class="form-control-label">Petugas</label>
                                        <input class="form-control" name="id_petugas" id="id_petugas" type="text" value="{{ Auth()->user()->nama_petugas }}" readonly>
                                        @error('id_petugas')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="example-text-input" class="form-control-label">NISN</label>
                                        <select class="form-control" name="tunggakan" id="tunggakan" value="{{ old('tunggakan') }}" required autofocus>
                                            @foreach($id_tunggakan as $siswa)
                                                <option value="{{$siswa->id}}">{{$siswa->nisn}}</option>
                                            @endforeach
                                        </select>
                                        @error('nisn')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="example-text-input" class="form-control-label">Nama</label>
                                        <select class="form-control" name="nama" id="nama" value="{{ old('nama') }}" required autofocus>
                                            @foreach($nisn as $siswa)
                                                <option value="{{$siswa->nisn}}">{{$siswa->nama}}</option>
                                            @endforeach
                                        </select>
                                        @error('nama')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="example-text-input" class="form-control-label">SPP</label>
                                        <select class="form-control" name="id_spp" id="bil1" value="{{ old('id_spp') }}" required>
                                            @foreach($id_spp as $spp)
                                                <option value="{{$spp->nominal}}" data-nominal="{{ $spp->nominal }}">{{ number_format($spp->nominal) }}</option>
                                            @endforeach
                                        </select>
                                        @error('id_spp')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="example-text-input" class="form-control-label">Bulan Dibayar</label>
                                        <input class="form-control" name="bulan_dibayar" id="bil2" type="number" placeholder="Masukkan jumlah bulan dibayar ..." value="{{ old('bulan_dibayar') }}" required>
                                        @error('bulan_dibayar')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="example-text-input" class="form-control-label">Jumlah bayar</label>
                                        <input class="form-control" name="jumlah_bayar" id="hasil" type="number"  value="{{ old('jumlah_bayar') }}" readonly>
                                        @error('jumlah_bayar')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <hr class="horizontal dark">
                            <div class="d-flex justify-content-end mt-4">
                                <button class="btn btn-primary btn-sm me-3">Save</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>
<script>
    document.querySelector('#bil2').addEventListener('input', () => {
        const bil1 = parseInt(document.querySelector('#bil1')[document.querySelector('#bil1').selectedIndex].dataset.nominal)
        const bil2 = parseInt(document.querySelector('#bil2').value)
        const hasil = bil1 * bil2
        document.querySelector('#hasil').value = hasil
    })
</script>
@endsection