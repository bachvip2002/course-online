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

    protected $table = 'users';

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
        'avatar',
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

    const STATUS_LIST = [
        1 => 'Active',
        2 => 'Inactive',
        3 => 'Account locked',
    ];

    const STATUES_BG_COLOR_LIST = [
        1 => 'light-success',
        2 => 'light-danger',
        3 => 'light-secondary text-black',
    ];

    protected $appends = [
        'status_text',
        'status_bg_color',
    ];


    /**
     * getAllStatus
     *
     * @return array
     */
    public function getAllStatus()
    {
        $statusObjects = [];

        foreach (self::STATUS_LIST as $id => $status) {
            $statusObjects[] = (object) [
                'id' => $id,
                'status' => $status
            ];
        }

        return $statusObjects;
    }

    /**
     * Method getTStatusTextAttribute 
     *
     * @return string
     */
    public function getStatusTextAttribute()
    {
        foreach (self::STATUS_LIST as $statusId => $status) {
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
        foreach (self::STATUES_BG_COLOR_LIST as $statusId => $status) {
            if ($statusId == $this->status) {
                return $status;
            }
        }
    }
}
