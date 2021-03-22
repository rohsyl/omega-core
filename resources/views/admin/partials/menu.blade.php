@php
    $r = \Route::current()->getAction();
    $route = (isset($r['as'])) ? $r['as'] : '';
@endphp

<li class="nav-item mT-30">
    <a class="sidebar-link {{ request()->is('*/admin/dashboard*') ? 'active' : '' }}" href="{{ route('omega.admin.dashboard') }}">
        <span class="icon-holder">
            <i class="c-blue-500 fas fa-home color-gray-dark"></i>
        </span>
        <span class="title">{{ __('Dashboard')}}</span>
    </a>
</li>
<li class="nav-item">
    <a class="sidebar-link {{ request()->is('*/admin/content/pages*') ? 'active' : '' }}" href="{{ route('omega.admin.content.pages.index') }}">
        <span class="icon-holder">
            <i class="c-blue-500 fas fa-file-alt color-gray-dark"></i>
        </span>
        <span class="title">{{ __('Pages')}}</span>
    </a>
</li>
<li class="nav-item">
    <a class="sidebar-link {{ request()->is('*/admin/apparence/menus*') ? 'active' : '' }}" href="{{ route('omega.admin.appearance.menus.index') }}">
        <span class="icon-holder">
            <i class="c-blue-500 fas fa-bars color-gray-dark"></i>
        </span>
        <span class="title">{{ __('Menus')}}</span>
    </a>
</li>
<li class="nav-item">
    <a class="sidebar-link {{ request()->is(['*/admin/users*', '*/admin/groups*']) ? 'active' : '' }}" href="{{ route('omega.admin.users.index') }}">
        <span class="icon-holder">
            <i class="c-brown-500 fas fa-user color-gray-dark"></i>
        </span>
        <span class="title">{{ __('Users & Groups') }}</span>
    </a>
</li>
<li class="nav-item">
    <a class="sidebar-link {{ request()->is('*/admin/plugins*') ? 'active' : '' }}" href="{{ route('omega.admin.plugins.index') }}">
        <span class="icon-holder">
            <i class="c-brown-500 fas fa-cubes color-gray-dark"></i>
        </span>
        <span class="title">{{ __('Plugins') }}</span>
    </a>
</li>