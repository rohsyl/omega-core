@if(!isset($inline) || !$inline)
    <div class="mb-4">
        <x-aqf-submit />
        <x-aqf-clear />
    </div>
@else
    <x-aqf-submit />
    <x-aqf-clear />
@endif