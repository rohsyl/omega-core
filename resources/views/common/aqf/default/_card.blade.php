<li class="nav-item col text-center">
    <a class="p-lg-2 nav-link mb-4 mb-sm-0
        @if(isset($selected) && $selected == $name) active @endif
        @if(!isset($selected) && $default) active @endif border"
       href="{{ QueryFilterUrl::filter($name) }}" data-category-link="{{ $name }}">
        {!! $slot ?? $label !!}
    </a>
</li>
