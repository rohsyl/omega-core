<div class="menu-item"
     data-id="{{ $item->id }}">
    <div class="border bg-light py-2 px-3 d-flex justify-content-between mb-2">
        <div class="font-weight-bold">
            {{ $item->label }}
        </div>
        <div>
            <button class="btn btn-link m-0 p-0"
                    wire:click="showEditMenuItemForm({{ $item->id }})">
                <i class="fas fa-edit"></i>
            </button>
            &nbsp;
            <button class="btn btn-link m-0 p-0 text-danger"
                    wire:click="deleteMenuItem({{ $item->id }})">
                <i class="fas fa-trash"></i>
            </button>
        </div>
    </div>
    <div class="sub-menu-items ml-4 mb-2">

        @foreach($item->children as $subitem)
            @include('omega::livewire.admin.appearance.menu.edit.sub._menu-item', ['item' => $subitem])
        @endforeach
    </div>
</div>