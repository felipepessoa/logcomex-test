<?php

namespace App\Models\Traits;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

trait HasUuid
{
    public static function bootHasUuid(): void
    {
        static::creating(function (Model $model): void {
            if(empty($model->uuid)) {
                $model->uuid = (string) Str::uuid7();
            }
        });
    }

    public function getRouteKeyName(): string
    {
        return 'uuid';
    }
}
