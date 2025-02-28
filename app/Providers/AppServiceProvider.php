<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use OpenApi\Annotations as OA;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * @OA\SecurityScheme(
     *     securityScheme="bearerAuth",
     *     type="http",
     *     scheme="bearer",
     *     bearerFormat="JWT"
     * )
     */
    public function boot(): void
    {
        //
    }
}
