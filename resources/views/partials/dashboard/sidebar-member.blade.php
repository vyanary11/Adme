<aside id="sidebar-wrapper">
    <div class="sidebar-brand">
        <a href="">{{ config('app.name') }}</a>
    </div>
    <div class="sidebar-brand sidebar-brand-sm">
        <a href="#">{{ strtoupper(substr(config('app.name'), 0, 2)) }}</a>
    </div>
    <ul class="sidebar-menu">
        <li class="menu-header">Dashboard</li>
        <li class="{{ request()->is('member') ? 'active' : '' }}">
            <a class="nav-link" href="{{ url('/member') }}"><i class="fas fa-columns"></i> <span>Dashboard</span></a>
        </li>

        <li class="menu-header">Layanan</li>
        <li class="{{ request()->is('member/tema-undangan') ? 'active' : '' }}">
            <a class="nav-link" href="{{ route('member.tema-undangan') }}"><i class="fab fa-elementor"></i> <span>Tema Undangan</span></a>
        </li>
        <li class="nav-item dropdown">
            <a href="#" class="nav-link has-dropdown"><i class="fas fa-shopping-basket"></i> <span>Pesanan</span></a>
            @if (request()->is('member/event') || request()->is('member/invoice'))
            <ul class="dropdown-menu" style="display: block;">
            @else
            <ul class="dropdown-menu" style="display: hidden;">
            @endif
                <li @if (request()->is('member/invoice')) class="active" @endif>
                    <a class="nav-link" href="{{ route('member.invoice') }}">Invoice</a>
                </li>
                <li @if (request()->is('member/event')) class="active" @endif>
                    <a class="nav-link" href="{{ route('member.event') }}">Event</a>
                </li>
            </ul>
        </li>
        <li class="menu-header">Pengaturan</li>
        <li class="{{ request()->is('member/profile') ? 'active' : '' }}">
            <a class="nav-link" href="{{ route('member.profile') }}"><i class="fas fa-user-circle"></i> <span>Profile</span></a>
        </li>
        <li>
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <a class="nav-link" href="#" onclick="event.preventDefault();this.closest('form').submit();">
                    <i class="fas fa-sign-out-alt"></i><span>Logout</span>
                </a>
            </form>
        </li>
    </ul>
</aside>
