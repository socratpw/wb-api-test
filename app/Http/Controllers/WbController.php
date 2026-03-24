<?php

namespace App\Http\Controllers;

use App\Services\WbApiService;
use Illuminate\Http\JsonResponse;

class WbController extends Controller
{
    // Сервис который будет делать всю работу
    // Laravel сам создаёт объект WbApiService и передаёт сюда
    public function __construct(
        private WbApiService $apiService
    ) {}

    // Показывает главную страницу с кнопками
    public function index()
    {
        return view('wb.index');
    }

    // Загружает данные с API и сохраняет в БД
    public function sendData(): JsonResponse
    {
        try {
            $result = $this->apiService->fetchAndSaveAll();

            return response()->json([
                'status'  => 'ok',
                'message' => 'Данные загружены и сохранены',
                'result'  => $result,
            ]);

        } catch (\Exception $e) {
            return response()->json([
                'status'  => 'error',
                'message' => $e->getMessage(),
            ], 500);
        }
    }
}
