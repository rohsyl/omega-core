<?php

namespace rohsyl\OmegaCore\Http\Controllers\Admin\Users;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

class UsersController extends Controller
{

    public function index(){

        return view('omega::admin.users.index');
    }
}
