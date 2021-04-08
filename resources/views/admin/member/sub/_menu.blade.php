<div class="row">
    <div class="col">
        <a href="{{ route('omega.admin.member.members.index') }}" class="{{ isset($active) && $active == 'members' ? 'text-muted' : '' }}">
            <div class="card">
                <div class="card-body">
                    <div class="text-center">
                        <i class="fas fa-user"></i>
                        {{ __('Members') }}
                    </div>
                </div>
            </div>
        </a>
    </div>
    <div class="col">
        <a href="{{ route('omega.admin.member.groups.index') }}" class="{{ isset($active) && $active == 'groups' ? 'text-muted' : '' }}">
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
