<?php

namespace DKing\OpenAI\Testing\Resources;

use DKing\OpenAI\Contracts\Resources\ImagesContract;
use DKing\OpenAI\Resources\Images;
use DKing\OpenAI\Responses\Images\CreateResponse;
use DKing\OpenAI\Responses\Images\EditResponse;
use DKing\OpenAI\Responses\Images\VariationResponse;
use DKing\OpenAI\Testing\Resources\Concerns\Testable;

final class ImagesTestResource implements ImagesContract
{
    use Testable;

    protected function resource(): string
    {
        return Images::class;
    }

    public function create(array $parameters): CreateResponse
    {
        return $this->record(__FUNCTION__, func_get_args());
    }

    public function edit(array $parameters): EditResponse
    {
        return $this->record(__FUNCTION__, func_get_args());
    }

    public function variation(array $parameters): VariationResponse
    {
        return $this->record(__FUNCTION__, func_get_args());
    }
}
