<?php

namespace DKing\OpenAI\Testing\Resources;

use DKing\OpenAI\Contracts\Resources\ConversationsItemsContract;
use DKing\OpenAI\Resources\ConversationsItems;
use DKing\OpenAI\Responses\Conversations\ConversationItem;
use DKing\OpenAI\Responses\Conversations\ConversationItemList;
use DKing\OpenAI\Responses\Conversations\ConversationResponse;
use DKing\OpenAI\Testing\Resources\Concerns\Testable;

final class ConversationsItemsTestResource implements ConversationsItemsContract
{
    use Testable;

    public function resource(): string
    {
        return ConversationsItems::class;
    }

    public function create(string $conversationId, array $parameters): ConversationItemList
    {
        return $this->record(__FUNCTION__, func_get_args());
    }

    public function list(string $conversationId, array $parameters = []): ConversationItemList
    {
        return $this->record(__FUNCTION__, func_get_args());
    }

    public function retrieve(string $conversationId, string $itemId, array $parameters = []): ConversationItem
    {
        return $this->record(__FUNCTION__, func_get_args());
    }

    public function delete(string $conversationId, string $itemId): ConversationResponse
    {
        return $this->record(__FUNCTION__, func_get_args());
    }
}
