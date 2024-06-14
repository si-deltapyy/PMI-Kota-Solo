@extends('layouts-relawan.default')

@section('content')

<!-- partial -->
<div class="main-panel">
  <div class="content-wrapper">
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
    <div class="row">
      <div class="col-lg-12 grid-margin stretch-card">
        <div class="card">
          <div class="card-body">
            <h4 class="card-title">Laporan Assessment</h4>
            <p class="card-description">
              Daftar laporan assessment yang telah diunggah
            </p>
            <div class="home-tab">
              <div class="d-sm-flex align-items-center justify-content-between border-bottom">
                <div class="btn-wrapper ms-auto">
                  <a href="{{ route('create-assessment') }}" class="btn btn-primary text-white me-0">
                    <i class="icon-download"></i> Tambah Data
                  </a>
                </div>
              </div>
            </div>
            <div>
              <div class="table-responsive pt-3">
                <table class="table table-bordered">
                  <thead>
                    <tr>
                      <th>
                        No
                      </th>
                      <th>
                        Jenis Kejadian
                      </th>
                      <th>
                        Lokasi
                      </th>
                      <th>
                        Waktu Kejadian
                      </th>
                      <th>
                        Terakhir Update
                      </th>
                      <th>
                        Status
                      </th>
                      <th>
                        Action
                      </th>
                    </tr>
                  </thead>
                  <tbody>
                    <tr>
                      <td>1</td>
                      <td>Banjir</td>
                      <td>Jakarta</td>
                      <td>2024-05-01 14:00</td>
                      <td>2024-05-01 15:00</td>
                      <td>
                        <p class="btn btn-success btn-sm">Terkonfirmasi</p>
                      </td>
                      <td>
                        <a href="{{ route('create-assessment') }}" class="btn btn-info btn-sm"><i
                            class="menu-icon mdi mdi-information"></i></a>
                        <a href="{{ route('edit-assessment') }}" class="btn btn-warning btn-sm"><i
                            class="menu-icon mdi mdi-border-color"></i></a>
                        <!-- Delete button settings -->
                        @if ($assessment->hasil_verifikasi === 'Belum Diverifikasi')
                          <a class="btn btn-danger btn-sm" href="#" data-bs-toggle="modal" data-bs-target="#deleteModal{{ $assessment->id_assessment }}"><i class="menu-icon mdi mdi-delete"></i></a>
                        @else
                          <button class="btn btn-danger btn-sm" disabled><i class="menu-icon mdi mdi-delete"></i></button>
                        @endif
                        <!-- End of Delete button settings -->
                      </td>
                    </tr>
                    <tr>
                      <td>2</td>
                      <td>Gempa</td>
                      <td>Bandung</td>
                      <td>2024-05-02 10:30</td>
                      <td>2024-05-02 11:00</td>
                      <td>
                        <p class="btn btn-warning btn-sm">Belum Terkonfirmasi</p>
                      </td>
                      <td>
                        <a href="{{ route('create-assessment') }}" class="btn btn-info btn-sm"><i
                            class="menu-icon mdi mdi-information"></i></a>
                        <a href="{{ route('edit-assessment') }}" class="btn btn-warning btn-sm"><i
                            class="menu-icon mdi mdi-border-color"></i></a>
                        <a href="#" class="btn btn-danger btn-sm"><i class="menu-icon mdi mdi-delete"></i></a>
                      </td>
                    </tr>
                    <tr>
                      <td>3</td>
                      <td>Kebakaran</td>
                      <td>Surabaya</td>
                      <td>2024-05-03 09:15</td>
                      <td>2024-05-03 09:45</td>
                      <td>
                        <p class="btn btn-success btn-sm">Terkonfirmasi</p>
                      </td>
                      <td>
                        <a href="{{ route('create-assessment') }}" class="btn btn-info btn-sm"><i
                            class="menu-icon mdi mdi-information"></i></a>
                        <a href="{{ route('edit-assessment') }}" class="btn btn-warning btn-sm"><i
                            class="menu-icon mdi mdi-border-color"></i></a>
                        <a href="#" class="btn btn-danger btn-sm"><i class="menu-icon mdi mdi-delete"></i></a>
                      </td>
                    </tr>
                    <tr>
                      <td>4</td>
                      <td>Longsor</td>
                      <td>Yogyakarta</td>
                      <td>2024-05-04 18:00</td>
                      <td>2024-05-04 18:30</td>
                      <td>
                        <p class="btn btn-success btn-sm">Terkonfirmasi</p>
                      </td>
                      <td>
                        <a href="{{ route('create-assessment') }}" class="btn btn-info btn-sm"><i
                            class="menu-icon mdi mdi-information"></i></a>
                        <a href="{{ route('edit-assessment') }}" class="btn btn-warning btn-sm"><i
                            class="menu-icon mdi mdi-border-color"></i></a>
                        <a href="#" class="btn btn-danger btn-sm"><i class="menu-icon mdi mdi-delete"></i></a>
                      </td>
                    </tr>
                    <tr>
                      <td>5</td>
                      <td>Banjir</td>
                      <td>Medan</td>
                      <td>2024-05-05 07:00</td>
                      <td>2024-05-05 08:00</td>
                      <td>
                        <p class="btn btn-warning btn-sm">Belum Terkonfirmasi</p>
                      </td>
                      <td>
                        <a href="{{ route('create-assessment') }}" class="btn btn-info btn-sm"><i
                            class="menu-icon mdi mdi-information"></i></a>
                        <a href="{{ route('edit-assessment') }}" class="btn btn-warning btn-sm"><i
                            class="menu-icon mdi mdi-border-color"></i></a>
                        <a href="#" class="btn btn-danger btn-sm"><i class="menu-icon mdi mdi-delete"></i></a>
                      </td>
                    </tr>
                    <!-- Delete Modal-->
                      <div class="modal fade" id="deleteModal{{ $assessment->id_assessment }}" tabindex="-1" aria-labelledby="exampleModalLabel{{ $assessment->id_assessment }}" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                          <div class="modal-content">
                            <div class="modal-header">
                              <h5 class="modal-title" id="exampleModalLabel{{ $assessment->id_assessment }}">Yakin untuk hapus data?</h5>
                              <button class="close" type="button" data-bs-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">×</span>
                              </button>
                            </div>
                            <div class="modal-body">Tekan tombol di bawah ini untuk menghapus data.</div>
                            <div class="modal-footer">
                              <form action="{{ route('delete-assessment', ['id' => $assessment->id_assessment]) }}" method="POST">
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