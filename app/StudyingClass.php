<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class StudyingClass extends Model
{
    protected $with = ['owner'];

    protected $attributes = [
        'image' => 'https://seeklogo.com/images/F/flutter-logo-5086DD11C5-seeklogo.com.png'
    ];

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
