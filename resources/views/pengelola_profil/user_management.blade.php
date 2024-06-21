@extends('layouts-pengelolaProfil.default')

@section('content')

<!-- Page Wrapper -->
<div id="wrapper">

    <!-- Content Wrapper -->
    <div id="content-wrapper" class="d-flex flex-column">

        <!-- Main Content -->
        @section('content')

            <div class="content-wrapper">
                <div class="row flex-grow">
                    <div class="col-12 grid-margin stretch-card">
                        <div class="card card-rounded">
                            <div class="card-body">
                                <div class="d-sm-flex justify-content-between align-items-center">
                                <div class="w-100 text-center">
                                    <h1 class="card-title card-title-dash">LIST USER</h1>
                                    <br>
                                    <!-- Roles -->
                                    <div class="d-flex justify-content-between align-items-center mb-6 ms-auto">
                                        <!-- Add Filter Buttons -->
                                        <div>
                                            <a href="{{ route('pengelola-user', ['role' => 'approved'] && ['status' => 'approved']) }}" class="btn btn-outline-primary btn-sm @if(empty(request('status'))) active @endif">All</a>
                                            <a href="{{ route('pengelola-user', ['role' => 'admin']) }}" class="btn btn-outline-success btn-sm @if(request('role') == 'admin') active @endif">Admin</a>
                                            <a href="{{ route('pengelola-user', ['role' => 'relawan']) }}" class="btn btn-outline-danger btn-sm @if(request('role') == 'relawan') active @endif">Relawan</a>
                                        </div>
                                        <!-- Add Search Form -->
                                        <form class="search-form ms-auto w-80" method="GET" action="{{ route('pengelola-user') }}">
                                            <div class="input-group">
                                                <input type="search" name="search" class="form-control" placeholder="Search Here" value="{{ request('search') }}">
                                                <span class="input-group-text"><i class="icon-search"></i></span>
                                            </div>
                                        </form>
                                    </div>
                                    
                                <br>
                                <div class="d-flex justify-content-between align-items-center mb-3 mr-2">
                                    <!-- tambah akun -->
                                <div>
                                        <!-- <a href="{{ url('/pengelolaProfil/add-admin') }}" class="btn btn-primary btn-sm me-2">
                                            <i class="mdi mdi-account-plus"></i> Tambah Akun
                                        </a> -->
                                    </div>
                                </div>
                                <!-- Confirmation Modal-->
                                <div class="modal fade" id="confirmationModal" tabindex="-1" aria-labelledby="confirmationModalLabel" aria-hidden="true">
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
                                </div>

                                <div class="table-responsive">
                                    <table class="table">
                                        <thead>
                                            <tr>
                                                <th>Nama</th>
                                                <th>Email</th>
                                                <th>Username</th>
                                                <th>Role</th>
                                                <th>Status</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach($users as $user)
                                                <tr>
                                                    <td>{{ $user->name }}</td>
                                                    <td>{{ $user->email }}</td>
                                                    <td>{{ $user->username }}</td>
                                                    <td>
                                                        @foreach($user->roles as $role)
                                                            {{ $role->name }}
                                                        @endforeach
                                                    </td>
                                                    <td>{{ $user->is_approved ? 'Approved' : 'Not Approved' }}</td>
                                                    <td>
                                                        <a href="{{ route('pengelolaProfiledit_relawan', $user->id) }}" class="btn btn-info btn-sm">
                                                            <i class="mdi mdi-pencil"></i>
                                                        </a>
                                                        <button class="btn btn-danger btn-sm" data-bs-toggle="modal" data-bs-target="#deleteModal{{ $user->id }}">
                                                            <i class="mdi mdi-delete-forever"></i>
                                                        </button>
                                                        @if (!$user->is_approved && $user->roles->contains('name', 'relawan'))
                                                            <form method="POST" action="{{ route('approve.user', $user->id) }}" class="d-inline">
                                                                @csrf
                                                                <button type="submit" class="btn btn-success btn-sm">Approve</button>
                                                            </form>
                                                        @endif
                                                    </td>
                                                </tr>

                                                <!-- Delete Confirmation Modal -->
                                                <div class="modal fade" id="deleteModal{{ $user->id }}" tabindex="-1" aria-labelledby="deleteModalLabel{{ $user->id }}" aria-hidden="true">
                                                    <div class="modal-dialog">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h5 class="modal-title" id="deleteModalLabel{{ $user->id }}">Yakin untuk hapus data?</h5>
                                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                            </div>
                                                            <div class="modal-body">Tekan tombol di bawah ini untuk menghapus data.</div>
                                                            <div class="modal-footer">
                                                                <form action="{{ route('pengelola-user-hapusRelawan', $user->id) }}" method="POST">
                                                                    @csrf
                                                                    @method('DELETE')
                                                                    <button type="submit" class="btn btn-danger">DELETE</button>
                                                                </form>
                                                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">CANCEL</button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>

                                <!-- Success Modal -->
                                @if(session('success'))
                                    <div class="modal fade" id="successModal" tabindex="-1" aria-labelledby="successModalLabel" aria-hidden="true">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="successModalLabel">Success</h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body">
                                                    {{ session('success') }}
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <script>
                                        document.addEventListener('DOMContentLoaded', function() {
                                            var successModal = new bootstrap.Modal(document.getElementById('successModal'));
                                            successModal.show();
                                        });
                                    </script>
                                @endif

                                <!-- Error Modal -->
                                @if(session('error'))
                                    <div class="modal fade" id="errorModal" tabindex="-1" aria-labelledby="errorModalLabel" aria-hidden="true">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="errorModalLabel">Error</h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body">
                                                    {{ session('error') }}
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <script>
                                        document.addEventListener('DOMContentLoaded', function() {
                                            var errorModal = new bootstrap.Modal(document.getElementById('errorModal'));
                                            errorModal.show();
                                        });
                                    </script>
                                @endif

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- End of Main Content -->

    </div>
    <!-- End of Content Wrapper -->

</div>
<!-- End of Page Wrapper -->
 </div>

@endsection
