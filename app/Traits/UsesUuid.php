<?php
namespace App\Traits;

use Illuminate\Database\Eloquent\Model;
use Ramsey\Uuid\Uuid;

trait UsesUuid
{
    public static function bootUsesUuid(): void
    {
        static::created(function(Model $model) {
            $model->id = Uuid::uuid6();
        });
    }

}
