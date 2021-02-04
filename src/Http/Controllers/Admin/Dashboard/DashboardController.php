<?php

namespace rohsyl\OmegaCore\Http\Controllers\Admin\Dashboard;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

class DashboardController extends Controller
{
    const LIMIT_PAGES = 7;

    public function index(){

        return view('omega::admin.dashboard.index');
    }
}
