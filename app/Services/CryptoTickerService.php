<?php

namespace App\Services;

use App\Models\WebsiteSetting;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class CryptoTickerService
{
    private const CACHE_KEY = 'crypto_ticker_data';
    private const CACHE_DURATION = 60; // 60 seconds
    private const API_URL = 'https://pro-api.coinmarketcap.com/v1/cryptocurrency/listings/latest';
    private const CRYPTO_LIMIT = 10;

    /**
     * Get cryptocurrency data with caching
     */
    public function getCryptoData(): ?array
    {
        $settings = WebsiteSetting::first();
        
        // Check if ticker is enabled
        if (!$settings || !$settings->crypto_ticker_enabled) {
            return null;
        }

        // Check if API key exists
        if (empty($settings->coinmarketcap_api_key)) {
            Log::warning('CoinMarketCap API key not configured');
            return $this->getDemoData();
        }

        // Try to get from cache first
        return Cache::remember(self::CACHE_KEY, self::CACHE_DURATION, function () use ($settings) {
            return $this->fetchFromApi($settings->coinmarketcap_api_key);
        });
    }

    /**
     * Fetch data from CoinMarketCap API
     */
    private function fetchFromApi(string $apiKey): array
    {
        try {
            $response = Http::withHeaders([
                'X-CMC_PRO_API_KEY' => $apiKey,
                'Accept' => 'application/json',
            ])->timeout(10)->get(self::API_URL, [
                'limit' => self::CRYPTO_LIMIT,
                'convert' => 'USD',
            ]);

            if ($response->successful()) {
                $data = $response->json();
                
                return collect($data['data'])->map(function ($coin) {
                    return [
                        'name' => $coin['name'],
                        'symbol' => $coin['symbol'],
                        'price' => $coin['quote']['USD']['price'],
                        'change' => $coin['quote']['USD']['percent_change_24h'],
                    ];
                })->toArray();
            }

            Log::error('CoinMarketCap API error', [
                'status' => $response->status(),
                'body' => $response->body()
            ]);

            return $this->getDemoData();

        } catch (\Exception $e) {
            Log::error('Error fetching crypto data: ' . $e->getMessage());
            return $this->getDemoData();
        }
    }

    /**
     * Get demo data as fallback
     */
    private function getDemoData(): array
    {
        return [
            ['name' => 'Bitcoin', 'symbol' => 'BTC', 'price' => 67234.56, 'change' => 2.34],
            ['name' => 'Ethereum', 'symbol' => 'ETH', 'price' => 3456.78, 'change' => -1.23],
            ['name' => 'Tether', 'symbol' => 'USDT', 'price' => 1.00, 'change' => 0.01],
            ['name' => 'BNB', 'symbol' => 'BNB', 'price' => 598.34, 'change' => 3.45],
            ['name' => 'Solana', 'symbol' => 'SOL', 'price' => 156.78, 'change' => 5.67],
            ['name' => 'XRP', 'symbol' => 'XRP', 'price' => 0.6234, 'change' => -2.34],
            ['name' => 'Cardano', 'symbol' => 'ADA', 'price' => 0.5678, 'change' => 1.89],
            ['name' => 'Dogecoin', 'symbol' => 'DOGE', 'price' => 0.1234, 'change' => 4.56],
            ['name' => 'TRON', 'symbol' => 'TRX', 'price' => 0.1678, 'change' => -0.89],
            ['name' => 'Polygon', 'symbol' => 'MATIC', 'price' => 0.8456, 'change' => 2.78],
        ];
    }

    /**
     * Clear cache manually
     */
    public function clearCache(): void
    {
        Cache::forget(self::CACHE_KEY);
    }

    /**
     * Test API connection
     */
    public function testApiConnection(string $apiKey): bool
    {
        try {
            $response = Http::withHeaders([
                'X-CMC_PRO_API_KEY' => $apiKey,
                'Accept' => 'application/json',
            ])->timeout(10)->get(self::API_URL, [
                'limit' => 1,
                'convert' => 'USD',
            ]);

            return $response->successful();
        } catch (\Exception $e) {
            return false;
        }
    }
}