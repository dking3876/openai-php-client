<?php

declare(strict_types=1);

namespace DKing\OpenAI\Responses\Responses\Format;

use DKing\OpenAI\Contracts\ResponseContract;
use DKing\OpenAI\Responses\Concerns\ArrayAccessible;
use DKing\OpenAI\Testing\Responses\Concerns\Fakeable;

/**
 * @phpstan-type TextFormatType array{type: 'text'}
 *
 * @implements ResponseContract<TextFormatType>
 */
final class TextFormat implements ResponseContract
{
    /**
     * @use ArrayAccessible<TextFormatType>
     */
    use ArrayAccessible;

    use Fakeable;

    /**
     * @param  'text'  $type
     */
    private function __construct(
        public readonly string $type,
    ) {}

    /**
     * @param  TextFormatType  $attributes
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
