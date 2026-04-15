<?php

declare(strict_types=1);

namespace DKing\OpenAI\Responses\Files;

use DKing\OpenAI\Contracts\ResponseContract;
use DKing\OpenAI\Contracts\ResponseHasMetaInformationContract;
use DKing\OpenAI\Responses\Concerns\ArrayAccessible;
use DKing\OpenAI\Responses\Concerns\HasMetaInformation;
use DKing\OpenAI\Responses\Meta\MetaInformation;
use DKing\OpenAI\Testing\Responses\Concerns\Fakeable;

/**
 * @implements ResponseContract<array{id: string, object: string, created_at: int, expires_at: int|null, bytes: int, filename: string, purpose: string, status: string, status_details: array<array-key, mixed>|string|null}>
 */
final class CreateResponse implements ResponseContract, ResponseHasMetaInformationContract
{
    /**
     * @use ArrayAccessible<array{id: string, object: string, created_at: int, expires_at: int|null, bytes: int, filename: string, purpose: string, status: string, status_details: array<array-key, mixed>|string|null}>
     */
    use ArrayAccessible;

    use Fakeable;
    use HasMetaInformation;

    /**
     * @param  array<array-key, mixed>|null  $statusDetails
     */
    private function __construct(
        public readonly string $id,
        public readonly string $object,
        public readonly int $bytes,
        public readonly int $createdAt,
        public readonly ?int $expiresAt,
        public readonly string $filename,
        public readonly string $purpose,
        public readonly string $status,
        public readonly array|string|null $statusDetails,
        private readonly MetaInformation $meta,
    ) {}

    /**
     * Acts as static factory, and returns a new Response instance.
     *
     * @param  array{id: string, object: string, created_at: int, expires_at: int|null, bytes: int, filename: string, purpose: string, status: string, status_details: array<array-key, mixed>|string|null}  $attributes
     */
    public static function from(array $attributes, MetaInformation $meta): self
    {
        return new self(
            $attributes['id'],
            $attributes['object'],
            $attributes['bytes'],
            $attributes['created_at'],
            $attributes['expires_at'] ?? null,
            $attributes['filename'],
            $attributes['purpose'],
            $attributes['status'],
            $attributes['status_details'] ?? null,
            $meta,
        );
    }

    /**
     * {@inheritDoc}
     */
    public function toArray(): array
    {
        return [
            'id' => $this->id,
            'object' => $this->object,
            'bytes' => $this->bytes,
            'created_at' => $this->createdAt,
            'expires_at' => $this->expiresAt,
            'filename' => $this->filename,
            'purpose' => $this->purpose,
            'status' => $this->status,
            'status_details' => $this->statusDetails,
        ];
    }
}
