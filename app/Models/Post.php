<?php

namespace App\Models;

use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;
use Cviebrock\EloquentSluggable\Services\SlugService;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Post extends Model
{
    use HasFactory;
    use Sluggable;

    protected $fillable = ['title', 'slug', 'description', 'image_path', 'user_id'];

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

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    function comments(){
    	return $this->hasMany(Comment::class)->orderBy('id','desc');
    }

    public function sluggable(): array
    {
        return [
            'slug' => [
                'source' => 'title'
            ]
        ];
    }
}
