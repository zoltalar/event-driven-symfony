<?php

namespace App\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\KernelBrowser;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

final class WebhookControllerTest extends WebTestCase
{
    private KernelBrowser $webTester;
    
    protected function setUp(): void 
    {
        $this->webTester = static::createClient();
    }

    public function testWebooksAreHandled(): void
    {
        $incomingWebhookPayload = '{"event":"newsletter_subscribed","id":"12345","origin":"www","timestamp":"2024-12-12T12:00:00Z","user": {"client_id":"4a2b342d-6235-46a9-bc95-6e889b8e5de1","email":"email@example.com","region":"EU"},"newsletter": {"newsletter_id":"newsletter-001","topic":"N/A","product_id":"TechGadget-3000X"}}';

        $this->webTester->request(
            method: 'POST',
            uri: '/webhook',
            server: [
                'Content-Type' => 'application/json',
                'Http-Accept' => '*/*'
            ],
            content: $incomingWebhookPayload
        );
        
        $this->assertSame(Response::HTTP_NO_CONTENT, $this->webTester->getResponse()->getStatusCode());
    }
}
