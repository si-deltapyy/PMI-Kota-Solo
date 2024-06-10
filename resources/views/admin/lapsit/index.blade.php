@extends('layouts-admin.default')

@section('content')

<!-- partial -->
<div class="main-panel">
  <div class="content-wrapper">
    <div class="row">
      <div class="col-lg-12 grid-margin stretch-card">
        <div class="card">
          <div class="card-body">
            <h4 class="card-title">Laporan Situasi</h4>
            <p class="card-description">
              Daftar laporan situasi yang telah diunggah
            </p>
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
                      Action
                    </th>
                  </tr>
                </thead>
                <tbody>
                  @foreach($user as $x)
                  <tr>
                    <td>{{$x->id}}</td>
                    <td>{{$x->name}}</td>
                    <td>{{$x->username}}</td>
                    <td>{{$x->created_at}}</td>
                    <td>{{$x->updated_at}}</td>
                    <td>
                      <a href="#" class="btn btn-info btn-sm" data-bs-toggle="modal" data-bs-target="#detailModal"><i
                          class="menu-icon mdi mdi-information"></i></a>
                      <a href="#" class="btn btn-success btn-sm" data-bs-toggle="modal" data-bs-target="#shareModal"><i
                          class="menu-icon mdi mdi-share-variant"></i></a>
                    </td>
                  </tr>

                  <!-- Modal -->
                  <div class="modal fade" id="detailModal" tabindex="-1" role="dialog" aria-labelledby="detailModalLabel"
                    aria-hidden="true">
                    <div class="modal-dialog" role="document">
                      <div class="modal-content">
                        <div class="modal-header">
                          <h5 class="modal-title" id="detailModalLabel">Detail Laporan Situasi</h5>
                          <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                          </button>
                        </div>
                        <div class="modal-body">
                          <!-- Detailed information content will be populated here -->
                          <form class="forms-sample">
                            <div class="form-group">
                              <label for="kejadianMusibah">Kejadian Musibah</label>
                              <input type="text" class="form-control" id="kejadianMusibah" value="Gempa Bumi" readonly>
                            </div>
                            <div class="form-group">
                              <label for="lokasi">Lokasi</label>
                              <input type="text" class="form-control" id="lokasi" value="Jakarta" readonly>
                            </div>
                            <div class="form-group">
                              <label for="waktuKejadian">Waktu Kejadian</label>
                              <input type="text" class="form-control" id="waktuKejadian" value="10 Juni 2024, 14:00" readonly>
                            </div>
                            <div class="form-group">
                              <label for="update">Update</label>
                              <input type="text" class="form-control" id="update" value="10 Juni 2024, 16:00" readonly>
                            </div>
                            <div class="form-group">
                              <label for="keterangan">Keterangan</label>
                              <textarea class="form-control" id="keterangan" rows="4"
                                readonly>Keterangan tambahan mengenai situasi dan kondisi korban.</textarea>
                            </div>
                          </form>
                        </div>
                        <div class="modal-footer">
                          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        </div>
                      </div>
                    </div>
                  </div>

                  <!-- Modal -->
                  <div class="modal fade" id="shareModal" tabindex="-1" role="dialog" aria-labelledby="shareModalLabel"
                    aria-hidden="true">
                    <div class="modal-dialog" role="document">
                      <div class="modal-content">
                        <div class="modal-header">
                          <h5 class="modal-title" id="detailModalLabel">Share Laporan Situasi</h5>
                          <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                          </button>
                        </div>
                        <div class="modal-body">
                          <!-- Detailed information content will be populated here -->
                          <form class="forms-sample">
                            <div class="form-group">
                              <label for="kejadianMusibah">Kejadian Musibah</label>
                              <input type="text" class="form-control" id="kejadianMusibah" value="Gempa Bumi" readonly>
                            </div>
                            <div class="form-group">
                              <label for="lokasi">Lokasi</label>
                              <input type="text" class="form-control" id="lokasi" value="Jakarta" readonly>
                            </div>
                            <div class="form-group">
                              <label for="waktuKejadian">Waktu Kejadian</label>
                              <input type="text" class="form-control" id="waktuKejadian" value="10 Juni 2024, 14:00" readonly>
                            </div>
                            <div class="form-group">
                              <label for="update">Update</label>
                              <input type="text" class="form-control" id="update" value="10 Juni 2024, 16:00" readonly>
                            </div>
                            <div class="form-group">
                              <label for="keterangan">Keterangan</label>
                              <textarea class="form-control" id="keterangan" rows="4"
                                readonly>Keterangan tambahan mengenai situasi dan kondisi korban.</textarea>
                            </div>
                          </form>
                          <div class="d-flex btn-wrapper">
                            <form action="{{ route('view-pdf', $x->id) }}" method="post" target="_blank">
                              @csrf
                              <button  class="btn btn-info text-white me-0">
                                <i class="mdi mdi-file-pdf"></i> Download Laporan PDF
                              </button>
                            </form>
                            <form action="{{ route('share.lapsit', $x->id) }}" method="post">
                              @csrf
                              <button  class="btn btn-success text-white me-0">
                                <i class="mdi mdi-whatsapp"></i> Share
                              </button>
                            </form>
                          </div>
                        </div>
                        <div class="modal-footer">
                          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        </div>
                      </div>
                    </div>
                  </div>
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
