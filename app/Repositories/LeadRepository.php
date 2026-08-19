<?php

namespace App\Repositories;

use App\Data\LeadData;
use App\Enums\LeadStatus;
use App\Models\Lead;

class LeadRepository
{
    /**
     * @param LeadData $data
     * @return Lead
     */
    public function create(LeadData $data): Lead
    {
        return Lead::query()->create([
            'name' => $data->name,
            'phone' => $data->phone,
            'status' => LeadStatus::NEW // Дублирование с миграцией, но во благо обновления обьекта для получения статуса
        ]);
    }
}
