<?php

namespace App\Models;

use App\Trait\FilterQueryTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Resource extends Model
{
    use HasFactory, FilterQueryTrait;

    protected $fillable = [
        'file_path',
        'file_type',
        'file_name',
        '',
    ];

    const TYPE_ARRAY = [
        1 => 'video',
        2 => 'ảnh',
        3 => 'tệp tin PDF',
    ];
}
