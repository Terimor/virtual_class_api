<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class StudyingClass extends Model
{
    protected $fillable = ['name', 'description', 'image', 'owner_id'];

    public function owner() {
        return $this->belongsTo('App\User', 'owner_id', 'id');
    }

    public function posts() {
        return $this->hasMany('App\Post', 'class_id');
    }

    public function members() {
        return $this->hasMany('App\Member', 'class_id');
    }
}
