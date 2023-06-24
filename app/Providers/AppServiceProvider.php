<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Intervention\Image\ImageManagerStatic as Image;
use Stripe\HttpClient\CurlClient;
use Stripe\HttpClient\ClientBuilder;


class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton('image', function ($app) {
            return $app->make(Image::class);
        });
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        // \Stripe\Stripe::setApiKey('sk_test_51NL7FFCwr8UATqaQTJ1Ubf0IMMPCyFgYFBOwxUVNBVWEWX0HW8yMp98kVFS26tn6V8Xf0EPUyfThQmN5h9DKlnil00C2OAyoAm');
        // \Stripe\HttpClient\ClientInterface::setHttpClient(
        //     new \Stripe\HttpClient\CurlClient('sk_test_51NL7FFCwr8UATqaQTJ1Ubf0IMMPCyFgYFBOwxUVNBVWEWX0HW8yMp98kVFS26tn6V8Xf0EPUyfThQmN5h9DKlnil00C2OAyoAm')
        // );


    }
}
