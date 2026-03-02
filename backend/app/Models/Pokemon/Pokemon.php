<?php

namespace App\Models\Pokemon;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Carbon;

/**
 * @property int $id
 * @property string $name
 * @property string $type
 * @property float $height
 * @property float $weight
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property Carbon|null $deleted_at
 */

class Pokemon extends Model
{
    use SoftDeletes;

    protected $table = 'pokemon';

    protected $fillable = [
        'name',
        'type',
        'height',
        'weight',
    ];

    public function getRouteKeyName()
    {
        return parent::getRouteKeyName();
    }
}
