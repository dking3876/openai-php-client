<?php

declare(strict_types=1);

namespace DKing\OpenAI\Responses\Responses\Streaming;

use DKing\OpenAI\Contracts\ResponseContract;
use DKing\OpenAI\Contracts\ResponseHasMetaInformationContract;
use DKing\OpenAI\Responses\Concerns\ArrayAccessible;
use DKing\OpenAI\Responses\Concerns\HasMetaInformation;
use DKing\OpenAI\Responses\Meta\MetaInformation;
use DKing\OpenAI\Responses\Responses\Output\OutputReasoningSummary;
use DKing\OpenAI\Testing\Responses\Concerns\Fakeable;

/**
 * @phpstan-import-type ReasoningSummaryType from OutputReasoningSummary
 *
 * @phpstan-type ReasoningSummaryPartType array{type: string, item_id: string, output_index: int, part: ReasoningSummaryType, summary_index: int}
 *
 * @implements ResponseContract<ReasoningSummaryPartType>
 */
final class ReasoningSummaryPart implements ResponseContract, ResponseHasMetaInformationContract
{
    /**
     * @use ArrayAccessible<ReasoningSummaryPartType>
     */
    use ArrayAccessible;

    use Fakeable;
    use HasMetaInformation;

    private function __construct(
        public readonly string $type,
        public readonly string $itemId,
        public readonly int $outputIndex,
        public readonly OutputReasoningSummary $part,
        public readonly int $summaryIndex,
        private readonly MetaInformation $meta,
    ) {}

    /**
     * @param  ReasoningSummaryPartType  $attributes
     */
    public static function from(array $attributes, MetaInformation $meta): self
    {
        return new self(
            type: $attributes['type'],
            itemId: $attributes['item_id'],
            outputIndex: $attributes['output_index'],
            part: OutputReasoningSummary::from($attributes['part']),
            summaryIndex: $attributes['summary_index'],
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
            'item_id' => $this->itemId,
            'output_index' => $this->outputIndex,
            'part' => $this->part->toArray(),
            'summary_index' => $this->summaryIndex,
        ];
    }
}
