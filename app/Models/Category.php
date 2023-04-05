<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * @property int $parent_id
 * @property $name
 */
class Category extends Model
{
    protected $fillable = [
        'parent_id',
        'name'
    ];

    protected $casts = [
        'name' => 'json'
    ];

    public function parent(): BelongsTo
    {
        return $this->belongsTo(self::class);
    }

    public function keyNameLocale(): string
    {
        return 'name->'.request()->segment(1);
    }

    public function getLocaleName(): string
    {
        return $this->name[app()->getLocale()]
            ?? $this->name[array_key_first($this->name)];
    }

}
