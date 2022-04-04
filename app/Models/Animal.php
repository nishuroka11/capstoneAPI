<?php

namespace App\Models;

use App\Traits\Models\Uuid\UuidCreateableTrait;
use App\Traits\Models\Uuid\UuidModelBidingableTrait;
use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use OwenIt\Auditing\Contracts\Auditable;

class Animal extends Model implements Auditable
{
    use HasFactory, Sluggable, \OwenIt\Auditing\Auditable;

    use UuidModelBidingableTrait, UuidCreateableTrait;

    use SoftDeletes;

    protected $primaryKey = 'animal_id';

    public $fillable = [
        'uuid',
        'fk_owner_id',
        'animal_name',
        'animal_image_url',
        'animal_slug',
        'date_of_birth',
        'breed_type',
        'is_walking',
    ];

    /**
     * Return the sluggable configuration array for this model.
     *
     * @return array
     */
    public function sluggable(): array
    {
        return [
            'animal_slug' => [
                'source' => 'animal_name'
            ]
        ];
    }

    public function owner()
    {
        return $this->belongsTo(User::class, 'fk_owner_id');
    }

    //filterByOwner
    public function scopeFilterByOwner($query, $ownerId)
    {
        return $query->where('fk_owner_id', $ownerId);
    }

    /**
     * @return string
     */
    public function getFormattedProfilePhoto()
    {
        return getImageUrlDefaultAnimalProfile($this->animal_image_url);
    }

}
