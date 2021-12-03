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
    protected $signature = 'omega:theme-install
                                {--U|uninstall   : Uninstall the theme} 
                                {--R|reinstall   : Reinstall the theme} ';

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

        // Uninstall the gives plugins
        if($this->hasOption('uninstall') && $this->option('uninstall')) {

            $this->info('Uninstalling theme');
            $this->uninstall();
            $this->info('[ DONE ]');
            return 0;
        }

        // Uninstall and re-install the gives plugins
        if($this->hasOption('reinstall') && $this->option('reinstall')) {

            $this->info('Re-installing theme');
            $this->info('Uninstalling theme');
            $this->uninstall();
            $this->info('Installing theme');
            $this->install();
            $this->info('[ DONE ]');
            return 0;
        }

        $this->info('Installing theme');
        $this->install();
        $this->info('[DONE]!');

        return 0;

    }

    public function install() {

        $path = OmegaTheme::getThemePath();
        $installer_path = OmegaTheme::getInstallerPath();
        $installer = OmegaTheme::getInstaller();

        $this->line($path);

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
    }

    public function uninstall() {

        $path = OmegaTheme::getThemePath();
        $installer_path = OmegaTheme::getInstallerPath();
        $installer = OmegaTheme::getInstaller();

        $this->line($path);

        if(!isset($installer) || !$installer instanceof Installer){
            $this->error(__('There is no valid installation file ('.$installer_path.') for the theme ('.$path.'). Check the the file exists and check your AppServiceProvider::register()'));
            return 1;
        }

        $theme = Theme::query()->where('name', $installer->getName())->first();

        if(!isset($theme)) {
            $this->error(__('Theme not installed ('.$installer_path.')'));
            return 1;
        }

        $theme->delete();

    }
}
