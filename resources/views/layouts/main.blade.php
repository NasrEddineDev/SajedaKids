<!DOCTYPE html>

@php $locale = App()->currentLocale(); @endphp

<html lang="{{$locale == 'en' ? 'English' : ($locale == 'ar' ? 'العربية' : 'Français')}}" dir="{{$locale == 'ar' ? 'rtl' : 'ltr'}}">


 <head>

   @include('layouts.partials.head')

   @stack('css')
 </head>

 <body class="{{ Auth::check() && Auth::user()->profile() && Auth::user()->profile()->theme ? Auth::user()->profile()->theme : 'default'}}">

    {{-- @include('layouts.partials.nav')

        <!-- Start Welcome area -->
    <div class="all-content-wrapper {{$locale == 'ar' ? 'all-content-wrapper-rtl' : ''}}">
        @include('layouts.partials.header')
        @yield('content')
        @include('layouts.partials.footer')
    </div>

    @include('layouts.partials.footer-scripts') --}}
        <!-- ============================================================== -->
    <!-- Preloader - style you can find in spinners.css -->
    <!-- ============================================================== -->
    <div class="preloader">
        <div class="lds-ripple">
            <div class="lds-pos"></div>
            <div class="lds-pos"></div>
        </div>
    </div>
    <!-- ============================================================== -->
    <!-- Main wrapper - style you can find in pages.scss -->
    <!-- ============================================================== -->
    <div id="main-wrapper" data-theme="light" data-layout="vertical" data-navbarbg="skin6" data-sidebartype="full" data-sidebar-position="fixed" data-header-position="fixed" data-boxed-layout="full">
        <!-- ============================================================== -->
        <!-- Topbar header - style you can find in pages.scss -->
        <!-- ============================================================== -->
        @include('layouts.partials.header')
        <!-- ============================================================== -->
        <!-- End Topbar header -->
        <!-- ============================================================== -->
        <!-- ============================================================== -->
        <!-- Left Sidebar - style you can find in sidebar.scss  -->
        <!-- ============================================================== -->
        @include('layouts.partials.sidebar')
        <!-- ============================================================== -->
        <!-- End Left Sidebar - style you can find in sidebar.scss  -->
        <!-- ============================================================== -->
        <!-- ============================================================== -->
        <!-- Page wrapper  -->
        <!-- ============================================================== -->
        <div class="page-wrapper">
            <!-- Static Table Start -->
            <!-- ============================================================== -->
            <!-- Bread crumb and right sidebar toggle -->
            <!-- ============================================================== -->
            <div class="page-breadcrumb">
                <div class="row">
                    <div class="col-7 align-self-center">
                        <!-- <h4 class="page-title text-truncate text-dark font-weight-medium mb-1">Basic Initialisation</h4> -->
                        <div class="d-flex align-items-center">
                            <nav aria-label="breadcrumb">
                                <ol class="breadcrumb m-0 p-0">
                                    <li class="breadcrumb-item"><a href="/" class="text-muted">{{ __('Home') }}</a></li>
                                    @if(count(explode('.', \Request::route()->getName())) >= 1)
                                    <li class="breadcrumb-item text-muted active" aria-current="page">{{ __(ucfirst(explode('.', \Request::route()->getName())[0])) }}</li>
                                    @endif
                                    @if(count(explode('.', \Request::route()->getName())) >= 2 && ucfirst(explode('.', \Request::route()->getName())[0]) != "Dashboards")
                                    <li class="breadcrumb-item text-muted active" aria-current="page">{{ __(ucfirst(explode('.', \Request::route()->getName())[1])) }}</li>
                                    @endif
                                </ol>
                            </nav>
                        </div>
                    </div>
                    <!-- <div class="col-5 align-self-center">
                        <div class="customize-input float-right">
                            <select class="custom-select custom-select-set form-control bg-white border-0 custom-shadow custom-radius">
                                <option selected>Aug 19</option>
                                <option value="1">July 19</option>
                                <option value="2">Jun 19</option>
                            </select>
                        </div>
                    </div> -->
                </div>
            </div>
            <!-- ============================================================== -->
            <!-- End Bread crumb and right sidebar toggle -->
            <!-- ============================================================== -->
            @yield('content')
            <!-- ============================================================== -->
            <!-- footer -->
            <!-- ============================================================== -->
            <footer class="footer text-center text-muted">
                {{__("All Rights Reserved by Mesbah Company. Designed and Developed by")}} <a
                    href="https://mesbah.dz">{{__("Mesbah High Tech")}}</a>.
            </footer>
            <!-- ============================================================== -->
            <!-- End footer -->
            <!-- ============================================================== -->

        </div>
        <!-- ============================================================== -->
        <!-- End Page wrapper  -->
        <!-- ============================================================== -->
    </div>

    @include('layouts.partials.footer-scripts')

    @stack('js')
 </body>

</html>
