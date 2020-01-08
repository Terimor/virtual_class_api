<?php

namespace App\Http\Controllers;

use App\Notification;
use App\StudyingClass;
use Illuminate\Http\Request;

class NotificationsController extends Controller
{
    public function feed(Request $request) {

    }

    public function index(StudyingClass $class, Request $request) {
        $query = Notification::orderBy('id', 'DESC');
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
