<?php

namespace App\Http\Controllers;

use App\Models\SmartAd;
use Illuminate\Http\Request;

class SmartAdController extends Controller
{
    public function getAds(Request $request)
    {
        $type = $request->get('type');
        $position = $request->get('position');
        $page = $request->get('page', 'home');
        
        $ads = SmartAd::getActiveAds($type, $position, $page);
        
        return response()->json([
            'ads' => $ads->map(function ($ad) {
                return [
                    'id' => $ad->id,
                    'title' => $ad->title,
                    'type' => $ad->type,
                    'position' => $ad->position,
                    'content' => $ad->content,
                    'priority' => $ad->priority,
                ];
            })
        ]);
    }
    
    public function recordImpression(Request $request, SmartAd $ad)
    {
        $ad->recordImpression();
        
        return response()->json(['success' => true]);
    }
    
    public function recordClick(Request $request, SmartAd $ad)
    {
        $ad->recordClick();
        
        return response()->json(['success' => true]);
    }
    
    public function clearCache()
    {
        SmartAd::clearCache();
        
        return response()->json([
            'success' => true,
            'message' => 'Cache cleared successfully'
        ]);
    }
}