@extends('layouts-pengelolaProfil.default')

@section('content')

@section('content')

<!-- Page Wrapper -->
<div id="wrapper">

<!-- Content Wrapper -->
<div id="content-wrapper">

    <!-- Main Content -->
    <div id="content">

        <!-- Topbar -->
        <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">

            <!-- Sidebar Toggle (Topbar)
            <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
                <i class="fa fa-bars"></i>
            </button> -->

        @section('content')
        <div class="main-panel">
          <div class="content-wrapper ">
            <div class="row flex-grow">
            <div class="col-20 grid-margin stretch-card">
                <div class="card card-rounded">
                  <div class="card-body">
                    <h4 class="card-title">Edit Akun Relawan</h4>
                    
                    <form class="forms-sample" action="post" >
                      <div class="form-group">
                        <label for="exampleInputName1">Name</label>
                        <input type="text" class="form-control" id="exampleInputName1" placeholder="Name">
                      </div>
                      <div class="form-group">
                        <label for="exampleInputName1">Username</label>
                        <input type="text" class="form-control" id="exampleInputName1" placeholder="Name">
                      </div>
                      <div class="form-group">
                        <label for="exampleInputEmail3">Email address</label>
                        <input type="email" class="form-control" id="exampleInputEmail3" placeholder="Email">
                      </div>
                      <div class="form-group">
                        <label for="exampleInputPassword4">Password</label>
                        <input type="password" class="form-control" id="exampleInputPassword4" placeholder="Password">
                      </div>

                      <!-- Edit Modal-->
                      <div class="modal fade" id="generateModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel">Apakah anda yakin ingin diedit?</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">Klik "Ya" dibawah ini jika ingin mengedit akun Relawan</div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-black" data-bs-dismiss="modal">Tidak</button>
                                        <a class="btn btn-primary text-white me-0" href="{{ route('pengelola-edit') }}">Ya</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                         <!-- end of Logout Modal-->
                      
                      <button type="submit" class="btn btn-primary me-2">Edit Akun</button>
                      <button class="btn btn-light">Cancel</button>
                    </form>
                  </div>
                </div>
              </div>
              </div>
              </div>
              </div>

    @endsection     
</div>
</div>
@endsection


    
