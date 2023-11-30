<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreGameRequest;
use App\Http\Requests\UpdateGameRequest;
use App\Models\Game;
use App\Repositories\GameRepository;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Log;

class GameApiController extends Controller
{
    protected GameRepository $gameRepository;

    public function __construct(GameRepository $gameRepository)
    {
        $this->gameRepository = $gameRepository;
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        try {
            $data = $this->gameRepository->all();
            return JsonResponse::success(data: $data, message: 'Games retrieved successfully');
        } catch (Exception $e) {
            Log::error(
                __FILE__ . '@' . __FUNCTION__ .
                ' - ' . $e->getMessage()
            );

            return JsonResponse::error(message: 'Games could not be retrieved', code: 500);
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreGameRequest $request)
    {
        try {
            $data = $this->gameRepository->create($request->validated());
            return JsonResponse::success(data: $data, message: 'Game created successfully', code: 201);
        } catch (Exception $e) {
            Log::error(
                __FILE__ . '@' . __FUNCTION__ .
                ' - ' . $e->getMessage()
            );

            return JsonResponse::error(message: 'Game could not be created', code: 500);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $game)
    {
        try {
            $data = $this->gameRepository->find($game);
            return $data ? JsonResponse::success(data: $data, message: 'Game retrieved successfully')
                        : JsonResponse::error(message: 'Game not found', code: 404);
        } catch (Exception $e) {
            Log::error(
                __FILE__ . '@' . __FUNCTION__ .
                ' - ' . $e->getMessage()
            );

            return JsonResponse::error(message: 'Game could not be retrieved', code: 500);
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateGameRequest $request, Game $game)
    {
        try {
            $data = $this->gameRepository->update($game, $request->validated());
            return JsonResponse::success(data: $data, message: 'Game updated successfully');
        } catch (Exception $e) {
            Log::error(
                __FILE__ . '@' . __FUNCTION__ .
                ' - ' . $e->getMessage()
            );

            return JsonResponse::error(message: 'Game could not be updated', code: 500);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try {
            $data = $this->gameRepository->delete($id);
            if (!$data) {
                return JsonResponse::error(message: 'Game not found', code: 404);
            }

            return JsonResponse::success(data: $data, message: 'Game deleted successfully');
        } catch (Exception $e) {
            Log::error(
                __FILE__ . '@' . __FUNCTION__ .
                ' - ' . $e->getMessage()
            );

            return JsonResponse::error(message: 'Game could not be deleted', code: 500);
        }
    }
}
