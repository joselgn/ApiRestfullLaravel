<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;
    
    //Convert dates
    //Function that convert user Date (dd/mm/YYY) to batabase date (YYYY-MM-DD)
    public function __dateToDb($date){
        $aData   = explode('/',trim($date));        
        $getTime = strlen($aData[2])>4? substr($aData[2],-7) : '';
        $year    = strlen($aData[2])>4? substr($aData[2],0,4) : $aData[2];
        
        $newDate = $year.'-'.$aData[1].'-'.$aData[0].' '.$getTime;
        
        return trim($newDate);
    }//date convert User to BD
    
    
    
}
