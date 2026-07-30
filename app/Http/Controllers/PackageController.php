<?php

namespace App\Http\Controllers;

use App\Models\Package;
use Illuminate\Http\Request;

class PackageController extends Controller
{
    public function index(Request $request)
    {
        $query = Package::active();
        if ($request->type && in_array($request->type, ['hosting', 'domain', 'services'])) {
            $query->where('type', $request->type);
        }
        $all = $query->get();
        $grouped = collect();

        $all->groupBy('type')->each(function ($items, $type) use ($grouped) {
            if ($type === 'services') {
                $byProvider = $items->groupBy('provider');
                $grouped[$type] = $byProvider;
            } else {
                $grouped[$type] = $items;
            }
        });

        $packages = $grouped;
        return view('packages.index', compact('packages'));
    }

    public function show(Package $package)
    {
        return view('packages.show', compact('package'));
    }

    public function order($packageId)
    {
        $package = Package::findOrFail($packageId);
        return view('packages.order', compact('package'));
    }
}
