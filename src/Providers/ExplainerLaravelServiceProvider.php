<?php

namespace Lemon\ExplainerLaravel\Providers;

use Lemon\Explainer\Providers\ExplainerServiceProvider;

use Illuminate\Routing\Route;
use Lemon\Explainer\Explainer;

class ExplainerLaravelServiceProvider extends ExplainerServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {

        Route::macro('explain', function($classname){

            // $this is an route instance actually

            // we have to register declaimer only when in console
            if (!app()->runningInConsole())
                return $this;

            if($classname)
            {
                Explainer::register([
                    'domain' => $this->domain(),
                    'method' => $this->methods()[0],
                    'uri' => $this->uri(),
                ], $classname);
            }

            return $this;
        });

        $this->loadRoutesFrom(__DIR__.'/../../routes/routes.php');

        parent::boot();
    }
}
