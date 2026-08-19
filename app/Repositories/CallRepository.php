<?php

namespace App\Repositories;

use App\Data\CallData;
use App\Models\Call;
use App\Models\Lead;

class CallRepository
{
    /**
     * @param Lead $lead
     * @param CallData $data
     * @return Call
     */
    public function createForLead(Lead $lead, CallData $data): Call
    {
        return $lead->calls()->create([
            'duration' => $data->duration,
            'result' => $data->result,
            'manager_id' => $data->managerId,
        ]);
    }
}
