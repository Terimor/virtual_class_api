<?php

namespace App\Http\Middleware;

use App\Member;
use Closure;

class CheckClassOwnerOrMember extends PermissionBase
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
        if($request->route('class', 0)->owner->id !== $this->user->id
            || !Member::count($this->user->id, $request->route('class', 0)->id, 0)) {
            return response()->json(self::ACCESS_FORBIDDEN, 403);
        }
        return $next($request);
    }
}
