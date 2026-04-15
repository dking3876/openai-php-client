<?php

namespace DKing\OpenAI\Testing\Resources;

use DKing\OpenAI\Contracts\Resources\ModerationsContract;
use DKing\OpenAI\Resources\Moderations;
use DKing\OpenAI\Responses\Moderations\CreateResponse;
use DKing\OpenAI\Testing\Resources\Concerns\Testable;

final class ModerationsTestResource implements ModerationsContract
{
    use Testable;

    protected function resource(): string
    {
        return Moderations::class;
    }

    public function create(array $parameters): CreateResponse
    {
        return $this->record(__FUNCTION__, func_get_args());
    }
}
