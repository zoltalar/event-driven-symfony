<?php

declare(strict_types=1);

namespace App\Forwarder\Newsletter\Identity;

use App\CDP\Analytics\Model\Subscription\Identify\IdentifyModel;
use App\CDP\Analytics\Model\Subscription\Identify\SubscriptionStartMapper;
use App\DTO\Newsletter\NewsletterWebhook;
use App\Forwarder\Newsletter\ForwarderInterface;
use Override;

final class SubscriptionStartForwarder implements ForwarderInterface
{
    private const string SUPPORTED_EVENT = 'newsletter_subscribed';
    
    #[Override]
    public function supports(NewsletterWebhook $newsletterWebhook): bool 
    {
        return $newsletterWebhook->getEvent() === self::SUPPORTED_EVENT;
    }
    
    #[Override]
    public function forward(NewsletterWebhook $newsletterWebhook): void 
    {
        $model = new IdentifyModel();
        (new SubscriptionStartMapper())->map($newsletterWebhook, $model);
        
        dd($model->toArray());
    }
}