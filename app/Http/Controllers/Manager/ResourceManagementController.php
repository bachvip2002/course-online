<?php

namespace App\Http\Controllers\Manager;

use App\Exceptions\JsonResponse;
use App\Http\Controllers\Controller;
use App\Http\Requests\Manager\ResourceManagement\StoreRequest;
use App\Models\Resource;
use Exception;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use Symfony\Component\HttpFoundation\Response;

/**
 * ResourceManagementController of Pages ...
 */
class ResourceManagementController extends Controller
{
    private $resource;

    public function __construct(
        Resource $resource,
    ) {
        $this->resource = $resource;
    }

    public function renderListPage()
    {
        $resourceTypes = Resource::TYPE_ARRAY;
        $resources = $this->resource
            ->queryEloquentBuilder()
            ->paginate(PAGE_SIZE_DEFAULT);

        return view('manager.page.resource-management.list-page', [
            'resourceTypes' => $resourceTypes,
            'resources' => $resources,
        ]);
    }

    public function renderCreatePage()
    {
        return view('manager.page.resource-management.create-page');
    }

    public function store(StoreRequest $request)
    {
        try {
            Storage::disk('public')->put(
                'video',
                $request->file('path')
            );
        } catch (Exception $exception) {

            Log::build([
                'driver' => 'single',
                'path' => storage_path('logs/upload-file.log'),
            ])->info(
                $exception->getMessage(),
                $exception->getTrace()
            );

            throw new JsonResponse([
                'message' => $exception->getMessage()
            ], $exception->getCode());
        }

        return response()->json([], Response::HTTP_CREATED);
    }
}
