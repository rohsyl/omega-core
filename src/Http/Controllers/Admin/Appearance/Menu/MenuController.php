<?php
namespace rohsyl\OmegaCore\Http\Controllers\Admin\Appearance\Menu;

use Illuminate\Routing\Controller;
use Illuminate\Http\Request;
use rohsyl\OmegaCore\Models\MemberGroup;
use rohsyl\OmegaCore\Models\Menu;

class MenuController extends Controller
{

    public function index() {
        $menus = Menu::query()
            ->paginate(10);

        return view('omega::admin.apparence.menu.index', compact('menus'));
    }

    public function create() {
        return view('omega::admin.apparence.menu.create');
    }

    public function store(Request $request) {
        $menu = Menu::create($request->all());

        return redirect()->route('omega.admin.appearance.menus.edit', $menu);
    }

    public function edit(Menu $menu) {
        $member_groups = MemberGroup::query()->get();
        return view('omega::admin.apparence.menu.edit', compact('menu', 'member_groups'));
    }

    public function update(Request $request, Menu $menu) {
        $menu->update($request->all());

        return redirect()->route('omega.admin.appearance.menus.edit', $menu);
    }

    public function destroy(Menu $menu) {

    }
}