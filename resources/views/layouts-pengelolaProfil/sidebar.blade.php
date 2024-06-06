<nav class="sidebar sidebar-offcanvas" id="sidebar">
        <ul class="nav">
          <li class="nav-item">
            <a class="nav-link" href="{{ url('/pengelolaProfil/dashboard') }}">
              <i class="mdi mdi-grid-large menu-icon"></i>
              <span class="menu-title">Dashboard</span>
            </a>
          </li>
          <li class="nav-item nav-category">Users</li>
          <li class="nav-item">
            <a class="nav-link" href="{{ url('/pengelolaProfil/user_management') }}">
              <i class="menu-icon mdi mdi-file-document"></i>
              <span class="menu-title">Users</span>
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="{{ url('/pengelolaProfil/relawan_management') }}">
              <i class="menu-icon mdi mdi-file-document"></i>
              <span class="menu-title">Relawan</span>
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="{{ url('/pengelolaProfil/admin_management') }}">
              <i class="menu-icon mdi mdi-file-document"></i>
              <span class="menu-title">Admin PMI</span>
            </a>
          </li>
        </ul>
      </nav>