<?php

namespace App\Models;

use App\Trait\FilterQueryTrait;
use Illuminate\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Model
{
    use HasApiTokens,
        HasFactory,
        Notifiable,
        Authenticatable,
        SoftDeletes,
        FilterQueryTrait;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'full_name',
        'email',
        'password',
        'id_login',
        'status',
        'address',
        'phone_number',
        'avatar_path',
        'description',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

    const DEFAULT_STATUES = [
        1 => 'Hoạt động',
        2 => 'Không hoạt động',
        3 => 'Tài khoản bị khóa',
    ];

    const DEFAULT_STATUES_BG_COLOR = [
        1 => 'light-success',
        2 => 'light-danger',
        3 => 'light-secondary text-black',
    ];

    /**
     * Method getTStatusTextAttribute 
     *
     * @return string
     */
    public function getStatusTextAttribute()
    {
        foreach (self::DEFAULT_STATUES as $statusId => $status) {
            if ($statusId == $this->status) {
                return $status;
            }
        }
    }


    /**
     * Method getTStatusTextAttribute 
     *
     * @return string
     */
    public function getStatusBgColorAttribute()
    {
        foreach (self::DEFAULT_STATUES_BG_COLOR as $statusId => $status) {
            if ($statusId == $this->status) {
                return $status;
            }
        }
    }
}
