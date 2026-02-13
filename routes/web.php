<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\AboutController;
use App\Http\Controllers\JourneyController;
use App\Http\Controllers\CountryController;
use App\Http\Controllers\ImpactController;
use App\Http\Controllers\TrustController;
use App\Http\Controllers\WorkController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\SitemapController;

// Home
Route::get('/', [HomeController::class, 'index'])->name('home');

// About
Route::get('/about-halisi', [AboutController::class, 'index'])->name('about');

// Journeys
Route::get('/journeys', [JourneyController::class, 'index'])->name('journeys.index');
Route::get('/journeys/signature-safaris', [JourneyController::class, 'signatureSafaris'])->name('journeys.signature-safaris');
Route::get('/journeys/bespoke-private-travel', [JourneyController::class, 'bespokePrivate'])->name('journeys.bespoke-private');
Route::get('/journeys/conservation-community', [JourneyController::class, 'conservationCommunity'])->name('journeys.conservation-community');
Route::get('/journeys/luxury-retreats', [JourneyController::class, 'luxuryRetreats'])->name('journeys.luxury-retreats');
Route::get('/journeys/{journey:slug}', [JourneyController::class, 'show'])->name('journeys.show');

// Countries
Route::get('/countries', [CountryController::class, 'index'])->name('countries.index');
Route::get('/countries/kenya', [CountryController::class, 'kenya'])->name('countries.kenya');
Route::get('/countries/uganda', [CountryController::class, 'uganda'])->name('countries.uganda');
Route::get('/countries/tanzania', [CountryController::class, 'tanzania'])->name('countries.tanzania');
Route::get('/countries/zambia', [CountryController::class, 'zambia'])->name('countries.zambia');
Route::get('/countries/zimbabwe', [CountryController::class, 'zimbabwe'])->name('countries.zimbabwe');
Route::get('/countries/botswana', [CountryController::class, 'botswana'])->name('countries.botswana');
Route::get('/countries/namibia', [CountryController::class, 'namibia'])->name('countries.namibia');
Route::get('/countries/{country:slug}', [CountryController::class, 'show'])->name('countries.show');

// Impact
Route::get('/responsible-regenerative-travel', [ImpactController::class, 'responsibleTravel'])->name('impact.responsible-travel');
Route::get('/climate-community-impact', [ImpactController::class, 'climateCommunity'])->name('impact.climate-community');

// Halisi Trust
Route::get('/halisi-trust', [TrustController::class, 'index'])->name('trust.index');
Route::get('/halisi-trust/{post:slug}', [TrustController::class, 'show'])->name('trust.show');

// Work With Us
Route::get('/work-with-us', [WorkController::class, 'index'])->name('work.index');

// Contact
Route::get('/contact', [ContactController::class, 'index'])->name('contact.index');

// SEO
Route::get('/sitemap.xml', [SitemapController::class, 'index'])->name('sitemap');
