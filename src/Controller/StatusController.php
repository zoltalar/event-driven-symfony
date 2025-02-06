<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Attribute\Route;

final class StatusController extends AbstractController
{
    #[Route(path: 'health', name: 'status.health')]
    public function health(): JsonResponse
    {
        return new JsonResponse([
            'app' => true
        ]);
    }
}
