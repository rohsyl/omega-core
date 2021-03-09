@php
    $r = \Route::current()->getAction();
    $route = (isset($r['as'])) ? $r['as'] : '';
@endphp

<li class="nav-item mT-30">
    <a class="sidebar-link {{ Str::startsWith($route, 'omega.admin.dashboard') ? 'active' : '' }}" href="{{ route('omega.admin.dashboard') }}">
        <span class="icon-holder">
            <i class="c-blue-500 far fa-home"></i>
        </span>
        <span class="title">Dashboard</span>
    </a>
</li>
<li class="nav-item">
    <a class="sidebar-link {{ Str::startsWith($route, '') ? 'active' : '' }}" href="{{ route('omega.admin.users.index') }}">
        <span class="icon-holder">
            <i class="c-brown-500 far fa-user"></i>
        </span>
        <span class="title">Users</span>
    </a>
</li>
