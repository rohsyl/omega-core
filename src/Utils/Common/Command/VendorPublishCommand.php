<?php


namespace rohsyl\OmegaCore\Utils\Common\Command;


use Illuminate\Console\Command;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\File;
use rohsyl\OmegaCore\Utils\Common\Facades\Plugin;

class VendorPublishCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'omega:vendor-publish';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Publish Omega assets';

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

        $path = public_path('vendor/omega');
        if(File::exists($path)) {
            File::deleteDirectory($path);
        }


        $code = Artisan::call('vendor:publish', [
            '--provider' => 'rohsyl\OmegaCore\ServiceProvider',
            '--tag' => 'public',
            '--force' => true,
        ]);

        $this->info(Artisan::output());

        return $code;
    }
}