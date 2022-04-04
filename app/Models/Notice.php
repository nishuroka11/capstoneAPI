<?php

namespace App\Models;

use App\Traits\Models\Uuid\UuidCreateableTrait;
use App\Traits\Models\Uuid\UuidModelBidingableTrait;
use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable;

class Notice extends Model implements Auditable
{
    use HasFactory, \OwenIt\Auditing\Auditable;

    use UuidModelBidingableTrait, UuidCreateableTrait;

    protected $primaryKey = 'notice_id';

    public $fillable = [
        'uuid',
        'fk_owner_id',
        'fk_animal_id',
        'fk_walker_id',
        'fk_from_address_id',
        'notice_title',
        'notice_description',
        'requested_date_time',
        'rating',
    ];

    public function owner()
    {
        return $this->belongsTo(User::class, 'fk_owner_id');
    }

    public function animal()
    {
        return $this->belongsTo(Animal::class, 'fk_animal_id');
    }

    public function walker()
    {
        return $this->belongsTo(User::class, 'fk_walker_id');
    }

    public function fromAddress()
    {
        return $this->belongsTo(Address::class, 'fk_from_address_id');
    }


    //filterByOwner
    public function scopeFilterByOwner($query, $ownerId)
    {
        return $query->where('fk_owner_id', $ownerId);
    }
}
