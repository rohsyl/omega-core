@php
$r = \Route::current()->getAction();
$route = (isset($r['as'])) ? $r['as'] : '';

$menuItems = [
    [
        'name' => 'dashboard',
        'icon' => 'fas fa-home',
        'label' => __('Dashboard'),
        'route' => route('omega.admin.dashboard'),
    ],
    [
        'name' => 'pages-index',
        'icon' => 'fas fa-file-alt',
        'label' => __('Pages'),
        'route' => route('omega.admin.content.pages.index'),
        'check' => auth()->user()->can('content.page'),
    ],
    [
        'name' => 'media-library',
        'icon' => 'fas fa-images',
        'label' => __('Media library'),
        'route' => route('omega.admin.content.media.index'),
        'check' => auth()->user()->can('content.medialibrary'),
    ],
    [
        'name' => 'menus-index',
        'icon' => 'fas fa-bars',
        'label' => __('Menus'),
        'route' => route('omega.admin.appearance.menus.index'),
        'check' => auth()->user()->can('appearance.menu'),
    ],
    [
        'name' => 'users-groups-index',
        'icon' => 'fas fa-users',
        'label' => __('Users & Groups'),
        'route' => route('omega.admin.users.index'),
        'check' => auth()->user()->canAny(['usermanagement', 'members']),
    ],
    [
        'name' => 'members-index',
        'icon' => 'fas fa-address-book',
        'label' => __('Members'),
        'route' => route('omega.admin.member.members.index'),
        'check' => auth()->user()->can('members'),
    ],
    [
        'name' => 'plugins-index',
        'icon' => 'fas fa-cubes',
        'label' => __('Plugins'),
        'route' => route('omega.admin.plugins.index'),
        'check' => auth()->user()->can('plugins'),
    ],
];
@endphp

{{ \rohsyl\OmegaCore\Utils\Common\Facades\Hook::callActions('admin_menu_item', [null, 'before'], true) }}

@foreach($menuItems as $menuItem)

    {{ \rohsyl\OmegaCore\Utils\Common\Facades\Hook::callActions('admin_menu_item', [$menuItem, 'before'], true) }}

    @include('omega::admin.partials.menu-item', $menuItem)

    {{ \rohsyl\OmegaCore\Utils\Common\Facades\Hook::callActions('admin_menu_item', [$menuItem, 'after'], true) }}

@endforeach

{{ \rohsyl\OmegaCore\Utils\Common\Facades\Hook::callActions('admin_menu_item', [null, 'after'], true) }}