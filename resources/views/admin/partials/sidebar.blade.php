 <aside id="layout-menu" class="layout-menu menu-vertical menu bg-menu-theme">
     <div class="app-brand demo">
         <a href="" class="app-brand-link">
             <span class="app-brand-logo demo">
                 <img src="{{ asset('template\img\logo_lama.png') }}" width="25" viewBox="0 0 25 42" alt="">
             </span>
             <span class="text-secondary fw-bolder ms-2">Toko Putra Subur</span>
         </a>

         <a href="javascript:void(0);" class="layout-menu-toggle menu-link text-large ms-auto d-block d-xl-none">
             <i class="bx bx-chevron-left bx-sm align-middle"></i>
         </a>
     </div>

     <div class="menu-inner-shadow"></div>

     <ul class="menu-inner py-1">
         <!-- Dashboard -->
         <li class="menu-item {{ request()->is('admin/dashboard*') ? 'active open' : '' }}">
             <a href="{{ route('dashboard') }}" class="menu-link">
                 <i class="menu-icon tf-icons bx bx-home-circle"></i>
                 <div data-i18n="Analytics">Dashboard</div>
             </a>
         </li>

         <li class="menu-header small text-uppercase">
             <span class="menu-header-text">Daftar Konten</span>

         <li class="menu-item {{ request()->is('admin/category*') ? 'active open' : '' }}">
             <a href="{{ route('admin.category') }}" class="menu-link">
                 <i class="menu-icon tf-icons bx bx-category"></i>
                 <div>Kategori</div>
             </a>
         </li>

         <li class="menu-item {{ request()->is('admin/product*') ? 'active open' : '' }}">
             <a href="{{ route('admin.product') }}" class="menu-link">
                 <i class="menu-icon tf-icons bx bx-cart"></i>
                 <div>Produk</div>
             </a>
         </li>
         <li class="menu-header small text-uppercase">
             <span class="menu-header-text">Daftar Pengguna</span>
         </li>
         <!-- Akun -->
         <li class="menu-item {{ request()->is('admin/user*') ? 'active open' : '' }}">
             <a href="{{ route('admin.user') }}" class="menu-link">
                 <i class="menu-icon tf-icons bx bx-user-circle"></i>
                 <div>Pengguna</div>
             </a>
         </li>
     </ul>
 </aside>
