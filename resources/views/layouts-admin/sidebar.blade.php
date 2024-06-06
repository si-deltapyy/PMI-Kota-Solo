<nav class="sidebar sidebar-offcanvas" id="sidebar">
        <ul class="nav">
          <li class="nav-item">
            <a class="nav-link" href="index.html">
              <i class="mdi mdi-grid-large menu-icon"></i>
              <span class="menu-title">Dashboard</span>
            </a>
          </li>
          <li class="nav-item nav-category">Laporan</li>
          <li class="nav-item">
            <a class="nav-link" data-bs-toggle="collapse" href="#ui-basic" aria-expanded="false" aria-controls="ui-basic">
              <i class="menu-icon mdi mdi-floor-plan"></i>
              <span class="menu-title">Assessment</span>
              <i class="menu-arrow"></i> 
            </a>
            <div class="collapse" id="ui-basic">
              <ul class="nav flex-column sub-menu">
                <li class="nav-item"> <a class="nav-link" href="{{ route('admin-assessment-unverif') }}">Unverified</a></li>
                <li class="nav-item"> <a class="nav-link" href="{{ route('admin-assessment-verif') }}">Verified</a></li>
              </ul>
            </div>
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