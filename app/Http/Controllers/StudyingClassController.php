<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\StudyingClass;

class StudyingClassController extends Controller
{
    public function index() {
        return StudyingClass::all();
    }

    public function show(StudyingClass $class) {
        return $class;
    }

    public function store(Request $request) {
        $class = StudyingClass::create($request->all());

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
