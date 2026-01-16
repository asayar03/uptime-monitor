<?php

namespace App\Service;

use App\ValueObjects\PageInformationValueObject;
use Symfony\Contracts\HttpClient\HttpClientInterface;

readonly class PingService
{
    public function __construct(
        private HttpClientInterface $httpClient,
    ) {
    }

    public function ping(string $url): PageInformationValueObject
    {
        if (!$this->validateUrl($url)) {
            throw new \InvalidArgumentException('The provided URL is not valid.');
        }

        $response = $this->httpClient->request(
            method: 'GET',
            url: $url,
        );

        return PageInformationValueObject::fromData(
            [
                'statusCode' => $response->getStatusCode(),
                'url'        => $url,
            ]
        );
    }

    private function validateUrl(string $url): bool
    {
        return filter_var($url, FILTER_VALIDATE_URL) !== false;
    }
}
