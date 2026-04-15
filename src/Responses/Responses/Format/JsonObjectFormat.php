<?php

declare(strict_types=1);

namespace DKing\OpenAI\Responses\Responses\Format;

use DKing\OpenAI\Contracts\ResponseContract;
use DKing\OpenAI\Responses\Concerns\ArrayAccessible;
use DKing\OpenAI\Testing\Responses\Concerns\Fakeable;

/**
 * @phpstan-type JsonObjectFormatType array{type: 'json_object'}
 *
 * @implements ResponseContract<JsonObjectFormatType>
 */
final class JsonObjectFormat implements ResponseContract
{
    /**
     * @use ArrayAccessible<JsonObjectFormatType>
     */
    use ArrayAccessible;

    use Fakeable;

    /**
     * @param  'json_object'  $type
     */
    private function __construct(
        public readonly string $type,
    ) {}

    /**
     * @param  JsonObjectFormatType  $attributes
     */
    public static function from(array $attributes): self
    {
        return new self(
            type: $attributes['type'],
        );
    }

    /**
     * {@inheritDoc}
     */
    public function toArray(): array
    {
        return [
            'type' => $this->type,
        ];
    }
}
