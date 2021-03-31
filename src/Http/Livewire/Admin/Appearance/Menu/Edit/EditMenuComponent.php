<?php


namespace rohsyl\OmegaCore\Http\Livewire\Admin\Appearance\Menu\Edit;

use Livewire\Component as LivewireComponent;
use rohsyl\OmegaCore\Models\Menu;
use rohsyl\OmegaCore\Models\MenuItem;
use rohsyl\OmegaCore\Models\Page;

class EditMenuComponent extends LivewireComponent
{
    public $readyToLoad = false;
    public Menu $menu;
    public $menuItems;

    public $created_pages = [];
    public $label;
    public $link;


    public $editedMenuItem = null;


    protected $rules = [
        'editedMenuItem.label' => 'required|string',
        'editedMenuItem.link' => 'required|string',
        'editedMenuItem.class' => 'required|string',
    ];

    public function render() {
        $pages = $this->readyToLoad ? Page::all() : collect();
        if($this->readyToLoad) {
            $this->loadMenuItems();
        }
        return view('omega::livewire.admin.appearance.menu.edit.edit', compact('pages'));
    }

    public function init() {
        $this->readyToLoad = true;
    }

    public function loadMenuItems() {
        $this->menuItems = MenuItem::query()
            ->with(['children'])
            ->where('menu_id', $this->menu->id)
            ->where('parent_id', 0)
            ->orderBy('sort', 'ASC')
            ->get();
    }

    public function addPageMenuItem() {

        foreach(array_filter($this->created_pages) as $page_id) {
            $page = Page::find($page_id);
            MenuItem::create([
                'parent_id' => 0,
                'menu_id' => $this->menu->id,
                'label' => $page->title,
                'link' => '/'.$page->slug,
                'sort' => 0,
                'class' => null,
                'depth' => 0,
            ]);
        }
        $this->created_pages = [];
        $this->loadMenuItems();
    }

    public function addLink() {
        $validatedData = $this->validate([
            'label' => 'required|string',
            'link' => 'required|string',
        ]);
        MenuItem::create([
            'parent_id' => 0,
            'menu_id' => $this->menu->id,
            'label' => $validatedData['label'],
            'link' => $validatedData['link'],
            'sort' => 0,
            'class' => null,
            'depth' => 0,
        ]);
        $this->label = null;
        $this->link = null;
        $this->loadMenuItems();
    }

    public function showEditMenuItemForm($menu_item_id) {
        $this->editedMenuItem = MenuItem::find($menu_item_id);
    }

    public function updateMenuItem() {
        $this->editedMenuItem->save();
        $this->cancelUpdateMenuItem();
    }

    public function cancelUpdateMenuItem() {
        $this->editedMenuItem = null;
    }

    public function deleteMenuItem($menu_item_id) {
        MenuItem::destroy($menu_item_id);
        $this->loadMenuItems();
    }

    public function updateOrders($orders) {

        foreach($orders as $order) {
            $item = MenuItem::find($order['id']);
            $item->update([
                'parent_id' => $order['parent'],
                'sort' => $order['order'],
            ]);
        }
    }
}