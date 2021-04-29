<li class="list-group-item @if(isset($attributes['dark']) && $attributes['dark']) bg-primary-darker @endif px-0 py-0 border-0"  data-level="{{ $level }}">
    {{--@if(sizeof($subPermissions) > 0)
        <a data-toggle="collapse" href="#collapse-{{ $permissionName }}" class="float-left mx-1 my-1"><i class="fas fa-chevron-down"></i></a>
    @endif--}}
    <span style="padding-left: {{ 20 * ($level + 1) }}px" class="my-1 pb-1 d-block @if(isset($attributes['dark']) && $attributes['dark']) border-bottom-secondary @else border-bottom @endif">
        {{ Form::hidden($name.'['.$permissionName.']', ACL_NONE) }}
        {{ Form::checkbox($name.'['.$permissionName.']', ACL_READ, acl_permission_level($user, $permissionName, isset($attributes['acls']) ? $attributes['acls'] : null) == ACL_READ, ['id' => $permissionName, 'disabled' => isset($attributes['readonly']) && $attributes['readonly']]) }}
        {{ Form::label($permissionName, __('label.acl_.'.str_replace('.', '_', $permissionName)), ['class' => 'm-0']) }}
    </span>
    <script>
        $('input[name="{{ $name.'['.$permissionName.']' }}"]').change(function (e) {
            $(this)
                .parent()
                .parent()
                .find('.list-group')
                .children()
                .find('input[type="checkbox"]')
                .prop('checked', $(this).prop('checked'));
        });
    </script>

    @if(sizeof($subPermissions) > 0)
        @php
            /** @var TYPE_NAME $level */
            $level++;
        @endphp
        <ul class="list-group my-0 px-0 border-0 {{--collapse @if($level <= 1) show @endif--}}"
            id="collapse-{{ $permissionName }}">
        @foreach($subPermissions as $subPermissionName => $subSubPermissions)
            @include('omega::admin.components.acl.item', ['name' => $name, 'permissionName' => $permissionName.'.'.$subPermissionName, 'subPermissions' => $subSubPermissions, 'user' => $user, 'level' => $level])
        @endforeach
        </ul>
    @endif
</li>

