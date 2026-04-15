<?php

namespace DKing\OpenAI\Testing\Resources;

use DKing\OpenAI\Contracts\Resources\ModelsContract;
use DKing\OpenAI\Resources\Models;
use DKing\OpenAI\Responses\Models\DeleteResponse;
use DKing\OpenAI\Responses\Models\ListResponse;
use DKing\OpenAI\Responses\Models\RetrieveResponse;
use DKing\OpenAI\Testing\Resources\Concerns\Testable;

final class ModelsTestResource implements ModelsContract
{
    use Testable;

    protected function resource(): string
    {
        return Models::class;
    }

    public function list(): ListResponse
    {
        return $this->record(__FUNCTION__);
    }

    public function retrieve(string $model): RetrieveResponse
    {
        return $this->record(__FUNCTION__, func_get_args());
    }

    public function delete(string $model): DeleteResponse
    {
        return $this->record(__FUNCTION__, func_get_args());
    }
}
