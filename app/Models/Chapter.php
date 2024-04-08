<?php

namespace App\Models;

use App\Trait\FilterQueryTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Chapter extends Model
{
    use HasFactory, SoftDeletes, FilterQueryTrait;

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
