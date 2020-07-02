<?php

namespace App\Http\Middleware;

use App\Model\Brief;
use App\Traits\ApiResponse;
use Illuminate\Support\Facades\Auth;
use Closure;

class BriefDataAccess
{

    use ApiResponse;

    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if ($request->brief_id ?? true)
            $this->sendError('Bad Request', 400);

        $brief = Brief::find($request->brief_id);

        if (!$brief)
            $this->sendError('Bad Request', 400);

        if ($brief && $brief->user_id == Auth::user()->id)
            return $next($request);
        else
            $this->sendError('Forbidden', 403);
    }
}
