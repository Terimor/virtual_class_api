<?php

namespace App\Http\Controllers;

use App\Member;
use App\StudyingClass;
use Illuminate\Http\Request;

class MembersController extends Controller
{
    public function index(StudyingClass $class) {
        $members = Member::where('class_id', $class->id)->with('user')->get();
        $result = [];
        foreach($members as $member) {
            $result[] = $member->user;
        };
        return $result;
    }

    public function store(Request $request, StudyingClass $class) {
        return Member::findOrCreate($request->get('user_id', 0), $class->id);
    }

    public function delete(Request $request, StudyingClass $class) {
        if($class) {
            Member::where([
                'user_id' => $request->get('user_id'),
                'class_id' => $class->id
            ])->delete();
            return response()->json(null, 204);
        } else {
            return response()->json([
                'message' => 'Uncorrect query parameters'
            ]);
        }
    }
}
