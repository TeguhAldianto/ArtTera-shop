<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->singleton(\App\Services\AgentSkillManager::class, function ($app) {
            $manager = new \App\Services\AgentSkillManager;
            $manager->register(new \App\Services\AgentSkills\SystemInfoSkill);

            return $manager;
        });
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
