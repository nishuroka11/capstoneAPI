<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SocialLogin extends Model
{
    use HasFactory;

    protected $fillable = [
        'fk_user_id',
        'name',
        'social_id',
        'email',
        'device_id',
        'social_media_id',
        'image_url'
    ];

    protected $primaryKey = 'login_id';
}
