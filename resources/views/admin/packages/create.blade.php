@extends('layouts.admin')

@section('title', 'Add New Package')

@section('content')
<div class="max-w-3xl mx-auto">
    <div class="mb-8">
        <a href="{{ route('admin.packages.index') }}" class="text-blue-600 hover:text-blue-800 font-medium flex items-center">
            <svg class="h-4 w-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path></svg>
            Back to Packages
        </a>
        <h1 class="text-3xl font-bold text-gray-900 mt-4">Create New Package</h1>
        <p class="text-gray-500 mt-1">Define a new hosting plan or domain service</p>
    </div>

    <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-8">
        <form action="{{ route('admin.packages.store') }}" method="POST">
            @csrf
            <div class="grid grid-cols-1 gap-6">
                <div>
                    <label class="block text-sm font-bold text-gray-700 mb-1">Package/Server Name (Drop & Add)</label>
                    <input type="text" name="name" list="server-names" required placeholder="Select or type a name..." 
                           class="mt-1 block w-full rounded-lg border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 border p-3 bg-gray-50">
                    <datalist id="server-names">
                        <option value="Basic Hosting">
                        <option value="Premium Hosting">
                        <option value="Business Cloud">
                        <option value="Starter VPS">
                        <option value="Pro VPS">
                        <option value="Dedicated Server">
                        <option value=".com Domain">
                        <option value=".net Domain">
                        <option value=".et Domain">
                        <option value="Schools & Universities">
                        <option value="Hospitals & Clinics">
                        <option value="Governmental Organizations">
                        <option value="Private Businesses">
                    </datalist>
                    <p class="text-xs text-gray-400 mt-1">Select a name from the list or type your own custom name.</p>
                </div>

                <div>
                    <label class="block text-sm font-bold text-gray-700 mb-1">Service Type</label>
                    <select name="type" id="type-select" required onchange="toggleProviderField()" class="mt-1 block w-full rounded-lg border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 border p-3 bg-gray-50">
                        <option value="hosting">Web Hosting</option>
                        <option value="domain">Domain Name</option>
                        <option value="services">Services</option>
                    </select>
                </div>

                <div id="provider-field" class="hidden">
                    <label class="block text-sm font-bold text-gray-700 mb-1">Provider / Category</label>
                    <input type="text" name="provider" list="provider-names" placeholder="e.g. Schools & Universities"
                           class="mt-1 block w-full rounded-lg border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 border p-3 bg-gray-50">
                    <datalist id="provider-names">
                        <option value="Schools & Universities">
                        <option value="Hospitals & Clinics">
                        <option value="Governmental Institutions">
                        <option value="Private Businesses">
                        <option value="NGOs & Non-Profits">
                        <option value="Religious Organizations">
                    </datalist>
                    <p class="text-xs text-gray-400 mt-1">Group this service under a provider category. Each provider can have multiple service plans.</p>
                </div>

                <div>
                    <label class="block text-sm font-bold text-gray-700 mb-1">Detailed Description</label>
                    <textarea name="description" rows="4" required placeholder="What's included in this package?" 
                              class="mt-1 block w-full rounded-lg border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 border p-3 bg-gray-50"></textarea>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                    <div>
                        <label class="block text-sm font-bold text-gray-700 mb-1">Price</label>
                        <div class="relative">
                            <input type="number" step="0.01" name="price" required 
                                   class="mt-1 block w-full rounded-lg border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 border p-3 pl-10 bg-gray-50">
                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                <span class="text-gray-400">$</span>
                            </div>
                        </div>
                    </div>
                    <div>
                        <label class="block text-sm font-bold text-gray-700 mb-1">Currency</label>
                        <input type="text" name="currency" value="ETB" required 
                               class="mt-1 block w-full rounded-lg border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 border p-3 bg-gray-50 font-bold text-blue-600">
                    </div>
                </div>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div>
                        <label class="block text-sm font-bold text-gray-700 mb-1">Registration Fee (one-time)</label>
                        <div class="relative">
                            <input type="number" step="0.01" name="registration_fee" value="0"
                                   class="mt-1 block w-full rounded-lg border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 border p-3 pl-10 bg-gray-50">
                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                <span class="text-gray-400">$</span>
                            </div>
                        </div>
                        <p class="text-xs text-gray-400 mt-1">For services: one-time signup fee</p>
                    </div>
                    <div>
                        <label class="block text-sm font-bold text-gray-700 mb-1">Monthly Fee (recurring)</label>
                        <div class="relative">
                            <input type="number" step="0.01" name="monthly_fee" value="0"
                                   class="mt-1 block w-full rounded-lg border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 border p-3 pl-10 bg-gray-50">
                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                <span class="text-gray-400">$</span>
                            </div>
                        </div>
                        <p class="text-xs text-gray-400 mt-1">For services: monthly subscription fee</p>
                    </div>
                </div>

                <div>
                    <label class="block text-sm font-bold text-gray-700 mb-1">Features</label>
                    <textarea name="features" id="features-input" rows="4" 
                           class="mt-1 block w-full rounded-lg border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 border p-3 bg-gray-50">{{ old('features') }}</textarea>
                    <p id="features-hint" class="text-xs text-gray-400 mt-1">For hosting/domain: comma separated (e.g. 1GB RAM, Free SSL). For services: one level per line - Name | Fee (e.g. Kindergarten | 1500)</p>
                </div>
                <script>
                document.getElementById('type-select')?.addEventListener('change', function() {
                    const hint = document.getElementById('features-hint');
                    if (this.value === 'services') {
                        hint.textContent = 'One level per line: Name | Fee. Example: Kindergarten | 1500';
                    } else {
                        hint.textContent = 'Comma separated list of features. Example: 1GB RAM, 20GB SSD, Free SSL';
                    }
                });
                </script>

                <div class="flex items-center bg-gray-50 p-4 rounded-lg border border-gray-100">
                    <input type="checkbox" name="is_active" id="is_active" checked 
                           class="h-5 w-5 text-blue-600 focus:ring-blue-500 border-gray-300 rounded cursor-pointer">
                    <label for="is_active" class="ml-3 block text-sm font-medium text-gray-700 cursor-pointer">Make this package active immediately</label>
                </div>

                <div class="pt-6">
                    <button type="submit" class="w-full bg-blue-600 text-white px-6 py-4 rounded-lg hover:bg-blue-700 font-bold text-lg shadow-lg shadow-blue-200 transition-all">
                        Create Package
                    </button>
                </div>
            </div>
        </form>
    </div>
</div>

<script>
function toggleProviderField() {
    const type = document.getElementById('type-select').value;
    document.getElementById('provider-field').classList.toggle('hidden', type !== 'services');
}
</script>
@endsection
