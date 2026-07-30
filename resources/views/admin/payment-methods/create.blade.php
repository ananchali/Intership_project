@extends('layouts.admin')

@section('title', 'Add Bank Method')

@section('content')
<div class="max-w-3xl mx-auto">
    <div class="mb-8 bg-black/40 backdrop-blur-md p-8 rounded-3xl border border-white/10 shadow-2xl">
        <a href="{{ route('admin.payment-methods.index') }}" class="text-blue-400 hover:text-blue-300 font-extrabold flex items-center transition-colors text-sm uppercase tracking-wider">
            <svg class="h-4 w-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path></svg>
            Back to Bank Details
        </a>
        <h1 class="text-3xl font-black text-white mt-4 tracking-tight">Add New Bank Account</h1>
        <p class="text-slate-400 mt-1 font-semibold">Add a new destination for customer transfers</p>
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

        <form action="{{ route('admin.payment-methods.store') }}" method="POST" enctype="multipart/form-data" class="space-y-6">
            @csrf
            <div class="grid grid-cols-1 gap-6">
                <div>
                    <label class="block text-xs font-black text-slate-300 uppercase tracking-widest mb-2">Method Name</label>
                    <div class="relative">
                        <select name="name" id="method-name" required
                                class="w-full px-4 py-3 bg-white/5 border border-white/10 rounded-xl focus:ring-2 focus:ring-blue-500 focus:border-blue-500 text-white font-semibold transition-all appearance-none cursor-pointer">
                            <option value="" disabled selected class="bg-gray-900 text-slate-400">Select a bank or payment method...</option>
                            <option value="CBE" class="bg-gray-900">Commercial Bank of Ethiopia</option>
                            <option value="Dashen" class="bg-gray-900">Dashen Bank</option>
                            <option value="Abyssinia" class="bg-gray-900">Bank of Abyssinia</option>
                            <option value="Awash" class="bg-gray-900">Awash Bank</option>
                            <option value="Wegagen" class="bg-gray-900">Wegagen Bank</option>
                            <option value="United" class="bg-gray-900">United Bank (Hibret)</option>
                            <option value="Nib" class="bg-gray-900">Nib International Bank</option>
                            <option value="Zemen" class="bg-gray-900">Zemen Bank</option>
                            <option value="Oromia" class="bg-gray-900">Oromia Bank (CBO)</option>
                            <option value="Berhan" class="bg-gray-900">Berhan International Bank</option>
                            <option value="Abay" class="bg-gray-900">Abay Bank</option>
                            <option value="Debo" class="bg-gray-900">Debos Global Bank</option>
                            <option value="Telebirr" class="bg-gray-900">Telebirr</option>
                            <option value="M-Pesa" class="bg-gray-900">M-Pesa</option>
                            <option value="HelloCash" class="bg-gray-900">HelloCash</option>
                            <option value="Amole" class="bg-gray-900">Amole</option>
                            <option value="__other__" class="bg-gray-900 text-blue-400 font-bold">── Other (type your own) ──</option>
                        </select>
                        <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center pr-4">
                            <svg class="h-4 w-4 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path></svg>
                        </div>
                    </div>
                    <div id="custom-name-wrapper" class="mt-3 hidden">
                        <input type="text" name="custom_name" id="custom-name-input" placeholder="Type the bank or payment method name..."
                               class="w-full px-4 py-3 bg-white/5 border border-white/10 rounded-xl focus:ring-2 focus:ring-blue-500 focus:border-blue-500 text-white placeholder-slate-500 font-semibold transition-all">
                    </div>
                </div>

                <div id="icon-upload" class="hidden">
                    <label class="block text-xs font-black text-slate-300 uppercase tracking-widest mb-2">Bank Icon (optional)</label>
                    <p class="text-xs text-slate-500 mb-2 font-medium">Upload the bank's logo or icon (PNG, JPG, SVG — max 2MB)</p>
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
                    <input type="text" name="account_number" required placeholder="Enter the account number" 
                           class="w-full px-4 py-3 bg-white/5 border border-white/10 rounded-xl focus:ring-2 focus:ring-blue-500 focus:border-blue-500 text-white placeholder-slate-500 font-semibold transition-all font-mono">
                </div>

                <div>
                    <label class="block text-xs font-black text-slate-300 uppercase tracking-widest mb-2">Account Holder Name</label>
                    <input type="text" name="account_name" required placeholder="The name on the account" 
                           class="w-full px-4 py-3 bg-white/5 border border-white/10 rounded-xl focus:ring-2 focus:ring-blue-500 focus:border-blue-500 text-white placeholder-slate-500 font-semibold transition-all">
                </div>

                <div>
                    <label class="block text-xs font-black text-slate-300 uppercase tracking-widest mb-2">Instructions (optional)</label>
                    <textarea name="instructions" rows="4" placeholder="e.g. Please include your order number in the reference." 
                              class="w-full px-4 py-3 bg-white/5 border border-white/10 rounded-xl focus:ring-2 focus:ring-blue-500 focus:border-blue-500 text-white placeholder-slate-500 font-semibold transition-all"></textarea>
                </div>

                <div>
                    <label class="block text-xs font-black text-slate-300 uppercase tracking-widest mb-3">Applies To Package Types</label>
                    <div class="grid grid-cols-2 md:grid-cols-4 gap-3">
                        <label class="flex items-center gap-3 bg-white/5 p-3 rounded-xl border border-white/10 cursor-pointer hover:border-blue-500/30 transition-colors">
                            <input type="checkbox" name="applicable_to[]" value="hosting"
                                   class="h-4 w-4 text-blue-600 focus:ring-blue-500 border-white/10 bg-black/40 rounded cursor-pointer applicable-type">
                            <span class="text-sm font-bold text-slate-300">Hosting</span>
                        </label>
                        <label class="flex items-center gap-3 bg-white/5 p-3 rounded-xl border border-white/10 cursor-pointer hover:border-blue-500/30 transition-colors">
                            <input type="checkbox" name="applicable_to[]" value="domain"
                                   class="h-4 w-4 text-blue-600 focus:ring-blue-500 border-white/10 bg-black/40 rounded cursor-pointer applicable-type">
                            <span class="text-sm font-bold text-slate-300">Domain</span>
                        </label>
                        <label class="flex items-center gap-3 bg-white/5 p-3 rounded-xl border border-white/10 cursor-pointer hover:border-blue-500/30 transition-colors">
                            <input type="checkbox" name="applicable_to[]" value="services"
                                   class="h-4 w-4 text-blue-600 focus:ring-blue-500 border-white/10 bg-black/40 rounded cursor-pointer applicable-type" id="cb-services">
                            <span class="text-sm font-bold text-slate-300">Services</span>
                        </label>
                        <label class="flex items-center gap-3 bg-white/5 p-3 rounded-xl border border-white/10 cursor-pointer hover:border-blue-500/30 transition-colors">
                            <input type="checkbox" name="applicable_to[]" value="all"
                                   class="h-4 w-4 text-blue-600 focus:ring-blue-500 border-white/10 bg-black/40 rounded cursor-pointer applicable-type">
                            <span class="text-sm font-bold text-slate-300">All Types</span>
                        </label>
                    </div>
                    <p class="text-xs text-slate-500 mt-2 font-medium">Select which package types this payment method applies to. If "All Types" is checked, others are ignored.</p>
                </div>

                <div id="services-section" class="hidden">
                    <label class="block text-xs font-black text-slate-300 uppercase tracking-widest mb-3">Service Providers & Packages</label>
                    <p class="text-xs text-slate-500 mb-3 font-medium">Check a provider to reveal its packages. Check individual packages, or leave provider checked with no packages to apply to all its services.</p>
                    <div class="space-y-3 max-h-96 overflow-y-auto bg-white/5 rounded-2xl p-4 border border-white/10">
                        @php
                            $servicePkgs = \App\Models\Package::where('type', 'services')->orderBy('provider')->orderBy('name')->get()->groupBy('provider');
                        @endphp
                        @foreach($servicePkgs as $prov => $pkgs)
                        <div class="bg-black/30 rounded-xl border border-white/10 overflow-hidden">
                            <label class="flex items-center gap-3 p-4 cursor-pointer hover:bg-white/5 transition-colors provider-toggle">
                                <input type="checkbox" name="applicable_providers[]" value="{{ $prov }}"
                                       class="h-4 w-4 text-blue-600 focus:ring-blue-500 border-white/10 bg-black/40 rounded cursor-pointer applicable-provider">
                                <span class="text-sm font-black text-slate-300 uppercase tracking-wider">{{ $prov }}</span>
                                <svg class="w-4 h-4 text-slate-500 ml-auto chevron transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path></svg>
                            </label>
                            <div class="provider-packages hidden border-t border-white/10 p-4">
                                <div class="grid grid-cols-1 md:grid-cols-2 gap-2">
                                    @foreach($pkgs as $pkg)
                                    <label class="flex items-center gap-3 bg-black/40 p-2.5 rounded-xl border border-white/5 cursor-pointer hover:border-blue-500/30 transition-colors">
                                        <input type="checkbox" name="applicable_package_ids[]" value="{{ $pkg->id }}"
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
                    <input type="checkbox" name="is_active" id="is_active" checked 
                           class="h-5 w-5 text-blue-600 focus:ring-blue-500 border-white/10 bg-black/40 rounded cursor-pointer">
                    <label for="is_active" class="ml-3 block text-sm font-bold text-slate-300 cursor-pointer">Make this method active for customers</label>
                </div>

                <div class="pt-4">
                    <button type="submit" class="w-full bg-gradient-to-r from-blue-600 to-purple-600 hover:from-blue-500 hover:to-purple-500 text-white px-6 py-4 rounded-2xl font-black text-lg shadow-lg shadow-blue-500/25 hover:shadow-blue-500/40 transition-all transform hover:-translate-y-0.5">
                        Create Payment Method
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
    methodSelect.addEventListener('change', function() {
        var isOther = this.value === '__other__';
        customNameWrapper.classList.toggle('hidden', !isOther);
        iconUpload.classList.toggle('hidden', !this.value);
        if (isOther) {
            customNameInput.focus();
        }
    });

    // On submit, if "__other__" selected, use the custom name value
    document.querySelector('form').addEventListener('submit', function() {
        if (methodSelect.value === '__other__') {
            methodSelect.value = customNameInput.value.trim();
        }
        validateForm(this);
    });

    // Client-side validation
    function validateForm(form) {
        var valid = true;
        form.querySelectorAll('[required]').forEach(function(el) {
            var container = el.closest('div');
            var existing = container.querySelector('.field-error');
            if (!el.value) {
                if (!existing) {
                    var label = container.querySelector('label')?.textContent?.replace('*', '').trim() || el.name;
                    var err = document.createElement('p');
                    err.className = 'field-error mt-1.5 text-xs font-semibold text-rose-400 flex items-center gap-1';
                    err.innerHTML = '<svg class="w-3.5 h-3.5 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z" clip-rule="evenodd"/></svg> ' + label + ' is required';
                    container.appendChild(err);
                }
                el.classList.add('border-rose-500');
                valid = false;
            } else {
                if (existing) existing.remove();
                el.classList.remove('border-rose-500');
            }
        });
        if (!valid) {
            event.preventDefault();
            return false;
        }
    }

    // Real-time validation on blur
    document.querySelectorAll('input[required], select[required]').forEach(function(el) {
        el.addEventListener('blur', function() {
            var container = this.closest('div');
            var existing = container.querySelector('.field-error');
            if (!this.value) {
                if (!existing) {
                    var label = container.querySelector('label')?.textContent?.replace('*', '').trim() || this.name;
                    var err = document.createElement('p');
                    err.className = 'field-error mt-1.5 text-xs font-semibold text-rose-400 flex items-center gap-1';
                    err.innerHTML = '<svg class="w-3.5 h-3.5 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z" clip-rule="evenodd"/></svg> ' + label + ' is required';
                    container.appendChild(err);
                }
                this.classList.add('border-rose-500');
            } else {
                if (existing) existing.remove();
                this.classList.remove('border-rose-500');
            }
        });
        el.addEventListener('input', function() {
            var container = this.closest('div');
            var existing = container.querySelector('.field-error');
            if (this.value) {
                if (existing) existing.remove();
                this.classList.remove('border-rose-500');
            }
        });
    });

    // Preview selected icon
    document.querySelector('input[name="icon"]').addEventListener('change', function(e) {
        var preview = document.getElementById('icon-preview');
        var img = document.getElementById('icon-preview-img');
        if (this.files && this.files[0]) {
            var reader = new FileReader();
            reader.onload = function(ev) {
                img.src = ev.target.result;
                preview.classList.remove('hidden');
            };
            reader.readAsDataURL(this.files[0]);
        } else {
            preview.classList.add('hidden');
            img.src = '';
        }
    });

    // Cascade: provider checkbox toggles its package list
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
