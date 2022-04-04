<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{$title ?? null}} - {{config('app.name')}}</title>

    <link rel="stylesheet" href="{{asset('assets/vendor/stacktable/stacktable.css')}}">

    <link href="{{asset('assets/vendor/select2/select2.min.css') }}" type="text/css" rel="stylesheet"/>
    <link href="{{asset('assets/vendor/select2/select2-bootstrap.min.css?v=' . rand(1,11111111111111)) }}" type="text/css" rel="stylesheet"/>

    <link href="{{asset('assets/vendor/flatpickr/css/flatpickr.min.css') }}" type="text/css" rel="stylesheet"/>
    <!-- Custom fonts for this template-->
    <link href="{{asset('assets/vendor/fontawesome-free/css/all.min.css')}}" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i&display=swap"
        rel="stylesheet">
    <link href="{{asset('assets/vendor/css/back.min.css')}}" rel="stylesheet">
    <link href="{{asset('assets/vendor/toastr/toastr.min.css')}}" rel="stylesheet" ></link>
    <link href="{{asset('assets/vendor/flatpickr/flatpickr.min.css')}}" rel="stylesheet" ></link>
    <link href="{{asset('assets/vendor/fancybox/fancybox.min.css')}}" rel="stylesheet" ></link>
    <!-- Custom styles for this template-->
    <link href="{{asset('assets/css/customstyle.css?v=' . rand(1,11111111111111))}}" rel="stylesheet">

    <meta name="robots" content="noindex, nofollow" />

    {{--    <style>
            .ck-editor__editable_inline {
                min-height: 400px;
            }
        </style>--}}
    <style>
        .a.active.dropdown-toggle.nav-link {
            color: white;
            font-weight: 700;
        }
        .sidebar-dark .nav-item.active .nav-link i{
            color: white;
            font-weight: 700;
        }
        .nav-link .dropdown-toggle .active{
            color: white;
            font-weight: 700;
        }
    </style>
    @yield('styles')
</head>
