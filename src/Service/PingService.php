<?php

namespace App\Service;

use App\ValueObjects\PageInformationValueObject;
use Symfony\Contracts\HttpClient\HttpClientInterface;

readonly class PingService
{
    public function __construct(
        private HttpClientInterface $httpClient,
        private readonly ValidatePingDataService $validatePingDataService,
    ) {
    }

    public function ping(
        int $monitoringConfigId,
        string $url,
        ?string $requestMethod = 'GET',
    ): PageInformationValueObject {
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
