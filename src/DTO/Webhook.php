<?php

declare(strict_types=1);

namespace App\DTO;

class Webhook 
{
    private string $event;
    
    private string $rawPayload;
    
    public function getEvent(): string
    {
        return $this->event;
    }
    
    public function setEvent(string $event): self
    {
        $this->event = $event;
        
        return $this;
    }
    
    public function getRawPayload(): string
    {
        return $this->rawPayload;
    }
    
    public function setRawPayload(string $rawPayload): self
    {
        $this->rawPayload = $rawPayload;
        
        return $this;
    }
}
