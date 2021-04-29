<div class="row">
    <div class="col">
        <a href="{{ route('omega.admin.users.index') }}" class="{{ isset($active) && $active == 'users' ? 'text-muted' : '' }}">
            <div class="card">
                <div class="card-body">
                    <div class="text-center">
                        <i class="fas fa-user"></i>
                        {{ __('Users') }}
                    </div>
                </div>
            </div>
        </a>
    </div>
    <div class="col">
        <a href="{{ route('omega.admin.groups.index') }}" class="{{ isset($active) && $active == 'groups' ? 'text-muted' : '' }}">
            <div class="card">
                <div class="card-body">
                    <div class="text-center">
                        <i class="fas fa-users"></i>
                        {{ __('Groups') }}
                    </div>
                </div>
            </div>
        </a>
    </div>
</div>
