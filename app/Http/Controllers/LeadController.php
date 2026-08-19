<?php

namespace App\Http\Controllers;

use App\Data\LeadData;
use App\Http\Resources\LeadResource;
use App\Repositories\LeadRepository;

class LeadController extends Controller
{
    public function __construct(protected LeadRepository $leadRepository)
    {}

    /**
     * @param LeadData $data
     * @return LeadResource
     */
    public function store(LeadData $data): LeadResource
    {
        $lead = $this->leadRepository->create($data);

        return new LeadResource($lead);
    }
}
