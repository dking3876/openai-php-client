<?php

declare(strict_types=1);

namespace DKing\OpenAI\Responses\Responses\Streaming;

use DKing\OpenAI\Contracts\ResponseContract;
use DKing\OpenAI\Contracts\ResponseHasMetaInformationContract;
use DKing\OpenAI\Responses\Concerns\ArrayAccessible;
use DKing\OpenAI\Responses\Concerns\HasMetaInformation;
use DKing\OpenAI\Responses\Meta\MetaInformation;
use DKing\OpenAI\Testing\Responses\Concerns\Fakeable;

/**
 * @phpstan-type McpCallType array{type: string, sequence_number: int}
 *
 * @implements ResponseContract<McpCallType>
 */
final class McpCall implements ResponseContract, ResponseHasMetaInformationContract
{
    /**
     * @use ArrayAccessible<McpCallType>
     */
    use ArrayAccessible;

    use Fakeable;
    use HasMetaInformation;

    private function __construct(
        public readonly string $type,
        public readonly int $sequenceNumber,
        private readonly MetaInformation $meta,
    ) {}

    /**
     * @param  McpCallType  $attributes
     */
    public static function from(array $attributes, MetaInformation $meta): self
    {
        return new self(
            type: $attributes['type'],
            sequenceNumber: $attributes['sequence_number'],
            meta: $meta,
        );
    }

    /**
     * {@inheritDoc}
     */
    public function toArray(): array
    {
        return [
            'type' => $this->type,
            'sequence_number' => $this->sequenceNumber,
        ];
    }
}
