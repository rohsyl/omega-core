<div class="card">
    <div class="card-body p-15">
        <div class="form-group mb-0">
            <label for="plain">{{ $label ?? __('Search') }}</label>
            <input type="text" class="form-control" name="plain" value="{{ $value() }}" />
        </div>
    </div>
</div>