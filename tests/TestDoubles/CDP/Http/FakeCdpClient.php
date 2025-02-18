<?php

declare(strict_types=1);

namespace App\Tests\TestDoubles\CDP\Http;

use App\CDP\Analytics\Model\ModelInterface;
use App\CDP\Http\CdpClientInterface;
use Override;

class FakeCdpClient implements CdpClientInterface
{
    private ModelInterface $identifyModel;
    private ModelInterface $trackModel;
    
    private int $identifyInvokeCount = 0;
    private int $trackInvokeCount = 0;

    #[Override]
    public function identify(ModelInterface $model): void
    {
        $this->identifyModel = $model;
        $this->identifyInvokeCount++;
    }

    #[Override]
    public function track(ModelInterface $model): void
    {
        $this->trackModel = $model;
        $this->trackInvokeCount++;
    }
    
    public function getIdentifyModel(): ModelInterface
    {
        return $this->identifyModel;
    }
    
    public function getTrackModel(): ModelInterface
    {
        return $this->trackModel;
    }
    
    public function getIdentifyInvokeCount(): int
    {
        return $this->identifyInvokeCount;
    }
    
    public function getTrackInvokeCount(): int
    {
        return $this->trackInvokeCount;
    }
}
