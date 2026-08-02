@extends('layouts.admin')

@section('title', 'Manage Businesses')

@section('content')
<div class="flex justify-between items-center mb-8">
    <div>
        <h1 class="text-3xl font-bold text-gray-900">Businesses</h1>
        <p class="text-gray-600 mt-2">Each business has its own owner account and sees only its own orders, verifications and history.</p>
    </div>
    <a href="{{ route('admin.businesses.create') }}" class="bg-blue-600 text-white px-6 py-3 rounded-lg hover:bg-blue-700 font-bold shadow-lg shadow-blue-200 transition-all">
        + Add New Business
    </a>
</div>

<div class="bg-white rounded-xl shadow-sm border border-gray-100 overflow-hidden">
    <div class="overflow-x-auto">
    <table class="min-w-full divide-y divide-gray-200">
        <thead class="bg-gray-50">
            <tr>
                <th class="px-4 py-4 text-left text-xs font-bold text-gray-500 uppercase tracking-wider">Business</th>
                <th class="px-4 py-4 text-left text-xs font-bold text-gray-500 uppercase tracking-wider">Owner</th>
                <th class="px-4 py-4 text-left text-xs font-bold text-gray-500 uppercase tracking-wider">Order Link</th>
                <th class="px-4 py-4 text-left text-xs font-bold text-gray-500 uppercase tracking-wider">Status</th>
                <th class="px-4 py-4 text-right text-xs font-bold text-gray-500 uppercase tracking-wider">Actions</th>
            </tr>
        </thead>
        <tbody class="bg-white divide-y divide-gray-100">
            @foreach($businesses as $business)
            <tr class="hover:bg-gray-50 transition-colors">
                <td class="px-4 py-4">
                    <div class="text-sm font-bold text-gray-900">{{ $business->name }}</div>
                    <div class="text-xs text-gray-500 mt-1">/b/{{ $business->slug }}</div>
                </td>
                <td class="px-4 py-4">
                    <div class="text-sm font-semibold text-gray-800">{{ $business->owner_name }}</div>
                    <div class="text-xs text-gray-500 mt-1">{{ $business->owner_email }}</div>
                    <div class="text-xs text-gray-400">{{ $business->owner_phone }}</div>
                </td>
                <td class="px-4 py-4">
                    <div class="flex items-center gap-2">
                        <code class="text-xs bg-gray-100 px-2 py-1 rounded text-gray-600">{{ url('/b/' . $business->slug) }}</code>
                        <button type="button" onclick="copyLink('{{ url('/b/' . $business->slug) }}', this)"
                                class="text-blue-600 hover:text-blue-800 text-xs font-bold">Copy</button>
                    </div>
                </td>
                <td class="px-4 py-4 whitespace-nowrap">
                    <div class="flex flex-col gap-1">
                        <span class="px-2 py-0.5 inline-flex text-xs leading-5 font-bold rounded-full {{ $business->status === 'approved' ? 'bg-green-100 text-green-700' : ($business->status === 'pending' ? 'bg-amber-100 text-amber-700' : 'bg-red-100 text-red-700') }}">
                            {{ ucfirst($business->status) }}
                        </span>
                        <span class="px-2 py-0.5 inline-flex text-xs leading-5 font-bold rounded-full {{ $business->is_active ? 'bg-blue-100 text-blue-700' : 'bg-gray-100 text-gray-600' }}">
                            {{ $business->is_active ? 'Live' : 'Offline' }}
                        </span>
                    </div>
                </td>
                <td class="px-4 py-4 whitespace-nowrap text-right text-sm font-medium">
                    @if($business->status === 'pending')
                    <form action="{{ route('admin.businesses.approve', $business->slug) }}" method="POST" class="inline">
                        @csrf
                        <button type="submit" class="text-green-700 hover:text-green-900 bg-green-50 px-2 py-1 rounded transition-colors font-bold text-xs">Approve</button>
                    </form>
                    <form action="{{ route('admin.businesses.reject', $business->slug) }}" method="POST" class="inline">
                        @csrf
                        <button type="submit" class="text-red-600 hover:text-red-800 bg-red-50 px-2 py-1 rounded transition-colors font-bold text-xs">Reject</button>
                    </form>
                    @elseif($business->status === 'rejected')
                    <form action="{{ route('admin.businesses.approve', $business->slug) }}" method="POST" class="inline">
                        @csrf
                        <button type="submit" class="text-green-700 hover:text-green-900 bg-green-50 px-2 py-1 rounded transition-colors font-bold text-xs">Approve</button>
                    </form>
                    @endif
                    <a href="{{ route('admin.businesses.edit', $business->slug) }}" class="text-blue-600 hover:text-blue-800 bg-blue-50 px-2 py-1 rounded transition-colors font-bold text-xs">Edit</a>
                    <a href="{{ route('admin.businesses.delete', ['id' => $business->id]) }}"
                       onclick="return confirm('Delete this business and its owner account? This cannot be undone.')"
                       class="text-red-600 hover:text-red-800 bg-red-50 px-2 py-1 rounded transition-colors font-bold text-xs">
                        Delete
                    </a>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
    </div>
    @if($businesses->hasPages())
        <div class="px-4 py-4 border-t border-gray-100">{{ $businesses->links() }}</div>
    @endif
</div>

<script>
function copyLink(link, btn) {
    navigator.clipboard.writeText(link).then(function () {
        const original = btn.textContent;
        btn.textContent = 'Copied!';
        setTimeout(function () { btn.textContent = original; }, 1500);
    });
}
</script>
@endsection
