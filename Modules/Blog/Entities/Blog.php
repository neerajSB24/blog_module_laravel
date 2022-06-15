<?php

namespace Modules\Blog\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;

class Blog extends Model
{
    use HasFactory;
    use SoftDeletes;
    protected $table = 'blogs';

    protected $fillable = ['title', 'description'];
    
    protected static function newFactory()
    {
        return \Modules\Blog\Database\factories\BlogFactory::new();
    }

     public function blogById($id)
     {
         $blog = Blog::find($id);
         if($blog){
             return $blog;
         }
         return false;
     }
}
