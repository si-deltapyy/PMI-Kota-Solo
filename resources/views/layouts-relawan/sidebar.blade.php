<nav class="sidebar sidebar-offcanvas" id="sidebar">
        <ul class="nav">
          <li class="nav-item">
            <a class="nav-link" href="{{ route('home-relawan') }}">
              <i class="mdi mdi-grid-large menu-icon"></i>
              <span class="menu-title">Dashboard</span>
            </a>
          </li>
          <li class="nav-item nav-category">Laporan</li>
          <li class="nav-item">
            <a class="nav-link" href="{{ route('relawan-assessment') }}" aria-expanded="false" aria-controls="assessment">
              <i class="menu-icon mdi mdi-file-document"></i>
              <span class="menu-title">Assessment</span>
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="{{ route('relawan-lapsit') }}" aria-expanded="false" aria-controls="lapsit">
              <i class="menu-icon mdi mdi-file-document"></i>
              <span class="menu-title">Laporan Situasi</span>
            </a>
          </li>
        </ul>
      </nav>