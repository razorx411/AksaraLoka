<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Chapter extends Model
{
    protected $fillable = ['title', 'description', 'order_index', 'image'];

    public function subChapters()
    {
        return $this->hasMany(SubChapter::class)->orderBy('order_index');
    }
}

