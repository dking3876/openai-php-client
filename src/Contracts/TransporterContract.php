<?php

declare(strict_types=1);

namespace DKing\OpenAI\Contracts;

use DKing\OpenAI\Exceptions\ErrorException;
use DKing\OpenAI\Exceptions\TransporterException;
use DKing\OpenAI\Exceptions\UnserializableResponse;
use DKing\OpenAI\ValueObjects\Transporter\AdaptableResponse;
use DKing\OpenAI\ValueObjects\Transporter\Payload;
use DKing\OpenAI\ValueObjects\Transporter\Response;
use Psr\Http\Message\ResponseInterface;

/**
 * @internal
 */
interface TransporterContract
{
    /**
     * Adds a custom header that will be included in all subsequent requests.
     */
    public function addHeader(string $name, string $value): self;

    /**
     * Sends a request to a server expecting an object back.
     *
     * @return Response<array<array-key, mixed>>
     *
     * @throws ErrorException|UnserializableResponse|TransporterException
     */
    public function requestObject(Payload $payload): Response;

    /**
     * Sends a request to a server expecting an adaptable response (object/string) back.
     *
     * @return AdaptableResponse<array<array-key, mixed>|string>
     *
     * @throws ErrorException|UnserializableResponse|TransporterException
     */
    public function requestStringOrObject(Payload $payload): AdaptableResponse;

    /**
     * Sends a content request to a server expecting a string back.
     *
     * @throws ErrorException|TransporterException
     */
    public function requestContent(Payload $payload): string;

    /**
     * Sends a stream request to a server.
     **
     * @throws ErrorException
     */
    public function requestStream(Payload $payload): ResponseInterface;
}
