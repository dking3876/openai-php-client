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
 * @phpstan-type ImageGenerationPartialImageType array{type: string, output_index: int, item_id: string, sequence_number: int, partial_image_index: int, partial_image_b64: string}
 *
 * @implements ResponseContract<ImageGenerationPartialImageType>
 */
final class ImageGenerationPartialImage implements ResponseContract, ResponseHasMetaInformationContract
{
    /**
     * @use ArrayAccessible<ImageGenerationPartialImageType>
     */
    use ArrayAccessible;

    use Fakeable;
    use HasMetaInformation;

    private function __construct(
        public readonly string $type,
        public readonly int $outputIndex,
        public readonly string $itemId,
        public readonly int $sequenceNumber,
        public readonly int $partialImageIndex,
        public readonly string $partialImageB64,
        private readonly MetaInformation $meta,
    ) {}

    /**
     * @param  ImageGenerationPartialImageType  $attributes
     */
    public static function from(array $attributes, MetaInformation $meta): self
    {
        return new self(
            type: $attributes['type'],
            outputIndex: $attributes['output_index'],
            itemId: $attributes['item_id'],
            sequenceNumber: $attributes['sequence_number'],
            partialImageIndex: $attributes['partial_image_index'],
            partialImageB64: $attributes['partial_image_b64'],
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
            'output_index' => $this->outputIndex,
            'item_id' => $this->itemId,
            'sequence_number' => $this->sequenceNumber,
            'partial_image_index' => $this->partialImageIndex,
            'partial_image_b64' => $this->partialImageB64,
        ];
    }
}
