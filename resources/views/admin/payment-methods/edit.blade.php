@extends('layouts.admin')

@section('title', 'Edit Bank Method')

@section('content')
<div class="max-w-3xl mx-auto">
    <div class="mb-8 bg-black/40 backdrop-blur-md p-8 rounded-3xl border border-white/10 shadow-2xl">
        <a href="{{ route('admin.payment-methods.index') }}" class="text-blue-400 hover:text-blue-300 font-extrabold flex items-center transition-colors text-sm uppercase tracking-wider">
            <svg class="h-4 w-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path></svg>
            Back to Bank Details
        </a>
        <h1 class="text-3xl font-black text-white mt-4 tracking-tight">Edit: {{ $paymentMethod->name }}</h1>
        <p class="text-slate-400 mt-1 font-semibold">Update the account details for this transfer method</p>
    </div>

    <div class="bg-black/40 backdrop-blur-md rounded-3xl shadow-2xl border border-white/10 p-8 md:p-10">
        @if ($errors->any())
        <div class="mb-6 p-4 bg-rose-500/10 border border-rose-500/30 rounded-2xl">
            <ul class="list-disc list-inside text-rose-400 text-sm font-semibold space-y-1">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
        @endif

        <form action="{{ route('admin.payment-methods.update', $paymentMethod->id) }}" method="POST" enctype="multipart/form-data" class="space-y-6">
            @csrf
            @method('PUT')
            <div class="grid grid-cols-1 gap-6">
                <div>
                    <label class="block text-xs font-black text-slate-300 uppercase tracking-widest mb-2">Method Name</label>
                    <div class="relative">
                        <select name="name" id="method-name" required
                                class="w-full px-4 py-3 bg-white/5 border border-white/10 rounded-xl focus:ring-2 focus:ring-blue-500 focus:border-blue-500 text-white font-semibold transition-all appearance-none cursor-pointer">
                            <option value="" disabled class="bg-gray-900 text-slate-400">Select a bank or payment method...</option>
                            <option value="CBE" {{ old('name', $paymentMethod->name) == 'CBE' ? 'selected' : '' }} class="bg-gray-900">Commercial Bank of Ethiopia</option>
                            <option value="Dashen" {{ old('name', $paymentMethod->name) == 'Dashen' ? 'selected' : '' }} class="bg-gray-900">Dashen Bank</option>
                            <option value="Abyssinia" {{ old('name', $paymentMethod->name) == 'Abyssinia' ? 'selected' : '' }} class="bg-gray-900">Bank of Abyssinia</option>
                            <option value="Awash" {{ old('name', $paymentMethod->name) == 'Awash' ? 'selected' : '' }} class="bg-gray-900">Awash Bank</option>
                            <option value="Wegagen" {{ old('name', $paymentMethod->name) == 'Wegagen' ? 'selected' : '' }} class="bg-gray-900">Wegagen Bank</option>
                            <option value="United" {{ old('name', $paymentMethod->name) == 'United' ? 'selected' : '' }} class="bg-gray-900">United Bank (Hibret)</option>
                            <option value="Nib" {{ old('name', $paymentMethod->name) == 'Nib' ? 'selected' : '' }} class="bg-gray-900">Nib International Bank</option>
                            <option value="Zemen" {{ old('name', $paymentMethod->name) == 'Zemen' ? 'selected' : '' }} class="bg-gray-900">Zemen Bank</option>
                            <option value="Oromia" {{ old('name', $paymentMethod->name) == 'Oromia' ? 'selected' : '' }} class="bg-gray-900">Oromia Bank (CBO)</option>
                            <option value="Berhan" {{ old('name', $paymentMethod->name) == 'Berhan' ? 'selected' : '' }} class="bg-gray-900">Berhan International Bank</option>
                            <option value="Abay" {{ old('name', $paymentMethod->name) == 'Abay' ? 'selected' : '' }} class="bg-gray-900">Abay Bank</option>
                            <option value="Debo" {{ old('name', $paymentMethod->name) == 'Debo' ? 'selected' : '' }} class="bg-gray-900">Debos Global Bank</option>
                            <option value="Telebirr" {{ old('name', $paymentMethod->name) == 'Telebirr' ? 'selected' : '' }} class="bg-gray-900">Telebirr</option>
                            <option value="M-Pesa" {{ old('name', $paymentMethod->name) == 'M-Pesa' ? 'selected' : '' }} class="bg-gray-900">M-Pesa</option>
                            <option value="HelloCash" {{ old('name', $paymentMethod->name) == 'HelloCash' ? 'selected' : '' }} class="bg-gray-900">HelloCash</option>
                            <option value="Amole" {{ old('name', $paymentMethod->name) == 'Amole' ? 'selected' : '' }} class="bg-gray-900">Amole</option>
                            @php
                                $knownBanks = ['CBE','Dashen','Abyssinia','Awash','Wegagen','United','Nib','Zemen','Oromia','Berhan','Abay','Debo','Telebirr','M-Pesa','HelloCash','Amole'];
                                $isCustomName = old('name', $paymentMethod->name) && !in_array(old('name', $paymentMethod->name), $knownBanks);
                            @endphp
                            <option value="__other__" {{ $isCustomName ? 'selected' : '' }} class="bg-gray-900 text-blue-400 font-bold">── Other (type your own) ──</option>
                        </select>
                        <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center pr-4">
                            <svg class="h-4 w-4 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path></svg>
                        </div>
                    </div>
                    <div id="custom-name-wrapper" class="mt-3 {{ $isCustomName ? '' : 'hidden' }}">
                        <input type="text" name="custom_name" id="custom-name-input" placeholder="Type the bank or payment method name..."
                               value="{{ $isCustomName ? old('name', $paymentMethod->name) : '' }}"
                               class="w-full px-4 py-3 bg-white/5 border border-white/10 rounded-xl focus:ring-2 focus:ring-blue-500 focus:border-blue-500 text-white placeholder-slate-500 font-semibold transition-all">
                    </div>
                </div>

                <div id="icon-upload" class="{{ $paymentMethod->name ? '' : 'hidden' }}">
                    <label class="block text-xs font-black text-slate-300 uppercase tracking-widest mb-2">Bank Icon (optional)</label>
                    <p class="text-xs text-slate-500 mb-2 font-medium">Upload the bank's logo or icon (PNG, JPG, SVG — max 2MB)</p>

                    @if($paymentMethod->icon)
                    <div class="mb-3 flex items-center gap-3 bg-white/5 p-3 rounded-xl border border-white/10">
                        <img src="{{ $paymentMethod->icon_url }}" alt="{{ $paymentMethod->name }}" class="h-10 w-10 object-contain rounded-lg border border-white/10 bg-white/5 p-1">
                        <span class="text-sm text-slate-400 font-medium">Current icon</span>
                    </div>
                    @endif

                    <div class="relative">
                        <input type="file" name="icon" accept="image/png,image/jpg,image/jpeg,image/svg+xml,image/webp"
                               class="w-full px-4 py-3 bg-white/5 border border-white/10 rounded-xl focus:ring-2 focus:ring-blue-500 focus:border-blue-500 text-slate-300 font-semibold transition-all file:mr-4 file:py-2 file:px-4 file:rounded-xl file:border-0 file:bg-blue-600 file:text-white file:font-black file:text-xs file:uppercase file:tracking-wider hover:file:bg-blue-500 cursor-pointer">
                    </div>
                    <div id="icon-preview" class="mt-3 hidden">
                        <p class="text-xs text-slate-500 mb-2 font-medium">Preview:</p>
                        <img id="icon-preview-img" src="" alt="Icon preview" class="h-12 w-12 object-contain rounded-xl border border-white/10 bg-white/5 p-1">
                    </div>
                </div>

                <div>
                    <label class="block text-xs font-black text-slate-300 uppercase tracking-widest mb-2">Account Number / Phone</label>
                    <input type="text" name="account_number" value="{{ old('account_number', $paymentMethod->account_number) }}" required 
                           class="w-full px-4 py-3 bg-white/5 border border-white/10 rounded-xl focus:ring-2 focus:ring-blue-500 focus:border-blue-500 text-white placeholder-slate-500 font-semibold transition-all font-mono">
                </div>

                <div>
                    <label class="block text-xs font-black text-slate-300 uppercase tracking-widest mb-2">Account Holder Name</label>
                    <input type="text" name="account_name" value="{{ old('account_name', $paymentMethod->account_name) }}" required 
                           class="w-full px-4 py-3 bg-white/5 border border-white/10 rounded-xl focus:ring-2 focus:ring-blue-500 focus:border-blue-500 text-white placeholder-slate-500 font-semibold transition-all">
                </div>

                <div>
                    <label class="block text-xs font-black text-slate-300 uppercase tracking-widest mb-2">Instructions (optional)</label>
                    <textarea name="instructions" rows="4" 
                              class="w-full px-4 py-3 bg-white/5 border border-white/10 rounded-xl focus:ring-2 focus:ring-blue-500 focus:border-blue-500 text-white placeholder-slate-500 font-semibold transition-all">{{ old('instructions', $paymentMethod->instructions) }}</textarea>
                </div>

                @php
                    $applicable = old('applicable_to', $paymentMethod->applicable_to ? explode(',', $paymentMethod->applicable_to) : ['all']);
                @endphp
                @php
                    $selectedProviders = old('applicable_providers', $paymentMethod->applicable_providers ? explode(',', $paymentMethod->applicable_providers) : []);
                @endphp
                <div>
                    <label class="block text-xs font-black text-slate-300 uppercase tracking-widest mb-3">Applies To Package Types</label>
                    <div class="grid grid-cols-2 md:grid-cols-4 gap-3">
                        <label class="flex items-center gap-3 bg-white/5 p-3 rounded-xl border border-white/10 cursor-pointer hover:border-blue-500/30 transition-colors">
                            <input type="checkbox" name="applicable_to[]" value="hosting" {{ in_array('hosting', $applicable) || in_array('all', $applicable) ? 'checked' : '' }}
                                   class="h-4 w-4 text-blue-600 focus:ring-blue-500 border-white/10 bg-black/40 rounded cursor-pointer applicable-type">
                            <span class="text-sm font-bold text-slate-300">Hosting</span>
                        </label>
                        <label class="flex items-center gap-3 bg-white/5 p-3 rounded-xl border border-white/10 cursor-pointer hover:border-blue-500/30 transition-colors">
                            <input type="checkbox" name="applicable_to[]" value="domain" {{ in_array('domain', $applicable) || in_array('all', $applicable) ? 'checked' : '' }}
                                   class="h-4 w-4 text-blue-600 focus:ring-blue-500 border-white/10 bg-black/40 rounded cursor-pointer applicable-type">
                            <span class="text-sm font-bold text-slate-300">Domain</span>
                        </label>
                        <label class="flex items-center gap-3 bg-white/5 p-3 rounded-xl border border-white/10 cursor-pointer hover:border-blue-500/30 transition-colors">
                            <input type="checkbox" name="applicable_to[]" value="services" {{ in_array('services', $applicable) || in_array('all', $applicable) ? 'checked' : '' }}
                                   class="h-4 w-4 text-blue-600 focus:ring-blue-500 border-white/10 bg-black/40 rounded cursor-pointer applicable-type" id="cb-services">
                            <span class="text-sm font-bold text-slate-300">Services</span>
                        </label>
                        <label class="flex items-center gap-3 bg-white/5 p-3 rounded-xl border border-white/10 cursor-pointer hover:border-blue-500/30 transition-colors">
                            <input type="checkbox" name="applicable_to[]" value="all" {{ in_array('all', $applicable) ? 'checked' : '' }}
                                   class="h-4 w-4 text-blue-600 focus:ring-blue-500 border-white/10 bg-black/40 rounded cursor-pointer applicable-type">
                            <span class="text-sm font-bold text-slate-300">All Types</span>
                        </label>
                    </div>
                    <p class="text-xs text-slate-500 mt-2 font-medium">Select which package types this payment method applies to. If "All Types" is checked, others are ignored.</p>
                </div>

                @php
                    $selectedPackageIds = old('applicable_package_ids', $paymentMethod->applicable_package_ids ? explode(',', $paymentMethod->applicable_package_ids) : []);
                    $servicePkgs = \App\Models\Package::where('type', 'services')->orderBy('provider')->orderBy('name')->get()->groupBy('provider');
                @endphp
                <div id="services-section" class="{{ in_array('services', $applicable) && !in_array('all', $applicable) ? '' : 'hidden' }}">
                    <label class="block text-xs font-black text-slate-300 uppercase tracking-widest mb-3">Service Providers & Packages</label>
                    <p class="text-xs text-slate-500 mb-3 font-medium">Check a provider to reveal its packages. Check individual packages, or leave provider checked with no packages to apply to all its services.</p>
                    <div class="space-y-3 max-h-96 overflow-y-auto bg-white/5 rounded-2xl p-4 border border-white/10">
                        @foreach($servicePkgs as $prov => $pkgs)
                        @php
                            $provChecked = in_array($prov, $selectedProviders);
                        @endphp
                        <div class="bg-black/30 rounded-xl border border-white/10 overflow-hidden">
                            <label class="flex items-center gap-3 p-4 cursor-pointer hover:bg-white/5 transition-colors provider-toggle">
                                <input type="checkbox" name="applicable_providers[]" value="{{ $prov }}" {{ $provChecked ? 'checked' : '' }}
                                       class="h-4 w-4 text-blue-600 focus:ring-blue-500 border-white/10 bg-black/40 rounded cursor-pointer applicable-provider">
                                <span class="text-sm font-black text-slate-300 uppercase tracking-wider">{{ $prov }}</span>
                                <svg class="w-4 h-4 text-slate-500 ml-auto chevron transition-transform {{ $provChecked ? 'rotate-180' : '' }}" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path></svg>
                            </label>
                            <div class="provider-packages {{ $provChecked ? '' : 'hidden' }} border-t border-white/10 p-4">
                                <div class="grid grid-cols-1 md:grid-cols-2 gap-2">
                                    @foreach($pkgs as $pkg)
                                    <label class="flex items-center gap-3 bg-black/40 p-2.5 rounded-xl border border-white/5 cursor-pointer hover:border-blue-500/30 transition-colors">
                                        <input type="checkbox" name="applicable_package_ids[]" value="{{ $pkg->id }}" {{ in_array((string) $pkg->id, $selectedPackageIds) ? 'checked' : '' }}
                                               class="h-4 w-4 text-blue-600 focus:ring-blue-500 border-white/10 bg-black/40 rounded cursor-pointer">
                                        <span class="text-sm font-semibold text-slate-300">{{ $pkg->name }}</span>
                                    </label>
                                    @endforeach
                                </div>
                                <p class="text-[10px] text-slate-500 mt-2 font-medium">If no packages are checked, this method applies to <strong class="text-slate-400">all {{ $prov }}</strong> packages.</p>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>

                <div class="flex items-center bg-white/5 p-5 rounded-2xl border border-white/10">
                    <input type="checkbox" name="is_active" id="is_active" {{ old('is_active', $paymentMethod->is_active) ? 'checked' : '' }} 
                           class="h-5 w-5 text-blue-600 focus:ring-blue-500 border-white/10 bg-black/40 rounded cursor-pointer">
                    <label for="is_active" class="ml-3 block text-sm font-bold text-slate-300 cursor-pointer">Method is Active</label>
                </div>

                <div class="pt-4">
                    <button type="submit" class="w-full bg-gradient-to-r from-blue-600 to-purple-600 hover:from-blue-500 hover:to-purple-500 text-white px-6 py-4 rounded-2xl font-black text-lg shadow-lg shadow-blue-500/25 hover:shadow-blue-500/40 transition-all transform hover:-translate-y-0.5">
                        Update Bank Method
                    </button>
                </div>
            </div>
        </form>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    var checks = document.querySelectorAll('input[name="applicable_to[]"]');
    var servicesCheck = document.getElementById('cb-services');
    var servicesSection = document.getElementById('services-section');

    function toggleSections() {
        var allChecked = document.querySelector('input[name="applicable_to[]"][value="all"]:checked');
        var servicesChecked = servicesCheck && servicesCheck.checked;
        servicesSection.classList.toggle('hidden', !(servicesChecked && !allChecked));
    }

    checks.forEach(function(cb) {
        cb.addEventListener('change', function() {
            if (this.value === 'all' && this.checked) {
                checks.forEach(function(c) {
                    if (c.value !== 'all') c.checked = false;
                });
            } else if (this.checked) {
                var allCheck = document.querySelector('input[name="applicable_to[]"][value="all"]');
                if (allCheck) allCheck.checked = false;
            }
            toggleSections();
        });
    });

    toggleSections();

    // Show icon upload & custom name when a bank method is selected
    var methodSelect = document.getElementById('method-name');
    var iconUpload = document.getElementById('icon-upload');
    var customNameWrapper = document.getElementById('custom-name-wrapper');
    var customNameInput = document.getElementById('custom-name-input');
    if (methodSelect && iconUpload) {
        methodSelect.addEventListener('change', function() {
            var isOther = this.value === '__other__';
            customNameWrapper.classList.toggle('hidden', !isOther);
            iconUpload.classList.toggle('hidden', !this.value);
            if (isOther) {
                customNameInput.focus();
            }
        });
    }

    // On submit, if "__other__" selected, use the custom name value
    document.querySelector('form').addEventListener('submit', function() {
        if (methodSelect.value === '__other__') {
            methodSelect.value = customNameInput.value.trim();
        }
    });

    // Preview selected icon
    var iconInput = document.querySelector('input[name="icon"]');
    if (iconInput) {
        iconInput.addEventListener('change', function(e) {
            var preview = document.getElementById('icon-preview');
            var img = document.getElementById('icon-preview-img');
            if (this.files && this.files[0]) {
                var reader = new FileReader();
                reader.onload = function(ev) {
                    img.src = ev.target.result;
                    if (preview) preview.classList.remove('hidden');
                };
                reader.readAsDataURL(this.files[0]);
            } else {
                if (preview) preview.classList.add('hidden');
                if (img) img.src = '';
            }
        });
    }

    document.querySelectorAll('.applicable-provider').forEach(function(cb) {
        cb.addEventListener('change', function() {
            var container = this.closest('.provider-toggle').parentNode;
            var packages = container.querySelector('.provider-packages');
            var chevron = container.querySelector('.chevron');
            if (this.checked) {
                packages.classList.remove('hidden');
                chevron.classList.add('rotate-180');
            } else {
                packages.classList.add('hidden');
                chevron.classList.remove('rotate-180');
            }
        });
    });
});
</script>
@endsection
