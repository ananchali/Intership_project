<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Package;
use Illuminate\Http\Request;

class AdminPackageController extends Controller
{
    public function index()
    {
        $packages = Package::all();
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
            'currency' => 'required|string|max:10',
            'type' => 'required|in:hosting,domain',
            'features' => 'nullable|string',
            'is_active' => 'nullable',
        ]);

        if (isset($data['features'])) {
            $data['features'] = array_map('trim', explode(',', $data['features']));
        } else {
            $data['features'] = [];
        }
        
        $data['is_active'] = $request->has('is_active');
        
        Package::create($data);

        return redirect()->route('admin.packages.index')->with('success', 'Package created successfully.');
    }

    public function edit(Package $package)
    {
        return view('admin.packages.edit', compact('package'));
    }

    public function update(Request $request, Package $package)
    {
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'price' => 'required|numeric',
            'currency' => 'required|string|max:10',
            'type' => 'required|in:hosting,domain',
            'features' => 'nullable|string',
            'is_active' => 'nullable',
        ]);

        if (isset($data['features'])) {
            $data['features'] = array_map('trim', explode(',', $data['features']));
        } else {
            $data['features'] = [];
        }

        $data['is_active'] = $request->has('is_active');

        $package->update($data);

        return redirect()->route('admin.packages.index')->with('success', 'Package updated successfully.');
    }

    public function destroy(Request $request, $id = null)
    {
        $id = $id ?: $request->query('id');
        if (!$id) {
            return redirect()->route('admin.packages.index')->with('error', 'No package ID provided.');
        }
        
        try {
            $package = Package::findOrFail($id);
            
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
}
