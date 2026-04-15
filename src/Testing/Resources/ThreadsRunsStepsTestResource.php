<?php

namespace DKing\OpenAI\Testing\Resources;

use DKing\OpenAI\Contracts\Resources\ThreadsRunsStepsContract;
use DKing\OpenAI\Resources\ThreadsRunsSteps;
use DKing\OpenAI\Responses\Threads\Runs\Steps\ThreadRunStepListResponse;
use DKing\OpenAI\Responses\Threads\Runs\Steps\ThreadRunStepResponse;
use DKing\OpenAI\Testing\Resources\Concerns\Testable;

class ThreadsRunsStepsTestResource implements ThreadsRunsStepsContract
{
    use Testable;

    public function resource(): string
    {
        return ThreadsRunsSteps::class;
    }

    public function retrieve(string $threadId, string $runId, string $stepId): ThreadRunStepResponse
    {
        return $this->record(__FUNCTION__, func_get_args());
    }

    public function list(string $threadId, string $runId, array $parameters = []): ThreadRunStepListResponse
    {
        return $this->record(__FUNCTION__, func_get_args());
    }
}
