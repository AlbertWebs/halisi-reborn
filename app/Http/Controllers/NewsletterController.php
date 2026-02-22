<?php

namespace App\Http\Controllers;

use App\Models\NewsletterSubscription;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\Facades\Validator;

class NewsletterController extends Controller
{
    public function subscribe(Request $request)
    {
        $rateLimitKey = 'newsletter-subscribe:' . $request->ip();
        if (RateLimiter::tooManyAttempts($rateLimitKey, 8)) {
            return back()->withErrors([
                'email' => 'Too many attempts. Please wait a minute and try again.',
            ], 'newsletterForm')->withInput();
        }
        RateLimiter::hit($rateLimitKey, 60);

        $validator = Validator::make($request->all(), [
            'email' => ['required', 'email', 'max:255'],
            'source' => ['nullable', 'string', 'in:footer,popup'],
            'challenge_answer' => ['required', 'integer'],
            'rendered_at' => ['required', 'integer'],
            'website' => ['nullable', 'string', 'max:0'], // honeypot
        ]);

        $validator->after(function ($validator) use ($request) {
            $renderedAt = (int) $request->input('rendered_at');
            if ($renderedAt <= 0 || (time() - $renderedAt) < 2) {
                $validator->errors()->add('email', 'Submission was too fast. Please try again.');
            }

            $expiresAt = (int) session('newsletter_math_expires_at');
            if ($expiresAt <= 0 || time() > $expiresAt) {
                $validator->errors()->add('challenge_answer', 'Challenge expired. Please try again.');
                return;
            }

            $expected = (int) session('newsletter_math_answer');
            if ((int) $request->input('challenge_answer') !== $expected) {
                $validator->errors()->add('challenge_answer', 'Incorrect arithmetic answer.');
            }

            $userAgent = (string) $request->userAgent();
            if (trim($userAgent) === '' || mb_strlen($userAgent) < 10) {
                $validator->errors()->add('email', 'Unable to verify request. Please try again.');
            }
        });

        $validated = $validator->validateWithBag('newsletterForm');

        NewsletterSubscription::updateOrCreate(
            ['email' => $validated['email']],
            [
                'source' => $validated['source'] ?? 'footer',
                'ip_address' => $request->ip(),
                'user_agent' => $request->userAgent(),
                'subscribed_at' => now(),
            ]
        );

        session()->forget(['newsletter_math_answer', 'newsletter_math_expires_at']);

        return back()->with('newsletter_success', 'Thank you for subscribing.');
    }
}
