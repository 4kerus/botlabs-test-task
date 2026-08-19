<?php

namespace App\Repositories;

use App\Models\Manager;
use Illuminate\Database\Eloquent\Collection;

class ManagerRepository
{
    /**
     * @param Manager $manager
     * @return Collection
     */
    public function leadsWithCallStats(Manager $manager): Collection
    {
        return $manager->leads()
            ->withCount('calls')
            ->withSum('calls as total_call_duration', 'duration')
            ->get();
    }
}
