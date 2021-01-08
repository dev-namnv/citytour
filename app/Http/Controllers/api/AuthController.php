<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Models\UserLogLocation;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function logLocation(Request $request)
    {
        $data = [
            'user_id' => Auth::id(),
            'latitude'=> $request->x,
            'longitude'=> $request->y,
            'ip' => $request->ip(),
        ];
        $user = UserLogLocation::query()->orderBy('created_at','desc')
            ->firstOrCreate(['user_id'=>Auth::id()],$data);

        $updated_at = Carbon::parse($user->updated_at)->timestamp;
        $now = Carbon::now()->addHours(-2)->timestamp;
        $check = true;
        if ($updated_at < $now) {
            UserLogLocation::query()->create($data);
            $check = false;
        }
        if ($check && $user->latitude != $request->x && $user->longitude != $request->y){
            $user->update($data);
        }
        return response(['success'],200);
    }
}
