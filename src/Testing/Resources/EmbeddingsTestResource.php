<?php

namespace DKing\OpenAI\Testing\Resources;

use DKing\OpenAI\Contracts\Resources\EmbeddingsContract;
use DKing\OpenAI\Resources\Embeddings;
use DKing\OpenAI\Responses\Embeddings\CreateResponse;
use DKing\OpenAI\Testing\Resources\Concerns\Testable;

final class EmbeddingsTestResource implements EmbeddingsContract
{
    use Testable;

    protected function resource(): string
    {
        return Embeddings::class;
    }

    public function create(array $parameters): CreateResponse
    {
        return $this->record(__FUNCTION__, func_get_args());
    }
}
