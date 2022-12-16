<?php

namespace App\Http\Controllers;

use App\Services\PageSpeedInsightsService;
use Illuminate\Http\Request;

class PageSpeedInsightsController extends Controller
{
    public function show(Request $request, PageSpeedInsightsService $pageSpeedInsightsService)
    {
        $url = 'https://kabhai.in';
        $strategy = 'mobile';

        $score = $pageSpeedInsightsService->getScore($url, $strategy);

        dd($score);

        return view('pagespeedinsights.show', [
            'score' => $score,
        ]);
    }

}
