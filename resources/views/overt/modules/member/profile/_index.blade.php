<x-oix-card title="{{ __('Profile') }}" subtitle="{{ __('Informations about you') }}">
    {{ Form::oattribute(__('Username'), auth('member')->user()->username) }}
    {{ Form::oattribute(__('E-Mail'), auth('member')->user()->email) }}
</x-oix-card>