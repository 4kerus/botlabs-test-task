<?php

namespace App\Data;

use App\Enums\CallResult;
use Spatie\LaravelData\Attributes\MapInputName;
use Spatie\LaravelData\Attributes\Validation\Exists;
use Spatie\LaravelData\Attributes\Validation\Min;
use Spatie\LaravelData\Data;
use Spatie\LaravelData\Mappers\SnakeCaseMapper;

#[MapInputName(SnakeCaseMapper::class)]
class CallData extends Data
{
    public function __construct(
        #[Min(0)]
        public int $duration,
        public CallResult $result,
        #[Exists('managers', 'id')]
        public int $managerId,
    ) {}
}