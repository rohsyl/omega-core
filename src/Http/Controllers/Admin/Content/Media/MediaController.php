<?php


namespace rohsyl\OmegaCore\Http\Controllers\Admin\Content\Media;

use Illuminate\Routing\Controller;
use Illuminate\Http\Request;

class MediaController extends Controller
{
    public function index() {
        return view('omega::admin.content.media.index');
    }
}