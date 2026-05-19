@extends('layouts.app')

@section('content')
<div class="main-container">
    <div style="margin-bottom: 2rem;">
        <a href="{{ route('home') }}" style="color: var(--primary); text-decoration: none; font-weight: 600; display: flex; align-items: center; gap: 0.5rem;">
            <svg style="width: 18px; height: 18px;" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path></svg>
            Back to Dashboard
        </a>
    </div>
    <div style="text-align: center; margin-bottom: 4rem;">
        <h1 class="page-title">Support Center</h1>
        <p class="page-subtitle">We're here to help you with any questions or issues</p>
    </div>

    @if(session('success'))
        <div style="max-width: 1000px; margin: 0 auto 2rem; background: #ECFDF5; color: #065F46; padding: 1.25rem; border-radius: 12px; border: 1px solid #A7F3D0; font-weight: 600; text-align: center; animation: fadeIn 0.4s ease;">
            {{ session('success') }}
        </div>
    @endif

    <div style="display: grid; grid-cols-1 md:grid-cols-2 gap: 3rem; max-width: 1000px; margin: 0 auto;">
        <!-- Contact Information -->
        <div class="card">
            <h2 style="font-size: 1.5rem; font-weight: 700; margin-bottom: 1.5rem; color: var(--text-main); display: flex; align-items: center; gap: 0.75rem;">
                <svg style="width: 24px; height: 24px; color: var(--primary);" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"></path></svg>
                Contact Us Directly
            </h2>
            <div style="space-y: 1.5rem;">
                <div style="padding: 1.25rem; background: #F8FAFC; border-radius: 10px; border: 1px solid var(--border);">
                    <p style="text-xs font-bold text-gray-400 uppercase tracking-widest mb-1">Phone Support</p>
                    <p style="font-size: 1.25rem; font-weight: 700; color: var(--text-main);">+251 911 234 567</p>
                    <p style="text-xs text-gray-500 mt-1">Available Mon-Fri, 8:00 AM - 6:00 PM</p>
                </div>
                
                <div style="padding: 1.25rem; background: #F8FAFC; border-radius: 10px; border: 1px solid var(--border); margin-top: 1.5rem;">
                    <p style="text-xs font-bold text-gray-400 uppercase tracking-widest mb-1">Email Support</p>
                    <p style="font-size: 1.25rem; font-weight: 700; color: var(--text-main);">support@afronex-hosting.com</p>
                    <p style="text-xs text-gray-500 mt-1">We typically reply within 2 hours</p>
                </div>

                <div style="padding: 1.25rem; background: #F8FAFC; border-radius: 10px; border: 1px solid var(--border); margin-top: 1.5rem;">
                    <p style="text-xs font-bold text-gray-400 uppercase tracking-widest mb-1">Office Location</p>
                    <p style="font-size: 1.1rem; font-weight: 700; color: var(--text-main);">Bole, Addis Ababa, Ethiopia</p>
                    <p style="text-xs text-gray-500 mt-1">Visit us for in-person consultation</p>
                </div>
            </div>
        </div>

        <!-- Support Request Form -->
        <div class="card">
            <h2 style="font-size: 1.5rem; font-weight: 700; margin-bottom: 1.5rem; color: var(--text-main); display: flex; align-items: center; gap: 0.75rem;">
                <svg style="width: 24px; height: 24px; color: var(--primary);" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 10h.01M12 10h.01M16 10h.01M9 16H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-5l-5 5v-5z"></path></svg>
                Send a Message
            </h2>
            <form action="{{ route('support.submit') }}" method="POST">
                @csrf
                <div class="form-group">
                    <label class="form-label" for="subject">Issue Subject</label>
                    <select id="subject" name="subject" class="form-control" required>
                        <option value="" disabled selected>Select an option</option>
                        <option value="billing">Billing & Payment</option>
                        <option value="technical">Technical Issue</option>
                        <option value="domain">Domain Registration</option>
                        <option value="other">Other Inquiry</option>
                    </select>
                </div>

                <div class="form-group">
                    <label class="form-label" for="message">Your Message</label>
                    <textarea id="message" name="message" class="form-control" rows="5" required placeholder="Tell us more about how we can help..."></textarea>
                </div>

                <button type="submit" class="btn btn-primary">
                    Send Support Request
                </button>
            </form>
        </div>
    </div>

    <!-- FAQ Section -->
    <div style="margin-top: 5rem; max-width: 800px; margin-left: auto; margin-right: auto;">
        <h2 style="text-align: center; font-size: 1.75rem; font-weight: 700; margin-bottom: 3rem;">Frequently Asked Questions</h2>
        <div style="space-y: 1.5rem;">
            <div style="background: white; border-radius: 12px; padding: 1.5rem; border: 1px solid var(--border); margin-bottom: 1.5rem;">
                <h4 style="font-weight: 700; color: var(--text-main); margin-bottom: 0.5rem;">How long does payment verification take?</h4>
                <p style="color: var(--text-muted); font-size: 0.95rem;">Once you submit your bank slip or transaction reference, our team typically verifies it within 1-2 hours during business hours.</p>
            </div>
            <div style="background: white; border-radius: 12px; padding: 1.5rem; border: 1px solid var(--border); margin-bottom: 1.5rem;">
                <h4 style="font-weight: 700; color: var(--text-main); margin-bottom: 0.5rem;">Can I change my hosting package later?</h4>
                <p style="color: var(--text-muted); font-size: 0.95rem;">Yes! You can upgrade or downgrade your package at any time. Just contact our support team and they will assist you with the process.</p>
            </div>
        </div>
    </div>
</div>
@endsection
