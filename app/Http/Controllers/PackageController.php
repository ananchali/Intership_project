<?php

namespace App\Http\Controllers;

use App\Models\Package;
use Illuminate\Http\Request;

class PackageController extends Controller
{
    public function index()
    {
        $packages = Package::active()->get()->groupBy('type');
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
