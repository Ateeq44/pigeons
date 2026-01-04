<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\ClubController;
use App\Http\Controllers\Admin\EventController;
use App\Http\Controllers\Admin\EventDayController;
use App\Http\Controllers\Admin\LoftController;
use App\Http\Controllers\Admin\EventLoftController;
use App\Http\Controllers\Admin\ArrivalController;
use App\Http\Controllers\Public\HomeController;
use App\Http\Controllers\Public\DayResultController;
use App\Http\Controllers\Public\EventListController;
use App\Http\Controllers\Public\EventResultController;
use App\Http\Controllers\Public\ClubPublicController;
use App\Http\Controllers\Admin\SliderController;
use App\Http\Controllers\Admin\SiteSettingController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Public\WeatherController;

Route::get('/weather', [WeatherController::class, 'index'])->name('public.weather');

Route::get('/', [HomeController::class, 'index'])->name('public.home');
Route::get('/day/{day}', [DayResultController::class, 'show'])->name('public.day');
Route::get('/events', [EventListController::class, 'index'])->name('public.events');
Route::get('/event/{event}', [EventResultController::class, 'show'])->name('public.event');
Route::get('/clubs', [ClubPublicController::class, 'index'])->name('public.clubs');
Route::get('/clubs/{club}', [ClubPublicController::class, 'show'])->name('public.clubs.show');


Route::middleware(['auth', 'admin'])->prefix('admin')->name('admin.')->group(function () {
	Route::get('/dashboard', [\App\Http\Controllers\Admin\DashboardController::class, 'index'])->name('dashboard');
	Route::resource('clubs', ClubController::class);
	Route::resource('events', EventController::class);
	Route::get('events/{event}/days', [EventDayController::class, 'index'])->name('events.days.index');
	Route::post('events/{event}/days/generate', [EventDayController::class, 'generate'])->name('events.days.generate');
	Route::delete('events/{event}/days/{day}', [EventDayController::class, 'destroy'])->name('events.days.destroy');
	Route::resource('lofts', LoftController::class);
	Route::get('events/{event}/participants', [EventLoftController::class, 'index'])->name('events.participants.index');
	Route::post('events/{event}/participants/attach', [EventLoftController::class, 'attach'])->name('events.participants.attach');
	Route::delete('events/{event}/participants/{eventLoft}', [EventLoftController::class, 'destroy'])->name('events.participants.destroy');
	Route::get('events/{event}/days/{day}/arrivals', [ArrivalController::class, 'edit'])->name('arrivals.edit');
	Route::post('events/{event}/days/{day}/arrivals', [ArrivalController::class, 'update'])->name('arrivals.update');
	
	Route::resource('sliders', SliderController::class);
	Route::get('settings', [SiteSettingController::class, 'edit'])->name('settings.edit');
	Route::post('settings', [SiteSettingController::class, 'update'])->name('settings.update');

});



Route::get('/dashboard', function () {
	return redirect('admin/dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
	Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
	Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
	Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
