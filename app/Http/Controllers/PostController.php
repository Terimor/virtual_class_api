<?php

namespace App\Http\Controllers;

use App\StudyingClass;
use App\Post;
use App\Member;
use App\Notification;
use Illuminate\Http\Request;

class PostController extends Controller
{
    public function index(StudyingClass $class) {
        return Post::where('class_id', $class->id)
            ->with('user')->orderBy('id', 'DESC')->get();
    }

    public function show(StudyingClass $class, Post $post) {
        return $post;
    }

    public function store(Request $request, StudyingClass $class) {
        $post = new Post($request->all());
        $notification = new Notification;
        $notification->class_id = $post->class_id = $class->id;
        $notification->user_id = $post->user_id = $this->user->id;
        $notification->content = $post->title;
        $post->save();
        $notification->save();
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
