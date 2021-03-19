<?php


namespace rohsyl\OmegaCore\Http\Controllers\Admin\Plugin;


use Illuminate\Routing\Controller;
use rohsyl\OmegaCore\Utils\Common\Facades\Plugin;

class PluginController extends Controller
{
    public function index() {
        $plugins = Plugin::all();

        return view('omega::admin.plugin.index', compact('plugins'));
    }
}