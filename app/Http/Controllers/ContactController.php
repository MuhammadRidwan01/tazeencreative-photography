<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Log;

class ContactController extends Controller
{
    /**
     * Display the contact page
     */
    public function index()
    {
        return view('contact.index');
    }

    /**
     * Handle contact form submission
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'phone' => 'nullable|string|max:20',
            'subject' => 'required|string|max:255',
            'message' => 'required|string|max:2000',
            'service_interest' => 'nullable|string|in:wedding,portrait,event,commercial,other'
        ]);

        try {
            // Here you would typically send an email
            // For now, we'll just log the contact attempt
            Log::info('Contact form submission', $validated);

            // You can uncomment this when you have email configured
            /*
            Mail::send('emails.contact', $validated, function ($message) use ($validated) {
                $message->to('admin@tazeencreative.id')
                        ->subject('New Contact Form Submission: ' . $validated['subject'])
                        ->from($validated['email'], $validated['name']);
            });
            */

            return redirect()->route('contact.index')
                ->with('success', 'Thank you for your message! We will get back to you soon.');

        } catch (\Exception $e) {
            Log::error('Contact form error: ' . $e->getMessage());

            return redirect()->route('contact.index')
                ->with('error', 'Sorry, there was an error sending your message. Please try again.');
        }
    }
}
