<?php

namespace DKing\OpenAI\Testing\Resources;

use DKing\OpenAI\Contracts\Resources\CompletionsContract;
use DKing\OpenAI\Resources\Completions;
use DKing\OpenAI\Responses\Completions\CreateResponse;
use DKing\OpenAI\Responses\StreamResponse;
use DKing\OpenAI\Testing\Resources\Concerns\Testable;

final class CompletionsTestResource implements CompletionsContract
{
    use Testable;

    protected function resource(): string
    {
        return Completions::class;
    }

    public function create(array $parameters): CreateResponse
    {
        return $this->record(__FUNCTION__, func_get_args());
    }

    public function createStreamed(array $parameters): StreamResponse
    {
        return $this->record(__FUNCTION__, func_get_args());
    }
}
