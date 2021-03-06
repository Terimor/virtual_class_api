<?php

namespace App\Http\Controllers;

use App\Member;
use App\Notification;
use App\StudyingClass;
use Illuminate\Http\Request;

class NotificationsController extends Controller
{
    public function feed(Request $request) {
        $classes = array_column(Member::where('user_id', $this->user->id)->get('class_id')->toArray(), 'class_id');
        $query = Notification::whereIn('class_id', $classes)->orderBy('id', 'DESC');
        if($amount = $request->get('amount', false)) {
            $query->limit($amount);
        }
        return $query->get();
    }

    public function index(StudyingClass $class, Request $request) {
        $query = Notification::orderBy('id', 'DESC')->where('class_id', $class->id);
        if($amount = $request->get('amount', false)) {
            $query->limit($amount);
        }
        return $query->get();
    }

    public function show(StudyingClass $class, Notification $notification) {
        return $notification;
    }

    public function store(StudyingClass $class, Request $request) {
        $notification = new Notification($request->all());
        $notification->user_id = $this->user->id;
        $notification->class_id = $class->id;
        $notification->save();
        return $notification;
    }

    public function update(StudyingClass $class, Request $request) {
        return Notification::update($request->all());
    }

    public function delete(StudyingClass $class, Notification $notification) {
        $notification->delete();
        return response()->json(null, 201);
    }
}
