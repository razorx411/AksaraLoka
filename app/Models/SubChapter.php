<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SubChapter extends Model
{
    protected $fillable = ['chapter_id', 'title', 'order_index'];

    public function chapter()
    {
        return $this->belongsTo(Chapter::class);
    }

    public function levels()
    {
        return $this->hasMany(Level::class)->orderBy('order_index');
    }
}

