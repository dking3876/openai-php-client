<?php

namespace DKing\OpenAI\Testing\Resources;

use DKing\OpenAI\Contracts\Resources\ChatContract;
use DKing\OpenAI\Resources\Chat;
use DKing\OpenAI\Responses\Chat\CreateResponse;
use DKing\OpenAI\Responses\StreamResponse;
use DKing\OpenAI\Testing\Resources\Concerns\Testable;

final class ChatTestResource implements ChatContract
{
    use Testable;

    protected function resource(): string
    {
        return Chat::class;
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
