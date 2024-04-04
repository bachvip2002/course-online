<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;

class Resource extends BaseModel
{
    use HasFactory;

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
