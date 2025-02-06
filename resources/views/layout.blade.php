<!doctype html>

<html lang="en" class="light-style layout-menu-fixed layout-compact" dir="ltr" data-theme="theme-default" data-assets-path="../assets/" data-template="vertical-menu-template-free" data-style="light">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0" />

    <title>Dashboard - Annur Net</title>

    <meta name="description" content="" />

    <!-- Favicon -->
    <link rel="icon" type="image/x-icon" href="{{ asset('assets/img/favicon/favicon.ico') }}" />

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&ampdisplay=swap" rel="stylesheet" />

    <link rel="stylesheet" href="{{ asset('assets/vendor/fonts/remixicon/remixicon.css') }}" />

    <!-- Menu waves for no-customizer fix -->
    <link rel="stylesheet" href="{{ asset('assets/vendor/libs/node-waves/node-waves.css') }}" />

    <!-- Core CSS -->
    <link rel="stylesheet" href="{{ asset('assets/vendor/css/core.css') }}" class="template-customizer-core-css" />
    <link rel="stylesheet" href="{{ asset('assets/vendor/css/theme-default.css') }}" class="template-customizer-theme-css" />
    <link rel="stylesheet" href="{{ asset('assets/css/demo.css') }}" />

    <!-- Vendors CSS -->
    <link rel="stylesheet" href="{{ asset('assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.css') }}" />

    <!-- Page CSS -->

    <!-- Helpers -->
    <script src="{{ asset('assets/vendor/js/helpers.js') }}"></script>
    <!--! Template customizer & Theme config files MUST be included after core stylesheets and helpers.js in the <head> section -->
    <!--? Config:  Mandatory theme config file contain global vars & default theme options, Set your preferred theme option in this file.  -->
    <script src="{{ asset('assets/js/config.js') }}"></script>

    {{-- LeafletJS  --}}
    @stack('custom-scripts-map')

    @stack('waktuOnload')


</head>

