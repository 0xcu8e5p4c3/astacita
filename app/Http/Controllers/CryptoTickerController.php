<?php

namespace App\Http\Controllers;

use App\Services\CryptoTickerService;
use Illuminate\Http\JsonResponse;

class CryptoTickerController extends Controller
{
    public function __construct(
        private CryptoTickerService $cryptoService
    ) {}

    /**
     * Get crypto ticker data
     */
    public function getData(): JsonResponse
    {
        $data = $this->cryptoService->getCryptoData();
        
        if ($data === null) {
            return response()->json([
                'success' => false,
                'message' => 'Crypto ticker is disabled',
                'data' => []
            ], 200);
        }

        return response()->json([
            'success' => true,
            'data' => $data,
            'cached_at' => now()->toIso8601String()
        ]);
    }

    /**
     * Clear cache (for admin use)
     */
    public function clearCache(): JsonResponse
    {
        $this->cryptoService->clearCache();
        
        return response()->json([
            'success' => true,
            'message' => 'Cache cleared successfully'
        ]);
    }
}