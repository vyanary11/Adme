@php
use App\Models\AdminSectionMenu;
use App\Models\MenuRoute;
$user=auth()->user();
$permissions = $user->getAllPermissions();
$permission_id = array();
foreach ($permissions as $permission) {
    array_push($permission_id, $permission->id);
}
@endphp
    <aside id="sidebar-wrapper" class="pb-5">
        <div class="sidebar-brand">
            <a href="{{ route('dashboard') }}">Dashboard</a>
        </div>
        <div class="sidebar-brand sidebar-brand-sm">
            <a href="{{ route('dashboard') }}">
                <img class="d-inline-block" width="32px" height="30.61px" src="" alt="">
            </a>
        </div>
        <ul class="sidebar-menu">
            <li class="menu-header">Role - {{ $user->getRoleNames()[0] }}</li>
            <li class="{{ Request::routeIs('dashboard') ? 'active' : '' }}">
                <a class="nav-link" href="{{ route('dashboard') }}"><i class="fas fa-fire"></i><span>{{ __('Dashboard') }}</span></a>
            </li>

            @foreach (AdminSectionMenu::get_admin_menus($permission_id) as $admin_section_menu)
                <li class="menu-header">{{$admin_section_menu->name}}</li>
                @foreach ($admin_section_menu->admin_menus as $admin_menu)
                    @if ($admin_menu->href!=null)
                        <li class="{{ Request::segment(2) == $admin_menu->href ? 'active' : '' }}">
                            <a class="nav-link" href="{{ route($admin_menu->href) }}"><i class="{{ $admin_menu->icon }}"></i><span>{{ $admin_menu->name }}</span></a>
                        </li>
                    @else
                        {{-- <li class="dropdown {{ ($is_active) ? 'active' : '' }}">
                            <a href="#" class="nav-link has-dropdown" data-toggle="dropdown"><i class="{{ $links->icon }}"></i> <span>{{ $links->text }}</span></a>
                            <ul class="dropdown-menu">
                                @foreach ($section->section_list as $child)
                                    <li class="{{ Request::routeIs($child->href) ? 'active' : '' }}"><a class="nav-link" href="{{ route($child->href) }}">{{ $child->text }}</a></li>
                                @endforeach
                            </ul>
                        </li> --}}
                    @endif
                @endforeach

            @endforeach
        </ul>
    </aside>
