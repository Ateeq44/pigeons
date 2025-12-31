<?php

namespace App\Providers;
use Illuminate\Support\Facades\View;
use App\Models\Slider;
use App\Models\Club;
use App\Models\Event;
use App\Models\SiteSetting;
use Illuminate\Support\ServiceProvider;

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
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        View::composer('layouts.public', function ($view) {
            $sliders = Slider::where('is_active', true)->orderBy('sort_order')->get();

            $featuredClubs = Club::where('is_featured', true)
            ->orderBy('sort_order')
            ->orderBy('name_ur')
            ->get();

            $featuredEvents = Event::where('is_featured', true)
            ->orderByDesc('start_date')
            ->limit(20)
            ->get();

            $tagline = optional(SiteSetting::first())->tagline ?? '';

            $view->with([
                'globalSliders' => $sliders,
                'globalFeaturedClubs' => $featuredClubs,
                'globalFeaturedEvents' => $featuredEvents,
                'globalTagline' => $tagline,
            ]);
        });
    }
}
