<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>

<h1>Laporan Executive Summary</h1>
<p>waktu cetak {{$waktu}}</p>

<h2>Jumlah Korban</h2>

<table border="1">
    <thead>
        <tr>
            <td>Jumlah KK</td>
            <td>Jumlah Jiwa</td>
            <td>Luka Ringan</td>
            <td>Meninggal</td>
            <td>Hilang</td>
            <td>Pengungsi</td>
        </tr>
    </thead>
    <tbody>
        <tr>
            <td>{{$jumlah['kk']}}</td>
            <td>{{$jumlah['jiwa']}}</td>
            <td>{{$jumlah['ringan']}}</td>
            <td>{{$jumlah['mati']}}</td>
            <td>{{$jumlah['hilang']}}</td>
            <td>{{$jumlah['pengungsi']}}</td>
        </tr>
    </tbody>
</table>
    <h2>Kejadian Bencana</h2>

    <table border="1">
        <thead>
            <tr>
                <td>Nama Kejadian</td>
                <td>Tanggal</td>
                <td>keterangan</td>
                <td>Status</td>
            </tr>
        </thead>
        <tbody>
            @foreach($kejadian as $x)
            <tr>
                <td>{{$x->nama_kejadian}}</td>
                <td>{{$x->tanggal_kejadian}}</td>
                <td>{{$x->keterangan}}</td>
                <td>{{$x->status}}</td>
            </tr>
            @endforeach
        </tbody>
    </table>

    <h2>Rekap Layanan</h2>

    <div>
        <table border="1">
        <thead>
            <tr>
            <th>No</th>
            <th>Kejadian</th>
            <th>Tanggal</th>
            <th>Distribusi</th>
            <th>Layanan Kesehatan</th>
            <th>Status</th>
            </tr>
        </thead>
        <tbody>
            @php
            $no=1;
            @endphp
            @foreach($layanan as $x)
            <tr>
            <td>{{$no}}</td>
            <td>
                <div class="d-flex ">
                <div>
                    <h6>{{$x->nmKejadian}}</h6>
                </div>
                </div>
            </td>
            <td>
                <h6>{{$x->dateKejadian}}</h6>
            </td>
            <td>
                <h6>{{$x->layDis}}</h6>
            </td>
            <td>
                <h6>{{$x->layKes}}</h6>
            </td>
            <td>
                @if($x->stat == 'On Process')
                <div class="badge badge-opacity-warning">In progress</div>
                @else
                <div class="badge badge-opacity-success">Aktif</div>
                @endif
            </td>
            </tr>
            @php
            $no++
            @endphp
            @endforeach
            <!-- <tr>
            <td>
                <div class="form-check form-check-flat mt-0">
                <label class="form-check-label">
                <input type="checkbox" class="form-check-input" aria-checked="false"><i class="input-helper"></i></label>
                </div>
            </td>
            <td>
                <div class="d-flex">
                <img src="images/faces/face2.jpg" alt="">
                <div>
                    <h6>Laura Brooks</h6>
                    <p>Head admin</p>
                </div>
                </div>
            </td>
            <td>
                <h6>Company name 1</h6>
                <p>company type</p>
            </td>
            <td>
                <div>
                <div class="d-flex justify-content-between align-items-center mb-1 max-width-progress-wrap">
                    <p class="text-success">65%</p>
                    <p>85/162</p>
                </div>
                <div class="progress progress-md">
                    <div class="progress-bar bg-success" role="progressbar" style="width: 65%" aria-valuenow="65" aria-valuemin="0" aria-valuemax="100"></div>
                </div>
                </div>
            </td>
            <td><div class="badge badge-opacity-warning">In progress</div></td>
            </tr>
            <tr>
            <td>
                <div class="form-check form-check-flat mt-0">
                <label class="form-check-label">
                <input type="checkbox" class="form-check-input" aria-checked="false"><i class="input-helper"></i></label>
                </div>
            </td>
            <td>
                <div class="d-flex">
                <img src="images/faces/face3.jpg" alt="">
                <div>
                    <h6>Wayne Murphy</h6>
                    <p>Head admin</p>
                </div>
                </div>
            </td>
            <td>
                <h6>Company name 1</h6>
                <p>company type</p>
            </td>
            <td>
                <div>
                <div class="d-flex justify-content-between align-items-center mb-1 max-width-progress-wrap">
                    <p class="text-success">65%</p>
                    <p>85/162</p>
                </div>
                <div class="progress progress-md">
                    <div class="progress-bar bg-warning" role="progressbar" style="width: 38%" aria-valuenow="38" aria-valuemin="0" aria-valuemax="100"></div>
                </div>
                </div>
            </td>
            <td><div class="badge badge-opacity-warning">In progress</div></td>
            </tr>
            <tr>
            <td>
                <div class="form-check form-check-flat mt-0">
                <label class="form-check-label">
                <input type="checkbox" class="form-check-input" aria-checked="false"><i class="input-helper"></i></label>
                </div>
            </td>
            <td>
                <div class="d-flex">
                <img src="images/faces/face4.jpg" alt="">
                <div>
                    <h6>Matthew Bailey</h6>
                    <p>Head admin</p>
                </div>
                </div>
            </td>
            <td>
                <h6>Company name 1</h6>
                <p>company type</p>
            </td>
            <td>
                <div>
                <div class="d-flex justify-content-between align-items-center mb-1 max-width-progress-wrap">
                    <p class="text-success">65%</p>
                    <p>85/162</p>
                </div>
                <div class="progress progress-md">
                    <div class="progress-bar bg-danger" role="progressbar" style="width: 15%" aria-valuenow="15" aria-valuemin="0" aria-valuemax="100"></div>
                </div>
                </div>
            </td>
            <td><div class="badge badge-opacity-danger">Pending</div></td>
            </tr>
            <tr>
            <td>
                <div class="form-check form-check-flat mt-0">
                <label class="form-check-label">
                <input type="checkbox" class="form-check-input" aria-checked="false"><i class="input-helper"></i></label>
                </div>
            </td>
            <td>
                <div class="d-flex">
                <img src="images/faces/face5.jpg" alt="">
                <div>
                    <h6>Katherine Butler</h6>
                    <p>Head admin</p>
                </div>
                </div>
            </td>
            <td>
                <h6>Company name 1</h6>
                <p>company type</p>
            </td>
            <td>
                <div>
                <div class="d-flex justify-content-between align-items-center mb-1 max-width-progress-wrap">
                    <p class="text-success">65%</p>
                    <p>85/162</p>
                </div>
                <div class="progress progress-md">
                    <div class="progress-bar bg-success" role="progressbar" style="width: 65%" aria-valuenow="65" aria-valuemin="0" aria-valuemax="100"></div>
                </div>
                </div>
            </td>
            <td><div class="badge badge-opacity-success">Completed</div></td>
            </tr> -->
        </tbody>
        </table>
    </div>
</body>
</html>