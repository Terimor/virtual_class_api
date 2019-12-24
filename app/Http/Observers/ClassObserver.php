<?php

namespace App\Observers;

use App\StudyingClass;

class ClassObserver
{
    public static function saving(StudyingClass $model) {
        $model->owner_id = 1;
    }
}