<?php


namespace rohsyl\OmegaCore\Utils\Common\Plugin\Commands;


use Illuminate\Console\Command;
use rohsyl\OmegaCore\Utils\Common\Facades\Plugin;

class PluginInstallCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'omega:plugin-install 
                                {name*} 
                                {--U|uninstall   : Uninstall the given plugin(s)} 
                                {--R|reinstall   : Reinstall the given plugin(s)} 
                                {--a|update-form : Update given plugins form}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Install one or more plugin(s).';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $names = $this->argument('name');

        // Uninstall the gives plugins
        if($this->hasOption('uninstall') && $this->option('uninstall')) {
            if (!$this->confirm('Do you wish to continue?')) {
                return -1;
            }
            $this->info('Uninstalling plugins ('.sizeof($names).')');
            foreach($names as $name) {
                $this->deletePlugin($name);
            }
            $this->info('[ DONE ]');
            return 0;
        }

        // Uninstall and re-install the gives plugins
        if($this->hasOption('reinstall') && $this->option('reinstall')) {
            if (!$this->confirm('Do you wish to continue?')) {
                return -1;
            }
            $this->info('Re-installing plugins ('.sizeof($names).')');
            foreach($names as $name) {
                $this->deletePlugin($name);
                $this->installPlugin($name);
            }
            $this->info('[ DONE ]');
            return 0;
        }

        // Updating given plugins form
        if($this->hasOption('update-form') && $this->option('update-form')) {
            $this->info('Updating plugin forms ('.sizeof($names).')');
            foreach($names as $name) {
                $this->updatePluginForm($name);
            }
            $this->info('[ DONE ]');
            return 0;
        }

        $this->info('Installing plugins ('.sizeof($names).')');
        foreach($names as $name) {
            $this->installPlugin($name);
        }
        $this->info('[ DONE ]');


        return 0;
    }

    private function deletePlugin($name) {
        $this->line(' ');
        $plugin = Plugin::getPlugin($name);
        if(!isset($plugin)) {
            $this->warn('Plugin ' . $name . ' not found. Have you installed it with composer ?');
            return;
        }
        $model = Plugin::getModel($name, true);
        if(!isset($model)) {
            $this->warn('Plugin ' . $name . ' not installed !');
            return;
        }

        $this->info('Uninstalling : ' . $name);

        $model->delete();

        $result = $plugin->uninstall();
        if(!$result) {
            $this->warn('[ FAILED ]');
            return;
        }
        $this->info('[ SUCCESS ]');
    }

    private function installPlugin($name) {
        $this->line(' ');
        $plugin = Plugin::getPlugin($name);
        if(!isset($plugin)) {
            $this->warn('Plugin ' . $name . ' not found. Have you installed it with composer ?');
            return;
        }

        $model = Plugin::getModel($name, true);
        if(isset($model)) {
            $this->warn('Plugin ' . $name . ' already installed !');
            return;
        }

        $this->info('Installing : ' . $name);

        \rohsyl\OmegaCore\Models\Plugin::firstOrCreate(
            [ 'name' => $name ],
            [ 'parent_id' => null, 'is_enabled' => true ]
        );

        $result = $plugin->install();
        if(!$result) {
            $this->warn('[ FAILED ]');
            return;
        }
        $this->info('[ SUCCESS ]');
    }

    private function updatePluginForm($name) {
        $this->line(' ');
        $plugin = Plugin::getPlugin($name);
        if(!isset($plugin)) {
            $this->warn('Plugin ' . $name . ' not found. Have you installed it with composer ?');
            return;
        }

        $model = Plugin::getModel($name, true);
        if(!isset($model)) {
            $this->warn('Plugin ' . $name . ' not installed !');
            return;
        }

        $this->info('Updating : ' . $name);

        $result = $plugin->install();
        if(!$result) {
            $this->warn('[ FAILED ]');
            return;
        }
        $this->info('[ SUCCESS ]');
    }
}