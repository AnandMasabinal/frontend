<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use App\Models\lead;

class leadProcess implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $path=resource_path('temp');
        $files=glob("$path/*.csv");
        $header=[];
        foreach ($files as $key => $file) {
            $data=array_map('str_getcsv',file($file));
            if($key===0){
                $header=$data[0];
                unset($data[0]);
            }

            foreach ($data as $value) {
               $lead=new lead;
               $lead->name=$value[0];
               $lead->email=$value[1];
               $lead->mobile=$value[2];
               $lead->campgid="1";
               $lead->ftype="image";
               $lead->fupload="jjj";
               $lead->save();

            }
        }
    }
}
