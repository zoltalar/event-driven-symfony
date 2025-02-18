<?php

declare(strict_types=1);

namespace App\CDP\Analytics\Model\Subscription\Identify;

use App\CDP\Analytics\Model\Subscription\Identify\IdentifyModel;
use App\CDP\Analytics\Model\Subscription\SubscriptionSourceInterface;
use App\Error\Exception\WebhookException;
use Throwable;

class SubscriptionStartMapper
{
    public function map(SubscriptionSourceInterface $source, IdentifyModel $target): void
    {
        try {
            $target->setProduct($source->getProduct());
            $target->setEventDate($source->getEventDate());
            $target->setSubscriptionId($source->getSubscriptionId());
            $target->setEmail($source->getEmail());
            $target->setId($source->getUserId());
        } catch (Throwable $throwable) {
            $className = get_class($source);
            throw new WebhookException(sprintf('Could not map %s to IdentifyModel target: %s', $className, $throwable->getMessage()));
        }
    }
}
