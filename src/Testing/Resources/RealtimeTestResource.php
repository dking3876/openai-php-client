<?php

namespace DKing\OpenAI\Testing\Resources;

use DKing\OpenAI\Contracts\Resources\RealtimeContract;
use DKing\OpenAI\Resources\Realtime;
use DKing\OpenAI\Responses\Realtime\SessionResponse;
use DKing\OpenAI\Responses\Realtime\TranscriptionSessionResponse;
use DKing\OpenAI\Testing\Resources\Concerns\Testable;

final class RealtimeTestResource implements RealtimeContract
{
    use Testable;

    public function resource(): string
    {
        return Realtime::class;
    }

    public function token(array $parameters = []): SessionResponse
    {
        return $this->record(__FUNCTION__, func_get_args());
    }

    public function transcribeToken(array $parameters = []): TranscriptionSessionResponse
    {
        return $this->record(__FUNCTION__, func_get_args());
    }
}
