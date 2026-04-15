<?php

declare(strict_types=1);

namespace DKing\OpenAI\Resources\Concerns;

use DKing\OpenAI\Contracts\TransporterContract;

trait Transportable
{
    public function __construct(private readonly TransporterContract $transporter)
    {
        // ..
    }
}
