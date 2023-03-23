<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use App\Models\User;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public function checkToken($userid,$usertoken){
        $verifiedToken = User::query()
                               ->select('id')
                               ->where('id',$userid)
                               ->where('userToken',$usertoken)
                               ->get(); 
                               
        if(count($verifiedToken) > 0){
           return $verifiedToken[0]->id;
       }
   }
}
