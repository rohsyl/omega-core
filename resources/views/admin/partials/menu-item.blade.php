@if(!isset($check) || $check)
<li class="nav-item">
    <a class="sidebar-link {{ request()->is('*/admin/plugins*') ? 'active' : '' }}" href="{{ $route }}" data-menu-item-name="{{ $name ?? 'noname' }}">
        <span class="icon-holder">
            <i class="c-brown-500 {{ $icon }} color-gray-dark"></i>
        </span>
        <span class="title">{{ $label }}</span>
    </a>
</li>
@endif