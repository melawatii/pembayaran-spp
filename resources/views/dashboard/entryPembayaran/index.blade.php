@extends('dashboard.layout')

@section('content')
<main class="main-content position-relative border-radius-lg ">
  <!-- Navbar -->
  <nav class="navbar navbar-main navbar-expand-lg px-0 mx-4 shadow-none border-radius-xl " id="navbarBlur" data-scroll="false">
    <div class="container-fluid py-1 px-3">
      <nav aria-label="breadcrumb">
        <h6 class="font-weight-bolder text-white mt-4 mb-0">Data Pembayaran</h6>
      </nav>
    </div>
  </nav>
  <!-- End Navbar -->
  <div class="container-fluid py-4">
    <div class="row">
      <div class="col-12">
        <div class="card mb-4">
          @if(session()->has('message'))
            <div class="mt-4 ms-3 me-3 text-light fw-bold alert alert-success" role="alert">
                {{ session('message') }}
            </div>
          @endif
          <div class="card-header pb-0 d-flex justify-content-between">
            <div class="input-group" style="width: 25%;">
              <form class="nav-link mt-2 mt-md-0 d-none d-lg-flex search" action="/entryPembayaran/search" method="GET">
                <input type="search" name="search" class="form-control" placeholder="Cari NISN ..." autofocus>
              </form>
            </div>
            <div>
              <a href="/dataPembayaran/create" class="btn btn-sm mb-0 me-1 btn-success">Create</a>
            </div>
          </div>
          <div class="card-body px-0 pt-0 pb-2">
            <div class="table-responsive p-0">
              <table class="table align-items-center mt-4 mb-0">
                <thead>
                  <tr>
                    <th class="text-uppercase text-xs font-weight-bolder opacity-9">No</th>
                    <th class="text-uppercase text-xs font-weight-bolder opacity-9">Petugas</th>
                    <th class="text-uppercase text-xs font-weight-bolder opacity-9">NISN</th>
                    <th class="text-uppercase text-xs font-weight-bolder opacity-9">Tanggal Bayar</th>
                    <th class="text-uppercase text-xs font-weight-bolder opacity-9">SPP</th>
                    <th class="text-uppercase text-xs font-weight-bolder opacity-9">Jumlah Bayar</th>
                    <th class="text-uppercase text-xs font-weight-bolder opacity-9">Sisa Pembayaran</th>
                    <th class="text-uppercase text-xs font-weight-bolder opacity-9">Action</th>
                  </tr>
                </thead>
                <tbody>
                  @foreach($pembayaran as $row)
                    <tr>
                      <td class="text-xs font-weight-bolder opacity-7">
                        {{ $loop->iteration }}
                      </td>
                      <td class="text-xs font-weight-bolder opacity-7">
                        {{ $row->id_petugas }}
                      </td>
                      <td class="text-xs font-weight-bolder opacity-7">
                        {{ $row->nisn }}
                      </td>
                      <td class="text-xs font-weight-bolder opacity-7">
                        {{ $row->tgl_bayar }} {{ $row->bulan_dibayar }} {{ $row->tahun_dibayar }}
                      </td>
                      <td class="text-xs font-weight-bolder opacity-7">
                        {{ number_format($row->id_spp) }}
                      </td>
                      <td class="text-xs font-weight-bolder opacity-7">
                        Rp {{ number_format($row->jumlah_bayar) }}
                      </td>
                      @if($row->sisa_bayar >= 0)
                        <td class="text-xs text-success font-weight-bolder opacity-7">
                          Rp {{ number_format($row->sisa_bayar) }}
                        </td>
                      @elseif($row->sisa_bayar < 0)
                        <td class="text-xs text-danger font-weight-bolder opacity-7">
                          Rp {{ number_format($row->sisa_bayar) }}
                        </td>
                      @endif
                      <td class="text-xs font-weight-bolder opacity-7">
                        <form action="{{ route('entryPembayaran.destroy',$row->id) }}" method="POST">
                          @csrf
                          @method('DELETE')
                          <button type="submit" onclick="return confirm('Apakah Anda yakin?')" class="btn btn-sm mb-0 me-1 btn-danger">Delete</button>
                        </form>
                      </td>
                    </tr>
                  @endforeach
                </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</main>
@endsection