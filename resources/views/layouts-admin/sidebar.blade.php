<nav class="sidebar sidebar-offcanvas" id="sidebar">
        <ul class="nav">
          {{--  <li class="nav-item">
            <a class="nav-link" href="{{ route('admin-home') }}">
              <i class="mdi mdi-grid-large menu-icon"></i>
              <span class="menu-title">Dashboard</span>
            </a>
          </li>  --}}
          <li class="nav-item nav-category">Laporan</li>
          <li class="nav-item">
            <a class="nav-link" href="{{ route('admin-laporankejadian') }}" aria-expanded="false" aria-controls="laporan-kejadian">
              <i class="menu-icon mdi mdi-file-document"></i>
              <span class="menu-title">Laporan Kejadian</span>
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="{{ route('admin-assessment') }}">
              <i class="menu-icon mdi mdi-file-document"></i>
              <span class="menu-title">Laporan Assesment</span>
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="{{ route('admin-lapsit') }}">
              <i class="menu-icon mdi mdi-file-document"></i>
              <span class="menu-title">Laporan Situasi</span>
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="{{ route('admin-exsum') }}">
              <i class="menu-icon mdi mdi-file-document"></i>
              <span class="menu-title">Executive Summary</span>
            </a>
          </li>
        </ul>
      </nav>