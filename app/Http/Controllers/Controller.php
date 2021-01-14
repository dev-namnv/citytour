<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;


    public function getOnTime($query,$date, $type = 'days', $paginate = 0)
    {
        $end = 0;
        switch ($type) {
            case 'days': $end = Carbon::create($date)->endOfDay()->timestamp;
                break;
            case 'months': $end = Carbon::create($date)->endOfMonth()->timestamp;
                break;
            case 'years': $end = Carbon::create($date)->endOfYear()->timestamp;
                break;
            default : return false;
        }
        $start = strtotime('-1 ' . $type,$end + 1);
        $result = $query->where('created_at', '>', date('Y-m-d H:i:s',$start))
            ->where('created_at', '<=', date('Y-m-d H:i:s',$end));
        if ($paginate != 0) {
            $result = $result->paginate($paginate);
        } else {
            $result = $result->get();
        }
        return $result;
    }
}
