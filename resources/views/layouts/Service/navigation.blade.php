  <!-- Topbar -->
  <nav class="navbar navbar-expand navbar-light bg-white topbar mb-3 static-top shadow-sm">

      <!-- Sidebar Toggle (Topbar) -->
      <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
          <i class="fa fa-bars"></i>
      </button>

      {{--  <!-- Topbar Search -->
      <form class="d-none d-sm-inline-block form-inline mr-auto ml-md-3 my-2 my-md-0 mw-100 navbar-search">
          <div class="input-group">
              <input type="text" class="form-control bg-light border-0 small" placeholder="Search for..."
                  aria-label="Search" aria-describedby="basic-addon2">
              <div class="input-group-append">
                  <button class="btn btn-success" type="button">
                      <i class="fas fa-search fa-sm"></i>
                  </button>
              </div>
          </div>
      </form>  --}}

      <!-- Topbar Navbar -->
      <ul class="navbar-nav ml-auto">

          <!-- Nav Item - Search Dropdown (Visible Only XS) -->
          <li class="nav-item dropdown no-arrow d-sm-none">
              <a class="nav-link dropdown-toggle" href="#" id="searchDropdown" role="button" data-toggle="dropdown"
                  aria-haspopup="true" aria-expanded="false">
                  <i class="fas fa-search fa-fw"></i>
              </a>
              <!-- Dropdown - Messages -->
              <div class="dropdown-menu dropdown-menu-right p-3 shadow animated--grow-in"
                  aria-labelledby="searchDropdown">
                  <form class="form-inline mr-auto w-100 navbar-search">
                      <div class="input-group">
                          <input type="text" class="form-control bg-light border-0 small" placeholder="Search for..."
                              aria-label="Search" aria-describedby="basic-addon2">
                          <div class="input-group-append">
                              <button class="btn btn-primary" type="button">
                                  <i class="fas fa-search fa-sm"></i>
                              </button>
                          </div>
                      </div>
                  </form>
              </div>
          </li>

          <!-- Nav Item - Alerts -->
          <li class="nav-item dropdown no-arrow mx-1">
              <a class="nav-link dropdown-toggle" href="#" id="alertsDropdown" role="button"
                  data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                  <i class="fas fa-bell fa-fw"></i>
                  <!-- Counter - Alerts -->
                  <span class="badge badge-danger badge-counter">{{ $count }}</span>
              </a>
              <!-- Dropdown - Alerts -->
              <div class="dropdown-list dropdown-menu dropdown-menu-right shadow animated--grow-in"
                  aria-labelledby="alertsDropdown">
                  <h6 class="dropdown-header">
                      Alerts Center
                  </h6>

                  @if ($notifications->isEmpty())
                      <p>No notifications available.</p>
                  @else
                      @foreach ($notifications as $notification)
                          <a class="dropdown-item d-flex align-items-center"
                              href="{{ route('service-provider.notifications.show', $notification->id) }}">


                              <div class="mr-3">
                                  <div class="icon-circle bg-primary">
                                      <i class="fas fa-file-alt text-white"></i>
                                  </div>
                              </div>
                              <div>
                                  <div @if (!$notification->read) style="background-color: white;" @endif
                                      class="small text-gray-900">
                                      {{ $notification->bookedBy->name ?? 'No name' }}

                                      {{--  notif name  --}}
                                  </div>
                                  <span class="font-weight-bold">{{ $notification->message }}</span>
                              </div>
                          </a>
                      @endforeach
                  @endif
                  <!-- Nav Item - Messages -->
          <li class="nav-item dropdown no-arrow mx-1">
              <a class="nav-link dropdown-toggle" href="#" id="messagesDropdown" role="button"
                  data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                  <i class="fas fa-envelope fa-fw"></i>
                  <!-- Counter - Messages -->
                  <span class="badge badge-danger badge-counter">7</span>
              </a>
              <!-- Dropdown - Messages -->
              <div class="dropdown-list dropdown-menu dropdown-menu-right shadow animated--grow-in"
                  aria-labelledby="messagesDropdown">
                  <h6 class="dropdown-header">
                      Message Center
                  </h6>
                  @forelse ($chatUsers ?? [] as $user)
                      @php
                          $lastMessage = $user->messages->first();
                          $messagePreview = $lastMessage
                              ? Str::words($lastMessage->message, 5, '...')
                              : 'No messages yet.';
                      @endphp
                      <a class="dropdown-item d-flex align-items-center"
                          href="{{ route('service-provider.chat', ['receiverId' => $user->id]) }}">
                          <div class="dropdown-list-image mr-3">
                              <img class="rounded-circle" src="img/undraw_profile_3.svg" alt="...">
                              <div class="status-indicator bg-warning"></div>
                          </div>
                          <div>
                              <div class="text-truncate">{{ $messagePreview }}</div>
                              <div class="small text-gray-500"> {{ $user->name }}</div>
                          </div>
                      </a>

                  @empty
                      <a class="dropdown-item text-center small text-gray-500" href="#">no
                          Messages</a>
                  @endforelse
              </div>
          </li>

          <div class="topbar-divider d-none d-sm-block"></div>

          <!-- Nav Item - User Information -->
          <li class="nav-item dropdown no-arrow">
              <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown"
                  aria-haspopup="true" aria-expanded="false">

                  @php
                      $user = Auth::user();
                  @endphp

                  <span class="mr-2 d-none d-lg-inline text-gray-600 small">{{ $user->name }}</span>
                  <img class="img-profile rounded-circle" src="{{ asset('assets/img/default.png') }}">
              </a>
              <!-- Dropdown - User Information -->
              <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="userDropdown">
                  <a class="dropdown-item" href="{{ route('service-provider.profile') }}">
                      <i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>
                      Profile
                  </a>
                  {{--  <a class="dropdown-item" href="#">
                      <i class="fas fa-cogs fa-sm fa-fw mr-2 text-gray-400"></i>
                      Settings
                  </a>
                  <a class="dropdown-item" href="#">
                      <i class="fas fa-list fa-sm fa-fw mr-2 text-gray-400"></i>
                      Activity Log
                  </a>  --}}
                  <div class="dropdown-divider"></div>
                  <a class="dropdown-item" href="#" data-toggle="modal" data-target="#logoutModal">
                      <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-danger"></i>
                      Logout
                  </a>
              </div>
          </li>

      </ul>

  </nav>
  <!-- End of Topbar -->
