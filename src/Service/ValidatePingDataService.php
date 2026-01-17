<?php

namespace App\Service;

use App\Repository\MonitoringConfigRepository;

readonly class ValidatePingDataService
{
    public function __construct(
        private MonitoringConfigRepository $monitoringConfigRepository,
    ) {
    }

    public function validate(int $configId, int $statusCode): bool
    {
        $config = $this->monitoringConfigRepository->find($configId);
        if (null === $config) {
            return false;
        }

        if (!($statusCode === $config->getMonitoringconfigExpectedhttpcode())) {
            return false;
        }

        return true;
    }
}
