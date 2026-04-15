<?php

declare(strict_types=1);

namespace DKing\OpenAI\Contracts;

use OpenAI\Responses\Meta\MetaInformation;

interface ResponseHasMetaInformationContract
{
    public function meta(): MetaInformation;
}
