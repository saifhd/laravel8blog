<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;
    protected $with=['user','category'];


    protected $fillable=['title','slug','image','body',
        'category_id','user_id'
    ];

    

    public function scopeFilter($query,$search){

        return $query->where('title','Like',"%$search%")->orWhere('body','Like',"%$search%");
    }

    public function user(){
        return $this->belongsTo(user::class);
    }
    public function category(){
        return $this->belongsTo(category::class);
    }
}
