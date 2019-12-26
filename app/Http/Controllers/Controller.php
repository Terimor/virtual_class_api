<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class Controller extends BaseController
{
    public $user;

    public function __construct()
    {
        if(auth('api')->user()) {
            $this->user = auth('api')->user();
        }
    }

    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;
}
