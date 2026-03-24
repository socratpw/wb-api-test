<?php

namespace App\Services;

use App\Models\WbOrder;
use App\Models\WbSale;
use App\Models\WbStock;
use App\Models\WbIncome;
use Illuminate\Support\Facades\Http;

class WbApiService
{
    private string $host;
    private string $apiKey;

    public function __construct()
    {
        $this->host = config('wb.host');
        $this->apiKey = config('wb.api_key');
    }

    public function fetchAndSaveAll(): array
    {
        return [
//            'orders'  => $this->fetchAndSave('/api/orders',  WbOrder::class,  ['dateFrom' => '2024-01-01', 'dateTo' => '2024-12-31']),
//            'sales'   => $this->fetchAndSave('/api/sales',   WbSale::class,   ['dateFrom' => '2024-01-01', 'dateTo' => '2024-12-31']),
            'stocks'  => $this->fetchAndSave('/api/stocks',  WbStock::class,  ['dateFrom' => now()->format('Y-m-d')]),
//            'incomes' => $this->fetchAndSave('/api/incomes', WbIncome::class, ['dateFrom' => '2024-01-01', 'dateTo' => '2024-12-31']),
        ];
    }

    private function fetchAndSave(string $endpoint, string $model, array $params): int
    {
        $saved = 0;
        $page  = 1;

        do {
            $data = $this->get($endpoint, array_merge($params, ['page' => $page]));

            foreach ($data as $item) {
                $model::create(array_merge(
                    $item,
                    ['raw_data' => json_encode($item, JSON_UNESCAPED_UNICODE)]
                ));
                $saved++;
            }

            $page++;
        } while (count($data) >= 500);

        return $saved;
    }

    private function get(string $endpoint, array $params = []): array
    {
        $params['key'] = $this->apiKey;

        $response = Http::timeout(120)
            ->retry(3, 2000)
            ->get($this->host . $endpoint, $params);

        if ($response->failed()) {
            throw new \Exception("Ошибка API: " . $response->status());
        }

        $body = $response->json();

        if (isset($body['data']) && is_array($body['data'])) {
            return $body['data'];
        }

        return is_array($body) ? $body : [];
    }
}
