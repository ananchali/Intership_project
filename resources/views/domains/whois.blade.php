@extends('layouts.yegara')

@section('title', 'WHOIS Lookup - Afronexhost')

@section('content')
<div class="max-w-7xl mx-auto px-4 py-8">
    <!-- Hero Section -->
    <div class="text-center mb-16">
        <div class="w-24 h-24 gradient-bg rounded-full flex items-center justify-center mx-auto mb-8">
            <svg width="80" height="80" viewBox="0 0 100 100" fill="none" xmlns="http://www.w3.org/2000/svg">
                <circle cx="50" cy="50" r="50" fill="#000000"/>
                <path d="M50 10 C30 10, 10 30, 10 50 C10 70, 30 90, 50 90 C70 90, 90 70, 90 50 C90 35, 75 15, 60 12" fill="#8B4513"/>
                <circle cx="35" cy="40" r="8" fill="#654321"/>
                <circle cx="65" cy="40" r="8" fill="#FF0000"/>
                <path d="M25 60 Q50 70, 75 60" stroke="#C0C0C0" stroke-width="2" fill="none"/>
            </svg>
        </div>
        <h1 class="text-4xl md:text-5xl font-bold text-gray-900 mb-4">WHOIS Lookup</h1>
        <p class="text-xl text-gray-600 max-w-3xl mx-auto">Check domain availability and get information about any registered domain.</p>
    </div>

    <!-- WHOIS Search -->
    <div class="bg-white rounded-2xl shadow-lg p-8 mb-16">
        <div class="max-w-3xl mx-auto">
            <h2 class="text-2xl font-bold text-gray-900 mb-6 text-center">Enter Domain Name</h2>
            <div class="flex flex-col sm:flex-row gap-4">
                <input type="text" id="domainInput" placeholder="example.com" class="flex-1 px-6 py-4 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 text-lg">
                <button onclick="lookupDomain()" class="bg-blue-600 text-white px-8 py-4 rounded-lg hover:bg-blue-700 transition-colors font-semibold text-lg">
                    Lookup
                </button>
            </div>
            <p class="text-sm text-gray-500 mt-4 text-center">Enter a domain name without http:// or www.</p>
        </div>
    </div>

    <!-- Results Section -->
    <div id="resultsSection" class="hidden mb-16">
        <div class="bg-white rounded-2xl shadow-lg p-8">
            <h2 class="text-2xl font-bold text-gray-900 mb-6">WHOIS Results</h2>
            <div id="resultsContent" class="space-y-4">
                <!-- Results will be populated by JavaScript -->
            </div>
        </div>
    </div>

    <!-- Info Section -->
    <section class="bg-gray-50 rounded-2xl p-12 mb-16">
        <div class="text-center mb-12">
            <h2 class="text-3xl font-bold text-gray-900 mb-6">What is WHOIS?</h2>
            <p class="text-xl text-gray-600 max-w-3xl mx-auto">Understanding WHOIS and domain information</p>
        </div>
        
        <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
            <div class="bg-white rounded-xl p-6 shadow-md">
                <h3 class="text-xl font-semibold text-gray-900 mb-4 flex items-center">
                    <svg class="w-6 h-6 text-blue-600 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                    </svg>
                    What is WHOIS?
                </h3>
                <p class="text-gray-600">WHOIS is a query and response protocol that is widely used for querying databases that store the registered users or assignees of an Internet resource, such as a domain name.</p>
            </div>
            
            <div class="bg-white rounded-xl p-6 shadow-md">
                <h3 class="text-xl font-semibold text-gray-900 mb-4 flex items-center">
                    <svg class="w-6 h-6 text-green-600 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                    </svg>
                    What Information is Available?
                </h3>
                <p class="text-gray-600">WHOIS provides information such as domain registration date, expiration date, registrar, registrant contact details, and DNS server information.</p>
            </div>
            
            <div class="bg-white rounded-xl p-6 shadow-md">
                <h3 class="text-xl font-semibold text-gray-900 mb-4 flex items-center">
                    <svg class="w-6 h-6 text-purple-600 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"/>
                    </svg>
                    Privacy Protection
                </h3>
                <p class="text-gray-600">Domain privacy protection (WHOIS privacy) hides your personal information from public WHOIS databases, protecting you from spam and identity theft.</p>
            </div>
            
            <div class="bg-white rounded-xl p-6 shadow-md">
                <h3 class="text-xl font-semibold text-gray-900 mb-4 flex items-center">
                    <svg class="w-6 h-6 text-orange-600 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"/>
                    </svg>
                    Why Use WHOIS Lookup?
                </h3>
                <p class="text-gray-600">Use WHOIS lookup to check domain availability before registration, verify domain ownership, research competitors, or investigate suspicious domains.</p>
            </div>
        </div>
    </section>

    <!-- CTA -->
    <section class="gradient-bg text-white py-16 rounded-2xl">
        <div class="text-center">
            <h2 class="text-3xl font-bold mb-4">Found an Available Domain?</h2>
            <p class="text-xl mb-8">Register it now with Afronex Host</p>
            <a href="{{ route('domains.register') }}" class="bg-white text-blue-600 px-8 py-4 rounded-lg hover:bg-gray-100 transition-colors font-semibold text-lg">
                Register Domain
            </a>
        </div>
    </section>
