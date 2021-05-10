<?php

namespace rohsyl\OmegaCore\Http\Controllers\Admin\Plugin;

use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Artisan;
use rohsyl\OmegaCore\Utils\Common\Facades\Plugin;

class InstallController extends Controller {

    public function __invoke($plugin) {

        $exitCode = Artisan::call('omega:plugin-install', [
            'name' => [$plugin]
        ]);

        return redirect()->route('omega.admin.plugins.index');
    }
}