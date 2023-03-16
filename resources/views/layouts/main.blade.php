<!DOCTYPE html>

@php $locale = App()->currentLocale(); @endphp

<html lang="{{$locale == 'en' ? 'English' : ($locale == 'ar' ? 'العربية' : 'Français')}}" dir="{{$locale == 'ar' ? 'rtl' : 'ltr'}}">


 <head>

   @include('layouts.partials.head')

   @stack('css')
 </head>

 <body class="{{ Auth::check() && Auth::user()->profile && Auth::user()->profile->theme ? Auth::user()->profile->theme : 'default'}}">

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
            @yield('content')

        </div>
        <!-- ============================================================== -->
        <!-- End Page wrapper  -->
        <!-- ============================================================== -->
    </div>

    @include('layouts.partials.footer-scripts')

    @stack('js')
 </body>

</html>
