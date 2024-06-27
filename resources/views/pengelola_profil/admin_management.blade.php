@extends('layouts-pengelolaProfil.default')
@section('content')

<!-- Page Wrapper -->
<div id="wrapper">

<!-- Content Wrapper -->
<div id="content-wrapper" class="d-flex flex-column">

    <!-- Main Content -->
    <div id="content">

        <!-- Topbar -->
        <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">

            <!-- Sidebar Toggle (Topbar) -->
            <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
                <i class="fa fa-bars"></i>
            </button>

            <!-- Topbar Search -->
        
            
            @section('content')

           

            <div class="content-wrapper">
            <div class="row flex-grow">
                <div class="col-12 grid-margin stretch-card">
                    <div class="card card-rounded">
                        <div class="card-body">
                        <div class="d-sm-flex justify-content-between align-items-center">

                            <div class="w-100 text-center">
                                <h1 class="card-title card-title-dash">LIST ADMIN</h1>
                            </div>
                        </div>

                        <!-- alert -->
                        @if (session('error'))
                                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                    <strong>Error!</strong> {{ session('error') }}
                                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                </div>
                            @endif

                            @if (session('success'))
                                <div class="alert alert-success alert-dismissible fade show" role="alert">
                                    <strong>Success!</strong> {{ session('success') }}
                                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                </div>
                            @endif
                            <!-- end alert  -->
                             
                        <br>
                        <div class="d-sm-flex justify-content-between align-items-start">
                        <a href="{{ url('/pengelolaProfil/add-admin') }}" class="btn btn-primary btn-sm me-2" type="button">
                                    <i class="mdi mdi-account-plus"></i> Tambah Akun
                             </a>
                            <div class="d-flex ms-auto align-items-center">
                            <form class="search-form" method="GET" action="{{ route('pengelola-admin') }}">  
                                <div class="input-group">
                                    <input type="search" name="search" class="form-control" placeholder="Search Here" title="Search here" value="{{ request('search') }}">
                                    <span class="input-group-text"><i class="icon-search"></i></span>
                                </div>
                            </form>
                            </div>
                        </div>
                       

                      
                        <!-- Confirmation Modal-->
                        <!-- <div class="modal fade" id="confirmationModal" tabindex="-1" aria-labelledby="confirmationModalLabel" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="confirmationModalLabel">Konfirmasi</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body" id="confirmationMessage">Apakah Anda yakin?</div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tidak</button>
                                        <a class="btn btn-primary text-white" id="confirmationButton">Ya</a>
                                    </div>
                                </div>
                            </div>
                        </div> -->


<!-- end modal -->


                    

                            <table class="table ">
                                <thead>
                                <tr>
                                    <th>Nama</th>
                                    <th>Email</th>
                                    <th>Username</th>
                                    <th>Action</th>
                                    <!-- <th>
                                    <a href="{{ url('/pengelolaProfil/add-admin') }}" class="btn btn-primary btn-sm" type="button"> <i class="mdi mdi-account-plus"></i> Tambah Akun</a>
                                    </th> -->
                                </tr>
                                </thead>
                                <tbody>
                                    @foreach($user as $list)
                                    <tr>
                                            <td>{{$list->name}}</td>
                                            <td>{{$list->email}}</td>
                                            <td>{{$list->username}}</td>
                    
                                            <td>
                                        <!-- <a href="javascript:void(0);" data-bs-toggle="modal" data-bs-target="#confirmationModal" data-action="edit" data-url="{{ route('pengelolaProfil.edit', $list->id) }}">
                                            <label class="btn btn-info btn-sm"><i class="mdi mdi-pencil"></i></label>
                                        </a>
                                        <a href="javascript:void(0);" data-bs-toggle="modal" data-bs-target="#confirmationModal" data-action="delete" data-url="{{ route('pengelola-user-hapusAdmin', $list->id) }}">
                                            <label class="btn btn-danger btn-sm"><i class="mdi mdi-delete-forever"></i></label>
                                        </a> -->

                                     
                                                <a href="{{ route('pengelolaProfil.edit_admin', $list->id) }}"><label class="btn btn-info btn-sm"><i class="mdi mdi-pencil"></i></label></a> 
                                                <a href="{{ route('pengelolaProfil.show_detail', $list->id) }}" class="btn btn-warning btn-sm"><i class="menu-icon mdi mdi-information"></i></a>
                                                <button class="btn btn-danger btn-sm" data-bs-toggle="modal" data-bs-target="#deleteModal{{ $list->id }}">
                                                    <i class="mdi mdi-delete-forever"></i>
                                                </button>
                                          
                                    </td>
                                </tr>
                                @endforeach
                                            
                                </tbody>
                            </table>
                            </div>

                            <!-- Modals -->
                        @foreach($user as $list)
                        <div class="modal fade" id="deleteModal{{ $list->id }}" tabindex="-1" aria-labelledby="exampleModalLabel{{ $list->id }}" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel{{ $list->id }}">Yakin untuk hapus data?</h5>
                                        <button class="close" type="button" data-bs-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">×</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">Tekan tombol di bawah ini untuk menghapus data.</div>
                                    <div class="modal-footer">
                                        <form action="{{ route('pengelola-user-hapusAdmin', $list->id) }}" method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger">DELETE</button>
                                        </form>
                                        <button class="btn btn-secondary" type="button" data-bs-dismiss="modal">CANCEL</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @endforeach
<!-- end modal -->
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

