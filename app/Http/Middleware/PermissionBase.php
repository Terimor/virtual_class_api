<?php

namespace App\Http\Middleware;

class PermissionBase {

    public $user;

    public const ACCESS_FORBIDDEN = [
        'message' => 'Access forbidden'
    ];

    public function __construct() {
        $this->user = auth('api')->user();
    }
}