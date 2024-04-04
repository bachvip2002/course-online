<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;

class Course extends BaseModel
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'code',
        'name',
        'price',
        'status',
        'image_path',
        'release_datetime',
        'description',
    ];

    public function chapters()
    {
        return $this->hasMany(Chapter::class, 'course_id', 'id');
    }
}
