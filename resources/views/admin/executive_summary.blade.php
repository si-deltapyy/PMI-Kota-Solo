@extends('layouts-admin.default')

@section('content')


      <!-- partial -->
      <x-notify::notify />
        @notifyJs
        <div class="content-wrapper">
          <div class="row">
            <div class="col-sm-12">
              <div class="home-tab">
                <div class="d-sm-flex align-items-center justify-content-between border-bottom">
                  <!-- <ul class="nav nav-tabs" role="tablist">
                    <li class="nav-item">
                      <a class="nav-link active ps-0" id="home-tab" data-bs-toggle="tab" href="#overview" role="tab" aria-controls="overview" aria-selected="true">Overview</a>
                    </li>
                    <li class="nav-item">
                      <a class="nav-link" id="profile-tab" data-bs-toggle="tab" href="#audiences" role="tab" aria-selected="false">Audiences</a>
                    </li>
                    <li class="nav-item">
                      <a class="nav-link" id="contact-tab" data-bs-toggle="tab" href="#demographics" role="tab" aria-selected="false">Demographics</a>
                    </li>
                    <li class="nav-item">
                      <a class="nav-link border-0" id="more-tab" data-bs-toggle="tab" href="#more" role="tab" aria-selected="false">More</a>
                    </li>
                  </ul> -->
                  <div>
                    <div class="btn-wrapper">
                      {{--  <a href="#" class="btn btn-otline-dark align-items-center"><i class="icon-share"></i> Share</a>
                      <a href="#" class="btn btn-otline-dark"><i class="icon-printer"></i> Print</a>  --}}
                      <form action="{{ route('eksum.pdf') }}" method="post" target="_blank">
                        @csrf
                        <button  class="btn btn-primary text-white me-0">
                        <i class="icon-download"></i> Export PDF Executive Summary
                      </button>
                    
                      </form>
                    </div>
                  </div>
                </div>
                <div class="tab-content tab-content-basic">
                  <div class="tab-pane fade show active" id="overview" role="tabpanel" aria-labelledby="overview"> 
                    <div class="row">
                      <div class="col-sm-12">
                        <div class="statistics-details d-flex align-items-center justify-content-between">
                          <div>
                            <p class="statistics-title">Jumlah KK</p>
                            <h3 class="rate-percentage">{{$jumlah['kk']}}</h3>
                            <!-- <p class="text-danger d-flex"><i class="mdi mdi-menu-down"></i><span>-0.5%</span></p> -->
                          </div>
                          <div>
                            <p class="statistics-title">Jumlah Jiwa</p>
                            <h3 class="rate-percentage">{{$jumlah['jiwa']}}</h3>
                            <!-- <p class="text-success d-flex"><i class="mdi mdi-menu-up"></i><span>+0.1%</span></p> -->
                          </div>
                          <div>
                            <p class="statistics-title">Korban Meninggal</p>
                            <h3 class="rate-percentage">{{$jumlah['mati']}}</h3>
                            <!-- <p class="text-danger d-flex"><i class="mdi mdi-menu-down"></i><span>68.8</span></p> -->
                          </div>
                          <div class="d-none d-md-block">
                            <p class="statistics-title">Korban Luka Ringan</p>
                            <h3 class="rate-percentage">{{$jumlah['ringan']}}</h3>
                            <!-- <p class="text-success d-flex"><i class="mdi mdi-menu-down"></i><span>+0.8%</span></p> -->
                          </div>
                          <div class="d-none d-md-block">
                            <p class="statistics-title">Korban Hilang</p>
                            <h3 class="rate-percentage">{{$jumlah['hilang']}}</h3>
                            <!-- <p class="text-danger d-flex"><i class="mdi mdi-menu-down"></i><span>68.8</span></p> -->
                          </div>
                          <div class="d-none d-md-block">
                            <p class="statistics-title">Jumlah Pengungsi</p>
                            <h3 class="rate-percentage">{{$jumlah['pengungsi']}}</h3>
                            <!-- <p class="text-success d-flex"><i class="mdi mdi-menu-down"></i><span>+0.8%</span></p> -->
                          </div>
                        </div>
                      </div>
                    </div> 
                    <div class="row">
                      <div class="col-lg-8 d-flex flex-column">
                        <div class="row flex-grow">
                          <div class="col-12 col-lg-4 col-lg-12 grid-margin stretch-card">
                            <div class="card card-rounded">
                              <div class="card-body">
                                <div class="d-sm-flex justify-content-between align-items-start">
                                <div class="container px-4 mx-auto">
                                  <div class="bg-white">
                                      {!! $chart->container() !!}
                                  </div>
                                </div>
                                <script src="{{ $chart->cdn() }}"></script>
                                {{ $chart->script() }}
                                </div>
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>
                      <div class="col-lg-4 d-flex flex-column">
                        <div class="row flex-grow">
                          
                          <div class="col-md-6 col-lg-12 grid-margin stretch-card">
                            <div class="card card-rounded">
                              <div class="card-body">
                              {!! $bar->container() !!}
                                <script src="{{ $bar->cdn() }}"></script>
                                {{ $bar->script() }}
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                    <div class="row">
                      <div class="col-lg-8 d-flex flex-column">
                        <div class="row flex-grow">
                          <div class="col-12 grid-margin stretch-card">
                              <div class="card card-rounded">
                                  <div class="card-body">
                                      <div class="d-sm-flex justify-content-between align-items-start">
                                          <div>
                                              <h4 class="card-title card-title-dash">Layanan korban</h4>
                                              <p class="card-subtitle card-subtitle-dash">You have 50+ new requests</p>
                                          </div>
                                      </div>
                                      <div class="table-responsive mt-1">
                                          <table class="table select-table">
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
                                              </tbody>
                                          </table>
                                      </div>
                                  </div>
                              </div>
                          </div>
                        </div>
                        <!-- <div class="row flex-grow">
                          <div class="col-md-6 col-lg-6 grid-margin stretch-card">
                            <div class="card card-rounded">
                              <div class="card-body card-rounded">
                                <h4 class="card-title  card-title-dash">Recent Events</h4>
                                <div class="list align-items-center border-bottom py-2">
                                  <div class="wrapper w-100">
                                    <p class="mb-2 font-weight-medium">
                                      Change in Directors
                                    </p>
                                    <div class="d-flex justify-content-between align-items-center">
                                      <div class="d-flex align-items-center">
                                        <i class="mdi mdi-calendar text-muted me-1"></i>
                                        <p class="mb-0 text-small text-muted">Mar 14, 2019</p>
                                      </div>
                                    </div>
                                  </div>
                                </div>
                                <div class="list align-items-center border-bottom py-2">
                                  <div class="wrapper w-100">
                                    <p class="mb-2 font-weight-medium">
                                      Other Events
                                    </p>
                                    <div class="d-flex justify-content-between align-items-center">
                                      <div class="d-flex align-items-center">
                                        <i class="mdi mdi-calendar text-muted me-1"></i>
                                        <p class="mb-0 text-small text-muted">Mar 14, 2019</p>
                                      </div>
                                    </div>
                                  </div>
                                </div>
                                <div class="list align-items-center border-bottom py-2">
                                  <div class="wrapper w-100">
                                    <p class="mb-2 font-weight-medium">
                                      Quarterly Report
                                    </p>
                                    <div class="d-flex justify-content-between align-items-center">
                                      <div class="d-flex align-items-center">
                                        <i class="mdi mdi-calendar text-muted me-1"></i>
                                        <p class="mb-0 text-small text-muted">Mar 14, 2019</p>
                                      </div>
                                    </div>
                                  </div>
                                </div>
                                <div class="list align-items-center border-bottom py-2">
                                  <div class="wrapper w-100">
                                    <p class="mb-2 font-weight-medium">
                                      Change in Directors
                                    </p>
                                    <div class="d-flex justify-content-between align-items-center">
                                      <div class="d-flex align-items-center">
                                        <i class="mdi mdi-calendar text-muted me-1"></i>
                                        <p class="mb-0 text-small text-muted">Mar 14, 2019</p>
                                      </div>
                                    </div>
                                  </div>
                                </div>
                                
                                <div class="list align-items-center pt-3">
                                  <div class="wrapper w-100">
                                    <p class="mb-0">
                                      <a href="#" class="fw-bold text-primary">Show all <i class="mdi mdi-arrow-right ms-2"></i></a>
                                    </p>
                                  </div>
                                </div>
                              </div>
                            </div>
                          </div>
                          <div class="col-md-6 col-lg-6 grid-margin stretch-card">
                            <div class="card card-rounded">
                              <div class="card-body">
                                <div class="d-flex align-items-center justify-content-between mb-3">
                                  <h4 class="card-title card-title-dash">Activities</h4>
                                  <p class="mb-0">20 finished, 5 remaining</p>
                                </div>
                                <ul class="bullet-line-list">
                                  <li>
                                    <div class="d-flex justify-content-between">
                                      <div><span class="text-light-green">Ben Tossell</span> assign you a task</div>
                                      <p>Just now</p>
                                    </div>
                                  </li>
                                  <li>
                                    <div class="d-flex justify-content-between">
                                      <div><span class="text-light-green">Oliver Noah</span> assign you a task</div>
                                      <p>1h</p>
                                    </div>
                                  </li>
                                  <li>
                                    <div class="d-flex justify-content-between">
                                      <div><span class="text-light-green">Jack William</span> assign you a task</div>
                                      <p>1h</p>
                                    </div>
                                  </li>
                                  <li>
                                    <div class="d-flex justify-content-between">
                                      <div><span class="text-light-green">Leo Lucas</span> assign you a task</div>
                                      <p>1h</p>
                                    </div>
                                  </li>
                                  <li>
                                    <div class="d-flex justify-content-between">
                                      <div><span class="text-light-green">Thomas Henry</span> assign you a task</div>
                                      <p>1h</p>
                                    </div>
                                  </li>
                                  <li>
                                    <div class="d-flex justify-content-between">
                                      <div><span class="text-light-green">Ben Tossell</span> assign you a task</div>
                                      <p>1h</p>
                                    </div>
                                  </li>
                                  <li>
                                    <div class="d-flex justify-content-between">
                                      <div><span class="text-light-green">Ben Tossell</span> assign you a task</div>
                                      <p>1h</p>
                                    </div>
                                  </li>
                                </ul>
                                <div class="list align-items-center pt-3">
                                  <div class="wrapper w-100">
                                    <p class="mb-0">
                                      <a href="#" class="fw-bold text-primary">Show all <i class="mdi mdi-arrow-right ms-2"></i></a>
                                    </p>
                                  </div>
                                </div>
                              </div>
                            </div>
                          </div>
                        </div> -->
                      </div>
                      <div class="col-lg-4 d-flex flex-column">
                        <!-- <div class="row flex-grow">
                          <div class="col-12 grid-margin stretch-card">
                            <div class="card card-rounded">
                              <div class="card-body">
                                <div class="row">
                                  <div class="col-lg-12">
                                    <div class="d-flex justify-content-between align-items-center mb-3">
                                      <h4 class="card-title card-title-dash">Type By Amount</h4>
                                    </div>
                                    <canvas class="my-auto" id="doughnutChart" height="200"></canvas>
                                    <div id="doughnut-chart-legend" class="mt-5 text-center"></div>
                                  </div>
                                </div>
                              </div>
                            </div>
                          </div>
                        </div> -->
                        <div class="row flex-grow">
                          <div class="col-12 grid-margin stretch-card">
                            <div class="card card-rounded">
                              <div class="card-body">
                                {!! $personil->container() !!}
                                <script src="{{ $personil->cdn() }}"></script>
                                {{ $personil->script() }}
                              </div>
                            </div>
                          </div>
                        </div>
                        <div class="row flex-grow">
                          <div class="col-12 grid-margin stretch-card">
                            <div class="card card-rounded">
                              <div class="card-body">
                                <div class="row">
                                <div class="col-12 grid-margin stretch-card">
                                  <div class="card card-rounded">
                                    <div class="card-body">
                                      <div class="d-sm-flex justify-content-between align-items-start">
                                        <div>
                                          <h4 class="card-title card-title-dash">Detail Kejadian Bencana</h4>
                                        <p class="card-subtitle card-subtitle-dash">PMI Kota Surakarta</p>
                                        </div>
                                      </div>
                                      <div class="table-responsive  mt-1">
                                        <table class="table select-table">
                                          <thead>
                                            <tr>
                                              <th><span class="italic-right">No</span></th>
                                              <th><span class="italic-right">Nama Bencana</span></th>
                                            </tr>
                                          </thead>
                                          <tbody>
                                          @php
                                          $no=1;
                                          @endphp
                                          @foreach($bencana as $x)
                                            <tr>
                                              <td>
                                                <h6>{{$no}}</h6>
                                              </td>
                                              <td>
                                                <h6><a href="../flash-report/generate/{{$x->id_kejadian}}" target="_blank">{{$x->nama_kejadian}}</a></h6>
                                              </td>
                                            </tr>
                                            <tr>
                                              <td>
                                                <h6>{{$no}}</h6>
                                              </td>
                                              <td>
                                                <h6><a href="../flash-report/generate/{{$x->id_kejadian}}" target="_blank">{{$x->nama_kejadian}}</a></h6>
                                              </td>
                                            </tr>
                                            @php
                                            $no++
                                            @endphp
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
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        <!-- content-wrapper ends -->

        <script>
        $(document).ready(function() {
            $('table').DataTable({
                "paging": true,
                "lengthChange": true,
                "searching": true,
                "ordering": true,
                "info": true,
                "autoWidth": false,
                "responsive": true
            });
        });
        </script>

@endsection