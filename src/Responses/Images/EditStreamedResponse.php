<?php

declare(strict_types=1);

namespace DKing\OpenAI\Responses\Images;

use DKing\OpenAI\Contracts\ResponseContract;
use DKing\OpenAI\Exceptions\UnknownEventException;
use DKing\OpenAI\Responses\Concerns\ArrayAccessible;
use DKing\OpenAI\Responses\Images\Streaming\Error;
use DKing\OpenAI\Responses\Images\Streaming\ImageGenerationCompleted;
use DKing\OpenAI\Responses\Images\Streaming\ImageGenerationPartialImage;
use DKing\OpenAI\Testing\Responses\Concerns\FakeableForStreamedResponse;

/**
 * @phpstan-type EditStreamedResponseType array{event: string, data: array<string, mixed>}
 *
 * @implements ResponseContract<EditStreamedResponseType>
 */
final class EditStreamedResponse implements ResponseContract
{
    /**
     * @use ArrayAccessible<EditStreamedResponseType>
     */
    use ArrayAccessible;

    use FakeableForStreamedResponse;

    private function __construct(
        public readonly string $event,
        public readonly ImageGenerationPartialImage|ImageGenerationCompleted|Error $response,
    ) {}

    /**
     * @param  array<string, mixed>  $attributes
     */
    public static function from(array $attributes): self
    {
        $event = $attributes['type'] ?? throw new UnknownEventException('Missing event type in streamed response');
        $meta = $attributes['__meta'];
        unset($attributes['__meta']);

        $response = match ($event) {
            'image_edit.partial_image' => ImageGenerationPartialImage::from($attributes, $meta), // @phpstan-ignore-line
            'image_edit.completed' => ImageGenerationCompleted::from($attributes, $meta), // @phpstan-ignore-line
            'error' => Error::from($attributes, $meta), // @phpstan-ignore-line
            default => throw new UnknownEventException('Unknown Images streaming event: '.$event),
        };

        return new self(
            event: $event, // @phpstan-ignore-line
            response: $response,
        );
    }

    /**
     * {@inheritDoc}
     */
    public function toArray(): array
    {
        return [
            'event' => $this->event,
            'data' => $this->response->toArray(),
        ];
    }
}
