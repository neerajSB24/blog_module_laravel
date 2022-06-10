<?php

namespace Modules\News\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;

class News extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = ['title', 'description', 'is_published'];
    
    protected static function newFactory()
    {
        return \Modules\News\Database\factories\NewsFactory::new();
    }
}
