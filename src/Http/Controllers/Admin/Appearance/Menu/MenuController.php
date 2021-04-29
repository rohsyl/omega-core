<?php
namespace rohsyl\OmegaCore\Http\Controllers\Admin\Appearance\Menu;

use Illuminate\Routing\Controller;
use Illuminate\Http\Request;
use rohsyl\OmegaCore\Http\Requests\Admin\Appearance\Menu\CreateMenuRequest;
use rohsyl\OmegaCore\Http\Requests\Admin\Appearance\Menu\UpdateMenuRequest;
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

    public function store(CreateMenuRequest $request) {
        $inputs = $request->validated();
        $inputs['is_enabled'] = true;
        $inputs['is_main'] = Menu::query()->count() == 0 ? true : false;
        $menu = Menu::create($inputs);

        return redirect()->route('omega.admin.appearance.menus.edit', $menu);
    }

    public function edit(Menu $menu) {
        $member_groups = [null => __('No membergroup')] + MemberGroup::query()->get()->pluck('name', 'id')->toArray();
        return view('omega::admin.apparence.menu.edit', compact('menu', 'member_groups'));
    }

    public function update(UpdateMenuRequest $request, Menu $menu) {
        $menu->update($request->validated());

        return redirect()->route('omega.admin.appearance.menus.edit', $menu);
    }

    public function destroy(Menu $menu) {
        $menu->delete();
        return redirect()->route('omega.admin.appearance.menus.index');
    }
}