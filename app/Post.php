<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    protected $with = ['class'];

    protected $appends = ['views_amount'];

    protected $fillable = ['content', 'attachments', 'class_id', 'user_id', 'title'];

    protected $casts = [
        'attachments' => 'array'
    ];

    public function user() {
        return $this->belongsTo('App\User', 'user_id', 'id');
    }

    public function class() {
        return $this->belongsTo('App\StudyingClass', 'class_id', 'id');
    }

    public function views() {
        return $this->hasMany('App\View');
    }

    public function getViewsAmountAttribute() {
        return $this->views()->count();
    }
}
