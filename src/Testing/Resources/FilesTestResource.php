<?php

namespace DKing\OpenAI\Testing\Resources;

use DKing\OpenAI\Contracts\Resources\FilesContract;
use DKing\OpenAI\Resources\Files;
use DKing\OpenAI\Responses\Files\CreateResponse;
use DKing\OpenAI\Responses\Files\DeleteResponse;
use DKing\OpenAI\Responses\Files\ListResponse;
use DKing\OpenAI\Responses\Files\RetrieveResponse;
use DKing\OpenAI\Testing\Resources\Concerns\Testable;

final class FilesTestResource implements FilesContract
{
    use Testable;

    protected function resource(): string
    {
        return Files::class;
    }

    public function list(array $parameters = []): ListResponse
    {
        return $this->record(__FUNCTION__, func_get_args());
    }

    public function retrieve(string $file): RetrieveResponse
    {
        return $this->record(__FUNCTION__, func_get_args());
    }

    public function download(string $file): string
    {
        return $this->record(__FUNCTION__, func_get_args());
    }

    public function upload(array $parameters): CreateResponse
    {
        return $this->record(__FUNCTION__, func_get_args());
    }

    public function delete(string $file): DeleteResponse
    {
        return $this->record(__FUNCTION__, func_get_args());
    }
}
