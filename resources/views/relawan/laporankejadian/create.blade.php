@extends('layouts-relawan.default')

@section('content')
        <!-- partial -->
        <div class="content-wrapper">
            <div class="row">
            <div class="col-12 grid-margin stretch-card">
              <div class="card">
                <div class="card-body">
                <h4 class="card-title">Laporan Kejadian</h4>
                  <p class="card-description">
                    Tambahkan laporan kejadian
                  </p> 
                  <div class="home-tab">
                    <div class="d-sm-flex align-items-center justify-content-between border-bottom">
                        <!-- <div class="btn-wrapper ms-auto">
                            <a href="{{ route('relawan-laporankejadian') }}" class="btn btn-primary text-white me-0">
                                <i class="mdi mdi-table-edit"></i> Edit Data
                            </a>
                        </div> -->
                    </div>
                  <div class="form-group">
                      <label for="exampleSelectGender">Kategori Bencana</label>
                        <select class="form-control form-control-sm" id="exampleSelectGender">
                          <option>Banjir</option>
                          <option>Gempa Bumi</option>
                          <option>Kecelakaan</option>
                          <option>Kebakaran</option>
                          <option>Longsor</option>
                        </select>
                      </div>
                    <div class="form-group">
                        <label for="exampleInputCity1">Lokasi</label>
                        <input type="text" class="form-control form-control-sm" id="exampleInputCity1" placeholder="Location">
                    </div>
                  <!-- <form class="forms-sample">
                    <div class="form-group">
                      <label for="exampleInputName1">Nama Bencana</label>
                      <input type="text" class="form-control form-control-sm" id="exampleInputName1" placeholder="Name">
                    </div> -->
                    <!-- <div class="form-group">
                        <label for="exampleInputDate">Nama Bencana</label>
                        <input type="date" class="form-control form-control-sm" id="exampleInputDate" placeholder="dd/mm/yyyy">
                      </div> -->
                    <div class="form-group">
                        <label class="exampleInputDate">Waktu Kejadian</label>
                        <input type="datetime-local" class="form-control form-control-sm" id="waktu-kejadian" placeholder="dd/mm/yyyy hh:mm"/>
                    </div>
                    <!-- <div class="form-group">
                      <label for="exampleInputPassword4">Password</label>
                      <input type="password" class="form-control" id="exampleInputPassword4" placeholder="Password">
                    </div>  -->
                    <!-- <div class="form-group">
                      <label for="exampleSelectGender">Kategori Bencana</label>
                        <select class="form-control form-control-sm" id="exampleSelectGender">
                          <option>Banjir</option>
                          <option>Gempa Bumi</option>
                          <option>Kecelakaan</option>
                          <option>Kebakaran</option>
                          <option>Longsor</option>
                        </select>
                      </div> -->
                    <!-- <div class="form-group">
                        <label>Lampiran</label>
                        <input id="fileInput" type="file" class="file-upload-default">
                        <div class="input-group col-xs-12">
                            {{-- <input type="file" name="file" id="fileInput"> --}}
                            <input type="file" class="form-control form-control-sm" placeholder="Upload Image">
                            <span class="input-group-append">
                                <button class="file-upload-browse btn btn-primary btn-sm" type="button">Upload</button>
                            </span>
                        </div>
                    </div> -->
                    <div class="form-group">
                      <label for="exampleTextarea1">Keterangan</label>
                      <textarea class="form-control form-control-sm" id="exampleTextarea1" rows="4"></textarea>
                    </div>
                    <div class="btn-wrapper">
                      {{--  <a href="#" class="btn btn-otline-dark align-items-center"><i class="icon-share"></i> Share</a>
                      <a href="#" class="btn btn-otline-dark"><i class="icon-printer"></i> Print</a>  --}}
                      <a href="#" class="btn btn-primary text-white me-0" data-bs-toggle="modal" data-bs-target="#generateModal"><i class="icon-download"></i> Submit</a>

                        <!-- Submit Modal-->
                        <div class="modal fade" id="generateModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel">Apakah anda yakin ingin mensubmit laporan kejadian?</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">Klik "Submit" dibawah ini jika ingin mensubmit Laporan Kejadian</div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-black" data-bs-dismiss="modal">Cancel</button>
                                        <a class="btn btn-primary text-white me-0" href="{{ route('relawan-laporankejadian') }}">Submit</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                         <!-- end of Logout Modal-->

                        <button class="btn btn-light">Cancel</button>
                    </div>
                    <!-- <a href="{{ route('relawan-laporankejadian') }}" class="btn btn-primary text-white me-2" role="button"></i>Submit</a> -->
                    <!-- Submit Modal -->
                    
                  </form>
                </div>
              </div>
            </div>
            </div>
          </div>
        </div>
        <!-- {{-- <form action="{{ route('submit-bencana') }}" method="POST">
            @csrf
            <div class="form-group">
                <label for="nama_bencana">Nama Bencana</label>
                <input type="text" class="form-control" id="nama_bencana" name="nama_bencana" required>
            </div>
            <div class="form-group">
                <label for="lokasi">Lokasi</label>
                <input type="text" class="form-control" id="lokasi" name="lokasi" required>
            </div>
            <div class="form-group">
                <label for="deskripsi">Deskripsi</label>
                <textarea class="form-control" id="deskripsi" name="deskripsi" rows="4" required></textarea>
            </div>
            <button type="submit" class="btn btn-primary">Laporkan Kejadian</button>
        </form> --}} -->
    </div>
    </div>
    </div>
    
@endsection
