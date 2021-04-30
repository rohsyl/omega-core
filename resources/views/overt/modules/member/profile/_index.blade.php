
<div class="text-right">
    <a href="{{ route('overt.module.member.profile.password') }}" class="btn btn-sm btn-outline-dark">
        <i class="fas fa-key"></i> {{ __('Change password') }}
    </a>
</div>

<x-oix-card title="{{ __('Profile') }}" subtitle="{{ __('Informations about you.') }}">
    {{ Form::oattribute(__('Username'), auth('member')->user()->username) }}
    {{ Form::oattribute(__('E-Mail'), auth('member')->user()->email) }}
</x-oix-card>