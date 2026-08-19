<?php

namespace App\Http\Resources;

use App\Models\Lead;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

// TODO: calls_count/total_call_duration динамические атрибуты, наподумать как переписать по архитектуре
/**
 * @mixin Lead
 * @property int $calls_count
 * @property int|null $total_call_duration
 */
class LeadStatsResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'status' => $this->status->value,
            'calls_count' => $this->calls_count,
            'total_call_duration' => (int) $this->total_call_duration,
        ];
    }
}
