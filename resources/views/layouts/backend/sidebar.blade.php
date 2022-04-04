@push('styles')
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
@endpush
<!-- Sidebar -->
<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

    <!-- Sidebar - Brand -->
    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="#">
        <div class="sidebar-brand-icon">
            <i class="fas fa-store"></i>
        </div>
        <div class="sidebar-brand-text mx-3">{{config('app.name')}}</div>
    </a>

    <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
    </div>

    <!-- Divider -->
    <hr class="sidebar-divider my-0">

    <!-- Nav Item - Dashboard -->
    <li class="nav-item @if(isset($navLink)) @if($navLink == 'dashboards') active @endif @endif">
        <a class="nav-link" href="{{route('backend.dashboards.index')}}">
            <i class="fas fa-fw fa-tachometer-alt"></i>
            <span>Dashboard</span></a>
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider">

    <!-- Heading -->
    <div class="sidebar-heading">
        Main
    </div>

    @include('layouts.backend.partials.users-submenu')

    @if(\App\Library\AppConfig::permission()->canReadPagePost())
        <li class="nav-item @if(isset($navLink)) @if($navLink == 'page-posts') active @endif @endif">
            <a class="nav-link" href="{{route('backend.page-posts.index')}}" title="View Page Post">
                <i class="fas fa-fw fa-file"></i>
                <span>Page Post</span></a>
        </li>
    @endif

    <!-- Divider -->
    <hr class="sidebar-divider">

    <li class="nav-item">
        <a class="nav-link" href="#">
            <i class="fas fa-fw fa-home"></i>
            <span>Frontend</span></a>
    </li>
    <hr class="sidebar-divider">

    <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
    </div>
</ul>
<!-- End of Sidebar -->
