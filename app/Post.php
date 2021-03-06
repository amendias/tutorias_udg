<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    protected $fillable = [
        'id', 'name', 'description', 'user_id', 'module_id', 'created_at'
    ];

    public function user()
    {
        return $this->belongsTo('App\User');
    }

    public function module()
    {
        return $this->belongsTo('App\Module');
    }

    public function files()
    {
        return $this->morphMany('App\File', 'foreign');
    }
}
