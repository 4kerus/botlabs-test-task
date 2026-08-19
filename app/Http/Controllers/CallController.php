<?php

namespace App\Http\Controllers;

use App\Data\CallData;
use App\Http\Resources\CallResource;
use App\Models\Lead;
use App\Repositories\CallRepository;

class CallController extends Controller
{
    public function __construct(protected CallRepository $callRepository)
    {}

    /**
     * @param Lead $lead
     * @param CallData $data
     * @return CallResource
     */
    public function store(Lead $lead, CallData $data): CallResource
    {
        $call = $this->callRepository->createForLead($lead, $data);

        return new CallResource($call);
    }
}
