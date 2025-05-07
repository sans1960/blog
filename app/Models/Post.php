<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Post extends Model
{
    protected $fillable = ['title','subtitle','slug','bgimage','image','category_id','summary','body','captionbg', 'captionig'];
    public function getRouteKeyName()
    {
        return 'slug';
    }
    public function category():BelongsTo
    {
        return $this->belongsTo(Category::class);
    }
}
