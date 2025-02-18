<?php

declare(strict_types=1);

namespace App\CDP\Http;

use App\CDP\Analytics\Model\ModelInterface;
use Symfony\Component\DependencyInjection\Attribute\Autowire;
use Symfony\Contracts\HttpClient\HttpClientInterface;

class CdpClient implements CdpClientInterface
{
    private const CDP_API_BASE_URL = 'https://cdp-api.site';

    public function __construct(
        private HttpClientInterface $httpClient,
        #[Autowire('%cdp.api_key%')]
        private string $apiKey
    ) {
    }

    public function track(ModelInterface $model): void
    {
        $this->httpClient->request(
            'POST',
            sprintf('%s/track', self::CDP_API_BASE_URL),
            [
                'body' => json_encode($model->toArray(), JSON_THROW_ON_ERROR),
                'headers' => [
                    'Content-Type' => 'application/json',
                    'X-API-Key' => $this->apiKey
                ]
            ]
        );
    }
    
    public function identify(ModelInterface $model): void
    {
        $this->httpClient->request(
            'POST',
            sprintf('%s/identify', self::CDP_API_BASE_URL),
            [
                'body' => json_encode($model->toArray(), JSON_THROW_ON_ERROR),
                'headers' => [
                    'Content-Type' => 'application/json',
                    'X-API-Key' => $this->apiKey
                ]
            ]
        );
    }
}
