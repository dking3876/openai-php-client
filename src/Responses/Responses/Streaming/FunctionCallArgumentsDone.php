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
 * @phpstan-type FunctionCallArgumentsDoneType array{type: string, arguments: string, item_id: string, output_index: int}
 *
 * @implements ResponseContract<FunctionCallArgumentsDoneType>
 */
final class FunctionCallArgumentsDone implements ResponseContract, ResponseHasMetaInformationContract
{
    /**
     * @use ArrayAccessible<FunctionCallArgumentsDoneType>
     */
    use ArrayAccessible;

    use Fakeable;
    use HasMetaInformation;

    private function __construct(
        public readonly string $type,
        public readonly string $arguments,
        public readonly string $itemId,
        public readonly int $outputIndex,
        private readonly MetaInformation $meta,
    ) {}

    /**
     * @param  FunctionCallArgumentsDoneType  $attributes
     */
    public static function from(array $attributes, MetaInformation $meta): self
    {
        return new self(
            type: $attributes['type'],
            arguments: $attributes['arguments'],
            itemId: $attributes['item_id'],
            outputIndex: $attributes['output_index'],
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
            'arguments' => $this->arguments,
            'item_id' => $this->itemId,
            'output_index' => $this->outputIndex,
        ];
    }
}
