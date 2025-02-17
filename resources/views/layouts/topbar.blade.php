 <!-- Topbar -->
 <nav class="navbar navbar-expand navbar-dark bg-dark topbar static-top shadow">

     <!-- Sidebar Toggle (Topbar) -->
     <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
         <i class="fa fa-bars"></i>
     </button>

     <!-- Topbar Navbar -->
     <ul class="navbar-nav ml-auto text-white">
         <!-- Tempatkan alert di sini -->
         <div class="d-flex justify-content-center flex-grow-1">
             @if (session('success'))
                 <div class="alert alert-success text-center mb-0" style="width: auto;">
                     {{ session('success') }}
                 </div>
             @elseif (session('error'))
                 <div class="alert alert-danger text-center mb-0" style="width: auto;">
                     {{ session('error') }}
                 </div>
             @endif
             @if ($errors->any())
                 <div class="alert alert-danger mb-0" style="width: auto;">
                     <ul class="mb-0">
                         @foreach ($errors->all() as $error)
                             <li>{{ $error }}</li>
                         @endforeach
                     </ul>
                 </div>
             @endif
         </div>
         <!-- Nav Item - User Information -->
         <li class="nav-item dropdown no-arrow">
             <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown"
                 aria-haspopup="true" aria-expanded="false">
                 <span class="mr-2 d-none d-lg-inline text-white-600 small">
                     @if (Auth::guard('admin')->check())
                         Anda login sebagai Admin
                     @elseif(Auth::guard('operator')->check())
                         Anda login sebagai Operator
                     @endif
                 </span>
                 <img class="img-profile rounded-circle" src="img/undraw_profile.svg">
             </a>
             <!-- Dropdown - User Information -->
             <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="userDropdown">
                 <a class="dropdown-item" href="#" data-toggle="modal" data-target="#logoutModal">
                     <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-white-400"></i>
                     Logout
                 </a>
             </div>
         </li>
     </ul>

 </nav>
 <!-- End of Topbar -->
 <!-- Modal Logout -->
 <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="logoutModalLabel"
     aria-hidden="true">
     <div class="modal-dialog" role="document">
         <div class="modal-content">
             <div class="modal-header">
                 <h5 class="modal-title" id="logoutModalLabel">Konfirmasi Logout</h5>
                 <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                     <span aria-hidden="true">&times;</span>
                 </button>
             </div>
             <div class="modal-body">
                 Apakah Anda yakin ingin logout?
             </div>
             <div class="modal-footer">
                 <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                 <form action="{{ route('logout') }}" method="POST" style="display: inline;">
                     @csrf
                     <button type="submit" class="btn btn-primary">Logout</button>
                 </form>
             </div>
         </div>
     </div>
 </div>
