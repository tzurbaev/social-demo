<?php

namespace App\Providers;

use GetStream\Stream\Client;
use Illuminate\Support\ServiceProvider;
use InvalidArgumentException;

class StreamServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     */
    public function boot()
    {
        //
    }

    /**
     * Register the application services.
     */
    public function register()
    {
        $this->app->singleton(Client::class, function () {
            $apiKey = env('GETSTREAM_API_KEY');
            $apiSecret = env('GETSTREAM_API_SECRET');
            $appId = env('GETSTREAM_APP_ID');

            if (is_null($apiKey) || is_null($apiSecret) || is_null($appId)) {
                throw new InvalidArgumentException('[GetStream] configs are missing.');
            }

            $client = new Client($apiKey, $apiSecret);
            $client->setLocation(env('GETSTREAM_LOCATION', 'us-east'));

            return $client;
        });
    }
}
