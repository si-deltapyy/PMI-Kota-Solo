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
                        <div class="w-80 text-center">
                            <h1 class="card-title card-title-dash">LIST RELAWAN</h1>
                        </div>
                        <br>

                        
                        <!-- alert sukses-tidak -->
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
                        
                        <!-- <div class="d-sm-flex justify-content-between align-items-center">
                            <div class="w-100 text-center">
                                <h1 class="card-title card-title-dash">LIST RELAWAN</h1>
                            </div>
                        </div>
                        <br>
                        <div class="d-sm-flex justify-content-between align-items-start">
                        <a href="{{ url('/pengelolaProfil/add-volunteer') }}" class="btn btn-primary btn-sm me-2" type="button">
                                    <i class="mdi mdi-account-plus"></i> Tambah Akun
                             </a>
                            <div class="d-flex ms-auto align-items-center">
                            <form class="search-form" method="GET" action="{{ route('pengelola-relawan') }}">  
                                <div class="input-group">
                                    <input type="search" name="search" class="form-control" placeholder="Search Here" title="Search here" value="{{ request('search') }}">
                                    <span class="input-group-text"><i class="icon-search"></i></span>
                                </div>
                            </form>
                            </div>
                        </div> -->

                        <div class="d-flex justify-content-between align-items-center mb-3">
                       
                            <!-- Add Filter Buttons -->
                            <div>
                            <a href="{{ route('pengelola-relawan', ['status' => 'approved'] && ['status' => 'approved']) }}" class="btn btn-outline-primary btn-sm @if(empty(request('status'))) active @endif">All</a>
                                <a href="{{ route('pengelola-relawan', ['status' => 'approved']) }}" class="btn btn-outline-success btn-sm @if(request('status') == 'approved') active @endif">Approved</a>
                                <a href="{{ route('pengelola-relawan', ['status' => 'Need_Approval']) }}" class="btn btn-outline-danger btn-sm @if(request('status') == 'Need_Approval') active @endif">Need Approval</a>
                            </div>
                            <!-- Add Search Form -->
                            <form class="search-form ms-auto" method="GET" action="{{ route('pengelola-relawan') }}">
                                <div class="input-group">
                                    <input type="search" name="search" class="form-control" placeholder="Search Here" value="{{ request('search') }}">
                                    <span class="input-group-text"><i class="icon-search"></i></span>
                                </div>
                            </form>
                        </div>

                       
                       
                        
                            <div class="table-responsive  ">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>Nama</th>
                                        <th>Email</th>
                                        <th>Username</th>
                                        <th>Status</th>
                                        <th>Approval Actions</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($user as $list)
                                    @if (empty(request('status')) || (request('status') == 'approved' && $list->is_approved) || (request('status') == 'Need_Approval' && !$list->is_approved))
                                    <tr>
                                        <td>{{$list->name}}</td>
                                        <td>{{$list->email}}</td>
                                        <td>{{$list->username}}</td>
                                        <td>{{$list->is_approved ? 'Approved' : 'Need Approval' }}</td>
                                        <!-- <td>
                                        @if ($list->is_approved)
                                            <a href="{{ route('pengelolaProfiledit_relawan', $list->id) }}" class="btn btn-info btn-sm"><i class="mdi mdi-pencil"></i></a>
                                        
                                            <button class="btn btn-danger btn-sm" data-bs-toggle="modal" data-bs-target="#deleteModal{{ $list->id }}"><i class="mdi mdi-delete-forever"></i></button>
                                            @endif
                                        </td> -->
                                        
                                        <td>
                                            @if (!$list->is_approved)
                                            <button class="btn btn-success btn-sm" data-bs-toggle="modal" data-bs-target="#approveModal{{ $list->id }}">Approve</button>
                                           
                                            <button class="btn btn-warning btn-sm" data-bs-toggle="modal" data-bs-target="#rejectModal{{ $list->id }}">Reject </button>

                                            @endif
                                        
                                        </td>

                                        <td>
                                        @if ($list->is_approved)
                                            <a href="{{ route('pengelolaProfiledit_relawan', $list->id) }}" class="btn btn-info btn-sm"><i class="mdi mdi-pencil"></i></a>
                                            <a href="{{ route('pengelolaProfil.show_detail', $list->id) }}" class="btn btn-warning btn-sm"><i class="menu-icon mdi mdi-information"></i></a>
                                            <button class="btn btn-danger btn-sm" data-bs-toggle="modal" data-bs-target="#deleteModal{{ $list->id }}"><i class="mdi mdi-delete-forever"></i></button>
                                            
                                            @endif
                                        </td>
                                    </tr>
                                    @endif
                                    @endforeach
                                </tbody>
                            </table>

                            </div>
                            <!-- Modals  approve-->
                            @foreach($user as $list)
                            <div class="modal fade" id="approveModal{{ $list->id }}" tabindex="-1" aria-labelledby="exampleModalLabel{{ $list->id }}" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLabel{{ $list->id }}">Approve User</h5>
                                            <button class="close" type="button" data-bs-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">×</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">Apakah yakin ingin memberi akses relawan pada akun ini?</div>
                                        <div class="modal-footer">
                                            <form action="{{ route('approve.user', $list->id) }}" method="POST">
                                                @csrf
                                                <button type="submit" class="btn btn-success">Approve</button>
                                            </form>
                                            <button class="btn btn-secondary" type="button" data-bs-dismiss="modal">Cancel</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            @endforeach
                            <!-- endmodals -->

                             <!-- Rejected Modals -->
                             @foreach($user as $list)
                            <div class="modal fade" id="rejectModal{{ $list->id }}" tabindex="-1" aria-labelledby="exampleModalLabel{{ $list->id }}" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLabel{{ $list->id }}">Yakin untuk hapus data?</h5>
                                            <button class="close" type="button" data-bs-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">×</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">Tekan tombol di bawah ini untuk menolak memberikan akses relawan pada akun ini.</div>
                                        <div class="modal-footer">
                                            <form action="{{ route('pengelola-user-hapusRelawan', $list->id) }}" method="POST">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger">REJECT</button>
                                            </form>
                                            <button class="btn btn-secondary" type="button" data-bs-dismiss="modal">CANCEL</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            @endforeach
                            <!-- end modal -->

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
                                            <form action="{{ route('pengelola-user-hapusRelawan', $list->id) }}" method="POST">
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

   
    
