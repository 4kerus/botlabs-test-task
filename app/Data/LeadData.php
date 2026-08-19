<?php

namespace App\Data;

use Spatie\LaravelData\Attributes\Validation\Max;
use Spatie\LaravelData\Data;

class LeadData extends Data
{
    public function __construct(
        #[Max(255)]
        public string $name,
        #[Max(32)]
        public string $phone,
    ) {}
}