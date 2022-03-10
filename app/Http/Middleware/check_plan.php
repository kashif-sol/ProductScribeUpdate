<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class check_plan
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        $shop = Auth::User();
        
        $domain = $shop->name;
        $user = DB::table('users')->where('name', $domain)->first();
        $plan_id =$user->plan_id;
        $user_credit = $user->credit;
        if (is_null($plan_id)) {
            return redirect('/plans');
        }else{
            $plan = DB::table('plans')->where('id', $plan_id)->first();
            $plan_credit = $plan->terms;
            if($user_credit > $plan_credit ){
                return redirect('/plans');
            }
        }
       
       
        return $next($request);
    }
}
