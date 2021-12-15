<!-- Main Sidebar Container -->
<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="{{ route('adminDashboard')}}" class="brand-link">
        <img src="{{ asset('public/assets/MNSUAM-Logo.png') }}" alt="MNSUAM Logo"
        class="brand-image img-circle elevation-3" style="opacity: .8">
        <span class="brand-text font-weight-light">Dashboard</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">

        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">

                <li class="nav-item has-treeview {{ (Route::currentRouteName() == 'submitStudent' || Route::currentRouteName() == 'listStudents') ? 'menu-open' : '' }}">
                    <a href="#"
                       class="nav-link {{ (Route::currentRouteName() == 'submitStudent' || Route::currentRouteName() == 'listStudents') ? 'active' : '' }}">
                        <i class="nav-icon fas fa-user-tie"></i>
                        <p>
                            Students
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{ route('submitStudent') }}"
                               class="nav-link {{ (Route::currentRouteName() == 'submitStudent') ? 'active' : '' }}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Add Student</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('listStudents') }}"
                               class="nav-link {{ (Route::currentRouteName() == 'listStudents' ) ? 'active' : '' }}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>List Students</p>
                            </a>
                        </li>
                    </ul>
                </li>


                <li class="nav-item has-treeview {{ (Route::currentRouteName() == 'submitCertificate' || Route::currentRouteName() == 'listCertificates') ? 'menu-open' : '' }}">
                    <a href="#"
                       class="nav-link {{ (Route::currentRouteName() == 'submitCertificate' || Route::currentRouteName() == 'listCertificates') ? 'active' : '' }}">
                        <i class="nav-icon fas fa-bookmark"></i>
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
                                <p>Add Certification</p>
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


                <li class="nav-item has-treeview {{ (Route::currentRouteName() == 'submitTranscript' || Route::currentRouteName() == 'listTranscripts') ? 'menu-open' : '' }}">
                    <a href="#"
                       class="nav-link {{ (Route::currentRouteName() == 'submitTranscript' || Route::currentRouteName() == 'listTranscripts') ? 'active' : '' }}">
                        <i class="nav-icon fas fa-address-book"></i>
                        <p>
                            Transcripts
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{ route('submitTranscript') }}"
                               class="nav-link {{ (Route::currentRouteName() == 'submitTranscript') ? 'active' : '' }}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Add Transcript</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('listTranscripts') }}"
                               class="nav-link {{ (Route::currentRouteName() == 'listTranscripts' ) ? 'active' : '' }}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>List Transcripts</p>
                            </a>
                        </li>
                    </ul>
                </li>


            </ul>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>

