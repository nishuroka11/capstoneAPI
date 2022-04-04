<?php

namespace App\Models;

use App\Traits\Models\Uuid\UuidCreateableTrait;
use App\Traits\Models\Uuid\UuidModelBidingableTrait;
use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use OwenIt\Auditing\Contracts\Auditable;

class PagePost extends Model implements Auditable
{
    use HasFactory, Sluggable, \OwenIt\Auditing\Auditable;

    use SoftDeletes;

    use UuidModelBidingableTrait, UuidCreateableTrait;

    protected $primaryKey = 'page_post_id';

    public $fillable = [
        'uuid',
        'page_post_name',
        'page_post_description',
        'page_post_slug'
    ];

    /**
     * Return the sluggable configuration array for this model.
     *
     * @return array
     */
    public function sluggable(): array
    {
        return [
            'page_post_slug' => [
                'source' => 'page_post_name'
            ]
        ];
    }
}
