<!doctype html>
<html lang="en" data-layout="vertical" data-topbar="light" data-sidebar="dark" data-sidebar-size="lg"
    data-sidebar-image="none" data-preloader="disable">
@include('admin.partials.head')

<body>

    <!-- Begin page -->
    <div id="layout-wrapper">
        @include('admin.partials.header')

        <!-- ========== App Menu ========== -->
        <div class="app-menu navbar-menu">
            <!-- LOGO -->
            <div class="navbar-brand-box">
                <!-- Dark Logo-->
                <a href="https://triviet.net/" class="logo logo-dark">
                    <span class="logo-sm">
                        <img src="{{ asset('admin_style/assets/images/logo.png ') }}" alt="" height="22">
                    </span>
                    <span class="logo-lg">
                        <img src="{{ asset('admin_style/assets/images/logo.png ') }}" alt="" height="17">
                    </span>
                </a>
                <!-- Light Logo-->
                <a href="https://triviet.net/" class="logo logo-light">
                    <span class="logo-sm">
                        <img src="{{ asset('admin_style/assets/images/logo.png ') }}" alt="" height="22">
                    </span>
                    <span class="logo-lg">
                        <img src="{{ asset('admin_style/assets/images/logo.png ') }}" alt=""
                            style="width:10rem;height:auto">
                    </span>
                </a>
                <button type="button" class="btn btn-sm p-0 fs-20 header-item float-end btn-vertical-sm-hover"
                    id="vertical-hover">
                    <i class="ri-record-circle-line"></i>
                </button>
            </div>

            @include('admin.partials.sidebar')

            <div class="sidebar-background"></div>
        </div>
        <!-- Left Sidebar End -->
        <!-- Vertical Overlay-->
        <div class="vertical-overlay"></div>

        <!-- ============================================================== -->
        <!-- Start right Content here -->
        <!-- ============================================================== -->
        <div class="main-content">


            {{-- Star page-content --}}
            @yield('content')
            <!-- End Page-content -->

            <footer class="footer">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-sm-6">
                            <script>
                                document.write(new Date().getFullYear())
                            </script> © Triviet.net
                        </div>
                        <div class="col-sm-6">
                            <div class="text-sm-end d-none d-sm-block">
                                Design & Develop by Triviet.net
                            </div>
                        </div>
                    </div>
                </div>
            </footer>
        </div>
        <!-- end main content-->

    </div>
    <!-- END layout-wrapper -->


    @include('admin.partials.footer')
    @include('sweetalert::alert')

</body>

</html>
