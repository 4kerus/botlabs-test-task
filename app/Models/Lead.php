<?php

namespace App\Models;

use App\Enums\LeadStatus;
use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Carbon;

/**
 * @property int $id
 * @property string $name
 * @property string $phone
 * @property LeadStatus $status
 * @property int|null $manager_id
 * @property Carbon $created_at
 * @property Carbon $updated_at
 * @property-read Manager|null $manager
 * @property-read Collection<int, Call> $calls
 */
#[Fillable(['name', 'phone', 'status', 'manager_id'])]
class Lead extends Model
{
    use HasFactory;

    public const int NO_ANSWER_STREAK_TO_LOSE = 3;

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
