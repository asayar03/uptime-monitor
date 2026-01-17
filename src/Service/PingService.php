<?php

namespace App\Service;

use App\ValueObjects\PageInformationValueObject;
use Symfony\Contracts\HttpClient\HttpClientInterface;

readonly class PingService
{
    public const array VALID_HTTP_METHODS = [
        'GET',
        'POST',
        'PUT',
        'DELETE',
        'HEAD',
        'OPTIONS',
        'PATCH',
    ];

    public function __construct(
        private HttpClientInterface $httpClient,
        private ValidatePingDataService $validatePingDataService,
    ) {
    }

    public function ping(
        int $monitoringConfigId,
        string $url,
        ?string $requestMethod = 'GET',
    ): PageInformationValueObject {
        if (null === $requestMethod || !in_array(strtoupper($requestMethod), self::VALID_HTTP_METHODS, true)) {
            $requestMethod = 'GET';
        }

        if (!$this->validateUrl($url)) {
            throw new \InvalidArgumentException('The provided URL is not valid.');
        }

        $response = $this->httpClient->request($requestMethod, $url, [
            'timeout' => 10,
        ]);

        $isSuccessful = $this->validatePingDataService->validate($monitoringConfigId, $response->getStatusCode());

        return PageInformationValueObject::fromData([
            'statusCode' => $response->getStatusCode(),
            'url' => $url,
            'isSuccessful' => $isSuccessful,
        ]);
    }

    private function validateUrl(string $url): bool
    {
        return false !== filter_var($url, FILTER_VALIDATE_URL);
    }
}
