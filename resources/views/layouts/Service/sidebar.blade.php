 <!-- Sidebar -->
 <ul class="navbar-nav bg-gradient-secondary sidebar sidebar-dark accordion" id="accordionSidebar">

     <!-- Sidebar - Brand -->
     <a class="sidebar-brand d-flex align-items-center justify-content-center bg-gradient-success"
         href="{{ url('/home') }}">
         <div class="sidebar-brand-icon">
             <img src="{{ asset('assets/img/Logo/logo1.jpg') }}" alt="Logo" class="rounded-circle border border-black"
                 height="50" width="50">
         </div>
         <div class="sidebar-brand-text">Service Provider</div>
     </a>

     <!-- Divider -->
     <hr class="sidebar-divider my-0 mb-3">
     <div class="sidebar-heading">
         Home
     </div>

     <!-- Nav Item - Dashboard -->
     <li class="nav-item {{ request()->routeIs('home') ? 'active' : '' }}">
         <a class="nav-link" href="{{ route('home') }}">
             <i class="fa-solid fa-house"></i>
             <span>Dashboard</span></a>
     </li>

     <!-- Divider -->
     <hr class="sidebar-divider">
     <div class="sidebar-heading">
         Event Services Management
     </div>

     <li class="nav-item">
         @php
             $isEventServicesActive =
                 request()->routeIs('service-provider.services.create') ||
                 request()->routeIs('service-provider.services.index');
         @endphp
         <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseOne"
             aria-expanded="{{ $isEventServicesActive ? 'true' : 'false' }}" aria-controls="collapseOne">
             <i class="fas fa-fw fa-cog"></i>
             <span>Event Services</span>
         </a>
         <div id="collapseOne" class="collapse {{ $isEventServicesActive ? 'show' : '' }}" aria-labelledby="headingTwo"
             data-parent="#accordionSidebar">
             <div class="bg-white py-2 collapse-inner rounded">
                 @if (Auth::user()->verified)
                     <a class="collapse-item {{ request()->routeIs('service-provider.services.create') ? 'active' : '' }}"
                         href="{{ route('service-provider.services.create') }}">Add Service</a>
                     <a class="collapse-item {{ request()->routeIs('service-provider.services.index') ? 'active' : '' }}"
                         href="{{ route('service-provider.services.index') }}">My Services</a>
                 @else
                     <p class="text-warning text-center">Wait for your account to be verified</p>
                 @endif
             </div>
         </div>
     </li>

     {{-- bookings management --}}
     <li class="nav-item">
         @php
             $isBookingsActive =
                 request()->is('service-provider/bookings') &&
                 in_array(request('status'), ['pending', 'confirmed', 'canceled']);
         @endphp
         <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#bookings"
             aria-expanded="{{ $isBookingsActive ? 'true' : 'false' }}" aria-controls="bookings">
             <i class="fas fa-fw fa-cog"></i>
             <span>Bookings</span>
         </a>
         <div id="bookings" class="collapse {{ $isBookingsActive ? 'show' : '' }}" aria-labelledby="headingTwo"
             data-parent="#accordionSidebar">
             <div class="bg-white py-2 collapse-inner rounded">
                 @if (Auth::user()->verified)
                     <a class="collapse-item {{ request()->is('service-provider/bookings') && request('status') == 'pending' ? 'active' : '' }}"
                         href="{{ route('service-provider.bookings.index', ['status' => 'pending']) }}">Pending</a>
                     <a class="collapse-item {{ request()->is('service-provider/bookings') && request('status') == 'confirmed' ? 'active' : '' }}"
                         href="{{ route('service-provider.bookings.index', ['status' => 'confirmed']) }}">Confirmed</a>
                     <a class="collapse-item {{ request()->is('service-provider/bookings') && request('status') == 'canceled' ? 'active' : '' }}"
                         href="{{ route('service-provider.bookings.index', ['status' => 'canceled']) }}">Canceled</a>
                 @else
                     <p class="text-warning text-center">Wait for your account to be verified</p>
                 @endif
             </div>
         </div>
     </li>
     <!-- Divider -->
     <hr class="sidebar-divider">

     <!-- Heading -->
     <div class="sidebar-heading">
         Users
     </div>


     <!-- Nav Item - Tables -->
     <li class="nav-item {{ request()->routeIs('booked.users') ? 'active' : '' }}">
         <a class="nav-link" href="{{ route('service-provider.booked.users') }}">
             <i class="fa-solid fa-users"></i>
             <span>Users List</span></a>
     </li>




     <!-- Divider -->
     <hr class="sidebar-divider d-none d-md-block">

     <!-- Sidebar Toggler (Sidebar) -->
     <div class="text-center d-none d-md-inline">
         <button class="rounded-circle border-0" id="sidebarToggle"></button>
     </div>

 </ul>
 <!-- End of Sidebar -->
