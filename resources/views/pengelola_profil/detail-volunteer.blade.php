@extends('layouts-relawan.default')

@section('content')
    <div class="main-panel">
        <div class="content-wrapper">
            <div class="row">


                <div class="col-12 grid-margin stretch-card">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="card-title">Relawan</h4>

                            <form class="forms-sample">
                                <div class="form-group">
                                    <label for="id_user">ID User</label>
                                    <input readonly type="text" class="form-control" id="id_user" placeholder="Name" value = "12345">
                                </div>
                                <div class="form-group">
                                    <label for="role">Role</label>
                                    <input readonly type="text" class="form-control" id="role" placeholder="Name" value="Relawan">
                                </div>
                                <div class="form-group">
                                    <label for="username">Username</label>
                                    <input readonly type="text" class="form-control" id="username" placeholder="Username" value="aura12">
                                </div>
                                <div class="form-group">
                                    <label for="password">Password</label>
                                    <input readonly type="text" class="form-control" id="password" placeholder="Password" value="12345678">
                                </div>
                                <div class="form-group">
                                    <label for="nama">Nama</label>
                                    <input readonly type="text" class="form-control" id="nama" placeholder="Name" value="aura">
                                </div>
                                <div class="form-group">
                                    <label for="email">Email</label>
                                    <input readonly type="email" class="form-control" id="email" placeholder="Email" value="test@relawan">
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


        