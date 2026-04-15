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
 * @phpstan-type ErrorType array{type: string, code: string|null, message: string, param: string|null}
 *
 * @implements ResponseContract<ErrorType>
 */
final class Error implements ResponseContract, ResponseHasMetaInformationContract
{
    /**
     * @use ArrayAccessible<ErrorType>
     */
    use ArrayAccessible;

    use Fakeable;
    use HasMetaInformation;

    private function __construct(
        public readonly string $type,
        public readonly ?string $code,
        public readonly string $message,
        public readonly ?string $param,
        private readonly MetaInformation $meta,
    ) {}

    /**
     * @param  ErrorType  $attributes
     */
    public static function from(array $attributes, MetaInformation $meta): self
    {
        return new self(
            type: $attributes['type'],
            code: $attributes['code'],
            message: $attributes['message'],
            param: $attributes['param'],
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
            'code' => $this->code,
            'message' => $this->message,
            'param' => $this->param,
        ];
    }
}
