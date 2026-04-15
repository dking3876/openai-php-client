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
 * @phpstan-type McpListToolsType array{type: string, sequence_number: int, output_index: int, item_id: string}
 *
 * @implements ResponseContract<McpListToolsType>
 */
final class McpListToolsInProgress implements ResponseContract, ResponseHasMetaInformationContract
{
    /**
     * @use ArrayAccessible<McpListToolsType>
     */
    use ArrayAccessible;

    use Fakeable;
    use HasMetaInformation;

    private function __construct(
        public readonly string $type,
        public readonly int $sequenceNumber,
        public readonly int $outputIndex,
        public readonly string $itemId,
        private readonly MetaInformation $meta,
    ) {}

    /**
     * @param  McpListToolsType  $attributes
     */
    public static function from(array $attributes, MetaInformation $meta): self
    {
        return new self(
            type: $attributes['type'],
            sequenceNumber: $attributes['sequence_number'],
            outputIndex: $attributes['output_index'],
            itemId: $attributes['item_id'],
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
            'output_index' => $this->outputIndex,
            'item_id' => $this->itemId,
        ];
    }
}
