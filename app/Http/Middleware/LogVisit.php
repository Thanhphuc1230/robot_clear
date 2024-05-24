<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use App\Models\Visit;
use Carbon\Carbon;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\DB;
class LogVisit
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        // Get the current date
        $currentDate = now()->toDateString();

        // Generate a unique session key
        $sessionKey = 'visit_' . $request->ip() . '_' . $currentDate;

        // Check if the session for the current date and IP address exists
        if (!$request->session()->has($sessionKey)) {
            // Increment the visit count for the current date or create a new record
            Visit::firstOrCreate(['visit_date' => $currentDate], ['visit_count' => DB::raw('visit_count + 1')]);

            // Set the session to mark the visit
            $request->session()->put($sessionKey, true);
        }

        return $next($request);
    }
}
