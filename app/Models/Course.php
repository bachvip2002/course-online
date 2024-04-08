<?php

namespace App\Models;

use App\Trait\FilterQueryTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Course extends Model
{
    use HasFactory, SoftDeletes, FilterQueryTrait;

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
