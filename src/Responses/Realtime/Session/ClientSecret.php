<?php

declare(strict_types=1);

namespace DKing\OpenAI\Responses\Realtime\Session;

use DKing\OpenAI\Contracts\ResponseContract;
use DKing\OpenAI\Responses\Concerns\ArrayAccessible;
use DKing\OpenAI\Testing\Responses\Concerns\Fakeable;

/**
 * @phpstan-type ClientSecretType array{expires_at: int, value: string}
 *
 * @implements ResponseContract<ClientSecretType>
 */
final class ClientSecret implements ResponseContract
{
    /**
     * @use ArrayAccessible<ClientSecretType>
     */
    use ArrayAccessible;

    use Fakeable;

    private function __construct(
        public readonly int $expiresAt,
        public readonly string $value,
    ) {}

    /**
     * @param  ClientSecretType  $attributes
     */
    public static function from(array $attributes): self
    {
        return new self(
            expiresAt: $attributes['expires_at'],
            value: $attributes['value'],
        );
    }

    /**
     * {@inheritDoc}
     */
    public function toArray(): array
    {
        return [
            'expires_at' => $this->expiresAt,
            'value' => $this->value,
        ];
    }
}
