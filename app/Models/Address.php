<?php

namespace App\Models;

use App\Traits\Models\Uuid\UuidCreateableTrait;
use App\Traits\Models\Uuid\UuidModelBidingableTrait;
use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use OwenIt\Auditing\Contracts\Auditable;

class Address extends Model implements Auditable
{
    use HasFactory, \OwenIt\Auditing\Auditable;

    use UuidModelBidingableTrait, UuidCreateableTrait;

    use SoftDeletes;

    protected $primaryKey = 'address_id';

    public $fillable = [
        'uuid',
        'address_line_1',
        'address_line_2',
        'address_city',
        'address_state',
        'address_country',
    ];
}
