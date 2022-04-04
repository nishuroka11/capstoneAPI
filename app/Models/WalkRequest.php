<?php

namespace App\Models;

use App\Traits\Models\Uuid\UuidCreateableTrait;
use App\Traits\Models\Uuid\UuidModelBidingableTrait;
use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use OwenIt\Auditing\Contracts\Auditable;

class WalkRequest extends Model implements Auditable
{
    use HasFactory, \OwenIt\Auditing\Auditable;

    use UuidModelBidingableTrait, UuidCreateableTrait;

    protected $primaryKey = 'request_id';

    const STATUS_FOR_PENDING = 'pending';
    const STATUS_FOR_APPROVED = 'approved';
    const STATUS_FOR_REJECTED = 'rejected';
    const STATUS_FOR_COMPLETED = 'completed';

    public $fillable = [
        'uuid',
        'fk_notice_id',
        'fk_owner_id',
        'fk_animal_id',
        'fk_walker_id',
        'request_status',
        'owner_requested_at',
        'owner_rejected_at',
        'walker_approved_at',
        'walker_rejected_at',
        'completed_at',
    ];
}
