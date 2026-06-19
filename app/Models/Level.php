<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Level extends Model
{
    protected $fillable = ['sub_chapter_id', 'title', 'order_index', 'xp_reward'];

    public function subChapter()
    {
        return $this->belongsTo(SubChapter::class);
    }

    public function questions()
    {
        return $this->hasMany(Question::class);
    }

    public function userProgress()
    {
        return $this->hasMany(UserLevelProgress::class);
    }
}

