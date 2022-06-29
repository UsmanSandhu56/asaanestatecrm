<?php

namespace App\Console\Commands;
use App\Models\Role;

use App\Models\Agency;
use App\Models\Scraper;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;

class ScraperZameenCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'zameen:urls agency:{agency_id} scraper:{scraper_id}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
      

        $id = $this->argument('agency_id');
   
  
        $agency =  Agency::find($id);
        $users = DB::table('agency_user')
        ->select('user_id')
        ->where('agency_id', $id)
        ->get();

       $finduser = Role::where('agency_id',$id)->where('name','Owner')->first();
   
       $users = DB::table('users_roles')
        ->select('user_id')
        ->where('role_id', $finduser->id)
        ->first();
        $updatestatus = Scraper::find($this->argument('scraper_id'));

   $test = exec("node index.js ".$agency->id." ".$agency->zameen_url." ".$users->user_id."");
  
        if ($test) {
        
            $updatestatus->status =1;
            $updatestatus->update();
        } 
        else {
            $updatestatus->status =2;
            $updatestatus->update();
        }


       
       
    }
}
