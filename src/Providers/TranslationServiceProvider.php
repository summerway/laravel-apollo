<?php

namespace MapleSnow\Apollo\Providers;

use \Illuminate\Translation\TranslationServiceProvider as IlluminateTranslationServiceProvider;
use MapleSnow\Apollo\YamlFileLoader;

class TranslationServiceProvider extends IlluminateTranslationServiceProvider
{
    /**
     * Register the translation line loader.
     * Add support for YAML files.
     *
     * @return void
     */
    protected function registerLoader()
    {
        $this->app->singleton('translation.loader', function ($app) {
            return new YamlFileLoader($app['files'], $app['path.lang']);
        });
    }
}