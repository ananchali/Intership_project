<div class="bg-white rounded-2xl shadow-lg p-8 hover:shadow-2xl transition-all duration-300 transform hover:-translate-y-2 border border-gray-100 flex flex-col">
    <div class="flex justify-between items-start mb-4">
        <h3 class="text-2xl font-bold text-gray-900">{{ $package->name }}</h3>
        @if($loop->first)
        <span class="bg-green-100 text-green-800 text-sm font-semibold px-3 py-1 rounded-full">Popular</span>
        @endif
    </div>
    @if($package->description)
    <p class="text-gray-500 text-sm mb-4">{{ $package->description }}</p>
    @endif
    @if($package->registration_fee || $package->monthly_fee)
    <div class="space-y-1 mb-4">
        @if($package->registration_fee)
        <div class="text-lg text-gray-700"><span class="font-medium">Registration:</span> {{ number_format($package->registration_fee) }} {{ $package->currency }}</div>
        @endif
        @if($package->monthly_fee)
        <div class="text-lg text-gray-700"><span class="font-medium">Monthly:</span> {{ number_format($package->monthly_fee) }} {{ $package->currency }}</div>
        @endif
    </div>
    @endif
    @if(is_array($package->features) && isset($package->features['levels']))
    <div class="mb-6 flex-grow">
        <span class="text-sm font-medium text-gray-700">Available Levels:</span>
        <ul class="mt-2 space-y-2">
            @foreach($package->features['levels'] as $level)
            <li class="flex items-start">
                <svg class="w-5 h-5 text-green-500 mr-3 mt-0.5 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 1.414z" clip-rule="evenodd"/>
                </svg>
                <span class="text-gray-600">{{ $level['name'] }} - <span class="font-semibold">{{ number_format($level['fee']) }} {{ $package->currency }}</span></span>
            </li>
            @endforeach
        </ul>
    </div>
    @endif
    <button onclick="handlePackageSelection({{ $package->id }})" class="w-full bg-blue-600 text-white text-center py-4 px-6 rounded-lg hover:bg-blue-700 transition-colors font-semibold text-lg shadow-lg mt-auto">
        Select {{ $package->name }}
    </button>
</div>