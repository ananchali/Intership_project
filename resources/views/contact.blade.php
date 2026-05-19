@extends('layouts.yegara')

@section('title', 'Contact Us')

@section('content')
<div class="max-w-4xl mx-auto px-4 py-8">
    <!-- Contact Form -->
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
        <div class="lg:col-span-2">
            <div class="bg-white rounded-lg shadow-sm p-8">
                <h1 class="text-3xl font-bold text-gray-900 mb-6">Contact us for any business inquiries</h1>
                
                @if(session('success'))
                <div class="mb-6 bg-green-50 border border-green-200 text-green-800 px-4 py-3 rounded-lg">
                    {{ session('success') }}
                </div>
                @endif

                @if($errors->any())
                <div class="mb-6 bg-red-50 border border-red-200 text-red-800 px-4 py-3 rounded-lg">
                    <ul class="list-disc list-inside">
                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
                @endif

                <form action="{{ route('contact.submit') }}" method="POST" class="space-y-6">
                    @csrf
                    
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <label for="name" class="block text-sm font-medium text-gray-700 mb-2">Name *</label>
                            <input type="text" id="name" name="name" required
                                   class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                                   value="{{ old('name') }}">
                        </div>
                        
                        <div>
                            <label for="email" class="block text-sm font-medium text-gray-700 mb-2">Email *</label>
                            <input type="email" id="email" name="email" required
                                   class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                                   value="{{ old('email') }}">
                        </div>
                    </div>
                    
                    <div>
                        <label for="phone" class="block text-sm font-medium text-gray-700 mb-2">Phone (10 digits starting with 09) *</label>
                        <input type="tel" id="phone" name="phone" required maxlength="10" placeholder="09xxxxxxxx"
                               class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                               value="{{ old('phone') }}">
                    </div>
                    
                    <div>
                        <label for="subject" class="block text-sm font-medium text-gray-700 mb-2">Subject</label>
                        <input type="text" id="subject" name="subject"
                               class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                               value="{{ old('subject') }}">
                    </div>
                    
                    <div>
                        <label for="message" class="block text-sm font-medium text-gray-700 mb-2">Message *</label>
                        <textarea id="message" name="message" rows="6" required
                                  class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500">{{ old('message') }}</textarea>
                    </div>
                    
                    <!-- ALTCHA Protection -->
                    <div class="bg-gray-50 rounded-lg p-4">
                        <div class="flex items-center mb-3">
                            <svg class="w-5 h-5 text-gray-600 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                            </svg>
                            <span class="text-sm font-medium text-gray-700">Protected by ALTCHA</span>
                        </div>
                        <div class="bg-white rounded border border-gray-200 p-3 text-center">
                            <div class="text-xs text-gray-600 mb-2">Please verify you're human</div>
                            <div class="flex justify-center space-x-2 mb-3">
                                <button type="button" class="px-3 py-1 bg-gray-100 hover:bg-gray-200 rounded text-sm">🔄</button>
                                <button type="button" class="px-3 py-1 bg-gray-100 hover:bg-gray-200 rounded text-sm">🔊</button>
                                <button type="button" class="px-3 py-1 bg-gray-100 hover:bg-gray-200 rounded text-sm">❓</button>
                            </div>
                            <input type="text" name="altcha" placeholder="Enter verification code" 
                                   class="w-full px-3 py-2 border border-gray-300 rounded text-sm focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                        </div>
                    </div>
                    
                    <div class="flex items-center">
                        <input type="checkbox" id="not_robot" name="not_robot" required class="mr-2">
                        <label for="not_robot" class="text-sm text-gray-700">I'm not a robot</label>
                    </div>
                    
                    <button type="submit" 
                            class="w-full bg-blue-600 text-white py-3 px-6 rounded-lg hover:bg-blue-700 transition-colors font-medium">
                        Send Message
                    </button>
                </form>
            </div>
        </div>
        
        <!-- Contact Info -->
        <div class="space-y-6">
            <div class="bg-white rounded-lg shadow-sm p-6">
                <h3 class="text-lg font-semibold text-gray-900 mb-4">Contact Information</h3>
                <div class="space-y-4">
                    <div class="flex items-center">
                        <svg class="w-5 h-5 text-gray-400 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257-2.257a1 1 0 01-1.21-.502 1 1 0 01-.502.948V5a2 2 0 012-2z"/>
                        </svg>
                        <div>
                            <p class="font-medium text-gray-900">Email</p>
                            <p class="text-gray-600">support@afronexhost.com</p>
                        </div>
                    </div>
                    
                    <div class="flex items-center">
                        <svg class="w-5 h-5 text-gray-400 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257-2.257a1 1 0 01-1.21-.502 1 1 0 01-.502.948V5a2 2 0 012-2z"/>
                        </svg>
                        <div>
                            <p class="font-medium text-gray-900">Phone</p>
                            <p class="text-gray-600">+251 902496151</p>
                        </div>
                    </div>
                    
                    <div class="flex items-center">
                        <svg class="w-5 h-5 text-gray-400 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-1.414 0l-4.243-4.242a1 1 0 010-1.414l4.242-4.242a1 1 0 011.414 0l6.364 6.364a1 1 0 010 1.414z"/>
                        </svg>
                        <div>
                            <p class="font-medium text-gray-900">Location</p>
                            <p class="text-gray-600">Dire Dawa, Ethiopia</p>
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="bg-white rounded-lg shadow-sm p-6">
                <h3 class="text-lg font-semibold text-gray-900 mb-4">Business Hours</h3>
                <div class="space-y-2">
                    <div class="flex justify-between">
                        <span class="text-gray-600">Monday - Friday</span>
                        <span class="font-medium text-gray-900">9:00 AM - 6:00 PM</span>
                    </div>
                    <div class="flex justify-between">
                        <span class="text-gray-600">Saturday</span>
                        <span class="font-medium text-gray-900">10:00 AM - 4:00 PM</span>
                    </div>
                    <div class="flex justify-between">
                        <span class="text-gray-600">Sunday</span>
                        <span class="font-medium text-gray-900">Closed</span>
                    </div>
                </div>
            </div>
            
            <div class="bg-white rounded-lg shadow-sm p-6">
                <h3 class="text-lg font-semibold text-gray-900 mb-4">Quick Links</h3>
                <div class="space-y-3">
                    <a href="{{ route('howto.buy') }}" class="block text-blue-600 hover:text-blue-800">How to Buy Domain & Hosting</a>
                    <a href="{{ route('packages.index') }}" class="block text-blue-600 hover:text-blue-800">View Hosting Plans</a>
                    <!-- <a href="https://t.me/afronexhost" target="_blank" class="block text-blue-600 hover:text-blue-800">Live Chat Support</a> -->
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
