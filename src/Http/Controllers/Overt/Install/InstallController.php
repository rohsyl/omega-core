<?php


namespace rohsyl\OmegaCore\Http\Controllers\Overt\Install;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Schema;
use rohsyl\OmegaCore\Models\Group;
use rohsyl\OmegaCore\Models\User;

class InstallController extends Controller
{
    public function __construct(){
        ini_set('max_execution_time', 300);
    }

    public function index(){
        $data = [
            'lang' => session()->has('install.lang') ? session('install.lang') : 'en',
        ];
        return view('omega::overt.install.index', $data);
    }

    public function step1(Request $request){
        // get form date and save to session
        session(['install.lang' => $request->input('lang')]);

        return redirect(route('omega.install.siteanduser'));
    }

    public function siteanduser(){

        $data = [
            'title' => session()->has('install.title') ? session('install.title') : '',
            'slogan' => session()->has('install.slogan') ? session('install.slogan') : '',
            'email' => session()->has('install.email') ? session('install.email') : '',
        ];

        return view('omega::overt.install.siteanduser', $data);
    }

    public function step2(Request $request){
        // get form date and save to session
        session(['install.title' => $request->input('title')]);
        session(['install.slogan' => $request->input('slogan')]);
        session(['install.email' => $request->input('email')]);
        session(['install.password' => Hash::make($request->input('password'))]);

        return redirect(route('omega.install.launch'));
    }

    public function launch(){

        $data = [
            'lang' => session('install.lang'),
            'title' => session('install.title'),
            'slogan' => session('install.slogan'),
            'email' => session('install.email'),
        ];

        return view('omega::overt.install.launch', $data);
    }

    public function do(){

        try {
            DB::connection()->getPdo();

        } catch (\Exception $e) {
            die("Could not connect to the database.  Please check your configuration.");

            //return an error
        }

        // create migrations table if not exists
        if(!Schema::hasTable('migrations')){
            Artisan::call('migrate:install');
        }


        // create migrations table if not exists
        /*if(!Schema::hasTable('migrations_plugins')){
            Artisan::call('omega:plugin:migrate:install');
        }*/

        // create omega tables and fill with data
        Artisan::call('migrate');
        Artisan::call('db:seed');

        // set configs in database
        om_config(['om_site_title' => session('install.title')]);
        om_config(['om_site_slogan' => session('install.slogan')]);
        om_config(['om_web_adress' => url('/')]);
        om_config(['om_lang' => session('install.lang')]);
        om_config(['om_theme_name' => 'clean_blog']);

        // create the admin user
        $admin = new User();
        $admin->email = session('install.email');
        $admin->password = session('install.password');
        $admin->fullname = 'Administrator';
        $admin->save();

        // put the admin user in the admin group
        $group = Group::where('name', 'administrator')->first();
        $group->users()->attach($admin);

        Artisan::call('omega-plugins-bundle:install');

        return redirect(route('omega.admin.dashboard'));
    }

}