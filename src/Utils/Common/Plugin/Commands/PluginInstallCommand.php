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
    protected $signature = 'omega:plugin-install {name*}';

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

        $this->info('Installing plugins ('.sizeof($names).')');

        foreach($names as $name) {
            $this->line(' ');
            $plugin = Plugin::getPlugin($name);
            if(!isset($plugin)) {
                $this->warn('Plugin ' . $name . ' not found. Have you installed it with composer ?');
                break;
            }
            $this->info('Installing : ' . $name);

            \rohsyl\OmegaCore\Models\Plugin::firstOrCreate(
                [ 'name' => $name ],
                [ 'parent_id' => null, 'is_enabled' => true ]
            );

            $result = $plugin->install();
            if(!$result) {
                $this->warn('[ FAILED ]');
                break;
            }
            $this->info('[ SUCCESS ]');
        }

        return 0;
    }
}