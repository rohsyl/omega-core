<?php

namespace rohsyl\OmegaCore\Utils\Common\Theme\Command;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Artisan;
use rohsyl\OmegaCore\Models\Theme;
use rohsyl\OmegaCore\Utils\Overt\Facades\OmegaTheme;
use rohsyl\OmegaCore\Utils\Overt\Theme\Installer\Installer;

class InstallThemeCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'omega:theme-install';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Install the registera theme';

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
        $installer = OmegaTheme::getInstaller();
        $path = OmegaTheme::getThemePath();

        $this->info('Installing theme : ' . $path);

        if(!isset($installer) || !$installer instanceof Installer){
            $this->error(__('There is no valid installation file (install/install.php) for the theme ('.$path.').'));
            return 1;
        }

        Theme::create([
            'name' => $installer->getName(),
            'title' => isset($data['title']) ? $data['title'] : $installer->getName(),
            'description' => isset($data['description']) ? $data['description'] : '',
            'website' => isset($data['website']) ? $data['website'] : '',
            'param' => [
                'colors' => json_encode(isset($data['colors']) ? $data['colors'] : []),
                ]
        ]);

        $postInstallCallable = $installer->getPostInstall();

        if(is_callable($postInstallCallable)) {
            call_user_func($postInstallCallable, $installer->getName());
        }

        $this->info('Theme installed !');

        return 0;

    }
}
