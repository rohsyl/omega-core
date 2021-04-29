<?php


namespace rohsyl\OmegaCore\Http\Controllers\Admin\Content\Page;


use Illuminate\Routing\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use rohsyl\OmegaCore\Http\Requests\Admin\Content\Page\CreatePageRequest;
use rohsyl\OmegaCore\Http\Requests\Admin\Content\Page\UpdatePageRequest;
use rohsyl\OmegaCore\Models\Page;
use rohsyl\OmegaCore\Utils\Common\Facades\Plugin;
use rohsyl\OmegaCore\Utils\Common\Plugin\Type\Type;

class PageController extends Controller
{

    public function index() {
        $pages = Page::query()
                    ->with(['author'])
                    ->paginate(50);
        return view('omega::admin.content.page.index', compact('pages'));
    }

    public function create() {
        return view('omega::admin.content.page.create');
    }

    public function store(CreatePageRequest $request) {
        $inputs = $request->validated();
        $inputs['slug'] = Str::slug($inputs['title']);
        $inputs['author_id'] = auth()->id();
        Page::create($inputs);

        return redirect()->route('omega.admin.content.pages.index');
    }

    public function edit(Page $page) {
        return view('omega::admin.content.page.edit', compact('page'));
    }

    public function update(UpdatePageRequest $request, Page $page) {

        $action = $request->input('action') ?? 'save';

        if($action == 'save') {
            foreach($page->components as $component) {
                Type::FormSave($component->plugin_form_id, $component->id, $component->page_id);
            }

            $page->update($request->validated());
        }
        if($action == 'publish') {
            $page->published_at = now();
            $page->save();
        }
        if($action == 'unpublish') {
            $page->published_at = null;
            $page->save();
        }

        return redirect()->route('omega.admin.content.pages.edit', $page);
    }

    public function destroy(Page $page) {
        $page->delete();
        return redirect()->route('omega.admin.content.pages.index');
    }
}