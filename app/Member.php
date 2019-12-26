<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Member extends Model
{
    public $timestamps = false;

    protected $fillable = ['class_id', 'user_id'];

    public function class() {
        return $this->belongsTo('App\StudyingClass', 'class_id', 'id');
    }

    public function user() {
        return $this->belongsTo('App\User', 'user_id', 'id');
    }

    public static function count($user_id, $class_id) {
        return Member::where([
            'class_id' => $class_id,
            'user_id' => $user_id
        ])->count();
    }

    public static function findOrCreate($user_id, $class_id) {
        $params = [
            'user_id' => $user_id,
            'class_id' => $class_id
        ];
        return self::where($params)->first() ?: self::create($params);
    }
}
