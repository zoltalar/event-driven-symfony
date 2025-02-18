<?php

declare(strict_types=1);

namespace App\Forwarder\Newsletter\Track;

use App\CDP\Analytics\Model\Subscription\Track\SubscriptionMapper;
use App\CDP\Analytics\Model\Subscription\Track\TrackModel;
use App\CDP\Http\CdpClientInterface;
use App\DTO\Newsletter\NewsletterWebhook;
use App\Forwarder\Newsletter\ForwarderInterface;
use Override;

final class SubscriptionForwarder implements ForwarderInterface
{    
    public function __construct(
        private CdpClientInterface $cdpClient
    ) {
    }
    
    #[Override]
    public function supports(NewsletterWebhook $newsletterWebhook): bool
    {
        return true;
    }
    
    #[Override]
    public function forward(NewsletterWebhook $newsletterWebhook): void
    {        
        $model = new TrackModel();
        (new SubscriptionMapper())->map($newsletterWebhook, $model);
        $this->cdpClient->track($model);
    }
}