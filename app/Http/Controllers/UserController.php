<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index() {
        return $this->user;
    }

    public function update(Request $request) {
        $this->user->update($request->all());
        return $this->user;
    }
}
