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
use App\Http\Controllers\NewsletterController;
use App\Http\Controllers\MediaCreditsController;
use App\Http\Controllers\SitemapController;
use App\Http\Controllers\Admin\Auth\LoginController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\JourneyController as AdminJourneyController;
use App\Http\Controllers\Admin\CountryController as AdminCountryController;
use App\Http\Controllers\Admin\PageController as AdminPageController;
use App\Http\Controllers\Admin\HomepageController;
use App\Http\Controllers\Admin\ImpactController as AdminImpactController;
use App\Http\Controllers\Admin\TrustController as AdminTrustController;
use App\Http\Controllers\Admin\CategoryController as AdminCategoryController;
use App\Http\Controllers\Admin\FooterController;
use App\Http\Controllers\Admin\SettingsController;
use App\Http\Controllers\Admin\Billing\BillingDashboardController;
use App\Http\Controllers\Admin\Billing\ClientController as BillingClientController;
use App\Http\Controllers\Admin\Billing\InvoiceController as BillingInvoiceController;
use App\Http\Controllers\Admin\Billing\PaymentController as BillingPaymentController;
use App\Http\Controllers\Billing\PublicInvoiceController;
use App\Http\Middleware\AdminMiddleware;

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
Route::post('/contact', [ContactController::class, 'submit'])->name('contact.submit');
Route::post('/subscribe', [NewsletterController::class, 'subscribe'])->name('newsletter.subscribe');

// Legal
Route::view('/privacy-policy', 'pages.privacy-policy')->name('privacy-policy');
Route::view('/terms-and-conditions', 'pages.terms-and-conditions')->name('terms-and-conditions');
Route::get('/media-credits', [MediaCreditsController::class, 'index'])->name('media-credits');

// SEO
Route::get('/sitemap.xml', [SitemapController::class, 'index'])->name('sitemap');

// Public billing (secure token-based invoice view and pay)
Route::get('/billing/invoice/{token}', [PublicInvoiceController::class, 'show'])->name('billing.invoice.show');
Route::get('/billing/invoice/{token}/pay', [PublicInvoiceController::class, 'pay'])->name('billing.invoice.pay');
Route::get('/billing/callback/{token}', [PublicInvoiceController::class, 'callback'])->name('billing.callback');
Route::get('/billing/invoice/{token}/pdf', [PublicInvoiceController::class, 'downloadPdf'])->name('billing.invoice.pdf');
Route::get('/billing/ipn', [PublicInvoiceController::class, 'ipn'])->name('billing.ipn');

// Admin Routes
Route::prefix('admin')->name('admin.')->group(function () {
    // Login routes (public)
    Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
    Route::post('/login', [LoginController::class, 'login']);
    
    // Protected admin routes
    Route::middleware([AdminMiddleware::class])->group(function () {
        Route::post('/logout', [LoginController::class, 'logout'])->name('logout');
        Route::get('/', [DashboardController::class, 'index'])->name('dashboard');
        
        // Content Management
        Route::resource('homepage', HomepageController::class);
        Route::resource('pages', AdminPageController::class);
        Route::post('journeys/{journey}/gallery', [AdminJourneyController::class, 'addGalleryImages'])->name('journeys.gallery.store');
        Route::delete('journeys/gallery/{journey_image}', [AdminJourneyController::class, 'destroyGalleryImage'])->name('journeys.gallery.destroy');
        Route::post('journeys/{journey}/itinerary', [AdminJourneyController::class, 'storeItinerary'])->name('journeys.itinerary.store');
        Route::get('journeys/{journey}/itinerary/{itinerary}/edit', [AdminJourneyController::class, 'editItinerary'])->name('journeys.itinerary.edit');
        Route::put('journeys/{journey}/itinerary/{itinerary}', [AdminJourneyController::class, 'updateItinerary'])->name('journeys.itinerary.update');
        Route::delete('journeys/{journey}/itinerary/{itinerary}', [AdminJourneyController::class, 'destroyItinerary'])->name('journeys.itinerary.destroy');
        Route::resource('journeys', AdminJourneyController::class);
        Route::resource('categories', AdminCategoryController::class)->parameters(['categories' => 'category']);
        Route::resource('countries', AdminCountryController::class);
        Route::resource('impact', AdminImpactController::class);
        Route::resource('trust', AdminTrustController::class);
        Route::get('footer', [FooterController::class, 'index'])->name('footer.index');
        Route::post('footer', [FooterController::class, 'update'])->name('footer.update');
        Route::get('settings', [SettingsController::class, 'index'])->name('settings.index');
        Route::put('settings', [SettingsController::class, 'update'])->name('settings.update');

        // Billing
        Route::get('billing', [BillingDashboardController::class, 'index'])->name('billing.dashboard');
        Route::resource('billing/clients', BillingClientController::class)->names('billing.clients')->parameters(['clients' => 'client']);
        Route::resource('billing/invoices', BillingInvoiceController::class)->names('billing.invoices')->parameters(['invoices' => 'invoice']);
        Route::get('billing/invoices/{invoice}/pdf', [BillingInvoiceController::class, 'pdf'])->name('billing.invoices.pdf');
        Route::post('billing/invoices/{invoice}/duplicate', [BillingInvoiceController::class, 'duplicate'])->name('billing.invoices.duplicate');
        Route::post('billing/invoices/{invoice}/mark-sent', [BillingInvoiceController::class, 'markSent'])->name('billing.invoices.mark-sent');
        Route::post('billing/invoices/{invoice}/payment-link', [BillingInvoiceController::class, 'paymentLink'])->name('billing.invoices.payment-link');
        Route::get('billing/payments', [BillingPaymentController::class, 'index'])->name('billing.payments.index');
    });
});
