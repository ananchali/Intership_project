<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Package;
use Illuminate\Http\Request;

class AdminPackageController extends Controller
{
    public function index()
    {
        $packages = Package::with('business')
            ->when($this->businessId(), fn($q) => $q->where('business_id', $this->businessId()))
            ->orderBy('created_at', 'desc')
            ->get();
        return view('admin.packages.index', compact('packages'));
    }

    public function create()
    {
        return view('admin.packages.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'price' => 'required|numeric',
            'registration_fee' => 'nullable|numeric|min:0',
            'monthly_fee' => 'nullable|numeric|min:0',
            'currency' => 'required|string|max:10',
            'type' => 'required|in:hosting,domain,services',
            'provider' => 'nullable|string|max:255',
            'features' => 'nullable|string',
            'is_active' => 'nullable',
        ]);

        $data['features'] = $this->parseFeatures($data, $data['type'] ?? 'hosting');
        $data['is_active'] = $request->has('is_active');
        $data['business_id'] = $this->businessId();
        
        Package::create($data);

        return redirect()->route('admin.packages.index')->with('success', 'Package created successfully.');
    }

    public function edit(Package $package)
    {
        $this->authorizePackage($package);
        return view('admin.packages.edit', compact('package'));
    }

    public function update(Request $request, Package $package)
    {
        $this->authorizePackage($package);

        $data = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'price' => 'required|numeric',
            'registration_fee' => 'nullable|numeric|min:0',
            'monthly_fee' => 'nullable|numeric|min:0',
            'currency' => 'required|string|max:10',
            'type' => 'required|in:hosting,domain,services',
            'provider' => 'nullable|string|max:255',
            'features' => 'nullable|string',
            'is_active' => 'nullable',
        ]);

        $data['features'] = $this->parseFeatures($data, $data['type']);

        $data['is_active'] = $request->has('is_active');

        $package->update($data);

        return redirect()->route('admin.packages.index')->with('success', 'Package updated successfully.');
    }

    private function parseFeatures(array $data, string $type): array
    {
        if (!isset($data['features']) || empty($data['features'])) {
            return [];
        }

        if ($type === 'services') {
            $lines = explode("\n", $data['features']);
            $levels = [];
            foreach ($lines as $line) {
                $line = trim($line);
                if (empty($line)) continue;
                $parts = explode('|', $line);
                if (count($parts) >= 2) {
                    $levels[] = [
                        'name' => trim($parts[0]),
                        'fee' => (float) trim($parts[1]),
                    ];
                }
            }
            return ['levels' => $levels];
        }

        return array_map('trim', explode(',', $data['features']));
    }

    public function destroy(Request $request, $id = null)
    {
        $id = $id ?: $request->query('id');
        if (!$id) {
            return redirect()->route('admin.packages.index')->with('error', 'No package ID provided.');
        }
        
        try {
            $package = Package::findOrFail($id);
            $this->authorizePackage($package);
            
            // Manually ensure related orders are handled if DB cascade fails
            foreach ($package->orders as $order) {
                foreach ($order->payments as $payment) {
                    $payment->paymentVerifications()->delete();
                    $payment->delete();
                }
                $order->delete();
            }
            
            $package->delete();
            \Log::info('Package ' . $id . ' deleted successfully');
            return redirect()->route('admin.packages.index')->with('success', 'Package deleted successfully.');
        } catch (\Exception $e) {
            \Log::error('Package deletion failed for ID ' . $id . ': ' . $e->getMessage());
            return redirect()->route('admin.packages.index')->with('error', 'System Error: ' . $e->getMessage());
        }
    }

    private function businessId(): ?int
    {
        $user = auth()->user();
        if (!$user || $user->isSuperAdmin()) {
            return null;
        }
        return $user->business_id;
    }

    private function authorizePackage(Package $package): void
    {
        $businessId = $this->businessId();
        if ($businessId && $package->business_id !== $businessId) {
            abort(403);
        }
    }
}
