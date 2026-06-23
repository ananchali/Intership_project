<?php

namespace App\Http\Controllers\Admin\Traits;

use Illuminate\Http\Request;

trait ValidatesPackageData
{
    /**
     * Validation rules shared between store and update for packages.
     */
    protected function packageValidationRules(): array
    {
        return [
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'price' => 'required|numeric',
            'currency' => 'required|string|max:10',
            'type' => 'required|in:hosting,domain',
            'features' => 'nullable|string',
            'is_active' => 'nullable',
        ];
    }

    /**
     * Prepare validated package data by parsing features and is_active.
     */
    protected function preparePackageData(Request $request, array $data): array
    {
        $data['features'] = isset($data['features'])
            ? array_map('trim', explode(',', $data['features']))
            : [];

        $data['is_active'] = $request->has('is_active');

        return $data;
    }
}
