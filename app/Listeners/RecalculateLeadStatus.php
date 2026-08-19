<?php

namespace App\Listeners;

use App\Enums\CallResult;
use App\Enums\LeadStatus;
use App\Events\CallCreated;
use App\Models\Lead;

class RecalculateLeadStatus
{
    public function handle(CallCreated $event): void
    {
        $call = $event->call;
        $lead = $call->lead;

        if ($lead->status === LeadStatus::NEW) {
            $lead->status = LeadStatus::IN_PROGRESS;
        }

        if ($lead->manager_id === null) {
            $lead->manager_id = $call->manager_id;
        }

        if ($call->result === CallResult::SUCCESS) {
            $lead->status = LeadStatus::WON;
        } elseif ($this->lastCallsAreNoAnswer($lead)) {
            $lead->status = LeadStatus::LOST;
        }

        $lead->save();
    }

    private function lastCallsAreNoAnswer(Lead $lead): bool
    {
        $lastResults = $lead->calls()->latest('id')->take(Lead::NO_ANSWER_STREAK_TO_LOSE)->pluck('result');

        return $lastResults->count() === Lead::NO_ANSWER_STREAK_TO_LOSE
            && $lastResults->every(fn (CallResult $result) => $result === CallResult::NO_ANSWER);
    }
}
