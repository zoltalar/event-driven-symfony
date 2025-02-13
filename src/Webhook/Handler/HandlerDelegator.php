<?php

declare(strict_types=1);

namespace App\Webhook\Handler;

use App\DTO\Webhook;
use App\Webhook\Handler\WebhookHandlerInterface;
use Symfony\Component\DependencyInjection\Attribute\AutowireIterator;

class HandlerDelegator 
{
    /**
     * @param iterable<WebhookHandlerInterface> $handlers
     */
    public function __construct(
        #[AutowireIterator('webhook.handler')]
        private iterable $handlers
    )
    {}
    
    public function delegate(Webhook $webhook): void
    {
        foreach ($this->handlers as $handler) {
            if ($handler->supports($webhook)) {
                $handler->handle($webhook);
            }
        }
    }
}
