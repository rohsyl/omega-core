<?php


namespace rohsyl\OmegaCore\Http\Controllers\Admin\Content\Page;


use Illuminate\Routing\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use rohsyl\OmegaCore\Models\Page;

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

    public function store(Request $request) {
        $inputs = $request->all();
        $inputs['slug'] = Str::slug($inputs['title']);
        $inputs['author_id'] = auth()->id();
        Page::create($inputs);

        return redirect()->route('omega.admin.content.pages.index');
    }
}