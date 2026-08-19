<?php

namespace App\Events;

use App\Models\Call;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class CallCreated
{
    use Dispatchable, SerializesModels;

    public function __construct(public readonly Call $call)
    {}
}
