<!-- Main Sidebar Container -->
<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="{{ route('adminDashboard')}}" class="brand-link">
        <img src={{ asset('public/admin/dist/img/AdminLTELogo.png') }} alt="AdminLTE Logo"
        class="brand-image img-circle elevation-3" style="opacity: .8">
        <span class="brand-text font-weight-light">Dashboard</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">

        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                    <li class="nav-item has-treeview {{ (Route::currentRouteName() == 'submitCertificate' || Route::currentRouteName() == 'listCertificates') ? 'menu-open' : '' }}">
                        <a href="#"
                           class="nav-link {{ (Route::currentRouteName() == 'submitCertificate' || Route::currentRouteName() == 'listCertificates') ? 'active' : '' }}">
                            <i class="nav-icon fas fa-user-tie"></i>
                            <p>
                                Certifications
                                <i class="right fas fa-angle-left"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <a href="{{ route('submitCertificate') }}"
                                   class="nav-link {{ (Route::currentRouteName() == 'submitCertificate') ? 'active' : '' }}">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Add Certificataion</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('listCertificates') }}"
                                   class="nav-link {{ (Route::currentRouteName() == 'listCertificates' ) ? 'active' : '' }}">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>List Certifications</p>
                                </a>
                            </li>
                        </ul>
                    </li>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>

