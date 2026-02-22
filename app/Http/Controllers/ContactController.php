<?php

namespace App\Http\Controllers;

use App\Models\Journey;
use App\Models\Country;
use App\Models\ContactInquiry;
use App\Models\Page;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\Facades\Validator;

class ContactController extends Controller
{
    public function index(Request $request)
    {
        $journey = null;
        $country = null;
        $page = Page::where('slug', 'contact')
            ->where('is_published', true)
            ->first();
        
        if ($request->has('journey')) {
            $journey = Journey::where('slug', $request->journey)->where('is_published', true)->first();
        }
        
        if ($request->has('country')) {
            $country = Country::where('slug', $request->country)->where('is_published', true)->first();
        }

        $suggestedJourneys = Journey::where('is_published', true)
            ->when($journey, function ($query) use ($journey) {
                $query->where('id', '!=', $journey->id);
            })
            ->with('countries')
            ->inRandomOrder()
            ->limit(3)
            ->get();

        $contactChallengeLeft = random_int(1, 9);
        $contactChallengeRight = random_int(1, 9);
        session([
            'contact_math_answer' => $contactChallengeLeft + $contactChallengeRight,
            'contact_math_expires_at' => now()->addMinutes(15)->timestamp,
        ]);
        
        return view('pages.contact', compact('journey', 'country', 'page', 'suggestedJourneys', 'contactChallengeLeft', 'contactChallengeRight'));
    }

    public function submit(Request $request)
    {
        $rateLimitKey = 'contact-submit:' . $request->ip();
        if (RateLimiter::tooManyAttempts($rateLimitKey, 5)) {
            return back()->withErrors([
                'message' => 'Too many attempts. Please wait a minute and try again.',
            ], 'contactForm')->withInput();
        }
        RateLimiter::hit($rateLimitKey, 60);

        $validator = Validator::make($request->all(), [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', 'max:255'],
            'message' => ['required', 'string', 'min:10', 'max:5000'],
            'journey_id' => ['nullable', 'integer', 'exists:journeys,id'],
            'country_id' => ['nullable', 'integer', 'exists:countries,id'],
            'challenge_answer' => ['required', 'integer'],
            'rendered_at' => ['required', 'integer'],
            'website' => ['nullable', 'string', 'max:0'], // honeypot
        ]);

        $validator->after(function ($validator) use ($request) {
            $renderedAt = (int) $request->input('rendered_at');
            if ($renderedAt <= 0 || (time() - $renderedAt) < 3) {
                $validator->errors()->add('message', 'Submission was too fast. Please try again.');
            }

            $expiresAt = (int) session('contact_math_expires_at');
            if ($expiresAt <= 0 || time() > $expiresAt) {
                $validator->errors()->add('challenge_answer', 'Challenge expired. Please refresh and try again.');
                return;
            }

            $expected = (int) session('contact_math_answer');
            if ((int) $request->input('challenge_answer') !== $expected) {
                $validator->errors()->add('challenge_answer', 'Incorrect arithmetic answer.');
            }

            $userAgent = (string) $request->userAgent();
            if (trim($userAgent) === '' || mb_strlen($userAgent) < 10) {
                $validator->errors()->add('message', 'Unable to verify request. Please try again.');
            }
        });

        $validated = $validator->validateWithBag('contactForm');

        ContactInquiry::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'message' => $validated['message'],
            'journey_id' => $validated['journey_id'] ?? null,
            'country_id' => $validated['country_id'] ?? null,
            'ip_address' => $request->ip(),
            'user_agent' => $request->userAgent(),
        ]);

        // Invalidate solved challenge after successful submit.
        session()->forget(['contact_math_answer', 'contact_math_expires_at']);

        return back()->with('success_contact', 'Thank you. Your message has been received.');
    }
}
