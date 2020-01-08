<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Notification extends Model
{
    protected $with = ['class'];

    protected $fillable = ['class_id', 'content', 'user_id'];

    public function class() {
        return $this->belongsTo('App\StudyingClass', 'class_id', 'id');
    }

    public function user() {
        return $this->belongsTo('App\User', 'user_id', 'id');
    }
}
