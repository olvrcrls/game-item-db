<?php

namespace App\Http\Controllers\Api;

use Exception;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreItemRequest;
use App\Http\Requests\UpdateItemRequest;
use App\Models\Item;
use App\Repositories\ItemRepository;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Log;

class ItemApiController extends Controller
{
    protected ItemRepository $itemRepository;

    public function __construct(ItemRepository $itemRepository)
    {
        $this->itemRepository = $itemRepository;
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        try {
            $data = $this->itemRepository->all();
            return JsonResponse::success(data: $data, message: 'Items retrieved successfully');
        } catch (Exception $e) {
            Log::error(
                __FILE__ . '@' . __FUNCTION__ .
                ' - ' . $e->getMessage()
            );

            return JsonResponse::error(message: 'Items could not be retrieved', code: 500);
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreItemRequest $request)
    {
        try {
            $data = $this->itemRepository->create($request->validated());
            return JsonResponse::success(data: $data, message: 'Item created successfully', code: 201);
        } catch (Exception $e) {
            Log::error(
                __FILE__ . '@' . __FUNCTION__ .
                ' - ' . $e->getMessage()
            );

            return JsonResponse::error(message: 'Item could not be created', code: 500);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $item)
    {
        try {
            $data = $this->itemRepository->find($item);
            return $data ? JsonResponse::success(data: $data, message: 'Item retrieved successfully')
                        : JsonResponse::error(message: 'Item not found', code: 404);
        } catch (Exception $e) {
            Log::error(
                __FILE__ . '@' . __FUNCTION__ .
                '- ' . $e->getMessage()
            );

            return JsonResponse::error(message: 'Item could not be retrieved', code: 500);
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateItemRequest $request, Item $item)
    {
        try {
            $data = $this->itemRepository->update($item, $request->validated());
            return JsonResponse::success(data: $data, message: 'Item updated successfully');
        } catch (Exception $e) {
            Log::error(
                __FILE__ . '@' . __FUNCTION__ .
                ' - ' . $e->getMessage()
            );

            return JsonResponse::error(message: 'Item could not be updated', code: 500);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try {
            $data = $this->itemRepository->delete($id);
            if (!$data) {
                return JsonResponse::error(message: 'Item not found', code: 404);
            }

            return JsonResponse::success(data: $data, message: 'Item deleted successfully');
        } catch (Exception $e) {
            Log::error(
                __FILE__ . '@' . __FUNCTION__ .
                ' - ' . $e->getMessage()
            );

            return JsonResponse::error(message: 'Item could not be deleted', code: 500);
        }
    }
}
