<?php

namespace Chwaqas\Laramail\Command;

use Illuminate\Console\Command;

class VendorPublishCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'laramail:install';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Publish all Laramail assets from vendor packages';

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $this->call('vendor:publish', [
            '--provider' => "Chwaqas\Laramail\LaramailServiceProvider",
        ]);
    }
}
