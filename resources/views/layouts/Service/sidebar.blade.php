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

     <!-- Heading -->
     <div class="sidebar-heading">
         Event Services
     </div>

     <li class="nav-item {{ request()->routeIs('services.create') ? 'active' : '' }}">
         <a class="nav-link" href="{{ route('service-provider.services.create') }}">
             <i class="fa-solid fa-file-circle-plus"></i>
             <span>Add Services</span>
         </a>
     </li>

     <li class="nav-item {{ request()->routeIs('services.index') ? 'active' : '' }}">
         <a class="nav-link" href="{{ route('service-provider.services.index') }}">
             <i class="fa-solid fa-list"></i>
             <span>My Services</span></a>
     </li>


     <!-- Heading -->
     <div class="sidebar-heading">
         Booked Services
     </div>

     <li class="nav-item {{ request()->routeIs('event-services.bookings') ? 'active' : '' }}">
         <a class="nav-link" href="{{ route('service-provider.event-services.bookings') }}">
             <i class="fa-solid fa-book"></i>
             <span>Booked List</span></a>
     </li>

     {{-- <li class="nav-item">
         <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseOne"
             aria-expanded="true" aria-controls="collapseOne">
             <i class="fas fa-fw fa-cog"></i>
             <span>Event Services</span>
         </a>
         <div id="collapseOne" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
             <div class="bg-white py-2 collapse-inner rounded">
                 <a class="collapse-item" href="{{ route('services.create') }}">Add Service</a>
                 <a class="collapse-item" href="{{ route('services.index') }}">My Services</a>
             </div>
         </div>
     </li> --}}

     <!-- Nav Item - Pages Collapse Menu -->
     {{-- <li class="nav-item">
         <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTwo"
             aria-expanded="true" aria-controls="collapseTwo">
             <i class="fas fa-fw fa-book"></i>
             <span>Booked Service</span>
         </a>
         <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
             <div class="bg-white py-2 collapse-inner rounded">
                 <a class="collapse-item" href="{{ route('event-services.bookings') }}">Service List</a>
                 <a class="collapse-item" href="cards.html">Cards</a>
             </div>
         </div>
     </li> --}}

     <!-- Nav Item - Utilities Collapse Menu -->
     {{-- <li class="nav-item">
         <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseUtilities"
             aria-expanded="true" aria-controls="collapseUtilities">
             <i class="fas fa-fw fa-wrench"></i>
             <span>Utilities</span>
         </a>
         <div id="collapseUtilities" class="collapse" aria-labelledby="headingUtilities"
             data-parent="#accordionSidebar">
             <div class="bg-white py-2 collapse-inner rounded">
                 <h6 class="collapse-header">Custom Utilities:</h6>
                 <a class="collapse-item" href="utilities-color.html">Colors</a>
                 <a class="collapse-item" href="utilities-border.html">Borders</a>
                 <a class="collapse-item" href="utilities-animation.html">Animations</a>
                 <a class="collapse-item" href="utilities-other.html">Other</a>
             </div>
         </div>
     </li> --}}

     <!-- Divider -->
     <hr class="sidebar-divider">

     <!-- Heading -->
     <div class="sidebar-heading">
         Users
     </div>

     <!-- Nav Item - Pages Collapse Menu -->
     {{-- <li class="nav-item">
         <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapsePages"
             aria-expanded="true" aria-controls="collapsePages">
             <i class="fas fa-fw fa-folder"></i>
             <span>Pages</span>
         </a>
         <div id="collapsePages" class="collapse" aria-labelledby="headingPages" data-parent="#accordionSidebar">
             <div class="bg-white py-2 collapse-inner rounded">
                 <h6 class="collapse-header">Login Screens:</h6>
                 <a class="collapse-item" href="login.html">Login</a>
                 <a class="collapse-item" href="register.html">Register</a>
                 <a class="collapse-item" href="forgot-password.html">Forgot Password</a>
                 <div class="collapse-divider"></div>
                 <h6 class="collapse-header">Other Pages:</h6>
                 <a class="collapse-item" href="404.html">404 Page</a>
                 <a class="collapse-item" href="blank.html">Blank Page</a>
             </div>
         </div>
     </li> --}}

     <!-- Nav Item - Charts -->
     {{-- <li class="nav-item">
         <a class="nav-link" href="charts.html">
             <i class="fas fa-fw fa-chart-area"></i>
             <span>Charts</span></a>
     </li> --}}

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
