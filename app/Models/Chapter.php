<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;

class Chapter extends BaseModel
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'course_id',
        'name',
        'order',
        'description'
    ];

    public function lessons()
    {
        return $this->hasMany(Lesson::class, 'chapter_id', 'id');
    }
}
