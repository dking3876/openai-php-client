<?php

declare(strict_types=1);

namespace DKing\OpenAI\Responses\Conversations;

use DKing\OpenAI\Actions\Conversations\ItemObjects;
use DKing\OpenAI\Contracts\ResponseContract;
use DKing\OpenAI\Responses\Concerns\ArrayAccessible;
use DKing\OpenAI\Responses\Conversations\Objects\Message;
use DKing\OpenAI\Responses\Responses\Input\ComputerToolCallOutput;
use DKing\OpenAI\Responses\Responses\Input\CustomToolCallOutput;
use DKing\OpenAI\Responses\Responses\Input\FunctionToolCallOutput;
use DKing\OpenAI\Responses\Responses\Input\LocalShellCallOutput;
use DKing\OpenAI\Responses\Responses\Input\McpApprovalResponse;
use DKing\OpenAI\Responses\Responses\Output\OutputCodeInterpreterToolCall;
use DKing\OpenAI\Responses\Responses\Output\OutputComputerToolCall;
use DKing\OpenAI\Responses\Responses\Output\OutputCustomToolCall;
use DKing\OpenAI\Responses\Responses\Output\OutputFileSearchToolCall;
use DKing\OpenAI\Responses\Responses\Output\OutputFunctionToolCall;
use DKing\OpenAI\Responses\Responses\Output\OutputImageGenerationToolCall;
use DKing\OpenAI\Responses\Responses\Output\OutputLocalShellCall;
use DKing\OpenAI\Responses\Responses\Output\OutputMcpApprovalRequest;
use DKing\OpenAI\Responses\Responses\Output\OutputMcpCall;
use DKing\OpenAI\Responses\Responses\Output\OutputMcpListTools;
use DKing\OpenAI\Responses\Responses\Output\OutputReasoning;
use DKing\OpenAI\Responses\Responses\Output\OutputWebSearchToolCall;
use DKing\OpenAI\Testing\Responses\Concerns\Fakeable;

/**
 * @phpstan-import-type ItemObjectTypes from ItemObjects
 *
 * @phpstan-type ConversationItemType ItemObjectTypes
 *
 * @implements ResponseContract<ConversationItemType>
 */
final class ConversationItem implements ResponseContract
{
    /**
     * @use ArrayAccessible<ConversationItemType>
     */
    use ArrayAccessible;

    use Fakeable;

    private function __construct(
        public readonly Message|OutputFileSearchToolCall|OutputFunctionToolCall|FunctionToolCallOutput|LocalShellCallOutput|McpApprovalResponse|CustomToolCallOutput|OutputWebSearchToolCall|OutputComputerToolCall|ComputerToolCallOutput|OutputReasoning|OutputMcpListTools|OutputMcpApprovalRequest|OutputMcpCall|OutputImageGenerationToolCall|OutputCodeInterpreterToolCall|OutputLocalShellCall|OutputCustomToolCall $item
    ) {}

    /**
     * @param  ConversationItemType  $attributes
     */
    public static function from(array $attributes): self
    {
        // Lets re-use our existing parser, so we don't have to duplicate the logic.
        // But we need to wrap the attributes in an array, since it expects an array of items.
        $item = ItemObjects::parse([$attributes])[0];

        return new self(
            item: $item,
        );
    }

    /**
     * {@inheritDoc}
     */
    public function toArray(): array
    {
        return $this->item->toArray();
    }
}
