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
                class="d-none d-sm-inline-block form-inline mr-auto ml-md-3 my-2 my-md-0 mw-100 navbar-search" method="GET" action="{{ route('pengelola-relawan') }}">
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
                                <h1 class="card-title card-title-dash">Pending Approvals</h1>
                            </div>
                        </div>
                        <br>
                        <div class="d-sm-flex justify-content-between align-items-start">
                        <a href="{{ url('/pengelolaProfil/add-volunteer') }}" class="btn btn-primary btn-sm me-2" type="button">
                                    <i class="mdi mdi-account-plus"></i> List Akun
                             </a>
                            <div class="d-flex ms-auto align-items-center">
                            <form class="search-form" method="GET" action="{{ route('approval.page') }}">  
                                <div class="input-group">
                                    <input type="search" name="search" class="form-control" placeholder="Search Here" title="Search here" value="{{ request('search') }}">
                                    <span class="input-group-text"><i class="icon-search"></i></span>
                                </div>
                            </form>
                            </div>
                        </div>
                       
                      
                            <div class="table-responsive  ">
                            <table class="table ">
                                <thead>
                                <tr>
                                    <th>Nama</th>
                                    <th>Email</th>
                                    <th>Action</th>
                                    
                                </tr>
                                </thead>
                                <tbody>
                                    @foreach($user as $list)
                                    <tr>
                                            <td>{{$list->name}}</td>
                                            <td>{{$list->email}}</td>
                                            <td>
                                                    <form method="POST" action="{{ route('approve.user', $user->id) }}">
                                                        @csrf
                                                        @method('PUT')
                                                        <button type="submit">Approve</button>
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
    </div>
            @endsection
    
</div>
</div>
@endsection

   
    
