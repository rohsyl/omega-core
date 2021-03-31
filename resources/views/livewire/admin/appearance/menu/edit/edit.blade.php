<div wire:init="init">
    <div class="card">
        <div class="card-header">
            {{ __('Menu') }}
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-md-6">
                    @if(isset($menuItems))
                        @if($menuItems->count() == 0)
                            <p class="text-muted">
                                No menu item...
                            </p>
                        @endif
                        <div id="menu-items" class="items-container">
                            @foreach($menuItems as $item)
                                @include('omega::livewire.admin.appearance.menu.edit.sub._menu-item', ['item' => $item])
                            @endforeach()
                        </div>

                        <style>
                            .items-container:not(.sorting) .drag-tooltip{
                                display: none;
                            }
                            .items-container.sorting .drag-tooltip{
                                display: block;
                            }
                        </style>
                        <script>
                            var el = document.getElementById('menu-items');
                            var options = {
                                group: 'nested',
                                fallbackOnBody: true,
                                swapThreshold: 0.65,
                                animation: 150,
                                draggable: '.menu-item',
                                // Element dragging started
                                onStart: function (/**Event*/evt) {
                                    el.classList.add("sorting");
                                },

                                // Element dragging ended
                                onEnd: function (/**Event*/evt) {
                                    el.classList.remove("sorting");
                                    orderUpdated();
                                },
                            };
                            var sortable = Sortable.create(el, options);

                            var els = document.getElementsByClassName('sub-menu-items');
                            for(var i = 0; i < els.length; i++) {
                                Sortable.create(els[i], options);
                            }

                            function orderUpdated() {

                                let orders = getOrdersArray();

                                console.log(orders);

                                @this.updateOrders(orders);
                            }

                            function getOrdersArray() {
                                return getOrdersArrayItem($('#menu-items'), 0, 0);
                            }

                            function getOrdersArrayItem(item, parent, level) {
                                level++;
                                let orders = [];
                                let i = 0;
                                item.children('.menu-item').each(function() {
                                    orders.push({
                                        id: $(this).data('id'),
                                        order: i,
                                        parent: parent
                                    })
                                    if(level <= 1) {
                                        let sub = $(this).find('.sub-menu-items');
                                        orders = orders.concat(getOrdersArrayItem(sub, $(this).data('id'), level))
                                    }
                                    i++;
                                });
                                return orders;
                            }
                        </script>
                    @else
                        <i class="fa fa-spinner fa-spin fa-2x"></i>
                    @endif
                </div>
                <div class="col-md-6">
                    @if(isset($editedMenuItem))
                        <div class="border py-2 px-3">
                            <label>{{ __('Label') }}</label>
                            <input type="text"
                                   class="form-control mb-2"
                                   value="{{ $editedMenuItem->label }}"
                                   wire:model.defer="editedMenuItem.label"
                            />

                            <label>{{ __('Link') }}</label>
                            <input type="text"
                                   class="form-control mb-2"
                                   value="{{ $editedMenuItem->link }}"
                                   wire:model.defer="editedMenuItem.link"
                            />

                            <label>{{ __('Class') }}</label>
                            <input type="text"
                                   class="form-control mb-2"
                                   value="{{ $editedMenuItem->class }}"
                                   wire:model.defer="editedMenuItem.class"
                            />
                            <button class="btn btn-primary"
                                    wire:click="updateMenuItem"
                                    wire:target="updateMenuItem"
                                    wire:loading.attr="disabled">
                                <span wire:loading.remove wire:target="updateMenuItem">
                                    {{ __('Update') }}
                                </span>
                                <span wire:loading wire:target="updateMenuItem">
                                    <i class="fas fa-spinner fa-spin"></i>
                                    {{ __('Loading') }}
                                </span>
                            </button>
                            <button class="btn btn-secondary" wire:click="cancelUpdateMenuItem">{{ __('Cancel') }}</button>
                        </div>
                    @endif
                </div>
            </div>

        </div>
    </div>




    <div class="row">
        <div class="col-md-4">

            <div class="card">
                <div class="card-header d-flex justify-content-between">
                    <div>
                        {{ __('Pages') }}
                    </div>
                    <div>
                        <input name="checkAll" id="chkAll" type="checkbox" /> <label for="chkAll" class="mb-0">{{ __('Toggle all') }}</label>
                    </div>
                </div>
                <div class="card-body">
                    <div wire:loading wire:target="init">
                        <i class="fa fa-spinner fa-spin fa-2x"></i>
                    </div>
                    <div wire:loading.remove wire:target="init">
                        <div style="height:150px;overflow:auto;">
                        @foreach($pages as $page)
                            <div>
                                {{ Form::checkbox('created_pages[]', $page->id, false, [
                                    'id' => 'label-page-' . $page->id,
                                    'wire:model.defer' => 'created_pages.'.$page->id
                                ]) }}
                                {{ Form::label('label-page-' . $page->id, $page->title)  }}
                            </div>
                        @endforeach
                        </div>
                        <button class="btn btn-primary btn-block"
                                wire:click="addPageMenuItem"
                                wire:target="addPageMenuItem"
                                wire:loading.attr="disabled"
                                >
                            <span wire:loading.remove wire:target="addPageMenuItem">
                                {{ __('Add element') }}
                            </span>
                            <span wire:loading wire:target="addPageMenuItem">
                                <i class="fas fa-spinner fa-spin"></i>
                                {{ __('Loading') }}
                            </span>
                        </button>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card">
                <div class="card-header">
                    {{ __('External link') }}
                </div>
                <div class="card-body">
                    <div style="height:150px;overflow:auto;">
                        <input type="text" wire:model.defer="label" class="form-control" placeholder="Title" /><br />
                        <input type="text" wire:model.defer="link" class="form-control" placeholder="http://" />
                    </div>
                    <button class="btn btn-primary btn-block"
                            wire:click="addLink"
                            wire:target="addLink"
                            wire:loading.attr="disabled">
                            <span wire:loading.remove wire:target="addLink">
                                {{ __('Add element') }}
                            </span>
                        <span wire:loading wire:target="addLink">
                                <i class="fas fa-spinner fa-spin"></i>
                                {{ __('Loading') }}
                            </span>
                    </button>
                </div>
            </div>
        </div>
        <div class="col-md-4">

        </div>
    </div>
</div>