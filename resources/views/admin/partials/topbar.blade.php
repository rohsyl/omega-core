<div class="header navbar">
    <div class="header-container">
        <ul class="nav-left">

            <li>
                <a id='sidebar-toggle' class="sidebar-toggle" href="javascript:void(0);">
                <i class="fas fa-bars"></i>
                </a>
            </li>


        </ul>
        <ul class="nav-right">
            <li class="nav-item dropdown">
                <a id="dropdown-user-menu" class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">

                    {{ Auth::user()->fullname }}
                </a>

                <ul class="dropdown-menu" aria-labelledby="dropdown-user-menu">
                    <li>
                        <a class="dropdown-item" href="{{ route('logout') }}"
                       onclick="event.preventDefault();
                                             document.getElementById('logout-form').submit();">
                        {{ __('Logout') }}
                        </a>
                    </li>

                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                        @csrf
                    </form>
                </ul>
            </li>
            <li>
                <a class="dropdown-item" href="{{ route('logout') }}"
                   onclick="event.preventDefault();
                                             document.getElementById('logout-form').submit();">
                    {{ __('Logout') }}
                </a>
            </li>

            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                @csrf
            </form>
        </ul>
    </div>
</div>
