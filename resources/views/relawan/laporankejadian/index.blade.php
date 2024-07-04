@extends('layouts-relawan.default')

@section('content')
<div class="content-wrapper">
  <div class="row">
    <div class="col-lg-12 grid-margin stretch-card">
      <div class="card">
        <div class="card-body">
          <h4 class="card-title">Laporan Kejadian</h4>
          <p class="card-description">Daftar laporan kejadian</p>
          <div class="d-flex justify-content-between align-items-center mb-6 ms-auto">
            <!-- Add Filter Buttons -->
            <div>
              <a href="{{ route('relawan-laporankejadian', ['status' => 'On Process'] && ['status' => 'Valid'] && ['status' => 'Invalid']) }}"
                class="btn btn-outline-primary btn-sm @if(empty(request('status'))) active @endif">All</a>
              <a href="{{ route('relawan-laporankejadian', ['status' => 'On Process']) }}"
                class="btn btn-outline-warning btn-sm @if(request('status') == 'On Process') active @endif">Dalam
                Proses</a>
              <a href="{{ route('relawan-laporankejadian', ['status' => 'Valid']) }}"
                class="btn btn-outline-success btn-sm @if(request('status') == 'Valid') active @endif">Valid</a>
              <a href="{{ route('relawan-laporankejadian', ['status' => 'Invalid']) }}"
                class="btn btn-outline-danger btn-sm @if(request('status') == 'Invalid') active @endif">Invalid</a>
            </div>
            <!-- Add Search Form -->
            <form class="search-form ms-auto w-80" method="GET" action="{{ route('relawan-laporankejadian') }}">
              <div class="input-group">
                <input type="search" name="search" class="form-control" placeholder="Search Here"
                  value="{{ request('search') }}">
                <span class="input-group-text"><i class="icon-search"></i></span>
              </div>
            </form>
          </div>
          @if(session('failure'))
        <br>
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
        {{ session('failure') }}
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
        </div>
      @endif

          @if(session('success'))
        <br>
        <div class="alert alert-success alert-dismissible fade show" role="alert">
        {{ session('success') }}
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
        </div>
      @endif

          <div class="table-responsive pt-3">
            <table class="table table-bordered">
              <thead>
                <tr>
                  <th>No</th>
                  <th>Kategori Kejadian</th>
                  <th>Lokasi</th>
                  <th>Tanggal Kejadian</th>
                  <th>Status</th>
                  <th>Aksi</th>
                </tr>
              </thead>
              <tbody>
                @forelse($reports as $report)
          <tr>
            <td>{{ $loop->iteration }}</td>
            <td>{{ $report->jeniskejadian ? $report->jeniskejadian->nama_kejadian : 'Nama tidak ditemukan' }}</td>
            <td>{{ $report->location_name }}</td>
            <td>{{ \Carbon\Carbon::parse($report->tanggal_kejadian)->format('d-m-Y') }}</td>
            <td>
            @if($report->status == 'On Process')
        <button class="btn btn-warning btn-sm text-white" disabled>Dalam Proses</button>
      @elseif($report->status == 'Valid')
    <button class="btn btn-success btn-sm text-white" disabled>Valid</button>
  @elseif($report->status == 'Invalid')
  <button class="btn btn-danger btn-sm text-white" disabled>Invalid</button>
@endif
            </td>
            <td>
            <a href="/relawan/laporan-kejadian/view/{{ $report->id_report }}" class="btn btn-info btn-sm"><i
              class="menu-icon mdi mdi-information"></i></a>
            <button class="btn btn-primary btn-sm btn-detail" data-bs-toggle="modal"
              data-bs-target="#approveModal{{ $report->id_report }}"
              data-document-id="{{ $report->id_report }}">
              <i class="menu-icon mdi mdi-checkbox-multiple-marked-circle"></i>
            </button>
            @if($report->status == 'Valid')
        <a href="{{ route('create-assessment', $report->id_report) }}"
          class="btn btn-success btn-sm btn-detail d-inline">Create</a>
        <form method="GET" action="{{ route('create-assessment', $report->id_report) }}" class="d-inline">
          @csrf
          <!-- <button type="submit" class="btn btn-success btn-sm btn-detail">Create</button> -->
        </form>
      @endif
            </td>
          </tr>

          <!-- Modal for each report -->
          <div class="modal fade" id="approveModal{{ $report->id_report }}" tabindex="-1"
            aria-labelledby="exampleModalLabel{{ $report->id }}" aria-hidden="true">
            <div class="modal-dialog" role="document">
            <div class="modal-content">
              <div class="modal-header">
              <h5 class="modal-title" id="exampleModalLabel{{ $report->id_report }}">Verifikasi Laporan</h5>
              <button class="close" type="button" data-bs-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">×</span>
              </button>
              </div>
              <div class="modal-body">Apakah yakin ingin memverifikasi laporan ini?</div>
              <div class="modal-footer">
              <!-- Validasi -->
              <form action="{{ route('relawan-verify', $report->id_report) }}" method="POST">
                @csrf
                @method('PATCH')
                <button type="submit" class="btn btn-success">Validasi</button>
              </form>

              <!-- Invalidasi -->
              <form action="{{ route('relawan-unverify', $report->id_report) }}" method="POST">
                @csrf
                @method('PATCH')
                <button type="submit" class="btn btn-danger">Invalidasi</button>
              </form>
              </div>
            </div>
            </div>
          </div>

        @empty
      <tr>
        <td colspan="7">Belum ada laporan kejadian.</td>
      </tr>
    @endforelse
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection




<!-- <script>
    document.querySelectorAll('.btn-detail').forEach(button => {
      button.addEventListener('click', function (event) {
        event.preventDefault();
        const documentId = this.getAttribute('data-document-id');
        fillModalWithData(documentId);
      });
    });

    document.querySelectorAll('.btn-verify').forEach(button => {
      button.addEventListener('click', function (event) {
        event.preventDefault();
        const documentId = this.getAttribute('data-document-id');
        console.log('Verifying document with ID:', documentId);
      });
    });

   
  </script> -->