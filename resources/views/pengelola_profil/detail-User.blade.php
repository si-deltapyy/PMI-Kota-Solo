@extends('layouts-pengelolaProfil.default')

@section('content')
    <div class="main-panel">
        <div class="content-wrapper">
            <div class="row">
                <div class="col-12 grid-margin stretch-card">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="card-title">Detail User</h4>

                            <form class="forms-sample">
                                <div class="form-group">
                                    <label for="nama">Nama</label>
                                    <input readonly type="text" class="form-control" id="nama" placeholder="Name" value="{{ $user->name }}">
                                </div>
                                <div class="form-group">
                                    <label for="username">Username</label>
                                    <input readonly type="text" class="form-control" id="username" placeholder="Username" value="{{$user->username }}">
                                </div>
                                <div class="form-group">
                                    <label for="email">Email</label>
                                    <input readonly type="email" class="form-control" id="email" placeholder="Email" value="{{ $user->email }}">
                                </div>
                                <div class="form-group">
                                    <label for="role">Role</label>
                                    <input readonly type="text" class="form-control" id="role" placeholder="Role" value="{{ $user->role }}">
                                </div>
                                <div class="form-group">
                                    <label for="location">Lokasi Longitude, Latitude</label>
                                    <input readonly type="text" class="form-control" id="location" placeholder="Location" value="{{ $user->longitude }}, {{ $user->latitude }}">
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
