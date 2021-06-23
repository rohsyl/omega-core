
{{ Form::open(['route' => ['overt.module.member.profile.avatar.update'], 'method' => 'PUT', 'enctype' => 'multipart/form-data']) }}
    <x-oix-card title="{{ __('Avatar') }}" subtitle="{{ __('Change the profile picture of the member') }}">

        <div class="form-group">
            {{ Form::label('avatar', __('Avatar')) }}
            <div class="input-group">
                <input type="file" name="avatar" class="{{ $errors->has('avatar') ? 'is-invalid' : '' }}" >
            </div>
            @if($errors->has('avatar'))
                <div class="small text-danger">
                    {{ $errors->first('avatar') }}
                </div>
            @endif
        </div>


        {{ Form::oback(null, ['class' => 'btn btn-secondary']) }}
        {{ Form::submit( __('Update avatar'), ['class' => 'btn btn-dark']) }}

    </x-oix-card>
{{ Form::close() }}