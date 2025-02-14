<?php

declare(strict_types=1);

namespace App\Webhook\Handler;

use App\DTO\Webhook;
use App\DTO\Newsletter\Factory\NewsletterWebhookFactory;
use Override;

final class NewsletterHandler implements WebhookHandlerInterface
{
    private const array SUPPORTED_EVENTS = [
        'newsletter_opened',
        'newsletter_subscribed',
        'newsletter_unsubscribed'
    ];
    
    public function __construct(
        private NewsletterWebhookFactory $newsletterWebhookFactory
    ) {
    }
    
    #[Override]
    public function supports(Webhook $webhook): bool
    {
        return in_array($webhook->getEvent(), self::SUPPORTED_EVENTS);
    }
    
    #[Override]
    public function handle(Webhook $webhook): void
    {
        $newsletterWebhook = $this->newsletterWebhookFactory->create($webhook);
        dd($newsletterWebhook);
    }    
}
