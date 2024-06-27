@extends('layouts-relawan.default')

@section('content')

<!-- partial -->
<div class="main-panel">
  <div class="content-wrapper">
    <div class="row">
      <div class="col-lg-12 grid-margin stretch-card">
        <div class="card">
          <div class="card-body">
            <h4 class="card-title">Laporan Assessment</h4>
            <p class="card-description">
              Daftar laporan assessment yang telah diunggah
            </p>
            <!-- Delete Alert-->
            @if(session('success'))
              <div class="alert alert-success">
                {{ session('success') }}
              </div>
            @endif

            @if(session('error'))
              <div class="alert alert-danger">
                {{ session('error') }}
              </div>
            @endif
            <!-- End of Delete Alert-->
            <div class="home-tab">
              <div class="d-sm-flex align-items-center justify-content-between border-bottom">
                <div class="btn-wrapper ms-auto">
                  {{--  <a href="{{ route('create-assessment') }}" class="btn btn-primary text-white me-0">
                    <i class="icon-download"></i> Tambah Data
                  </a>  --}}
                </div>
              </div>
            </div>
            <div>
              <div class="table-responsive pt-3">
                <table class="table table-bordered">
                  <thead>
                    <tr>
                      <th>No</th>
                      <th>Jenis Kejadian</th>
                      <th>Lokasi</th>
                      <th>Waktu Kejadian</th>
                      <th>Terakhir Update</th>
                      <th>Status</th>
                      <th>Action</th>
                    </tr>
                  </thead>
                  <tbody>
                    @foreach($kejadianBencanaList as $kejadianBencana)
                    <tr>
                      <td>{{ $loop->iteration }}</td>
                      <td>{{ $kejadianBencana->jenisKejadian->nama }}</td>
                      <td>{{ $kejadianBencana->lokasi }}</td>
                      <td>{{ $kejadianBencana->tanggal_kejadian }}</td>
                      <td>{{ $kejadianBencana->updated_at }}</td>
                      <td>
                        <p class="btn btn-success btn-sm">Terkonfirmasi</p>
                      </td>
                      <td>
                        <a href="{{ route('create-assessment') }}" class="btn btn-info btn-sm"><i class="menu-icon mdi mdi-information"></i></a>
                        <a href="{{ route('edit-assessment', ['id' => $kejadianBencana->id_kejadian]) }}" class="btn btn-warning btn-sm"><i class="menu-icon mdi mdi-border-color"></i></a>
                        <!-- Delete button settings -->
                        <a class="btn btn-danger btn-sm" href="#" data-bs-toggle="modal" data-bs-target="#deleteModal{{ $kejadianBencana->id_kejadian }}"><i class="menu-icon mdi mdi-delete"></i></a>
                        <!-- End of Delete button settings -->
                      </td>
                    </tr>
                    <!-- Delete Modal-->
                    <div class="modal fade" id="deleteModal{{ $kejadianBencana->id_kejadian }}" tabindex="-1" aria-labelledby="exampleModalLabel{{ $kejadianBencana->id_kejadian }}" aria-hidden="true">
                      <div class="modal-dialog" role="document">
                        <div class="modal-content">
                          <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel{{ $kejadianBencana->id_kejadian }}">Yakin untuk hapus data?</h5>
                            <button class="close" type="button" data-bs-dismiss="modal" aria-label="Close">
                              <span aria-hidden="true">×</span>
                            </button>
                          </div>
                          <div class="modal-body">Tekan tombol di bawah ini untuk menghapus data.</div>
                          <div class="modal-footer">
                            <form action="{{ route('delete-lapsit', ['id' => $kejadianBencana->id_kejadian]) }}" method="POST">
                              @csrf
                              @method('DELETE')
                              <button type="submit" class="btn btn-danger">DELETE</button>
                            </form>
                            <button class="btn btn-secondary" type="button" data-bs-dismiss="modal">CANCEL</button>
                          </div>
                        </div>
                      </div>
                    </div>
                    <!-- End of Delete Modal-->
                    @endforeach
                  </tbody>
                </table>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <!-- content-wrapper ends -->

@endsection
