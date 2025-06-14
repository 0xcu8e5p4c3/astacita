<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\View;
use App\Models\WebsiteVisit;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;

class TrackingController extends Controller
{
    /**
     * Track article view
     */
    public function trackView(Request $request): JsonResponse
    {
        $request->validate([
            'article_id' => 'required|integer|exists:articles,id',
            'session_id' => 'required|string|max:255',
            'user_agent' => 'nullable|string',
            'referrer' => 'nullable|string',
            'viewed_at' => 'required|date'
        ]);

        // Cek apakah sudah ada view dari session yang sama untuk artikel ini dalam 1 jam terakhir
        // Untuk menghindari duplicate views
        $existingView = View::where('article_id', $request->article_id)
            ->where('session_id', $request->session_id)
            ->where('viewed_at', '>', now()->subHour())
            ->first();

        if (!$existingView) {
            View::create([
                'article_id' => $request->article_id,
                'session_id' => $request->session_id,
                'user_agent' => $request->user_agent,
                'referrer' => $request->referrer,
                'viewed_at' => $request->viewed_at
            ]);
        }

        return response()->json(['status' => 'success']);
    }

    /**
     * Track website visit
     */
    public function trackVisit(Request $request): JsonResponse
    {
        $request->validate([
            'session_id' => 'required|string|max:255',
            'page_url' => 'required|url',
            'referrer' => 'nullable|string',
            'user_agent' => 'nullable|string',
            'visited_at' => 'required|date'
        ]);

        // Cek apakah sudah ada visit dari session yang sama untuk halaman ini dalam 30 menit terakhir
        $existingVisit = WebsiteVisit::where('session_id', $request->session_id)
            ->where('page_url', $request->page_url)
            ->where('visited_at', '>', now()->subMinutes(30))
            ->first();

        if (!$existingVisit) {
            WebsiteVisit::create([
                'session_id' => $request->session_id,
                'page_url' => $request->page_url,
                'referrer' => $request->referrer,
                'user_agent' => $request->user_agent,
                'visited_at' => $request->visited_at
            ]);
        }

        return response()->json(['status' => 'success']);
    }

    /**
     * Update visit duration
     */
    public function updateVisitDuration(Request $request): JsonResponse
    {
        $request->validate([
            'session_id' => 'required|string|max:255',
            'page_url' => 'required|url',
            'duration' => 'required|integer|min:0'
        ]);

        WebsiteVisit::where('session_id', $request->session_id)
            ->where('page_url', $request->page_url)
            ->whereDate('visited_at', today())
            ->update(['duration' => $request->duration]);

        return response()->json(['status' => 'success']);
    }

    /**
     * Track custom events
     */
    public function trackEvent(Request $request): JsonResponse
    {
        $request->validate([
            'session_id' => 'required|string|max:255',
            'event_name' => 'required|string|max:255',
            'event_data' => 'nullable|array',
            'page_url' => 'required|url',
            'timestamp' => 'required|date'
        ]);

        // Simpan ke tabel events jika diperlukan
        // Event::create($request->all());

        return response()->json(['status' => 'success']);
    }

    /**
     * Get analytics data for dashboard
     */
    public function getAnalytics(Request $request): JsonResponse
    {
        $period = $request->get('period', 'week'); // day, week, month, year

        $data = [
            'article_views' => $this->getArticleViewsData($period),
            'website_visits' => $this->getWebsiteVisitsData($period),
            'top_articles' => $this->getTopArticlesData($period),
            'popular_pages' => $this->getPopularPagesData($period)
        ];

        return response()->json($data);
    }

    private function getArticleViewsData($period)
    {
        $query = View::query();

        switch ($period) {
            case 'today':
                $query->whereDate('viewed_at', today());
                break;
            case 'week':
                $query->whereBetween('viewed_at', [now()->startOfWeek(), now()->endOfWeek()]);
                break;
            case 'month':
                $query->whereMonth('viewed_at', now()->month);
                break;
        }

        return $query->count();
    }

    private function getWebsiteVisitsData($period)
    {
        $query = WebsiteVisit::query();

        switch ($period) {
            case 'today':
                $query->whereDate('visited_at', today());
                break;
            case 'week':
                $query->whereBetween('visited_at', [now()->startOfWeek(), now()->endOfWeek()]);
                break;
            case 'month':
                $query->whereMonth('visited_at', now()->month);
                break;
        }

        return $query->distinct('session_id')->count();
    }

    private function getTopArticlesData($period)
    {
        return View::getTopArticles(10, $period);
    }

    private function getPopularPagesData($period)
    {
        $query = WebsiteVisit::select('page_url', \DB::raw('COUNT(*) as total_visits'))
            ->groupBy('page_url');

        switch ($period) {
            case 'today':
                $query->whereDate('visited_at', today());
                break;
            case 'week':
                $query->whereBetween('visited_at', [now()->startOfWeek(), now()->endOfWeek()]);
                break;
            case 'month':
                $query->whereMonth('visited_at', now()->month);
                break;
        }

        return $query->orderBy('total_visits', 'desc')
                    ->limit(10)
                    ->get();
    }
}