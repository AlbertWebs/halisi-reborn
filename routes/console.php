<?php

use App\Services\Billing\PesapalService;
use Illuminate\Foundation\Inspiring;
use Illuminate\Support\Facades\Artisan;

Artisan::command('inspire', function () {
    $this->comment(Inspiring::quote());
})->purpose('Display an inspiring quote');

Artisan::command('pesapal:register-ipn', function () {
    $service = new PesapalService();
    $ipnUrl = config('pesapal.ipn_url');

    $this->info('Environment: ' . config('pesapal.environment', 'sandbox'));
    $this->info('IPN URL: ' . $ipnUrl);

    if (! config('pesapal.consumer_key') || ! config('pesapal.consumer_secret')) {
        $this->error('PESAPAL_CONSUMER_KEY and PESAPAL_CONSUMER_SECRET must be set in .env');

        return 1;
    }

    $ipnId = $service->resolveNotificationId();

    if (! $ipnId) {
        $this->error('Could not obtain a Pesapal notification_id. Check storage/logs/laravel.log for API errors.');

        return 1;
    }

    $this->newLine();
    $this->info('notification_id (add to .env as PESAPAL_IPN_ID):');
    $this->line($ipnId);
    $this->newLine();
    $this->comment('Then run: php artisan config:clear');

    return 0;
})->purpose('Register or resolve Pesapal IPN and print notification_id for .env');
