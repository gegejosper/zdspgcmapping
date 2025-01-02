<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <title>{{config('app.name')}}</title>
        <link href="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/style.min.css" rel="stylesheet" />
        <link href="{{asset('css/styles.css') }}" rel="stylesheet" />
        <link href="{{asset('css/custom.css') }}" rel="stylesheet" />
        <script src="https://use.fontawesome.com/releases/v6.3.0/js/all.js" crossorigin="anonymous"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/Turf.js/6.5.0/turf.min.js"></script>
        <script src='https://api.mapbox.com/mapbox-gl-js/v2.15.0/mapbox-gl.js'></script>
        <link href='https://api.mapbox.com/mapbox-gl-js/v2.15.0/mapbox-gl.css' rel='stylesheet' />
        @yield('scripts')
    </head>
    <body class="sb-nav-fixed">
        <nav class="sb-topnav navbar navbar-expand navbar-dark bg-dark">
            <!-- Navbar Brand-->
            <a class="navbar-brand ps-3" href="/panel/dashboard">ZDSPGC Dashboard</a>
            <!-- Sidebar Toggle-->
            <button class="btn btn-link btn-sm order-1 order-lg-0 me-4 me-lg-0" id="sidebarToggle" href="#!"><i class="fas fa-bars"></i></button>
            
        </nav>
        <div id="layoutSidenav">
            <div id="layoutSidenav_nav">
                <nav class="sb-sidenav accordion sb-sidenav-dark" id="sidenavAccordion">
                    <div class="sb-sidenav-menu">
                        <div class="nav">
                            <div class="sb-sidenav-menu-heading">Administration</div>
                            <a class="nav-link" href="/panel/dashboard">
                                <span class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></span> <span class="sb-nav-link-text">Dashboard</span>
                            </a>
                            <a class="nav-link" href="/panel/students">
                                <span class="sb-nav-link-icon "><i class="fas fa-users"></i></span><span class="sb-nav-link-text">Students</span>
                            </a>
                            <a class="nav-link" href="/panel/courses">
                                <span class="sb-nav-link-icon"><i class="fas fa-list"></i></span><span class="sb-nav-link-text">Courses</span>
                            </a>
                            <a class="nav-link" href="/panel/campuses">
                                <span class="sb-nav-link-icon"><i class="fas fa-building"></i></span><span class="sb-nav-link-text">Campuses</span>
                            </a>
                            <a class="nav-link" href="/panel/scholarships">
                                <span class="sb-nav-link-icon"><i class="fas fa-money-check"></i></span><span class="sb-nav-link-text">Scholarships</span>
                            </a>
                            <a class="nav-link" href="/panel/profile">
                                <span class="sb-nav-link-icon"><i class="fas fa-user-shield"></i></span><span class="sb-nav-link-text">Account</span>
                            </a>
                            <form method="POST" action="{{ route('logout') }}">
                            @csrf                    
                            <a class="nav-link" href="route('logout')"
                                        onclick="event.preventDefault();
                                        this.closest('form').submit();">
                                <span class="sb-nav-link-icon"><i class="fas fa-lock"></i></span>
                                <span class="sb-nav-link-text">Logout</span>
                            </a>
                            
                            </form>
                        </div>
                    </div>
                    <!-- <div class="sb-sidenav-footer">
                        <div class="small">Logged in as:</div>
                        Start Bootstrap
                    </div> -->
                </nav>
            </div>
                @yield('content')
                <footer class="py-4 bg-light mt-auto">
                    <div class="container-fluid px-4">
                        <div class="d-flex align-items-center justify-content-between small">
                            <div class="text-muted">Copyright &copy; {{config('app.name')}}</div>
                            <!-- <div>
                                <a href="#">Privacy Policy</a>
                                &middot;
                                <a href="#">Terms &amp; Conditions</a>
                            </div> -->
                        </div>
                    </div>
                </footer>
            </div>
        </div>
        <script src="https://code.jquery.com/jquery-3.7.1.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
        <script src="{{ asset('js/scripts.js') }}"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.min.js" crossorigin="anonymous"></script>
        <script src="assets/demo/chart-area-demo.js"></script>
        <script src="assets/demo/chart-bar-demo.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/umd/simple-datatables.min.js" crossorigin="anonymous"></script>
        <script src="js/datatables-simple-demo.js"></script>
        @yield('footer_scripts')
    </body>
</html>
