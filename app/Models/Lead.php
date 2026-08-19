<?php

namespace App\Models;

use App\Enums\LeadStatus;
use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

#[Fillable(['name', 'phone', 'manager_id'])]
class Lead extends Model
{
    protected function casts(): array
    {
        return [
            'status' => LeadStatus::class,
        ];
    }
    public function manager(): BelongsTo
    {
        return $this->belongsTo(Manager::class);
    }

    public function calls(): HasMany
    {
        return $this->hasMany(Call::class);
    }
}
