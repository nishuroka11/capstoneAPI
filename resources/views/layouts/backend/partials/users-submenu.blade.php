@if(\App\Library\AppConfig::permission()->canReadUser())
    <li class="nav-item ">
        <a class="nav-link dropdown-toggle" href="#user-submenu" data-toggle="collapse" aria-expanded="false">
            <i class="fas fa-fw fa-user"></i> User </a>
        <ul class="collapse list-unstyled @if(isset($navLink) && in_array($navLink, ['users', 'permissions', 'roles']))  show @endif" id="user-submenu">
            <li class="nav-item @if(isset($navLink) && $navLink == 'users') active @endif">
                <a class="nav-link" href="{{route('backend.users.index')}}" title="View User">
                    <i class="fas fa-fw fa-user"></i>
                    <span>User</span></a>
            </li>
            @if(\App\Library\AppConfig::permission()->canReadPermission())
                <li class="nav-item @if(isset($navLink)) @if($navLink == 'permissions') active @endif @endif">
                    <a class="nav-link" href="{{route('backend.permissions.index')}}" title="View Permission">
                        <i class="fas fa-fw fa-key"></i>
                        <span>Permission</span></a>
                </li>
            @endif
            @if(\App\Library\AppConfig::permission()->canReadRole())
                <li class="nav-item @if(isset($navLink)) @if($navLink == 'roles') active @endif @endif">
                    <a class="nav-link" href="{{route('backend.roles.index')}}" title="View Role">
                        <i class="fas fa-fw fa-user-shield"></i>
                        <span>Role</span></a>
                </li>
            @endif
        </ul>
    </li>
@endif
