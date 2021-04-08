<?php


namespace rohsyl\OmegaCore\Http\Controllers\Admin\Member\Group;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

class GroupController extends Controller
{

    public function index() {

        return view('omega::admin.member.group.index');
    }
}