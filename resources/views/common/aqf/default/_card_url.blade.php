<li class="nav-item col text-center">
    <a class="p-lg-2 bg-warnin nav-link @if(request()->fullUrl() == $url) active @endif border"
       href="{{ $url }}" data-category-link="all">
        {{ $label }} <br>
    </a>
</li>
