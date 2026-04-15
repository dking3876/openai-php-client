<?php

declare(strict_types=1);

namespace DKing\OpenAI\Responses\Responses;

use DKing\OpenAI\Contracts\ResponseContract;
use DKing\OpenAI\Responses\Concerns\ArrayAccessible;
use DKing\OpenAI\Responses\Responses\Format\JsonObjectFormat;
use DKing\OpenAI\Responses\Responses\Format\JsonSchemaFormat;
use DKing\OpenAI\Responses\Responses\Format\TextFormat;
use DKing\OpenAI\Testing\Responses\Concerns\Fakeable;

/**
 * @phpstan-import-type JsonObjectFormatType from JsonObjectFormat
 * @phpstan-import-type JsonSchemaFormatType from JsonSchemaFormat
 * @phpstan-import-type TextFormatType from TextFormat
 *
 * @phpstan-type ResponseFormatType array{format: TextFormatType|JsonObjectFormatType|JsonSchemaFormatType}
 *
 * @implements ResponseContract<ResponseFormatType>
 */
final class CreateResponseFormat implements ResponseContract
{
    /**
     * @use ArrayAccessible<ResponseFormatType>
     */
    use ArrayAccessible;

    use Fakeable;

    private function __construct(
        public readonly TextFormat|JsonSchemaFormat|JsonObjectFormat $format
    ) {}

    /**
     * @param  ResponseFormatType  $attributes
     */
    public static function from(array $attributes): self
    {
        $format = match ($attributes['format']['type']) {
            'text' => TextFormat::from($attributes['format']),
            'json_schema' => JsonSchemaFormat::from($attributes['format']),
            'json_object' => JsonObjectFormat::from($attributes['format']),
        };

        return new self(
            format: $format
        );
    }

    /**
     * {@inheritDoc}
     */
    public function toArray(): array
    {
        return [
            'format' => $this->format->toArray(),
        ];
    }
}
