<!DOCTYPE html>

<html lang="en">
    <!--<![endif]-->
    <!-- BEGIN HEAD -->

    <head>
        <meta charset="utf-8" />
        <title>{{config('app.name')}}</title>
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta content="width=device-width, initial-scale=1.0" name="viewport" />
        <meta http-equiv="Content-type" content="text/html; charset=utf-8">
        <meta content="" name="description" />
        <meta content="" name="author" />
        <!-- BEGIN GLOBAL MANDATORY STYLES -->
        <link href='http://fonts.googleapis.com/css?family=Roboto+Condensed:300italic,400italic,700italic,400,300,700&amp;subset=all' rel='stylesheet' type='text/css'>
        <link href="{{asset('assets/plugins/socicon/socicon.css') }}" rel="stylesheet" type="text/css" />
        <link href="{{asset('assets/plugins/bootstrap-social/bootstrap-social.css') }}" rel="stylesheet" type="text/css" />
        <link href="{{asset('assets/plugins/font-awesome/css/font-awesome.min.css') }}" rel="stylesheet" type="text/css" />
        <link href="{{asset('assets/plugins/simple-line-icons/simple-line-icons.min.css') }}" rel="stylesheet" type="text/css" />
        <link href="{{asset('assets/plugins/animate/animate.min.css') }}" rel="stylesheet" type="text/css" />
        <link href="{{asset('assets/plugins/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet" type="text/css" />
        <!-- END GLOBAL MANDATORY STYLES -->
       
        <!-- BEGIN: PAGE STYLES -->
        <link href="{{asset('assets/plugins/ilightbox/css/ilightbox.css') }}" rel="stylesheet" type="text/css" />
        <!-- END: PAGE STYLES -->
        <!-- BEGIN THEME STYLES -->
        <link href="{{asset('assets/demos/index/css/plugins.css') }}" rel="stylesheet" type="text/css" />
        <link href="{{asset('assets/demos/index/css/components.css') }}" id="style_components" rel="stylesheet" type="text/css" />
        <link href="{{asset('assets/demos/index/css/themes/default.css') }}" rel="stylesheet" id="style_theme" type="text/css" />
        <link href="{{asset('assets/demos/index/css/custom.css') }}" rel="stylesheet" type="text/css" />
        <!-- END THEME STYLES -->
        <link rel="shortcut icon" href="favicon.ico" /> 
        <link href="{{asset('css/front.css') }}" rel="stylesheet" />
        <link href="{{asset('css/custom.css') }}" rel="stylesheet" />
        <script src='https://api.mapbox.com/mapbox-gl-js/v2.15.0/mapbox-gl.js'></script>
        <link href='https://api.mapbox.com/mapbox-gl-js/v2.15.0/mapbox-gl.css' rel='stylesheet' />
        @yield('scripts')
    </head>

    <body class="c-layout-header-fixed c-layout-header-mobile-fixed">
        <!-- BEGIN: LAYOUT/HEADERS/HEADER-1 -->
        <!-- BEGIN: HEADER -->
        <header class="c-layout-header c-layout-header-4 c-layout-header-default-mobile" data-minimize-offset="80">
            <div class="c-navbar">
                <div class="container">
                    <!-- BEGIN: BRAND -->
                    <div class="c-navbar-wrapper clearfix">
                        <div class="c-brand c-pull-left">
                            <a href="index.html" class="c-logo">
                                <img src="{{asset('img/logo.png')}}" alt="{{config('app.name')}}" class="c-desktop-logo" style="width:100px;">
                                <img src="{{asset('img/logo.png')}}" alt="{{config('app.name')}}" class="c-desktop-logo-inverse">
                                <img src="{{asset('img/logo.png')}}" alt="{{config('app.name')}}" class="c-mobile-logo"> 
                            </a>
                            
                        </div>
                        <!-- END: BRAND -->
                       
                        <!-- BEGIN: HOR NAV -->
                        <!-- BEGIN: LAYOUT/HEADERS/MEGA-MENU -->
                        <!-- BEGIN: MEGA MENU -->
                        <!-- Dropdown menu toggle on mobile: c-toggler class can be applied to the link arrow or link itself depending on toggle mode -->
                        <nav class="c-mega-menu c-pull-right c-mega-menu-dark c-mega-menu-dark-mobile c-fonts-uppercase c-fonts-bold">
                            <ul class="nav navbar-nav c-theme-nav">
                                <li>
                                    <a href="/" class="c-link">Home
                                    </a>
                                </li>
                                <li>
                                    <a href="/" class="c-link">Campus
                                    </a>
                                </li>
                                <li>
                                    <a href="/" class="c-link">Statistics
                                    </a>
                                </li>
                            </ul>
                        </nav>
                        <!-- END: MEGA MENU -->
                        <!-- END: LAYOUT/HEADERS/MEGA-MENU -->
                        <!-- END: HOR NAV -->
                    </div>
                   
                </div>
            </div>
        </header>
        <!-- END: HEADER -->
        <!-- END: LAYOUT/HEADERS/HEADER-1 -->
        <!-- BEGIN: PAGE CONTAINER -->
        <div class="c-layout-page">
            @yield('content_front')

        </div>
        <!-- END: PAGE CONTAINER -->
        <!-- BEGIN: LAYOUT/FOOTERS/FOOTER-6 -->
        <a name="footer"></a>
        <footer class="c-layout-footer c-layout-footer-6 c-bg-grey-1">
            <div class="c-postfooter c-bg-dark-2">
                <div class="container">
                    <div class="row">
                        <div class="col-md-6 col-sm-12 c-col">
                            <p class="c-copyright c-font-grey">2024 &copy; {{config('app.name')}}
                                <span class="c-font-grey-3">All Rights Reserved.</span>
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </footer>
        <!-- END: LAYOUT/FOOTERS/FOOTER-6 -->
        <!-- BEGIN: LAYOUT/FOOTERS/GO2TOP -->
        <div class="c-layout-go2top">
            <i class="icon-arrow-up"></i>
        </div>
        <!-- END: LAYOUT/FOOTERS/GO2TOP -->
        <!-- BEGIN: LAYOUT/BASE/BOTTOM -->
        <!-- BEGIN: CORE PLUGINS -->
        <!--[if lt IE 9]>
	<script src="../../assets/global/plugins/excanvas.min.js"></script> 
	<![endif]-->
        <script src="{{asset('assets/plugins/jquery.min.js') }}" type="text/javascript"></script>
        <script src="{{asset('assets/plugins/jquery-migrate.min.js') }}" type="text/javascript"></script>
        <script src="{{asset('assets/plugins/bootstrap/js/bootstrap.min.js') }}" type="text/javascript"></script>
        <script src="{{asset('assets/plugins/jquery.easing.min.js') }}" type="text/javascript"></script>
        <script src="{{asset('assets/plugins/reveal-animate/wow.js') }}" type="text/javascript"></script>
        <script src="{{asset('assets/demos/index/js/scripts/reveal-animate/reveal-animate.js') }}" type="text/javascript"></script>
        <!-- END: CORE PLUGINS -->
       
        <!-- <script src="{{asset('assets/base/js/app.js') }}" type="text/javascript"></script> -->
        <!-- <script>
            $(document).ready(function()
            {
                App.init(); // init core    
            });
        </script> -->
        <!-- END: THEME SCRIPTS -->
        <!-- BEGIN: PAGE SCRIPTS -->
       
        <script src="https://code.jquery.com/jquery-3.7.1.js"></script>
        <script src="{{ asset('js/scripts.js') }}"></script>
        <script src="{{ asset('js/welcome.js') }}"></script>
        <!-- END: PAGE SCRIPTS -->
        <!-- END: LAYOUT/BASE/BOTTOM -->
    </body>

</html>