<?php

namespace App\Jobs;

use App\Services\PageSpeedInsightsService;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Log;

class FetchPageSpeedInsightsData implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $url;

    /**
     * Create a new job instance.
     *
     * @param string $url
     * @return void
     */
    public function __construct(string $clients)
    {
        $this->clients = $clients;
        $this->finalData = null;

        $this->finalData['mobile']['is_data'] = false;
        $this->finalData['desktop']['is_data'] = false;

        $this->poor_round_color = "#f64331";
        $this->poor_text_color = "#cd351d";

        $this->medium_round_color = "#fda732";
        $this->medium_text_color = "#c3341b";

        $this->good_round_color = "#55c862";
        $this->good_text_color = "#3a8509";
    }

    /**
     * Execute the job.
     *
     * @return void
     */

    public function handle(PageSpeedInsightsService $pageSpeedInsightsService)
    {

        foreach ($this->clients as $client) {
            $mobileInsights = $this->getMobileInsights($pageSpeedInsightsService, $client['url']);
            $desktopInsights = $this->getDesktopInsights($pageSpeedInsightsService, $client['url']);
            Log::info('finalData :', array($this->finalData));

            // Send mail $client['mail'] 
        }
    }


    public function getMobileInsights(PageSpeedInsightsService $pageSpeedInsightsService, $url)
    {
        $strategy = 'mobile';
        $score = $pageSpeedInsightsService->getScore($url, $strategy);

        $this->finalData['site_url'] = $url;
        $this->finalData['mobile']['strategy'] = ucfirst($strategy);

        if (isset($score['lighthouseResult']['categories'])) {
            $this->finalData['mobile']['is_data'] = true;
        }

        // Mobile
        if (isset($score['lighthouseResult']['categories']['performance'])) {

            if ((($score['lighthouseResult']['categories']['performance']['score'] * 100) >= 0) && (($score['lighthouseResult']['categories']['performance']['score'] * 100) <= 49)) {
                $this->finalData['mobile']['categories']['performance']['roundc'] = $this->poor_round_color;
                $this->finalData['mobile']['categories']['performance']['textc'] =  $this->poor_text_color;
            } else if ((($score['lighthouseResult']['categories']['performance']['score'] * 100) >= 50) && (($score['lighthouseResult']['categories']['performance']['score'] * 100) <= 89)) {
                $this->finalData['mobile']['categories']['performance']['roundc'] = $this->medium_round_color;
                $this->finalData['mobile']['categories']['performance']['textc'] = $this->medium_text_color;
            } else {
                $this->finalData['mobile']['categories']['performance']['roundc'] = $this->good_round_color;
                $this->finalData['mobile']['categories']['performance']['textc'] = $this->good_text_color;
            }

            $this->finalData['mobile']['categories']['performance']['title'] = $score['lighthouseResult']['categories']['performance']['title'];
            $this->finalData['mobile']['categories']['performance']['score'] = $score['lighthouseResult']['categories']['performance']['score'] * 100;

            $this->finalData['mobile']['categories']['performance']['degree'] = $score['lighthouseResult']['categories']['performance']['score'] * 360;
        }

        if (isset($score['lighthouseResult']['categories']['accessibility'])) {

            if ((($score['lighthouseResult']['categories']['accessibility']['score'] * 100) >= 0) && (($score['lighthouseResult']['categories']['accessibility']['score'] * 100) <= 49)) {
                $this->finalData['mobile']['categories']['accessibility']['roundc'] = $this->poor_round_color;
                $this->finalData['mobile']['categories']['accessibility']['textc'] =  $this->poor_text_color;
            } else if ((($score['lighthouseResult']['categories']['accessibility']['score'] * 100) >= 50) && (($score['lighthouseResult']['categories']['accessibility']['score'] * 100) <= 89)) {
                $this->finalData['mobile']['categories']['accessibility']['roundc'] = $this->medium_round_color;
                $this->finalData['mobile']['categories']['accessibility']['textc'] = $this->medium_text_color;
            } else {
                $this->finalData['mobile']['categories']['accessibility']['roundc'] = $this->good_round_color;
                $this->finalData['mobile']['categories']['accessibility']['textc'] = $this->good_text_color;
            }

            $this->finalData['mobile']['categories']['accessibility']['title'] = $score['lighthouseResult']['categories']['accessibility']['title'];
            $this->finalData['mobile']['categories']['accessibility']['score'] = $score['lighthouseResult']['categories']['accessibility']['score'] * 100;

            $this->finalData['mobile']['categories']['accessibility']['degree'] = $score['lighthouseResult']['categories']['accessibility']['score'] * 360;
        }

        if (isset($score['lighthouseResult']['categories']['seo'])) {

            if ((($score['lighthouseResult']['categories']['seo']['score'] * 100) >= 0) && (($score['lighthouseResult']['categories']['seo']['score'] * 100) <= 49)) {
                $this->finalData['mobile']['categories']['seo']['roundc'] = $this->poor_round_color;
                $this->finalData['mobile']['categories']['seo']['textc'] =  $this->poor_text_color;
            } else if ((($score['lighthouseResult']['categories']['seo']['score'] * 100) >= 50) && (($score['lighthouseResult']['categories']['seo']['score'] * 100) <= 89)) {
                $this->finalData['mobile']['categories']['seo']['roundc'] = $this->medium_round_color;
                $this->finalData['mobile']['categories']['seo']['textc'] = $this->medium_text_color;
            } else {
                $this->finalData['mobile']['categories']['seo']['roundc'] = $this->good_round_color;
                $this->finalData['mobile']['categories']['seo']['textc'] = $this->good_text_color;
            }

            $this->finalData['mobile']['categories']['seo']['title'] = $score['lighthouseResult']['categories']['seo']['title'];
            $this->finalData['mobile']['categories']['seo']['score'] = $score['lighthouseResult']['categories']['seo']['score'] * 100;

            $this->finalData['mobile']['categories']['seo']['degree'] = $score['lighthouseResult']['categories']['seo']['score'] * 360;
        }

        if (isset($score['lighthouseResult']['categories']['best-practices'])) {

            if ((($score['lighthouseResult']['categories']['best-practices']['score'] * 100) >= 0) && (($score['lighthouseResult']['categories']['best-practices']['score'] * 100) <= 49)) {
                $this->finalData['mobile']['categories']['best_practices']['roundc'] = $this->poor_round_color;
                $this->finalData['mobile']['categories']['best_practices']['textc'] =  $this->poor_text_color;
            } else if ((($score['lighthouseResult']['categories']['best-practices']['score'] * 100) >= 50) && (($score['lighthouseResult']['categories']['best-practices']['score'] * 100) <= 89)) {
                $this->finalData['mobile']['categories']['best_practices']['roundc'] = $this->medium_round_color;
                $this->finalData['mobile']['categories']['best_practices']['textc'] = $this->medium_text_color;
            } else {
                $this->finalData['mobile']['categories']['best_practices']['roundc'] = $this->good_round_color;
                $this->finalData['mobile']['categories']['best_practices']['textc'] = $this->good_text_color;
            }

            $this->finalData['mobile']['categories']['best_practices']['title'] = $score['lighthouseResult']['categories']['best-practices']['title'];
            $this->finalData['mobile']['categories']['best_practices']['score'] = $score['lighthouseResult']['categories']['best-practices']['score'] * 100;

            $this->finalData['mobile']['categories']['best_practices']['degree'] = $score['lighthouseResult']['categories']['best-practices']['score'] * 360;
        }

        return $this->finalData;
    }


    public function getDesktopInsights(PageSpeedInsightsService $pageSpeedInsightsService, $url)
    {
        $strategy = 'desktop';
        $score = $pageSpeedInsightsService->getScore($url, $strategy);
        $this->finalData['desktop']['strategy'] = ucfirst($strategy);

        if (isset($score['lighthouseResult']['categories'])) {
            $this->finalData['desktop']['is_data'] = true;
        }

        // Desktop
        if (isset($score['lighthouseResult']['categories']['performance'])) {

            if ((($score['lighthouseResult']['categories']['performance']['score'] * 100) >= 0) && (($score['lighthouseResult']['categories']['performance']['score'] * 100) <= 49)) {
                $this->finalData['desktop']['categories']['performance']['roundc'] = $this->poor_round_color;
                $this->finalData['desktop']['categories']['performance']['textc'] =  $this->poor_text_color;
            } else if ((($score['lighthouseResult']['categories']['performance']['score'] * 100) >= 50) && (($score['lighthouseResult']['categories']['performance']['score'] * 100) <= 89)) {
                $this->finalData['desktop']['categories']['performance']['roundc'] = $this->medium_round_color;
                $this->finalData['desktop']['categories']['performance']['textc'] = $this->medium_text_color;
            } else {
                $this->finalData['desktop']['categories']['performance']['roundc'] = $this->good_round_color;
                $this->finalData['desktop']['categories']['performance']['textc'] = $this->good_text_color;
            }

            $this->finalData['desktop']['categories']['performance']['title'] = $score['lighthouseResult']['categories']['performance']['title'];
            $this->finalData['desktop']['categories']['performance']['score'] = $score['lighthouseResult']['categories']['performance']['score'] * 100;

            $this->finalData['desktop']['categories']['performance']['degree'] = $score['lighthouseResult']['categories']['performance']['score'] * 360;
        }

        if (isset($score['lighthouseResult']['categories']['accessibility'])) {

            if ((($score['lighthouseResult']['categories']['accessibility']['score'] * 100) >= 0) && (($score['lighthouseResult']['categories']['accessibility']['score'] * 100) <= 49)) {
                $this->finalData['desktop']['categories']['accessibility']['roundc'] = $this->poor_round_color;
                $this->finalData['desktop']['categories']['accessibility']['textc'] =  $this->poor_text_color;
            } else if ((($score['lighthouseResult']['categories']['accessibility']['score'] * 100) >= 50) && (($score['lighthouseResult']['categories']['accessibility']['score'] * 100) <= 89)) {
                $this->finalData['desktop']['categories']['accessibility']['roundc'] = $this->medium_round_color;
                $this->finalData['desktop']['categories']['accessibility']['textc'] = $this->medium_text_color;
            } else {
                $this->finalData['desktop']['categories']['accessibility']['roundc'] = $this->good_round_color;
                $this->finalData['desktop']['categories']['accessibility']['textc'] = $this->good_text_color;
            }

            $this->finalData['desktop']['categories']['accessibility']['title'] = $score['lighthouseResult']['categories']['accessibility']['title'];
            $this->finalData['desktop']['categories']['accessibility']['score'] = $score['lighthouseResult']['categories']['accessibility']['score'] * 100;

            $this->finalData['desktop']['categories']['accessibility']['degree'] = $score['lighthouseResult']['categories']['accessibility']['score'] * 360;
        }

        if (isset($score['lighthouseResult']['categories']['seo'])) {

            if ((($score['lighthouseResult']['categories']['seo']['score'] * 100) >= 0) && (($score['lighthouseResult']['categories']['seo']['score'] * 100) <= 49)) {
                $this->finalData['desktop']['categories']['seo']['roundc'] = $this->poor_round_color;
                $this->finalData['desktop']['categories']['seo']['textc'] =  $this->poor_text_color;
            } else if ((($score['lighthouseResult']['categories']['seo']['score'] * 100) >= 50) && (($score['lighthouseResult']['categories']['seo']['score'] * 100) <= 89)) {
                $this->finalData['desktop']['categories']['seo']['roundc'] = $this->medium_round_color;
                $this->finalData['desktop']['categories']['seo']['textc'] = $this->medium_text_color;
            } else {
                $this->finalData['desktop']['categories']['seo']['roundc'] = $this->good_round_color;
                $this->finalData['desktop']['categories']['seo']['textc'] = $this->good_text_color;
            }

            $this->finalData['desktop']['categories']['seo']['title'] = $score['lighthouseResult']['categories']['seo']['title'];
            $this->finalData['desktop']['categories']['seo']['score'] = $score['lighthouseResult']['categories']['seo']['score'] * 100;

            $this->finalData['desktop']['categories']['seo']['degree'] = $score['lighthouseResult']['categories']['seo']['score'] * 360;
        }

        if (isset($score['lighthouseResult']['categories']['best-practices'])) {

            if ((($score['lighthouseResult']['categories']['best-practices']['score'] * 100) >= 0) && (($score['lighthouseResult']['categories']['best-practices']['score'] * 100) <= 49)) {
                $this->finalData['desktop']['categories']['best_practices']['roundc'] = $this->poor_round_color;
                $this->finalData['desktop']['categories']['best_practices']['textc'] =  $this->poor_text_color;
            } else if ((($score['lighthouseResult']['categories']['best-practices']['score'] * 100) >= 50) && (($score['lighthouseResult']['categories']['best-practices']['score'] * 100) <= 89)) {
                $this->finalData['desktop']['categories']['best_practices']['roundc'] = $this->medium_round_color;
                $this->finalData['desktop']['categories']['best_practices']['textc'] = $this->medium_text_color;
            } else {
                $this->finalData['desktop']['categories']['best_practices']['roundc'] = $this->good_round_color;
                $this->finalData['desktop']['categories']['best_practices']['textc'] = $this->good_text_color;
            }

            $this->finalData['desktop']['categories']['best_practices']['title'] = $score['lighthouseResult']['categories']['best-practices']['title'];

            $this->finalData['desktop']['categories']['best_practices']['score'] = $score['lighthouseResult']['categories']['best-practices']['score'] * 100;

            $this->finalData['desktop']['categories']['best_practices']['degree'] = $score['lighthouseResult']['categories']['best-practices']['score'] * 360;
        }

        return $this->finalData;
    }
}
