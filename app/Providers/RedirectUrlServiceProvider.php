<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Models\LinkRedirect;


class RedirectUrlServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap services.
     */
    public function boot(Request $request)
    {
        // Check if the route matches your desired pattern
        Route::matched(function ($route) use ($request) {
            // Retrieve the 'url_code' parameter from the route
            $urlCode = $route->parameters['url_code'] ?? null;

            // Check if the parameter exists and is not empty
            if ($urlCode) {
                // Query the database to get the redirection URL
                $redirectUrl = LinkRedirect::where('redirect_to', $urlCode)->value('redirect_from');

                // If a redirection URL is found, redirect the user
                if ($redirectUrl) {
                    return Redirect::to($redirectUrl);
                }
            }
        });
    }

    /**
     * Register services.
     */
    public function register(): void
    {
        //
    }
}
