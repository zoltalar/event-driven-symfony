<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

final class WebhookController extends AbstractController
{
    #[Route('/webhook', name: 'webhook.default', methods: ['POST'])]
    public function __invoke(): Response
    {
        return new Response(status: 204);
    }
}
