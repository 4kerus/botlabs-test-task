<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

#[Fillable(['name'])]
class Manager extends Model
{
    public function leads(): HasMany
    {
        return $this->hasMany(Lead::class);
    }
}
