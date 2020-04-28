<?php

namespace Ahilan\Apple;

use Ahilan\Apple\Console\Commands\AppleKeyGenerate;
use Illuminate\Support\ServiceProvider;
use Laravel\Socialite\Contracts\Factory;

class AppleHelperServiceProvider extends ServiceProvider
{
    protected $commands = [
        AppleKeyGenerate::class,
    ];

    public function boot()
    {
        $this->bootAppleProvide();
    }

    public function register()
    {
        $this->registerAppleScheduler();
    }

    private function bootAppleProvide()
    {
        $this->commands($this->commands);
    }

    private function registerAppleScheduler()
    {
        $this->app->singleton('ahilan.apple.console.kernel', function($app) {
            $dispatcher = $app->make(\Illuminate\Contracts\Events\Dispatcher::class);
            return new \Ahilan\Apple\Console\Kernel($app, $dispatcher);
        });

        $this->app->make('ahilan.apple.console.kernel');
    }

}
