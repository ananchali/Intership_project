<?php

namespace App\Http\Controllers\Admin\Traits;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

trait HandlesAdminDestroy
{
    /**
     * Resolve the record ID from route parameter or query string.
     */
    protected function resolveDestroyId(Request $request, ?string $id = null): ?string
    {
        return $id ?: $request->query('id');
    }

    /**
     * Perform a destroy operation with consistent error handling and redirect.
     *
     * @param Request $request
     * @param string|null $id
     * @param string $modelClass Fully-qualified model class name
     * @param string $redirectRoute Named route to redirect after operation
     * @param string $entityLabel Human-friendly label for messages (e.g. "Package")
     * @param callable|null $beforeDelete Optional callback receiving the model instance for cascading deletes
     */
    protected function destroyRecord(
        Request $request,
        ?string $id,
        string $modelClass,
        string $redirectRoute,
        string $entityLabel,
        ?callable $beforeDelete = null
    ) {
        $id = $this->resolveDestroyId($request, $id);

        if (!$id) {
            return redirect()->route($redirectRoute)
                ->with('error', "No {$entityLabel} ID provided.");
        }

        try {
            $record = $modelClass::findOrFail($id);

            if ($beforeDelete) {
                $beforeDelete($record);
            }

            $record->delete();
            Log::info("{$entityLabel} {$id} deleted successfully");

            return redirect()->route($redirectRoute)
                ->with('success', "{$entityLabel} deleted successfully.");
        } catch (\Exception $e) {
            Log::error("{$entityLabel} deletion failed for ID {$id}: " . $e->getMessage());

            return redirect()->route($redirectRoute)
                ->with('error', "Error deleting {$entityLabel}: " . $e->getMessage());
        }
    }
}
