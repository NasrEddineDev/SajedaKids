{{-- <meta charset="utf-8">
<meta http-equiv="x-ua-compatible" content="ie=edge">
<title>{{ __(config('app.name')) }}</title>
<meta name="description" content="">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="shortcut icon" type="image/x-icon" href="{{ URL::asset('') }}img/logo/caci-logo.ico" /> --}}



<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<!-- Tell the browser to be responsive to screen width -->
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta name="description" content="">
<meta name="author" content="">
<!-- Favicon icon -->
<link rel="icon" type="image/png" sizes="16x16" href="{{ URL::asset('img/logo.jpg') }}">
<title>{{ __("Sajeda Kids")}}</title>
<!-- This page plugin CSS -->
<link rel="stylesheet" href="{{ URL::asset('assets/extra-libs/datatables.net-bs4/css/dataTables.bootstrap4.css') }}" />
<link rel="stylesheet" href="https://cdn.datatables.net/1.13.4/css/jquery.dataTables.min.css" />
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
<!-- Custom CSS -->
<link rel="stylesheet" href="{{ URL::asset('dist/css/style.min.css') }}" />
<link rel="stylesheet" href="{{ URL::asset('dist/css/custom.css') }}" />
@if (App::currentLocale() == 'ar')
<link rel="stylesheet" href="{{ URL::asset('dist/css/custom_ar.css') }}" />
@endif
<!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
<!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->

<meta name="csrf-token" content="{{ csrf_token() }}">
<style>

</style>
@if (App::currentLocale() == 'ar')
    <style>
        @media (min-width: 768px) {
            #main-wrapper[data-layout="vertical"][data-sidebartype="full"] .page-wrapper {
                margin-left: 0px;
                margin-right: 260px;
            }

            #main-wrapper[data-layout="vertical"][data-sidebar-position="fixed"][data-sidebartype="full"] .topbar .top-navbar .navbar-collapse {
                margin-left: 0px;
                margin-right: 260px;
            }
        }
    </style>
@endif