<body {{ request()->is('/') ? 'onLoad="waktu()"' : '' }}>
    <!-- Layout wrapper -->
    <div class="layout-wrapper layout-content-navbar">
        <div class="layout-container">
            <!-- Menu -->

            <aside id="layout-menu" class="layout-menu menu-vertical menu bg-menu-theme">
                <div class="app-brand demo">
                    <a href="/" class="app-brand-link">
                        <img src="{{ asset('assets/img/dashboard3.png') }}" alt="dashboard" style="max-width: 90%">
                    </a>

                    <a href="javascript:void(0);" class="layout-menu-toggle menu-link text-large ms-auto">
                        <i class="menu-toggle-icon d-xl-block align-middle"></i>
                    </a>
                </div>

                <div class="menu-inner-shadow"></div>

                <ul class="menu-inner py-1">
                    <!-- Dashboards -->
                    <li class="menu-item {{ request()->is('/') ? 'active' : '' }}">
                        <a href="/" class="menu-link">
                            <i class="menu-icon tf-icons ri-home-smile-line"></i>
                            <div data-i18n="Dashboards">Dashboards</div>
                        </a>
                    </li>

                    <li class="menu-header mt-7">
                        <span class="menu-header-text">Data Master</span>
                    </li>
                    <!-- Karyawan -->
                    <!-- Layouts -->
                    <li class="menu-item  {{ request()->is('karyawan*','task*','password*','priority*') ? 'active open' : '' }}">
                        <a href="javascript:void(0);" class="menu-link menu-toggle">
                            <i class="menu-icon tf-icons ri-id-card-line"></i>
                            <div data-i18n="Layouts">Karyawan</div>
                        </a>

                        <ul class="menu-sub">
                            <li class="menu-item {{ request()->is('karyawan*','password*') ? 'active' : '' }}">
                                <a href="{{ route('karyawan.index') }}" class="menu-link">
                                    <div>Data Karyawan</div>
                                </a>
                            </li>
                            <li class="menu-item menu-item {{ request()->is('task*') ? 'active' : '' }}">
                                <a href="{{ route('task.index') }}" class="menu-link">
                                    <div data-i18n="Without navbar">Kategori Tugas</div>
                                </a>
                            </li>
                            <li class="menu-item {{ request()->is('priority*') ? 'active' : '' }}">
                                <a href="{{ route('priority.index') }}" class="menu-link">
                                    <div data-i18n="Container">Kategori Urgensi</div>
                                </a>
                            </li>
                        </ul>
                    </li>

                    <!-- OLT -->
                    <!-- Layouts -->
                    <li class="menu-item {{ request()->is('network*','map*') ? 'active open' : '' }}">
                        <a href="javascript:void(0);" class="menu-link menu-toggle">
                            <i class="menu-icon tf-icons ri-router-line"></i>
                            <div data-i18n="Layouts">OLT</div>
                        </a>

                        <ul class="menu-sub">
                            <li class="menu-item {{ request()->is('network*') ? 'active' : '' }}">
                                <a href="{{ route('network.index') }}" class="menu-link">
                                    <div data-i18n="Without menu">Data OLT</div>
                                </a>
                            </li>
                            <li class="menu-item {{ request()->is('map*') ? 'active' : '' }}">
                                <a href="{{ route('map.index') }}" class="menu-link">
                                    <div data-i18n="Without navbar">MAP OLT</div>
                                </a>
                            </li>
                        </ul>
                    </li>

                    <!-- Barang -->
                    <!-- Layouts -->
                    <li class="menu-item {{ request()->is('barang*') ? 'active open' : '' }}">
                        <a href="javascript:void(0);" class="menu-link menu-toggle">
                            <i class="menu-icon tf-icons ri-layout-2-line"></i>
                            <div data-i18n="Layouts">Barang</div>
                        </a>

                        <ul class="menu-sub">
                            <li class="menu-item {{ request()->is('barang*') ? 'active' : '' }}">
                                <a href="{{ route('barang.index') }}" class="menu-link">
                                    <div data-i18n="Without menu">Data Barang & Stok</div>
                                </a>
                            </li>
                        </ul>
                    </li>

                    <!-- SLA -->
                    <!-- Layouts -->
                    <li class="menu-item {{ request()->is('sla*') ? 'active open' : '' }}">
                        <a href="javascript:void(0);" class="menu-link menu-toggle">
                            <i class="menu-icon tf-icons ri-timer-line"></i>
                            <div data-i18n="Layouts">SLA</div>
                        </a>

                        <ul class="menu-sub">
                            <li class="menu-item {{ request()->is('sla*') ? 'active' : '' }}">
                                <a href="{{ route('sla.index') }}" class="menu-link">
                                    <div data-i18n="Without menu">Setting SLA</div>
                                </a>
                            </li>
                        </ul>
                    </li>

                    <li class="menu-header mt-7">
                        <span class="menu-header-text">Managemen</span>
                    </li>

                    <!-- Barang -->
                    <!-- Layouts -->
                    <li class="menu-item">
                        <a href="javascript:void(0);" class="menu-link menu-toggle">
                            <i class="menu-icon tf-icons ri-layout-2-line"></i>
                            <div data-i18n="Layouts">Managemen Barang</div>
                        </a>

                        <ul class="menu-sub">
                            <li class="menu-item">
                                <a href="layouts-without-menu.html" class="menu-link">
                                    <div data-i18n="Without menu">Input Barang Masuk</div>
                                </a>
                            </li>
                            <li class="menu-item">
                                <a href="layouts-without-navbar.html" class="menu-link">
                                    <div data-i18n="Without navbar">Input Barang Keluar</div>
                                </a>
                            </li>
                            <li class="menu-item">
                                <a href="layouts-container.html" class="menu-link">
                                    <div data-i18n="Container">Input Barang Rusak</div>
                                </a>
                            </li>
                        </ul>
                    </li>

                    <!-- Karyawan -->
                    <!-- Layouts -->
                    <li class="menu-item {{ request()->is('ticket*') ? 'active open' : '' }}">
                        <a href="javascript:void(0);" class="menu-link menu-toggle">
                            <i class="menu-icon tf-icons ri-id-card-line"></i>
                            <div data-i18n="Layouts">Karyawan</div>
                        </a>

                        <ul class="menu-sub">
                            <li class="menu-item">
                                <a href="layouts-without-menu.html" class="menu-link">
                                    <div data-i18n="Without menu">Absensi</div>
                                </a>
                            </li>
                            <li class="menu-item {{ request()->is('ticket*') ? 'active' : '' }}">
                                <a href="{{ route('ticket.index') }}" class="menu-link">
                                    <div data-i18n="Without navbar">Ticket</div>
                                </a>
                            </li>
                            <li class="menu-item">
                                <a href="layouts-container.html" class="menu-link">
                                    <div data-i18n="Container">Laporan Tugas</div>
                                </a>
                            </li>
                        </ul>
                    </li>
                    <li class="menu-item">
                        <a href="/" class="menu-link">
                            <i class="menu-icon tf-icons ri-git-repository-private-line"></i>
                            <div data-i18n="Layouts">Hak Akses</div>
                        </a>
                    </li>
                    <li class="menu-item">
                        <a href="/" class="menu-link">
                            <i class="menu-icon tf-icons ri-archive-line"></i>
                            <div data-i18n="Layouts">Dokumentasi & Arsip</div>
                        </a>
                    </li>

                    <li class="menu-header mt-7">
                        <span class="menu-header-text">Laporan</span>
                    </li>

                    <!-- Karyawan -->
                    <!-- Layouts -->
                    <li class="menu-item">
                        <a href="javascript:void(0);" class="menu-link menu-toggle">
                            <i class="menu-icon tf-icons ri-cash-line"></i>
                            <div data-i18n="Layouts">Keuangan</div>
                        </a>

                        <ul class="menu-sub">
                            <li class="menu-item">
                                <a href="layouts-without-menu.html" class="menu-link">
                                    <div data-i18n="Without menu">Pemasukan</div>
                                </a>
                            </li>
                            <li class="menu-item">
                                <a href="layouts-without-navbar.html" class="menu-link">
                                    <div data-i18n="Without navbar">Pengeluaran</div>
                                </a>
                            </li>
                            <li class="menu-item">
                                <a href="layouts-container.html" class="menu-link">
                                    <div data-i18n="Container">Laporan Keuangan</div>
                                </a>
                            </li>
                        </ul>
                    </li>

                    <li class="menu-item">
                        <a href="javascript:void(0);" class="menu-link menu-toggle">
                            <i class="menu-icon tf-icons ri-ticket-2-line"></i>
                            <div data-i18n="Layouts">Ticket Karyawan</div>
                        </a>

                        <ul class="menu-sub">
                            <li class="menu-item">
                                <a href="layouts-without-menu.html" class="menu-link">
                                    <div data-i18n="Without menu">Statistik & SLA</div>
                                </a>
                            </li>
                        </ul>
                    </li>
                </ul>
            </aside>
            <!-- / Menu -->

            <!-- Layout container -->
            <div class="layout-page">
                <!-- Navbar -->

                <nav class="layout-navbar container-xxl navbar navbar-expand-xl navbar-detached align-items-center bg-navbar-theme" id="layout-navbar">
                    <div class="layout-menu-toggle navbar-nav align-items-xl-center me-4 me-xl-0 d-xl-none">
                        <a class="nav-item nav-link px-0 me-xl-6" href="javascript:void(0)">
                            <i class="ri-menu-fill ri-24px"></i>
                        </a>
                    </div>

                    <div class="navbar-nav-right d-flex align-items-center" id="navbar-collapse">

                        <ul class="navbar-nav flex-row align-items-center ms-auto">
                            <!-- Place this tag where you want the button to render. -->
                            <li class="nav-item lh-1 me-4">
                                <span><b>Hi</b>, Adi</span>
                            </li>

                            <!-- User -->
                            <li class="nav-item navbar-dropdown dropdown-user dropdown">
                                <a class="nav-link dropdown-toggle hide-arrow p-0" href="javascript:void(0);" data-bs-toggle="dropdown">
                                    <div class="avatar avatar-online">
                                        <img src="{{ asset('assets/img/avatars/1.png') }}" alt class="w-px-40 h-auto rounded-circle" />
                                    </div>
                                </a>
                                <ul class="dropdown-menu dropdown-menu-end mt-3 py-2">
                                    <li>
                                        <a class="dropdown-item" href="#">
                                            <div class="d-flex align-items-center">
                                                <div class="flex-shrink-0 me-2">
                                                    <div class="avatar avatar-online">
                                                        <img src="{{ asset('assets/img/avatars/1.png') }}" alt class="w-px-40 h-auto rounded-circle" />
                                                    </div>
                                                </div>
                                                <div class="flex-grow-1">
                                                    <h6 class="mb-0 small">John Doe</h6>
                                                    <small class="text-muted">Admin</small>
                                                </div>
                                            </div>
                                        </a>
                                    </li>
                                    <li>
                                        <div class="dropdown-divider"></div>
                                    </li>
                                    <li>
                                        <a class="dropdown-item" href="#">
                                            <i class="ri-user-3-line ri-22px me-2"></i>
                                            <span class="align-middle">My Profile</span>
                                        </a>
                                    </li>
                                    <li>
                                        <a class="dropdown-item" href="#">
                                            <i class="ri-settings-4-line ri-22px me-2"></i>
                                            <span class="align-middle">Settings</span>
                                        </a>
                                    </li>
                                    <li>
                                        <a class="dropdown-item" href="#">
                                            <span class="d-flex align-items-center align-middle">
                                                <i class="flex-shrink-0 ri-file-text-line ri-22px me-3"></i>
                                                <span class="flex-grow-1 align-middle">Billing</span>
                                                <span class="flex-shrink-0 badge badge-center rounded-pill bg-danger h-px-20 d-flex align-items-center justify-content-center">4</span>
                                            </span>
                                        </a>
                                    </li>
                                    <li>
                                        <div class="dropdown-divider"></div>
                                    </li>
                                    <li>
                                        <div class="d-grid px-4 pt-2 pb-1">
                                            <a class="btn btn-danger d-flex" href="javascript:void(0);">
                                                <small class="align-middle">Logout</small>
                                                <i class="ri-logout-box-r-line ms-2 ri-16px"></i>
                                            </a>
                                        </div>
                                    </li>
                                </ul>
                            </li>
                            <!--/ User -->
                        </ul>
                    </div>
                </nav>

                <!-- / Navbar -->

                <!-- Content wrapper -->
                <div class="content-wrapper">
                    <!-- Content -->

                    <div class="container-xxl flex-grow-1 container-p-y">
                        <div class="row gy-6">

                            @yield('content')

                        </div>
                    </div>
                    <!-- / Content -->

                </div>
                <!-- / Layout page -->
            </div>

            <!-- Overlay -->
            <div class="layout-overlay layout-menu-toggle"></div>
        </div>
        <!-- / Layout wrapper -->


        <!-- Core JS -->
        <!-- build:js assets/vendor/js/core.js -->
        <script src="{{ asset('assets/vendor/libs/jquery/jquery.js') }}"></script>
        <script src="{{ asset('assets/vendor/libs/popper/popper.js') }}"></script>
        <script src="{{ asset('assets/vendor/js/bootstrap.js') }}"></script>
        <script src="{{ asset('assets/vendor/libs/node-waves/node-waves.js') }}"></script>
        <script src="{{ asset('assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.js') }}"></script>
        <script src="{{ asset('assets/vendor/js/menu.js') }}"></script>

        <!-- endbuild -->

        <!-- Vendors JS -->

        <!-- Main JS -->
        <script src="{{ asset('assets/js/main.js') }}"></script>

        <!-- Page JS -->

        <!-- Place this tag before closing body tag for github widget button. -->
        <script async defer src="https://buttons.github.io/buttons.js"></script>

</body>
</html>
