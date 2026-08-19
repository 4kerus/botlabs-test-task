<?php

namespace App\Models;

use App\Enums\CallResult;
use App\Events\CallCreated;
use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Carbon;

/**
 * @property int $id
 * @property int $lead_id
 * @property int $manager_id
 * @property int $duration
 * @property CallResult $result
 * @property Carbon $created_at
 * @property Carbon $updated_at
 * @property-read Lead $lead
 * @property-read Manager $manager
 */
#[Fillable(['lead_id', 'manager_id', 'duration', 'result'])]
class Call extends Model
{
    use HasFactory;

    protected $dispatchesEvents = [
        'created' => CallCreated::class,
    ];

    protected function casts(): array
    {
        return [
            'result' => CallResult::class,
        ];
    }

    public function lead(): BelongsTo
    {
        return $this->belongsTo(Lead::class);
    }

    public function manager(): BelongsTo
    {
        return $this->belongsTo(Manager::class);
    }
}
