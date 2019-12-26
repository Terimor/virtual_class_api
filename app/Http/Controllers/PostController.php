<?php

namespace App\Http\Controllers;

use App\StudyingClass;
use App\Post;
use App\Member;
use Illuminate\Http\Request;

class PostController extends Controller
{
    public function index(StudyingClass $class) {
        return Post::where('class_id', $class->id)
            ->with('user')->get();
    }

    public function show(StudyingClass $class, Post $post) {
        $post->user = $post->user;
        return $post;
    }

    public function store(Request $request, StudyingClass $class) {
        $post = new Post($request->all());
        $post->class_id = $class->id;
        $post->user_id = $this->user->id;
        $post->save();
        return $post;
    }

    public function update(Request $request, StudyingClass $class, Post $post) {
        $post->update($request->all());
        return $post;
    }

    public function delete(StudyingClass $class, Post $post) {
        $post->delete();
        return response()->json(null, 204);
    }
}
