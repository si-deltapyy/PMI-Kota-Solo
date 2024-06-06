<nav class="navbar default-layout col-lg-12 col-12 p-0 fixed-top d-flex align-items-top flex-row">
      <div class="text-center navbar-brand-wrapper d-flex align-items-center justify-content-start">
        <div class="me-3">
          <button class="navbar-toggler navbar-toggler align-self-center" type="button" data-bs-toggle="minimize">
            <span class="icon-menu"></span>
          </button>
        </div>
        <div>
          <a class="navbar-brand brand-logo">
            <img src="{{ asset('assets/images/logo-pmi.svg') }}" alt="logo" style="width: 200px; height: auto;" />
          </a>
          <a class="navbar-brand brand-logo-mini">
            <img src="{{ asset('assets/images/logo-pmi-small.png') }}" alt="logo" style="width: 200px; height: auto; color:red" />
          </a>
        </div>
      </div>
      <div class="navbar-menu-wrapper d-flex align-items-top"> 
        <ul class="navbar-nav">
          <li class="nav-item font-weight-semibold d-none d-lg-block ms-0">
            {{--  <h1 class="welcome-text">Selamat Datang, <span class="text-black fw-bold">{{ auth()->user()->name }}</span></h1>  --}}
            <h1 class="welcome-text">Selamat Datang, <span class="text-black fw-bold">{{ auth()->user()->name }}</span></h1>
            <h3 class="welcome-sub-text">PMI Surakarta</h3>
          </li>
        </ul>
        <ul class="navbar-nav ms-auto">
          <li class="nav-item dropdown d-none d-lg-block user-dropdown">
            <a class="nav-link" id="UserDropdown" href="#" data-bs-toggle="dropdown" aria-expanded="false">
              <img class="img-xs rounded-circle" src="{{ asset('assets/images/faces/face8.jpg') }}" alt="Profile image"> </a>
            <div class="dropdown-menu dropdown-menu-right navbar-dropdown" aria-labelledby="UserDropdown">
              <div class="dropdown-header text-center">
                <img class="img-md rounded-circle" src="{{ asset('assets/images/faces/face8.jpg') }}" alt="Profile image">
                {{--  <p class="mb-1 mt-3 font-weight-semibold">{{ auth()->user()->name }}</p>  --}}
                <p class="mb-1 mt-3 font-weight-semibold">{{ auth()->user()->name }}</p>
                {{--  <p class="fw-light text-muted mb-0">{{ auth()->user()->email }}</p>  --}}
                <p class="fw-light text-muted mb-0">{{ auth()->user()->email }}</p>
              </div>
              <a class="dropdown-item"><i class="dropdown-item-icon mdi mdi-account-outline text-primary me-2"></i> My Profile</a>
              <a class="dropdown-item"><i class="dropdown-item-icon mdi mdi-power text-primary me-2" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();"></i>Sign Out</a>

                                        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                        @csrf
                                    </form>
            </div>
          </li>
        </ul>
        <button class="navbar-toggler navbar-toggler-right d-lg-none align-self-center" type="button" data-bs-toggle="offcanvas">
          <span class="mdi mdi-menu"></span>
        </button>
      </div>
    </nav>