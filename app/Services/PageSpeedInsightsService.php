<?php

namespace App\Services;

use GuzzleHttp\Client;

class PageSpeedInsightsService
{
    public function getScore($url, $strategy)
    {
        $client = new Client();
        $gpsi_key = config('nexus.gpsi_key');

        $response = $client->get('https://www.googleapis.com/pagespeedonline/v5/runPagespeed', [
            'query' => [
                'url' => $url,
                'strategy' => $strategy,
                'key' => $gpsi_key,

                "category" => [
                    "pwa",
                    "performance",
                    "accessibility",
                    "best-practices",
                    "seo",
                ],
            ],
            'headers' => [
                'User-Agent' => 'Nexus',
            ],
        ]);

        $data = json_decode($response->getBody(), true);
        return $data;
    }
}
