<?php

namespace App\Http\Middleware;

use App\Models\Logs_safety;
use App\User;
use Closure;
use Illuminate\Support\Facades\Auth;
//use

class TimeBasedRestriction
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $time_start_session = Auth::user()->time_begin;
        $time_stop_session = Auth::user()->time_stop;

        if (!now()->isBetween($time_start_session, $time_stop_session)) {
            return response()->view('welcome'); // Status forbidden
        }
        $date_last_password = User::where('id', '=', Auth::user()->id)->first()->updated_at;
        $time_live_password = Logs_safety::first();
        $url = $_SERVER['REQUEST_URI'];
        if ($url != '/change-password'){
//            dd(Auth::user()->id);
            if (strtotime(now()) > strtotime($date_last_password.' +'.$time_live_password->time_password.' days')){
                return response()->view('change_pass');
            }
        }
        return $next($request);
    }
}