</div>

@section('scripts')
<script>
function lookupDomain() {
    const domain = document.getElementById('domainInput').value.trim();
    const resultsSection = document.getElementById('resultsSection');
    const resultsContent = document.getElementById('resultsContent');
    
    if (!domain) {
        alert('Please enter a domain name');
        return;
    }
    
    // Simulate WHOIS lookup (in production, this would call an API)
    resultsContent.innerHTML = `
        <div class="animate-pulse">
            <div class="h-4 bg-gray-200 rounded w-3/4 mb-4"></div>
            <div class="h-4 bg-gray-200 rounded w-1/2 mb-4"></div>
            <div class="h-4 bg-gray-200 rounded w-5/6 mb-4"></div>
            <div class="h-4 bg-gray-200 rounded w-2/3"></div>
        </div>
    `;
    resultsSection.classList.remove('hidden');
    
    setTimeout(() => {
        resultsContent.innerHTML = `
            <div class="space-y-4">
                <div class="flex justify-between items-center py-3 border-b border-gray-200">
                    <span class="font-semibold text-gray-700">Domain Name:</span>
                    <span class="text-gray-900">${domain}</span>
                </div>
                <div class="flex justify-between items-center py-3 border-b border-gray-200">
                    <span class="font-semibold text-gray-700">Status:</span>
                    <span class="text-green-600 font-semibold">Available</span>
                </div>
                <div class="flex justify-between items-center py-3 border-b border-gray-200">
                    <span class="font-semibold text-gray-700">Registrar:</span>
                    <span class="text-gray-900">-</span>
                </div>
                <div class="flex justify-between items-center py-3 border-b border-gray-200">
                    <span class="font-semibold text-gray-700">Registration Date:</span>
                    <span class="text-gray-900">-</span>
                </div>
                <div class="flex justify-between items-center py-3 border-b border-gray-200">
                    <span class="font-semibold text-gray-700">Expiration Date:</span>
                    <span class="text-gray-900">-</span>
                </div>
                <div class="flex justify-between items-center py-3">
                    <span class="font-semibold text-gray-700">Name Servers:</span>
                    <span class="text-gray-900">-</span>
                </div>
                <div class="mt-6 p-4 bg-green-50 rounded-lg border border-green-200">
                    <p class="text-green-800 font-semibold mb-2">🎉 This domain is available!</p>
                    <a href="{{ route('domains.register') }}" class="inline-block bg-green-600 text-white px-6 py-2 rounded-lg hover:bg-green-700 transition-colors font-semibold">
                        Register ${domain}
                    </a>
                </div>
            </div>
        `;
    }, 1500);
}

// Allow Enter key to trigger lookup
document.getElementById('domainInput').addEventListener('keypress', function(e) {
    if (e.key === 'Enter') {
        lookupDomain();
    }
});
</script>
@endsection
