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
        $finalData = null;

        $score = $pageSpeedInsightsService->getScore($url, $strategy);

        $finalData['site_url'] = $url;
        $finalData['mobile']['strategy'] = ucfirst($strategy);

        // Mobile
        if (isset($score['lighthouseResult']['categories']['performance'])) {
            $finalData['mobile']['categories']['performance']['title'] = $score['lighthouseResult']['categories']['performance']['title'];
            $finalData['mobile']['categories']['performance']['score'] = $score['lighthouseResult']['categories']['performance']['score'] * 100;

            $finalData['mobile']['categories']['performance']['degree'] = $score['lighthouseResult']['categories']['performance']['score'] * 360;
        }

        if (isset($score['lighthouseResult']['categories']['accessibility'])) {
            $finalData['mobile']['categories']['accessibility']['title'] = $score['lighthouseResult']['categories']['accessibility']['title'];
            $finalData['mobile']['categories']['accessibility']['score'] = $score['lighthouseResult']['categories']['accessibility']['score'] * 100;

            $finalData['mobile']['categories']['accessibility']['degree'] = $score['lighthouseResult']['categories']['accessibility']['score'] * 360;
        }

        if (isset($score['lighthouseResult']['categories']['seo'])) {
            $finalData['mobile']['categories']['seo']['title'] = $score['lighthouseResult']['categories']['seo']['title'];
            $finalData['mobile']['categories']['seo']['score'] = $score['lighthouseResult']['categories']['seo']['score'] * 100;

            $finalData['mobile']['categories']['seo']['degree'] = $score['lighthouseResult']['categories']['seo']['score'] * 360;
        }

        if (isset($score['lighthouseResult']['categories']['best-practices'])) {
            $finalData['mobile']['categories']['best_practices']['title'] = $score['lighthouseResult']['categories']['best-practices']['title'];
            $finalData['mobile']['categories']['best_practices']['score'] = $score['lighthouseResult']['categories']['best-practices']['score'] * 100;

            $finalData['mobile']['categories']['best_practices']['degree'] = $score['lighthouseResult']['categories']['best-practices']['score'] * 360;
        }

        $strategy = 'desktop';
        $score = $pageSpeedInsightsService->getScore($url, $strategy);
        $finalData['desktop']['strategy'] = ucfirst($strategy);

        // Desktop
        if (isset($score['lighthouseResult']['categories']['performance'])) {
            $finalData['desktop']['categories']['performance']['title'] = $score['lighthouseResult']['categories']['performance']['title'];
            $finalData['desktop']['categories']['performance']['score'] = $score['lighthouseResult']['categories']['performance']['score'] * 100;

            $finalData['desktop']['categories']['performance']['degree'] = $score['lighthouseResult']['categories']['performance']['score'] * 360;
        }

        if (isset($score['lighthouseResult']['categories']['accessibility'])) {
            $finalData['desktop']['categories']['accessibility']['title'] = $score['lighthouseResult']['categories']['accessibility']['title'];
            $finalData['desktop']['categories']['accessibility']['score'] = $score['lighthouseResult']['categories']['accessibility']['score'] * 100;

            $finalData['desktop']['categories']['accessibility']['degree'] = $score['lighthouseResult']['categories']['accessibility']['score'] * 360;
        }

        if (isset($score['lighthouseResult']['categories']['seo'])) {
            $finalData['desktop']['categories']['seo']['title'] = $score['lighthouseResult']['categories']['seo']['title'];
            $finalData['desktop']['categories']['seo']['score'] = $score['lighthouseResult']['categories']['seo']['score'] * 100;

            $finalData['desktop']['categories']['seo']['degree'] = $score['lighthouseResult']['categories']['seo']['score'] * 360;
        }

        if (isset($score['lighthouseResult']['categories']['best-practices'])) {
            $finalData['desktop']['categories']['best_practices']['title'] = $score['lighthouseResult']['categories']['best-practices']['title'];

            $finalData['desktop']['categories']['best_practices']['score'] = $score['lighthouseResult']['categories']['best-practices']['score'] * 100;

            $finalData['desktop']['categories']['best_practices']['degree'] = $score['lighthouseResult']['categories']['best-practices']['score'] * 360;
        }

        return view('mail', ['data' => $finalData]);

        // return $finalData;

    }
}
