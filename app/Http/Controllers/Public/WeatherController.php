<?php

namespace App\Http\Controllers\Public;

use App\Http\Controllers\Controller;
use App\Models\SiteSetting;

class WeatherController extends Controller
{
    public function index()
    {
        $settings = SiteSetting::first();
        $weatherSrc = $settings?->weather_iframe_src
            ?? 'https://embed.windy.com/embed2.html?lat=31.5204&lon=74.3587&detailLat=31.5204&detailLon=74.3587&width=650&height=450&zoom=6&level=surface&overlay=wind&product=ecmwf&menu=&message=true&marker=&calendar=now&pressure=&type=map&location=coordinates&detail=&metricWind=km%2Fh&metricTemp=%C2%B0C&radarRange=-1';

        return view('public.weather', compact('weatherSrc'));
    }
}
