@php
/** @var array $permissions */
$groups = aclx_group($permissions);
$level = 0;
@endphp

<ul class="list-group p-0 mt-2 mb-2">
@foreach($groups as $permissionName => $subPermissions)
        @include('omega::admin.components.acl.item', compact('name', 'permissionName', 'subPermissions', 'user', 'level', 'attributes'))
@endforeach
</ul>
