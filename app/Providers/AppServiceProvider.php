<?php

namespace App\Providers;

use App\Activities\ActivityManager;
use App\Contracts\Activities\ActivityManagerContract;
use App\Image;
use App\Post;
use App\Video;
use Illuminate\Database\Eloquent\Relations\Relation;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     */
    public function boot()
    {
        Relation::morphMap([
            'post' => Post::class,
            'image' => Image::class,
            'video' => Video::class,
        ]);
    }

    /**
     * Register any application services.
     */
    public function register()
    {
        $this->app->bind(ActivityManagerContract::class, ActivityManager::class);
    }
}
