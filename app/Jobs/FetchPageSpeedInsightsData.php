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
    public function __construct(string $url)
    {
        $this->url = $url;
    }

    /**
     * Execute the job.
     *
     * @return void
     */

    public function handle(PageSpeedInsightsService $pageSpeedInsightsService)
    {
        $url = 'https://kabhai.in';

        $desktopData = $pageSpeedInsightsService->getScore($url, 'desktop');
        $mobileData = $pageSpeedInsightsService->getScore($url, 'mobile');

        Log::info('pageSpeedInsight Desktop :', array($desktopData));
    }

}
