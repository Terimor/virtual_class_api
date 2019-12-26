<?php

namespace App\Http\Middleware;

use App\StudyingClass;
use Closure;

class CheckClassOwner extends PermissionBase
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
        if($request->route('class', 0)->owner->id !== $this->user->id) {
            return response()->json(self::ACCESS_FORBIDDEN, 403);
        }
        return $next($request);
    }
}
