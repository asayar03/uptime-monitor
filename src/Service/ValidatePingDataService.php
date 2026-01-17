<?php

namespace App\Service;

use App\Repository\MonitoringConfigRepository;

class ValidatePingDataService
{
    public function __construct(
        private readonly MonitoringConfigRepository $monitoringConfigRepository,
    )
    {

    }

    public function validate(int $configId, int $statusCode): bool
    {
        $config = $this->monitoringConfigRepository->find($configId);
        if ($config === null) {
            return false;
        }

        if (!($statusCode === $config->getMonitoringconfigExpectedhttpcode())) {
            return false;
        }

        return true;
    }
}
