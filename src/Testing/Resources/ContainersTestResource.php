<?php

namespace DKing\OpenAI\Testing\Resources;

use DKing\OpenAI\Contracts\Resources\ContainerFileContract;
use DKing\OpenAI\Contracts\Resources\ContainersContract;
use DKing\OpenAI\Resources\Containers;
use DKing\OpenAI\Responses\Containers\CreateContainer;
use DKing\OpenAI\Responses\Containers\DeleteContainer;
use DKing\OpenAI\Responses\Containers\ListContainers;
use DKing\OpenAI\Responses\Containers\RetrieveContainer;
use DKing\OpenAI\Testing\Resources\Concerns\Testable;

final class ContainersTestResource implements ContainersContract
{
    use Testable;

    public function resource(): string
    {
        return Containers::class;
    }

    public function create(array $parameters): CreateContainer
    {
        return $this->record(__FUNCTION__, func_get_args());
    }

    public function retrieve(string $id): RetrieveContainer
    {
        return $this->record(__FUNCTION__, func_get_args());
    }

    public function list(array $parameters = []): ListContainers
    {
        return $this->record(__FUNCTION__, func_get_args());
    }

    public function delete(string $id): DeleteContainer
    {
        return $this->record(__FUNCTION__, func_get_args());
    }

    public function files(): ContainerFileContract
    {
        return new ContainerFileTestResource($this->fake);
    }
}
