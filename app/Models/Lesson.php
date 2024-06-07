<?php

namespace App\Models;

use App\Trait\FilterQueryTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Lesson extends Model
{
    use HasFactory, SoftDeletes, FilterQueryTrait;

    protected $fillable = [
        'chapter_id',
        'name',
        'try_learning',
        'release_datetime',
        'type',
        'video',
        'avatar',
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
