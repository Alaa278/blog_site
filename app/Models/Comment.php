<?php

namespace App\Models;

use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Comment extends Model
{
    use HasFactory;
    public static function boot()
    {
        parent::boot();
        static::creating(function ($model) {
            $model->created_by = Auth::id() ? Auth::id() : 1;
            $model->updated_by = Auth::id() ? Auth::id() : 1;
        });
        static::updating(function ($model) {
            $model->updated_by = Auth::id() ? Auth::id() : 1;
        });
    }
    function user(){
    	return $this->belongsTo(User::class);
    }
    function post(){
    	return $this->belongsTo(Post::class);
    }
}
