<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\StudyingClass;
use App\Member;

class StudyingClassController extends Controller
{
    public function index() {
        return StudyingClass::whereHas('members', function($query) {
            $query->where('user_id', $this->user->id);
        })->get();
    }

    public function show(StudyingClass $class) {
        return $class;
    }

    public function store(Request $request) {
        $class = StudyingClass::create($request->all());
        $member = new Member;
        $member->class_id = $class->id;
        $member->user_id = $this->user->id;
        $member->save();
        return response()->json($class, 200);
    }

    public function update(Request $request, StudyingClass $class) {
        $class->update($request->all());
        return response()->json($class, 200);
    }

    public function delete(StudyingClass $class) {
        $class->delete();
        return response()->json(null, 204);
    }
}
