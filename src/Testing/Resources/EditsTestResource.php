<?php

namespace DKing\OpenAI\Testing\Resources;

use DKing\OpenAI\Contracts\Resources\EditsContract;
use DKing\OpenAI\Resources\Edits;
use DKing\OpenAI\Responses\Edits\CreateResponse;
use DKing\OpenAI\Testing\Resources\Concerns\Testable;

final class EditsTestResource implements EditsContract
{
    use Testable;

    protected function resource(): string
    {
        return Edits::class;
    }

    public function create(array $parameters): CreateResponse
    {
        return $this->record(__FUNCTION__, func_get_args());
    }
}
