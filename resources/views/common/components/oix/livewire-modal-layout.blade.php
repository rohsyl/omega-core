<div class="modal-dialog {{ $size ?? '' }}">
    <div class="modal-content">
        <div class="modal-header" style="border-bottom: 1px solid #e6ecec;">
            <h5 class="modal-title h2">
                {{ $title ?? 'Modal' }}
            </h5>
            <button wire:click="$emit('closeModal')" type="button" class="close" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <div class="modal-body">

            {{ $slot }}

        </div>
        <div class="modal-footer">
            {{ $actions ?? '' }}
        </div>
    </div>
</div>
