<?php

namespace DKing\OpenAI\Testing;

use DKing\OpenAI\Contracts\ClientContract;
use DKing\OpenAI\Contracts\Resources\VectorStoresContract;
use DKing\OpenAI\Contracts\ResponseContract;
use DKing\OpenAI\Contracts\ResponseStreamContract;
use DKing\OpenAI\Responses\StreamResponse;
use DKing\OpenAI\Testing\Requests\TestRequest;
use DKing\OpenAI\Testing\Resources\AssistantsTestResource;
use DKing\OpenAI\Testing\Resources\AudioTestResource;
use DKing\OpenAI\Testing\Resources\BatchesTestResource;
use DKing\OpenAI\Testing\Resources\ChatTestResource;
use DKing\OpenAI\Testing\Resources\CompletionsTestResource;
use DKing\OpenAI\Testing\Resources\ContainersTestResource;
use DKing\OpenAI\Testing\Resources\ConversationsTestResource;
use DKing\OpenAI\Testing\Resources\EditsTestResource;
use DKing\OpenAI\Testing\Resources\EmbeddingsTestResource;
use DKing\OpenAI\Testing\Resources\FilesTestResource;
use DKing\OpenAI\Testing\Resources\FineTunesTestResource;
use DKing\OpenAI\Testing\Resources\FineTuningTestResource;
use DKing\OpenAI\Testing\Resources\ImagesTestResource;
use DKing\OpenAI\Testing\Resources\ModelsTestResource;
use DKing\OpenAI\Testing\Resources\ModerationsTestResource;
use DKing\OpenAI\Testing\Resources\RealtimeTestResource;
use DKing\OpenAI\Testing\Resources\ResponsesTestResource;
use DKing\OpenAI\Testing\Resources\ThreadsTestResource;
use DKing\OpenAI\Testing\Resources\VectorStoresTestResource;
use PHPUnit\Framework\Assert as PHPUnit;
use Throwable;

class ClientFake implements ClientContract
{
    /**
     * @var array<array-key, TestRequest>
     */
    private array $requests = [];

    /**
     * @param  array<array-key, ResponseContract|StreamResponse|Throwable|string>  $responses
     */
    public function __construct(protected array $responses = []) {}

    /**
     * @param  array<array-key, ResponseContract|StreamResponse|Throwable|string>  $responses
     */
    public function addResponses(array $responses): void
    {
        $this->responses = [...$this->responses, ...$responses];
    }

    public function assertSent(string $resource, callable|int|null $callback = null): void
    {
        if (is_int($callback)) {
            $this->assertSentTimes($resource, $callback);

            return;
        }

        PHPUnit::assertTrue(
            $this->sent($resource, $callback) !== [],
            "The expected [{$resource}] request was not sent."
        );
    }

    private function assertSentTimes(string $resource, int $times = 1): void
    {
        $count = count($this->sent($resource));

        PHPUnit::assertSame(
            $times, $count,
            "The expected [{$resource}] resource was sent {$count} times instead of {$times} times."
        );
    }

    /**
     * @return mixed[]
     */
    private function sent(string $resource, ?callable $callback = null): array
    {
        if (! $this->hasSent($resource)) {
            return [];
        }

        $callback = $callback ?: fn (): bool => true;

        return array_filter($this->resourcesOf($resource), fn (TestRequest $resource) => $callback($resource->method(), ...$resource->args()));
    }

    private function hasSent(string $resource): bool
    {
        return $this->resourcesOf($resource) !== [];
    }

    public function assertNotSent(string $resource, ?callable $callback = null): void
    {
        PHPUnit::assertCount(
            0, $this->sent($resource, $callback),
            "The unexpected [{$resource}] request was sent."
        );
    }

    public function assertNothingSent(): void
    {
        $resourceNames = implode(
            separator: ', ',
            array: array_map(fn (TestRequest $request): string => $request->resource(), $this->requests)
        );

        PHPUnit::assertEmpty($this->requests, 'The following requests were sent unexpectedly: '.$resourceNames);
    }

    /**
     * @return array<array-key, TestRequest>
     */
    private function resourcesOf(string $type): array
    {
        return array_filter($this->requests, fn (TestRequest $request): bool => $request->resource() === $type);
    }

    public function record(TestRequest $request): ResponseContract|ResponseStreamContract|string
    {
        $this->requests[] = $request;

        $response = array_shift($this->responses);

        if (is_null($response)) {
            throw new \Exception('No fake responses left.');
        }

        if ($response instanceof Throwable) {
            throw $response;
        }

        return $response;
    }

    public function responses(): ResponsesTestResource
    {
        return new ResponsesTestResource($this);
    }

    public function conversations(): ConversationsTestResource
    {
        return new ConversationsTestResource($this);
    }

    public function realtime(): RealtimeTestResource
    {
        return new RealtimeTestResource($this);
    }

    public function completions(): CompletionsTestResource
    {
        return new CompletionsTestResource($this);
    }

    public function chat(): ChatTestResource
    {
        return new ChatTestResource($this);
    }

    public function containers(): ContainersTestResource
    {
        return new ContainersTestResource($this);
    }

    public function embeddings(): EmbeddingsTestResource
    {
        return new EmbeddingsTestResource($this);
    }

    public function audio(): AudioTestResource
    {
        return new AudioTestResource($this);
    }

    public function edits(): EditsTestResource
    {
        return new EditsTestResource($this);
    }

    public function files(): FilesTestResource
    {
        return new FilesTestResource($this);
    }

    public function models(): ModelsTestResource
    {
        return new ModelsTestResource($this);
    }

    public function fineTunes(): FineTunesTestResource
    {
        return new FineTunesTestResource($this);
    }

    public function fineTuning(): FineTuningTestResource
    {
        return new FineTuningTestResource($this);
    }

    public function moderations(): ModerationsTestResource
    {
        return new ModerationsTestResource($this);
    }

    public function images(): ImagesTestResource
    {
        return new ImagesTestResource($this);
    }

    public function assistants(): AssistantsTestResource
    {
        return new AssistantsTestResource($this);
    }

    public function threads(): ThreadsTestResource
    {
        return new ThreadsTestResource($this);
    }

    public function batches(): BatchesTestResource
    {
        return new BatchesTestResource($this);
    }

    public function vectorStores(): VectorStoresContract
    {
        return new VectorStoresTestResource($this);
    }
}
