<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Contracts\Queue\ShouldBeUnique;

class ScraperJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    protected $agency_id;
    protected $scraper_id;


    public function __construct($agency_id,$scraper_id)
    {
        $this->agency_id =$agency_id;
        $this->scraper_id =$scraper_id;

    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
     
        \Artisan::call('zameen:urls '.$this->agency_id.' '.$this->scraper_id);
       
    }
   
}
