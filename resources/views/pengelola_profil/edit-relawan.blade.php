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
                    <h4 class="card-title">Edit Akun Relawan </h4>
                    @if ($errors->any())
                        <div>
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                    <form class="forms-sample" action="{{  route('pengelolaProfil.update_relawan', $user->id) }}" method="POST">
                      @csrf
                      @method('PUT')
                      <div class="form-group">
                        <label for="name">Name</label>
                        <input type="text" id="name" name="name" class="form-control"  placeholder="Name" value="{{ old('name', $user->name) }}" required>
                      </div>
                      <div class="form-group">
                        <label for="username">Username</label>
                        <input type="text" class="form-control" id="username" name="username" placeholder="Username" value="{{ old('username', $user->username) }}" required>
                      </div>
                      <div class="form-group">
                        <label for="email">Email address</label>
                        <input type="email" class="form-control" id="email" placeholder="Email" name="email" value="{{ old('email', $user->email) }}" required>
                      </div>
                      <div class="form-group">
                        <label for="password">Password</label>
                        <input type="password" class="form-control" id="password" placeholder="Password" name="password" required>
                      </div>
                      <div class="form-group">
                        <label for="password_confirmation">Confirm Password</label>
                        <input type="password" class="form-control" id="password_confirmation" placeholder="Password Confirm" name="password_confirmation" required>
                      </div>
                      
                      <button type="submit" class="btn btn-primary" style="background-color: #007bff; border-color: #007bff; transition: none;">Update</button>
                      <button class="btn btn-light" style="background-color: #f8f9fa; border-color: #f8f9fa; transition: none; color: black;" onclick="window.history.back()">Cancel</button>
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


    
