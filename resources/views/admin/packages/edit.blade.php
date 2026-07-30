@extends('layouts.admin')

@section('title', 'Edit Package')

@section('content')
<div class="max-w-3xl mx-auto">
    <div class="mb-8">
        <a href="{{ route('admin.packages.index') }}" class="text-blue-600 hover:text-blue-800 font-medium flex items-center">
            <svg class="h-4 w-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path></svg>
            Back to Packages
        </a>
        <h1 class="text-3xl font-bold text-gray-900 mt-4">Edit Package: {{ $package->name }}</h1>
        <p class="text-gray-500 mt-1">Update the details for this service plan</p>
    </div>

    <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-8">
        <form action="{{ route('admin.packages.update', $package->id) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="grid grid-cols-1 gap-6">
                <div>
                    <label class="block text-sm font-bold text-gray-700 mb-1">Package Name (Drop & Add)</label>
                    <input type="text" name="name" value="{{ $package->name }}" list="server-names" required 
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
                </div>

                <div>
                    <label class="block text-sm font-bold text-gray-700 mb-1">Type</label>
                    <select name="type" id="type-select" required onchange="toggleProviderField()" class="mt-1 block w-full rounded-lg border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 border p-3 bg-gray-50">
                        <option value="hosting" {{ $package->type === 'hosting' ? 'selected' : '' }}>Hosting</option>
                        <option value="domain" {{ $package->type === 'domain' ? 'selected' : '' }}>Domain</option>
                        <option value="services" {{ $package->type === 'services' ? 'selected' : '' }}>Services</option>
                    </select>
                </div>

                <div id="provider-field" class="{{ $package->type === 'services' ? '' : 'hidden' }}">
                    <label class="block text-sm font-bold text-gray-700 mb-1">Provider / Category</label>
                    <input type="text" name="provider" list="provider-names" value="{{ $package->provider ?? '' }}"
                           class="mt-1 block w-full rounded-lg border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 border p-3 bg-gray-50">
                    <datalist id="provider-names">
                        <option value="Schools & Universities">
                        <option value="Hospitals & Clinics">
                        <option value="Governmental Institutions">
                        <option value="Private Businesses">
                        <option value="NGOs & Non-Profits">
                        <option value="Religious Organizations">
                    </datalist>
                    <p class="text-xs text-gray-400 mt-1">Group this service under a provider category.</p>
                </div>

                <div>
                    <label class="block text-sm font-bold text-gray-700 mb-1">Description</label>
                    <textarea name="description" rows="4" required class="mt-1 block w-full rounded-lg border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 border p-3 bg-gray-50">{{ $package->description }}</textarea>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div>
                        <label class="block text-sm font-bold text-gray-700 mb-1">Price</label>
                        <input type="number" step="0.01" name="price" value="{{ $package->price }}" required 
                               class="mt-1 block w-full rounded-lg border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 border p-3 bg-gray-50">
                    </div>
                    <div>
                        <label class="block text-sm font-bold text-gray-700 mb-1">Currency</label>
                        <input type="text" name="currency" value="{{ $package->currency }}" required 
                               class="mt-1 block w-full rounded-lg border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 border p-3 bg-gray-50 font-bold text-blue-600">
                    </div>
                </div>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div>
                        <label class="block text-sm font-bold text-gray-700 mb-1">Registration Fee (one-time)</label>
                        <input type="number" step="0.01" name="registration_fee" value="{{ $package->registration_fee ?? 0 }}"
                               class="mt-1 block w-full rounded-lg border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 border p-3 bg-gray-50">
                    </div>
                    <div>
                        <label class="block text-sm font-bold text-gray-700 mb-1">Monthly Fee (recurring)</label>
                        <input type="number" step="0.01" name="monthly_fee" value="{{ $package->monthly_fee ?? 0 }}"
                               class="mt-1 block w-full rounded-lg border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 border p-3 bg-gray-50">
                    </div>
                </div>

                <div id="features-field">
                    <label class="block text-sm font-bold text-gray-700 mb-1">
                        @if($package->type === 'services') Service Levels (one per line: Name | Fee) @else Features (comma separated) @endif
                    </label>
                    @if($package->type === 'services')
                    @php
                        $levelsText = '';
                        if (is_array($package->features) && isset($package->features['levels'])) {
                            $lines = [];
                            foreach ($package->features['levels'] as $level) {
                                $lines[] = ($level['name'] ?? '') . ' | ' . ($level['fee'] ?? 0);
                            }
                            $levelsText = implode("\n", $lines);
                        }
                    @endphp
                    <textarea name="features" rows="6" class="mt-1 block w-full rounded-lg border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 border p-3 bg-gray-50">{{ $levelsText }}</textarea>
                    <p class="text-xs text-gray-400 mt-1">Format: Level Name | Fee (one per line). Example: Outpatient Service | 500</p>
                    @else
                    <input type="text" name="features" value="{{ is_array($package->features) ? implode(', ', array_filter($package->features, 'is_string')) : $package->features }}" 
                           class="mt-1 block w-full rounded-lg border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 border p-3 bg-gray-50">
                    @endif
                </div>

                <div class="flex items-center bg-gray-50 p-4 rounded-lg border border-gray-100">
                    <input type="checkbox" name="is_active" id="is_active" {{ $package->is_active ? 'checked' : '' }} 
                           class="h-5 w-5 text-blue-600 focus:ring-blue-500 border-gray-300 rounded cursor-pointer">
                    <label for="is_active" class="ml-3 block text-sm font-medium text-gray-700 cursor-pointer">Package is Active</label>
                </div>

                <div class="pt-6">
                    <button type="submit" class="w-full bg-blue-600 text-white px-6 py-4 rounded-lg hover:bg-blue-700 font-bold text-lg shadow-lg shadow-blue-200 transition-all">
                        Update Package
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
