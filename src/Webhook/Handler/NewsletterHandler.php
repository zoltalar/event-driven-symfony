<?php

declare(strict_types=1);

namespace App\Webhook\Handler;

use App\DTO\Webhook;
use App\DTO\Newsletter\Factory\NewsletterWebhookFactory;
use App\Forwarder\Newsletter\ForwarderInterface;
use Override;
use Symfony\Component\DependencyInjection\Attribute\AutowireIterator;

final class NewsletterHandler implements WebhookHandlerInterface
{
    private const array SUPPORTED_EVENTS = [
        'newsletter_opened',
        'newsletter_subscribed',
        'newsletter_unsubscribed'
    ];
    
    /**
     * @param iterable<ForwarderInterface> $forwarders
     */
    public function __construct(
        private NewsletterWebhookFactory $newsletterWebhookFactory,
        #[AutowireIterator('forwarder.newsletter')]
        private iterable $forwarders
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
        
        foreach ($this->forwarders as $forwarder) {
            if ($forwarder->supports($newsletterWebhook)) {
                $forwarder->forward($newsletterWebhook);
            }
        }
    }    
}
