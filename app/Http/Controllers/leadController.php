<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\lead;
use App\Jobs\leadProcess;

class leadController extends Controller
{
    public function index(){
        return view('uploadfile');
    }

    public function upload(){
        if(request()->has('ufile')){
            // $data=array_map('str_getcsv',file(request()->ufile));
            $data=file(request()->ufile);
            $header=$data[0];
            unset($data[0]);
            $chunks=array_chunk($data,1000);
            foreach ($chunks as $key => $value) {
                $name="/tmp{$key}.csv";
                $path=resource_path('temp');
                file_put_contents($path.$name,$value);
            }
            // foreach ($data as $value) {
            //    $lead=new lead;
            //    $lead->name=$value[0];
            //    $lead->email=$value[1];
            //    $lead->mobile=$value[2];
            //    $lead->campgid="1";
            //    $lead->ftype="image";
            //    $lead->fupload="jjj";
            //    $lead->save();
            // }

        }
    }

    public function store(){

        leadProcess::dispatch();
        return "stored";

    }
}
