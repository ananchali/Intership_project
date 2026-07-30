@extends('layouts.admin')

@section('title', 'Manage Servers')

@section('content')
<div class="flex justify-between items-center mb-8">
    <div>
        <h1 class="text-3xl font-bold text-gray-900">Servers & Packages</h1>
        <p class="text-gray-600 mt-2">Add, edit or remove hosting and domain packages</p>
    </div>
    <a href="{{ route('admin.packages.create') }}" class="bg-blue-600 text-white px-6 py-3 rounded-lg hover:bg-blue-700 font-bold shadow-lg shadow-blue-200 transition-all">
        + Add New Package
    </a>
</div>

<div class="bg-white rounded-xl shadow-sm border border-gray-100 overflow-hidden">
    <div class="overflow-x-auto">
    <table class="min-w-full divide-y divide-gray-200">
        <thead class="bg-gray-50">
            <tr>
                <th class="px-4 py-4 text-left text-xs font-bold text-gray-500 uppercase tracking-wider">Name</th>
                <th class="px-4 py-4 text-left text-xs font-bold text-gray-500 uppercase tracking-wider">Type</th>
                <th class="px-4 py-4 text-left text-xs font-bold text-gray-500 uppercase tracking-wider">Provider</th>
                <th class="px-4 py-4 text-left text-xs font-bold text-gray-500 uppercase tracking-wider">Pricing</th>
                <th class="px-4 py-4 text-left text-xs font-bold text-gray-500 uppercase tracking-wider">Levels / Features</th>
                <th class="px-4 py-4 text-left text-xs font-bold text-gray-500 uppercase tracking-wider">Status</th>
                <th class="px-4 py-4 text-right text-xs font-bold text-gray-500 uppercase tracking-wider">Actions</th>
            </tr>
        </thead>
        <tbody class="bg-white divide-y divide-gray-100">
            @foreach($packages as $package)
            <tr class="hover:bg-gray-50 transition-colors">
                <td class="px-4 py-4">
                    <div class="text-sm font-bold text-gray-900 whitespace-nowrap">{{ $package->name }}</div>
                    <div class="text-xs text-gray-500 mt-1 max-w-[200px] truncate" title="{{ $package->description }}">{{ $package->description }}</div>
                </td>
                <td class="px-4 py-4 whitespace-nowrap">
                    <span class="px-2 py-0.5 inline-flex text-xs leading-5 font-bold rounded-full {{ $package->type === 'hosting' ? 'bg-purple-100 text-purple-700' : ($package->type === 'services' ? 'bg-green-100 text-green-700' : 'bg-indigo-100 text-indigo-700') }}">
                        {{ ucfirst($package->type) }}
                    </span>
                </td>
                <td class="px-4 py-4 whitespace-nowrap text-sm text-gray-600">
                    {{ $package->provider ?? '-' }}
                </td>
                <td class="px-4 py-4 whitespace-nowrap text-sm">
                    @if($package->type === 'services')
                        <div class="text-xs space-y-1">
                            @if($package->registration_fee)<div class="flex justify-between gap-3"><span class="text-gray-500">Reg:</span><span class="font-semibold text-gray-900">{{ number_format($package->registration_fee) }} {{ $package->currency }}</span></div>@endif
                            @if($package->monthly_fee)<div class="flex justify-between gap-3"><span class="text-gray-500">Monthly:</span><span class="font-semibold text-gray-900">{{ number_format($package->monthly_fee) }} {{ $package->currency }}</span></div>@endif
                        </div>
                    @else
                        <span class="font-semibold">{{ number_format($package->price) }} {{ $package->currency }}</span>
                    @endif
                </td>
                <td class="px-4 py-4 whitespace-nowrap text-xs text-gray-600">
                    @if($package->type === 'services' && is_array($package->features) && isset($package->features['levels']))
                        <button onclick="toggleLevels({{ $package->id }})" class="text-blue-600 hover:text-blue-800 font-semibold flex items-center gap-1">
                            <span id="label-{{ $package->id }}">{{ count($package->features['levels']) }} levels</span>
                            <svg id="arrow-{{ $package->id }}" class="w-3 h-3 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/></svg>
                        </button>
                        <div id="levels-{{ $package->id }}" class="hidden mt-2 bg-gray-50 rounded p-2 space-y-1 border">
                            @foreach($package->features['levels'] as $level)
                            <div class="flex justify-between gap-4 text-xs">
                                <span class="text-gray-700">{{ $level['name'] }}</span>
                                <span class="font-semibold text-gray-900">{{ number_format($level['fee']) }} {{ $package->currency }}</span>
                            </div>
                            @endforeach
                        </div>
                    @elseif(is_array($package->features) && count($package->features))
                        {{ count($package->features) }} features
                    @else
                        -
                    @endif
                </td>
                <td class="px-4 py-4 whitespace-nowrap">
                    <span class="px-2 py-0.5 inline-flex text-xs leading-5 font-bold rounded-full {{ $package->is_active ? 'bg-green-100 text-green-700' : 'bg-red-100 text-red-700' }}">
                        {{ $package->is_active ? 'Active' : 'Inactive' }}
                    </span>
                </td>
                <td class="px-4 py-4 whitespace-nowrap text-right text-sm font-medium">
                    <a href="{{ route('admin.packages.edit', $package->id) }}" class="text-blue-600 hover:text-blue-800 bg-blue-50 px-2 py-1 rounded transition-colors font-bold text-xs">Edit</a>
                    <a href="{{ route('admin.packages.delete', ['id' => $package->id]) }}" 
                       class="text-red-600 hover:text-red-800 bg-red-50 px-2 py-1 rounded transition-colors font-bold text-xs">
                        Delete
                    </a>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
    </div>
</div>

<script>
function toggleLevels(id) {
    const el = document.getElementById('levels-' + id);
    const arrow = document.getElementById('arrow-' + id);
    el.classList.toggle('hidden');
    arrow.classList.toggle('rotate-180');
}
</script>
@endsection
