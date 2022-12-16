<?php

namespace App\Console\Commands;

use App\Jobs\FetchPageSpeedInsightsData;
use Illuminate\Console\Command;

class FetchPageSpeedInsightsCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'espeed:fetch';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $url = 'http://kabhai.in';

        FetchPageSpeedInsightsData::dispatch($url)->onQueue('high');

        return Command::SUCCESS;
    }
}
