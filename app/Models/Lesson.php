<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;

class Lesson extends BaseModel
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'chapter_id',
        'name',
        'try_learning',
        'release_datetime',
        'type',
        'video_path',
        'avatar_path',
        'description',
        'order',
    ];

    const TYPE_ARRAY = [
        1 => 'video',
    ];


    public function chapter()
    {
        return $this->belongsTo(chapter::class, 'chapter_id', 'id');
    }
}
