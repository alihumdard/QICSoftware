<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\Log;
use App\Models\User;

class CheckSubscription
{
    public function handle($request, Closure $next)
    {
        $user = auth()->user();

        $currentDate = Carbon::now();
   
        // Client role
        if ($user->role == user_roles('2')) {
            $expirationDate = Carbon::createFromFormat('Y-m-d', $user->sub_exp_date);
            if ($currentDate->gt($expirationDate)) {
                return redirect('/subscription-expired');
            }
        } 
    
        // Driver role
        elseif ($user->role == user_roles('3')) {

            $client = User::where(['role' => 'Client', 'id' => $user->client_id])->first();

            if ($client) {
                $expirationDate = Carbon::createFromFormat('Y-m-d', $client->sub_exp_date);
                if ($currentDate->gt($expirationDate)) {
                    return redirect('/subscription-expired');
                }
            } else {
                return redirect('/login');
            }
        }
    
        return $next($request);
    }
    
}
