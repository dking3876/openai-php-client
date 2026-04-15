<?php

declare(strict_types=1);

namespace DKing\OpenAI\Responses\Concerns;

use DKing\OpenAI\Responses\Meta\MetaInformation;

trait HasMetaInformation
{
    public function meta(): MetaInformation
    {
        return $this->meta;
    }
}
