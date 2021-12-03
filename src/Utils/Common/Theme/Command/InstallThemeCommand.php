<?php

namespace rohsyl\OmegaCore\Utils\Common\Theme\Command;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Artisan;
use rohsyl\OmegaCore\Models\Theme;
use rohsyl\OmegaCore\Utils\Overt\Facades\OmegaTheme;
use rohsyl\OmegaCore\Utils\Overt\Theme\Installer\Installer;
use rohsyl\OmegaCore\Utils\Overt\Theme\ThemeManager;

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
    protected $description = 'Install the registered theme';

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
        $installer_path = OmegaTheme::getInstallerPath();
        $installer = OmegaTheme::getInstaller();
        $path = OmegaTheme::getThemePath();

        $this->info('Installing theme : ' . $path);



        if(!isset($installer) || !$installer instanceof Installer){
            $this->error(__('There is no valid installation file ('.$installer_path.') for the theme ('.$path.'). Check the the file exists and check your AppServiceProvider::register()'));
            return 1;
        }

        $register_path = OmegaTheme::getRegisterPath();
        if(isset($register_path) && !file_exists($register_path)) {
            $this->error(__('There is a template register file set but file not found under : '.$register_path.' for the theme ('.$path.'). Check the the file exists and check your AppServiceProvider::register()'));
            return 1;
        }

        if(Theme::query()->where('name', $installer->getName())->exists()) {
            $this->warn(__('Theme "'.$installer->getName().'" alreay installed...'));
            $this->info('[DONE]!');
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
            call_user_func($postInstallCallable, OmegaTheme::get());
        }

        $this->info('[DONE]!');

        return 0;

    }
}
