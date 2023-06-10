<head>
  <link rel="stylesheet" href="{{ asset('https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css') }}">
</head>
  <!-- Main Sidebar Container -->
  <aside class="main-sidebar sidebar-dark-primary elevation-4">
      <!-- Brand Logo -->
      <a href="#" class="brand-link">
          <img src="{{ asset('/dist/img/AdminLTELogo.png') }}" alt="AdminLTE Logo"
              class="brand-image img-circle elevation-3" style="opacity: .8">
          <span class="brand-text font-weight-light">AdminLTE 3</span>
      </a>
      <!-- Sidebar -->
      <div class="sidebar">


          <!-- Sidebar Menu -->
          <nav class="mt-2">
              <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu"
                  data-accordion="false">
                  <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
                  <li class="nav-item menu-open">
                      <a href="{{ route('dashboard') }}" class="nav-link active">
                          <i class="nav-icon fas fa-tachometer-alt"></i>
                          <p>
                              Dashboard

                          </p>
                      </a>
                  </li>
                  <li class="nav-item">
                      <a href="{{ route('users.index') }}" class="nav-link">
                          <i class="nav-icon fas fa-user"></i>
                          <p>
                              Users

                          </p>
                      </a>
                  </li>
                  <li class="nav-item">
                      <a class="nav-link" href="{{ route('roles.index') }}">
                          <i class="nav-icon fas fa-users"></i>
                          <p>
                              Roles
                          </p>
                      </a>
                  </li>

                  <li class="nav-item">
                      <a class="nav-link" href="{{ route('products.index') }}">
                        <i class="nav-icon fa fa-cart-plus" ></i>
                          <p>
                              Manage Products
                          </p>
                      </a>
                  </li>

                  <li class="nav-item">
                      <a class="nav-link" href="{{ route('categories.index') }}">
                          <i class="nav-icon fa fa-truck"></i>
                          <p>
                              Manage Categories
                          </p>
                      </a>
                  </li>
                  <li class="nav-item">
                      <a class="nav-link" href="{{ route('coupons.index') }}">
                        <i class="nav-icon fa fa-money" aria-hidden="true"></i>
                          <p>
                              Manage Coupons
                          </p>
                      </a>
                  </li>
              </ul>
          </nav>
          <!-- /.sidebar-menu -->
      </div>
      <!-- /.sidebar -->
  </aside>
  </aside>
