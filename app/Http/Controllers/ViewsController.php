<?php

namespace App\Http\Controllers;

use App\Post;
use App\View;
use Illuminate\Http\Request;

class ViewsController extends Controller
{
    public function index(Post $post) {
        $views = View::where('post_id', $post->id)->with('user')->get();
        $result = [];
        foreach($views as $view) {
            $result[] = $view->user;
        };
        return $result;
    }

    public function store(Post $post) {
        return View::firstOrCreate([
            'post_id' => $post->id,
            'user_id' => $this->user->id
        ]);
    }
}
