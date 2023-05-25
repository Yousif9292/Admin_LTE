  <!-- Navbar -->
  <nav class="main-header navbar navbar-expand navbar-white navbar-light">
      <!-- Left navbar links -->
      <ul class="navbar-nav">
          <li class="nav-item">
              <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
          </li>
          <li class="nav-item d-none d-sm-inline-block">
              <a href="index3.html" class="nav-link">Home</a>
          </li>
          <li>
              <!-- Authentication -->
              <form method="POST" action="{{ route('logout') }}">
                  @csrf

                  <a href="route('logout')" class="nav-link d-none d-sm-inline-block "
                      onclick="event.preventDefault();
                                    this.closest('form').submit();">
                      Contant
                  </a>
              </form>
          </li>
      </ul>

      <!-- Right navbar links -->
      <ul class="navbar-nav ml-auto">
          <!-- Navbar Search -->
          <li class="nav-item">
              <a class="nav-link" data-widget="navbar-search" href="#" role="button">
                  <i class="fas fa-search"></i>
              </a>
              <div class="navbar-search-block">
                  <form class="form-inline">
                      <div class="input-group input-group-sm">
                          <input class="form-control form-control-navbar" type="search" placeholder="Search"
                              aria-label="Search">
                          <div class="input-group-append">
                              <button class="btn btn-navbar" type="submit">
                                  <i class="fas fa-search"></i>
                              </button>
                              <button class="btn btn-navbar" type="button" data-widget="navbar-search">
                                  <i class="fas fa-times"></i>
                              </button>
                          </div>
                      </div>
                  </form>
              </div>
          </li>



          <!-- Active User -->
          <li class="nav-item dropdown">
              {{-- <x-dropdown aligne="right" width="48">
                  <div class="dropdown d-flex profile-1">
                      <x-slot name="trigger">
                          <a href="javascript:void(0)" data-bs-toggle="dropdown" class="nav-link leading-none d-flex">
                              <img src="../dist/img/avatar5.png" alt="profile-user"
                                  style="border-radius:100%; height:30px; margin-top:-8px;"
                                  class="avatar  profile-user brround cover-image">
                          </a>
                      </x-slot>
                      <x-slot name="content">
                          <div class="dropdown-menu dropdown-menu-end dropdown-menu-arrow">
                              <div class="drop-heading">
                                  <div class="text-center">
                                      <h5 class="text-dark mb-0 fs-14 fw-semibold">Test User</h5>
                                      <small class="text-muted">Senior Admin</small>
                                  </div>
                              </div>
                              <div class="dropdown-divider m-0"></div>
                              <x-dropdown-link :href="route('profile.edit')">
                                  <i class="dropdown-icon fe fe-user"></i>
                                  {{ __('Profile') }}
                              </x-dropdown-link>

                              <form method="POST" action="{{ route('logout') }}">
                                  @csrf

                                  <x-dropdown-link :href="route('logout')"
                                      onclick="event.preventDefault();
                                    this.closest('form').submit();">
                                      <i class="dropdown-icon fe fe-alert-circle"></i>
                                      {{ __('Log Out') }}
                                  </x-dropdown-link>
                              </form>
                          </div>
                      </x-slot>
                  </div>
              </x-dropdown> --}}
              <!-- Settings Dropdown -->
              <div class="hidden sm:flex sm:items-center sm:ml-6 dropdown d-flex">
                  <x-dropdown aligne="right" width="48">
                      <x-slot name="trigger">
                        <a href="javascript:void(0)" data-bs-toggle="dropdown" class="nav-link leading-none d-flex">
                            <img src="../dist/img/avatar5.png" alt="profile-user"
                                style="border-radius:100%; height:30px; margin-top:-8px;"
                                class="avatar  profile-user brround cover-image">
                        </a>
                      </x-slot>
                      <x-slot name="content">
                          <x-dropdown-link :href="route('profile.edit')">
                              {{ __('Profile') }}
                          </x-dropdown-link>

                          <!-- Authentication -->
                          <form method="POST" action="{{ route('logout') }}">
                              @csrf
                              <x-dropdown-link :href="route('logout')"
                                  onclick="event.preventDefault();
                                          this.closest('form').submit();">
                                  {{ __('Log Out') }}
                              </x-dropdown-link>
                          </form>
                      </x-slot>
                  </x-dropdown>
              </div>
          </li>

      </ul>
  </nav>
  <!-- /.navbar -->
