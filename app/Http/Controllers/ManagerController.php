<?php

namespace App\Http\Controllers;

use App\Http\Resources\LeadStatsResourceCollection;
use App\Models\Manager;
use App\Repositories\ManagerRepository;

class ManagerController extends Controller
{
    public function __construct(protected ManagerRepository $managerRepository)
    {}

    /**
     * @param Manager $manager
     * @return LeadStatsResourceCollection
     */
    public function leads(Manager $manager): LeadStatsResourceCollection
    {
        $leads = $this->managerRepository->leadsWithCallStats($manager);

        return new LeadStatsResourceCollection($leads);
    }
}
