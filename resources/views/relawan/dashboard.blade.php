@extends('layouts-relawan.default')

@section('content')

      <!-- partial -->
      <div class="main-panel">
        <div class="content-wrapper">
          <div class="row">
            <div class="col-sm-12">
              <div class="home-tab">
                <div class="tab-content tab-content-basic">
                  <div class="tab-pane fade show active" id="overview" role="tabpanel" aria-labelledby="overview"> 
                    <div class="row">
                      <div class="col-sm-12">
                        {{--  <div class="statistics-details d-flex align-items-center justify-content-between">
                          <div>
                            <p class="statistics-title">Bounce Rate</p>
                            <h3 class="rate-percentage">32.53%</h3>
                            <p class="text-danger d-flex"><i class="mdi mdi-menu-down"></i><span>-0.5%</span></p>
                          </div>
                          <div>
                            <p class="statistics-title">Page Views</p>
                            <h3 class="rate-percentage">7,682</h3>
                            <p class="text-success d-flex"><i class="mdi mdi-menu-up"></i><span>+0.1%</span></p>
                          </div>
                          <div>
                            <p class="statistics-title">New Sessions</p>
                            <h3 class="rate-percentage">68.8</h3>
                            <p class="text-danger d-flex"><i class="mdi mdi-menu-down"></i><span>68.8</span></p>
                          </div>
                          <div class="d-none d-md-block">
                            <p class="statistics-title">Avg. Time on Site</p>
                            <h3 class="rate-percentage">2m:35s</h3>
                            <p class="text-success d-flex"><i class="mdi mdi-menu-down"></i><span>+0.8%</span></p>
                          </div>
                          <div class="d-none d-md-block">
                            <p class="statistics-title">New Sessions</p>
                            <h3 class="rate-percentage">68.8</h3>
                            <p class="text-danger d-flex"><i class="mdi mdi-menu-down"></i><span>68.8</span></p>
                          </div>
                          <div class="d-none d-md-block">
                            <p class="statistics-title">Avg. Time on Site</p>
                            <h3 class="rate-percentage">2m:35s</h3>
                            <p class="text-success d-flex"><i class="mdi mdi-menu-down"></i><span>+0.8%</span></p>
                          </div>
                        </div>  --}}
                      </div>
                    </div> 
                    <div class="row">
                      <div class="col-lg-8 d-flex flex-column">
                        <div class="row flex-grow">
                          <div class="col-12 col-lg-4 col-lg-12 grid-margin stretch-card">
                            <div class="card card-rounded">
                              <div class="card-body">
                                <div class="d-sm-flex justify-content-between align-items-start">
                                  <div>
                                   <h4 class="card-title card-title-dash">Grafik Jumlah Kejadian Bencana</h4>
                                   <h5 class="card-subtitle card-subtitle-dash">Kejadian Bencana Per Bulan</h5>
                                  </div>
                                  <div id="performance-line-legend"></div>
                                </div>
                                <div class="chartjs-wrapper mt-5">
                                  <canvas id="performaneLine"></canvas>
                                </div>
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>
                      <div class="col-lg-4 d-flex flex-column">
                        <div class="row flex-grow">
                          <div class="col-md-6 col-lg-12 grid-margin stretch-card">
                            <div class="card bg-primary card-rounded">
                              <div class="card-body pb-0">
                                <h4 class="card-title card-title-dash text-white mb-4">Status Summary</h4>
                                <div class="row">
                                  <div class="col-sm-4">
                                    <p class="status-summary-ight-white mb-1">Total Kejadian Bencana</p>
                                    <h2 class="text-info">357</h2>
                                  </div>
                                  <div class="col-sm-8">
                                    <div class="status-summary-chart-wrapper pb-4">
                                      <canvas id="status-summary"></canvas>
                                    </div>
                                  </div>
                                </div>
                              </div>
                            </div>
                          </div>
                          <div class="col-md-6 col-lg-12 grid-margin stretch-card">
                            <div class="card card-rounded">
                              <div class="card-body">
                                <div class="row">
                                  <div class="col-sm-6">
                                    <div class="d-flex justify-content-between align-items-center mb-2 mb-sm-0">
                                      <div class="circle-progress-width">
                                        <div id="totalVisitors" class="progressbar-js-circle pr-2"></div>
                                      </div>
                                      <div>
                                        <p class="text-small mb-2">Total Korban Terdampak</p>
                                        <h4 class="mb-0 fw-bold">999</h4>
                                      </div>
                                    </div>
                                  </div>
                                  <div class="col-sm-6">
                                    <div class="d-flex justify-content-between align-items-center">
                                      <div class="circle-progress-width">
                                        <div id="visitperday" class="progressbar-js-circle pr-2"></div>
                                      </div>
                                      <div>
                                        <p class="text-small mb-2">Jumlah Penerima Bantuan</p>
                                        <h4 class="mb-0 fw-bold">1000</h4>
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
                    <div class="row">
                      <div class="col-lg-8 d-flex flex-column">
                        <div class="row flex-grow">
                          <div class="col-12 grid-margin stretch-card">
                            <div class="card card-rounded">
                              <div class="card-body">
                                <div class="d-sm-flex justify-content-between align-items-start">
                                  <div>
                                    <h4 class="card-title card-title-dash">Distribusi Anggaran Per Bulan</h4>
                                   <p class="card-subtitle card-subtitle-dash">Lorem ipsum dolor sit amet consectetur adipisicing elit</p>
                                  </div>
                                  <div>
                                    <div class="dropdown">
                                      <button class="btn btn-secondary dropdown-toggle toggle-dark btn-lg mb-0 me-0" type="button" id="dropdownMenuButton2" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> This year </button>
                                      <div class="dropdown-menu" aria-labelledby="dropdownMenuButton2">
                                        <h6 class="dropdown-header">Settings</h6>
                                        <a class="dropdown-item" href="#">Action</a>
                                        <a class="dropdown-item" href="#">Another action</a>
                                        <a class="dropdown-item" href="#">Something else here</a>
                                        <div class="dropdown-divider"></div>
                                        <a class="dropdown-item" href="#">Separated link</a>
                                      </div>
                                    </div>
                                  </div>
                                </div>
                                <div class="d-sm-flex align-items-center mt-1 justify-content-between">
                                  <div class="d-sm-flex align-items-center mt-4 justify-content-between"><h2 class="me-2 fw-bold">Rp36.2531.000</h2><h4 class="me-2"></h4><h4 class="text-success">(+1.37%)</h4></div>
                                  <div class="me-3"><div id="marketing-overview-legend"></div></div>
                                </div>
                                <div class="chartjs-bar-wrapper mt-3">
                                  <canvas id="marketingOverview"></canvas>
                                </div>
                              </div>
                            </div>
                          </div>
                        </div>
                        {{--  <div class="row flex-grow">
                          <div class="col-12 grid-margin stretch-card">
                            <div class="card card-rounded table-darkBGImg">
                              <div class="card-body">
                                <div class="col-sm-8">
                                  <h3 class="text-white upgrade-info mb-0">
                                    Enhance your <span class="fw-bold">Campaign</span> for better outreach
                                  </h3>
                                  <a href="#" class="btn btn-info upgrade-btn">Upgrade Account!</a>
                                </div>
                              </div>
                            </div>
                          </div>
                        </div>  --}}
                        <div class="row flex-grow">
                          <div class="col-12 grid-margin stretch-card">
                            <div class="card card-rounded">
                              <div class="card-body">
                                <div class="d-sm-flex justify-content-between align-items-start">
                                  <div>
                                    <h4 class="card-title card-title-dash">Tabel Rekapitulasi Kejadian Bencana</h4>
                                   {{--  <p class="card-subtitle card-subtitle-dash">You have 50+ new requests</p>  --}}
                                  </div>
                                  {{--  <div>
                                    <button class="btn btn-primary btn-lg text-white mb-0 me-0" type="button"><i class="mdi mdi-account-plus"></i>Add new member</button>
                                  </div>  --}}
                                </div>
                                <div class="table-responsive  mt-1">
                                  <table class="table select-table">
                                    <thead>
                                      <tr>
                                        {{--  <th>
                                          <div class="form-check form-check-flat mt-0">
                                            <label class="form-check-label">
                                              <input type="checkbox" class="form-check-input" aria-checked="false"><i class="input-helper"></i></label>
                                          </div>
                                        </th>  --}}
                                        <th>No.</th>
                                        <th>Nama Bencana</th>
                                        <th>Jumlah Per Tahun</th>
                                        <th>Jumlah Korban Terdampak</th> 
                                        <th>Jumlah Penerima Bantuan</th>
                                      </tr>
                                    </thead>
                                    <tbody>
                                      <tr>
                                        <td>
                                          <div class="form-check form-check-flat mt-0">
                                            <h6>1.</h6>

                                          </div>
                                        </td>
                                        <td>
                                          <div class="d-flex ">
                                            <div>
                                              <h6>Banjir</h6>
                                              {{--  <p>Head admin</p>  --}}
                                            </div>
                                          </div>
                                        </td>
                                        <td>
                                          <h6>100</h6>
                                          {{--  <p>company type</p>  --}}
                                        </td>
                                        <td>
                                          <div>
                                            <div class="d-flex justify-content-between align-items-center mb-1 max-width-progress-wrap">
                                                <h6>1567</h6>

                                            </div>
                                            
                                          </div>
                                        </td>
                                        <td><div><h6>1345</h6></div></td>
                                      </tr>
                                      <tr>
                                        <td>
                                          <div class="form-check form-check-flat mt-0">
                                            <h6>2.</h6>

                                          </div>
                                        </td>
                                        <td>
                                          <div class="d-flex ">
                                            <div>
                                              <h6>Tanah Longsor</h6>
                                              {{--  <p>Head admin</p>  --}}
                                            </div>
                                          </div>
                                        </td>
                                        <td>
                                          <h6>100</h6>
                                          {{--  <p>company type</p>  --}}
                                        </td>
                                        <td>
                                          <div>
                                            <div class="d-flex justify-content-between align-items-center mb-1 max-width-progress-wrap">
                                                <h6>1567</h6>

                                            </div>
                                            
                                          </div>
                                        </td>
                                        <td><div><h6>1345</h6></div></td>
                                      </tr>
                                      <tr>
                                        <td>
                                          <div class="form-check form-check-flat mt-0">
                                            <h6>3.</h6>

                                          </div>
                                        </td>
                                        <td>
                                          <div class="d-flex ">
                                            <div>
                                              <h6>Gunung Meletus</h6>
                                              {{--  <p>Head admin</p>  --}}
                                            </div>
                                          </div>
                                        </td>
                                        <td>
                                          <h6>100</h6>
                                          {{--  <p>company type</p>  --}}
                                        </td>
                                        <td>
                                          <div>
                                            <div class="d-flex justify-content-between align-items-center mb-1 max-width-progress-wrap">
                                                <h6>1567</h6>

                                            </div>
                                            
                                          </div>
                                        </td>
                                        <td><div><h6>1345</h6></div></td>
                                      </tr>
                                      <tr>
                                        <td>
                                          <div class="form-check form-check-flat mt-0">
                                            <h6>4.</h6>

                                          </div>
                                        </td>
                                        <td>
                                          <div class="d-flex ">
                                            <div>
                                              <h6>Gempa Bumi</h6>
                                              {{--  <p>Head admin</p>  --}}
                                            </div>
                                          </div>
                                        </td>
                                        <td>
                                          <h6>100</h6>
                                          {{--  <p>company type</p>  --}}
                                        </td>
                                        <td>
                                          <div>
                                            <div class="d-flex justify-content-between align-items-center mb-1 max-width-progress-wrap">
                                                <h6>1567</h6>

                                            </div>
                                            
                                          </div>
                                        </td>
                                        <td><div><h6>1345</h6></div></td>
                                      </tr>
                                      <tr>
                                        <td>
                                          <div class="form-check form-check-flat mt-0">
                                            <h6>5.</h6>

                                          </div>
                                        </td>
                                        <td>
                                          <div class="d-flex ">
                                            <div>
                                              <h6>Kebakaran</h6>
                                              {{--  <p>Head admin</p>  --}}
                                            </div>
                                          </div>
                                        </td>
                                        <td>
                                          <h6>100</h6>
                                          {{--  <p>company type</p>  --}}
                                        </td>
                                        <td>
                                          <div>
                                            <div class="d-flex justify-content-between align-items-center mb-1 max-width-progress-wrap">
                                                <h6>1567</h6>

                                            </div>
                                            
                                          </div>
                                        </td>
                                        <td><div><h6>1345</h6></div></td>
                                      </tr>
                                    </tbody>
                                  </table>
                                </div>
                              </div>
                            </div>
                          </div>
                        </div>
                        {{--  <div class="row flex-grow">
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
                        </div>  --}}
                      </div>
                      <div class="col-lg-4 d-flex flex-column">
                        {{--  <div class="row flex-grow">
                          <div class="col-12 grid-margin stretch-card">
                            <div class="card card-rounded">
                              <div class="card-body">
                                <div class="row">
                                  <div class="col-lg-12">
                                    <div class="d-flex justify-content-between align-items-center">
                                      <h4 class="card-title card-title-dash">Todo list</h4>
                                      <div class="add-items d-flex mb-0">
                                        <!-- <input type="text" class="form-control todo-list-input" placeholder="What do you need to do today?"> -->
                                        <button class="add btn btn-icons btn-rounded btn-primary todo-list-add-btn text-white me-0 pl-12p"><i class="mdi mdi-plus"></i></button>
                                      </div>
                                    </div>
                                    <div class="list-wrapper">
                                      <ul class="todo-list todo-list-rounded">
                                        <li class="d-block">
                                          <div class="form-check w-100">
                                            <label class="form-check-label">
                                              <input class="checkbox" type="checkbox"> Lorem Ipsum is simply dummy text of the printing <i class="input-helper rounded"></i>
                                            </label>
                                            <div class="d-flex mt-2">
                                              <div class="ps-4 text-small me-3">24 June 2020</div>
                                              <div class="badge badge-opacity-warning me-3">Due tomorrow</div>
                                              <i class="mdi mdi-flag ms-2 flag-color"></i>
                                            </div>
                                          </div>
                                        </li>
                                        <li class="d-block">
                                          <div class="form-check w-100">
                                            <label class="form-check-label">
                                              <input class="checkbox" type="checkbox"> Lorem Ipsum is simply dummy text of the printing <i class="input-helper rounded"></i>
                                            </label>
                                            <div class="d-flex mt-2">
                                              <div class="ps-4 text-small me-3">23 June 2020</div>
                                              <div class="badge badge-opacity-success me-3">Done</div>
                                            </div>
                                          </div>
                                        </li>
                                        <li>
                                          <div class="form-check w-100">
                                            <label class="form-check-label">
                                              <input class="checkbox" type="checkbox"> Lorem Ipsum is simply dummy text of the printing <i class="input-helper rounded"></i>
                                            </label>
                                            <div class="d-flex mt-2">
                                              <div class="ps-4 text-small me-3">24 June 2020</div>
                                              <div class="badge badge-opacity-success me-3">Done</div>
                                            </div>
                                          </div>
                                        </li>
                                        <li class="border-bottom-0">
                                          <div class="form-check w-100">
                                            <label class="form-check-label">
                                              <input class="checkbox" type="checkbox"> Lorem Ipsum is simply dummy text of the printing <i class="input-helper rounded"></i>
                                            </label>
                                            <div class="d-flex mt-2">
                                              <div class="ps-4 text-small me-3">24 June 2020</div>
                                              <div class="badge badge-opacity-danger me-3">Expired</div>
                                            </div>
                                          </div>
                                        </li>
                                      </ul>
                                    </div>
                                  </div>
                                </div>
                              </div>
                            </div>
                          </div>
                        </div>  --}}
                        <div class="row flex-grow">
                          <div class="col-12 grid-margin stretch-card">
                            <div class="card card-rounded">
                              <div class="card-body">
                                <div class="row">
                                  <div class="col-lg-12">
                                    <div class="d-flex justify-content-between align-items-center mb-3">
                                      <h4 class="card-title card-title-dash">Grafik Rekapitulasi Kejadian Bencana</h4>
                                    </div>
                                    <canvas class="my-auto" id="doughnutChart" height="200"></canvas>
                                    <div id="doughnut-chart-legend" class="mt-5 text-center"></div>
                                  </div>
                                </div>
                              </div>
                            </div>
                          </div>
                        </div>
                        <div class="row flex-grow">
                          <div class="col-12 grid-margin stretch-card">
                            <div class="card card-rounded">
                              <div class="card-body">
                                <div class="row">
                                  <div class="col-lg-12">
                                    <div class="d-flex justify-content-between align-items-center mb-3">
                                      <div>
                                        <h4 class="card-title card-title-dash">Leave Report</h4>
                                      </div>
                                      <div>
                                        <div class="dropdown">
                                          <button class="btn btn-secondary dropdown-toggle toggle-dark btn-lg mb-0 me-0" type="button" id="dropdownMenuButton3" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> Month Wise </button>
                                          <div class="dropdown-menu" aria-labelledby="dropdownMenuButton3">
                                            <h6 class="dropdown-header">week Wise</h6>
                                            <a class="dropdown-item" href="#">Year Wise</a>
                                          </div>
                                        </div>
                                      </div>
                                    </div>
                                    <div class="mt-3">
                                      <canvas id="leaveReport"></canvas>
                                    </div>
                                  </div>
                                </div>
                              </div>
                            </div>
                          </div>
                        </div>
                        <div class="row flex-grow">
                          <div class="col-12 grid-margin stretch-card">
                            <div class="card card-rounded">
                              <div class="card-body">
                                {{--  <div class="row">
                                  <div class="col-lg-12">
                                    <div class="d-flex justify-content-between align-items-center mb-3">
                                      <div>
                                        <h4 class="card-title card-title-dash">Top Performer</h4>
                                      </div>
                                    </div>
                                    <div class="mt-3">
                                      <div class="wrapper d-flex align-items-center justify-content-between py-2 border-bottom">
                                        <div class="d-flex">
                                          <img class="img-sm rounded-10" src="images/faces/face1.jpg" alt="profile">
                                          <div class="wrapper ms-3">
                                            <p class="ms-1 mb-1 fw-bold">Brandon Washington</p>
                                            <small class="text-muted mb-0">162543</small>
                                          </div>
                                        </div>
                                        <div class="text-muted text-small">
                                          1h ago
                                        </div>
                                      </div>
                                      <div class="wrapper d-flex align-items-center justify-content-between py-2 border-bottom">
                                        <div class="d-flex">
                                          <img class="img-sm rounded-10" src="images/faces/face2.jpg" alt="profile">
                                          <div class="wrapper ms-3">
                                            <p class="ms-1 mb-1 fw-bold">Wayne Murphy</p>
                                            <small class="text-muted mb-0">162543</small>
                                          </div>
                                        </div>
                                        <div class="text-muted text-small">
                                          1h ago
                                        </div>
                                      </div>
                                      <div class="wrapper d-flex align-items-center justify-content-between py-2 border-bottom">
                                        <div class="d-flex">
                                          <img class="img-sm rounded-10" src="images/faces/face3.jpg" alt="profile">
                                          <div class="wrapper ms-3">
                                            <p class="ms-1 mb-1 fw-bold">Katherine Butler</p>
                                            <small class="text-muted mb-0">162543</small>
                                          </div>
                                        </div>
                                        <div class="text-muted text-small">
                                          1h ago
                                        </div>
                                      </div>
                                      <div class="wrapper d-flex align-items-center justify-content-between py-2 border-bottom">
                                        <div class="d-flex">
                                          <img class="img-sm rounded-10" src="images/faces/face4.jpg" alt="profile">
                                          <div class="wrapper ms-3">
                                            <p class="ms-1 mb-1 fw-bold">Matthew Bailey</p>
                                            <small class="text-muted mb-0">162543</small>
                                          </div>
                                        </div>
                                        <div class="text-muted text-small">
                                          1h ago
                                        </div>
                                      </div>
                                      <div class="wrapper d-flex align-items-center justify-content-between pt-2">
                                        <div class="d-flex">
                                          <img class="img-sm rounded-10" src="images/faces/face5.jpg" alt="profile">
                                          <div class="wrapper ms-3">
                                            <p class="ms-1 mb-1 fw-bold">Rafell John</p>
                                            <small class="text-muted mb-0">Alaska, USA</small>
                                          </div>
                                        </div>
                                        <div class="text-muted text-small">
                                          1h ago
                                        </div>
                                      </div>
                                    </div>
                                  </div>
                                </div>  --}}
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

@endsection