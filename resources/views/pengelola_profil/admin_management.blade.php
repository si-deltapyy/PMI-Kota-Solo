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
            <form
                class="d-none d-sm-inline-block form-inline mr-auto ml-md-3 my-2 my-md-0 mw-100 navbar-search" method="GET" action="{{ route('pengelola-admin') }}">
                <div class="input-group">
                    <input type="text" name="search" class="form-control bg-light border-0 small" placeholder="Search for..." aria-label="Search" aria-describedby="basic-addon2" value="{{ request('search') }}">
                    <div class="input-group-append">
                        <button class="btn btn-primary" type="submit">
                            <i class="fas fa-search fa-sm"></i>
                        </button>
                    </div>
                </div>
            </form>
            
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


                        
                            <div class="table-responsive  ">
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
                                                <a href="{{ route('pengelola-user-hapusAdmin', $list->id) }}"><label class="btn btn-danger btn-sm"><i class="mdi mdi-delete-forever"></i></label></a>
                                          
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
    </div>
            @endsection
    
</div>
</div>
@endsection

<!-- <script>
(function($) {
  'use strict';
  $('#confirmationModal').on('show.bs.modal', function(event) {
    var button = $(event.relatedTarget) // Button that triggered the modal
    var action = button.data('action'); // Extract info from data-* attributes
    var url = button.data('url'); // URL for the action

    // Determine the message based on the action
    var message = '';
    if (action === 'edit') {
      message = 'Apakah Anda yakin ingin mengedit akun Relawan ini?';
    } else if (action === 'delete') {
      message = 'Apakah Anda yakin ingin menghapus akun Relawan ini?';
    }

    // Update the modal's content
    var modal = $(this);
    modal.find('#confirmationMessage').text(message);
    modal.find('#confirmationButton').attr('href', url);
  });
})(jQuery);
</script> -->

   
    
