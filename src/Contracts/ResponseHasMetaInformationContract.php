<?php

declare(strict_types=1);

namespace DKing\OpenAI\Contracts;

use DKing\OpenAI\Responses\Meta\MetaInformation;

interface ResponseHasMetaInformationContract
{
    public function meta(): MetaInformation;
}
