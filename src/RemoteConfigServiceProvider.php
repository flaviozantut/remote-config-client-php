<?php

namespace Linx\RemoteConfigClient;

use Illuminate\Support\ServiceProvider;

class RemoteConfigServiceProvider extends ServiceProvider
{
    public function boot()
    {
        $source = dirname(__DIR__).'/config/remote-config.php';

        if ($this->app instanceof LumenApplication) {
            $this->app->configure('remote-config');
        }

        $this->mergeConfigFrom($source, 'remote-config');
    }

    public function register()
    {
        $this->app->singleton(RemoteConfig::class, function ($app) {
            $config = $app->make('config')->get('remote-config');
            return new RemoteConfig($config);
        });
    }
}
