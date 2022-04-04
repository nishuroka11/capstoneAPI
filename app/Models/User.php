<?php

namespace App\Models;

use App\Traits\Models\Uuid\UuidCreateableTrait;
use App\Traits\Models\Uuid\UuidModelBidingableTrait;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Fortify\TwoFactorAuthenticatable;
use Laravel\Jetstream\HasProfilePhoto;
use Laravel\Sanctum\HasApiTokens;
use OwenIt\Auditing\Contracts\Auditable;
use Spatie\Permission\Exceptions\PermissionDoesNotExist;
use Spatie\Permission\Traits\HasRoles;
use Tymon\JWTAuth\Contracts\JWTSubject;

class User extends Authenticatable implements JWTSubject, Auditable
{
    use \OwenIt\Auditing\Auditable;

    use UuidModelBidingableTrait, UuidCreateableTrait;

    protected $primaryKey = 'user_id';

    use HasApiTokens;
    use HasFactory;
    use HasProfilePhoto;
    use Notifiable;
    use TwoFactorAuthenticatable;
    use SoftDeletes;
    use HasRoles {
        hasPermissionTo as hasPermissionToOriginal;
    }

    public function hasPermissionTo($permission, $guardName = '*'): bool
    {
        if(empty($guardName)){
            $guardName = '*';
        }
        try{
            return $this->hasPermissionToOriginal($permission, $guardName);
        }catch (PermissionDoesNotExist $exception){
            $userMessage = '';
            if(getSessionUser()){
                $userMessage.= ' for the user ' .  getSessionUser()->name;
            }
            \Log::error("Permission does not exist on " . $permission . $userMessage);
            return false;
        }
    }

    /**
     * Get the identifier that will be stored in the subject claim of the JWT.
     *
     * @return mixed
     */
    public function getJWTIdentifier()
    {
        return $this->getKey();
    }

    /**
     * Return a key value array, containing any custom claims to be added to the JWT.
     *
     * @return array
     */
    public function getJWTCustomClaims()
    {
        return [];
    }

    const USER_TYPE_FOR_ADMIN = 1;
    const USER_TYPE_FOR_OWNER = 2;
    const USER_TYPE_FOR_WALKER = 3;

    const USER_TYPES = [
        self::USER_TYPE_FOR_ADMIN => 'Admin',
        self::USER_TYPE_FOR_OWNER => 'Owner',
        self::USER_TYPE_FOR_WALKER => 'Walker',
    ];

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'uuid',
        'user_type_id',
        'name',
        'email',
        'years_of_experience',
        'average_rating',
        'is_available',
        'password',
        'profile_photo_path',
        'email_verified_at',
        'created_social_media_id',
        'email_verification_code',
        'password_changed_at'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
        'two_factor_recovery_codes',
        'two_factor_secret',
        'email_verification_code',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /**
     * The accessors to append to the model's array form.
     *
     * @var array
     */
    protected $appends = [
        'profile_photo_url',
    ];

    /**
     * @var string[]
     */
    protected $with = ['roles', 'permissions'];


    /**
     * Retrieve the main role
     * @return mixed|null
     */
    public function mainRole()
    {
        return $this->roles()->first();
    }

    public function animal()
    {
        return $this->hasOne(Animal::class, 'fk_owner_id');
    }

    public function animals()
    {
        return $this->hasMany(Animal::class, 'fk_owner_id');
    }

    /**
     * Checks if user is super admin
     * @return bool
     */
    public function isSuperAdministrator()
    {
        return $this->is_super_administrator;
    }

    /**
     * @return bool
     */
    public function isEmptyEmail()
    {
        return empty($this->email);
    }

    /**
     * @return bool
     */
    public function isEmptyVerified()
    {
        return empty($this->email_verified_at);
    }

    /**
     * @return bool
     */
    public function isEmptyPassword()
    {
        return empty($this->password);
    }

    /**
     * @return string
     */
    public function getFormattedProfilePhoto()
    {
        return getImageUrlDefaultProfile($this->profile_photo_path);
    }

    /**
     * @param $code
     * @return bool
     */
    public function isEmailVerificationCodeCorrect($code)
    {
        if ($this->email_verification_code != $code) {
            return false;
        }

        if ($this->email_verification_expires_at >= now()->toDateTimeString()) {
            return false;
        }

        return true;
    }

    /**
     * @param array $data
     * @return bool
     */
    public function isTokenValid($data = [])
    {
        $isValid = true;
        if(!empty($data['iat_time'])){
            if(!empty($this->password_changed_at) && Carbon::parse($data['iat_time'])->lessThan($this->password_changed_at)){
                return false;
            }
        }

        return $isValid;
    }

    public function isUserTypeOwner()
    {
        return ($this->user_type_id == self::USER_TYPE_FOR_OWNER);
    }
}
