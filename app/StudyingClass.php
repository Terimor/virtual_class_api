<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class StudyingClass extends Model
{
    protected $fillable = ['name', 'description', 'image', 'owner_id'];

    public function owner() {
        return $this->belongsTo('App\User', 'owner_id', 'id');
    }
}
