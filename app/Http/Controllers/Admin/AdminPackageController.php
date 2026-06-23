<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Admin\Traits\HandlesAdminDestroy;
use App\Http\Controllers\Admin\Traits\ValidatesPackageData;
use App\Models\Package;
use App\Services\CascadeDeleteService;
use Illuminate\Http\Request;

class AdminPackageController extends Controller
{
    use HandlesAdminDestroy, ValidatesPackageData;

    protected CascadeDeleteService $cascadeDeleteService;

    public function __construct(CascadeDeleteService $cascadeDeleteService)
    {
        $this->cascadeDeleteService = $cascadeDeleteService;
    }

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
        $data = $request->validate($this->packageValidationRules());
        $data = $this->preparePackageData($request, $data);

        Package::create($data);

        return redirect()->route('admin.packages.index')->with('success', 'Package created successfully.');
    }

    public function edit(Package $package)
    {
        return view('admin.packages.edit', compact('package'));
    }

    public function update(Request $request, Package $package)
    {
        $data = $request->validate($this->packageValidationRules());
        $data = $this->preparePackageData($request, $data);

        $package->update($data);

        return redirect()->route('admin.packages.index')->with('success', 'Package updated successfully.');
    }

    public function destroy(Request $request, $id = null)
    {
        return $this->destroyRecord(
            $request,
            $id,
            Package::class,
            'admin.packages.index',
            'Package',
            fn ($package) => $this->cascadeDeleteService->deleteAllOrdersForParent($package)
        );
    }
}
