<?php

namespace App\Scheduler\Handler;

use App\Entity\MonitoringInfo;
use App\Repository\MonitoringConfigRepository;
use App\Scheduler\Message\PingMonitoringEntryMessage;
use App\Service\PingService;
use App\ValueObjects\PageInformationValueObject;
use Doctrine\ORM\EntityManagerInterface;
use Psr\Log\LoggerInterface;
use Symfony\Component\Messenger\Attribute\AsMessageHandler;

#[AsMessageHandler]
class PingMonitoringEntryHandler
{
    public function __construct(
        private readonly MonitoringConfigRepository $monitoringConfigRepository,
        private readonly PingService                $pingService,
        private readonly EntityManagerInterface     $entityManager,
        private readonly LoggerInterface            $logger,
    )
    {
    }

    public function __invoke(PingMonitoringEntryMessage $message): void
    {
        $monitoringConfig = $this->monitoringConfigRepository->find($message->getMonitoringConfigId());

        if (null === $monitoringConfig) {
            return;
        }

        $pingInfo = $this->pingService->ping(
            $monitoringConfig->getMonitoringconfigId(),
            $monitoringConfig->getMonitoringconfigUrl(),
            $monitoringConfig->getMonitoringconfigRequestmethod()
        );

        $this->logger->info('Pinged URL: ' . $pingInfo->url . ' with status code: ' . $pingInfo->statusCode);

        $this->createEntryFromPingInfo($pingInfo, $message->getMonitoringConfigId());
    }

    private function createEntryFromPingInfo(PageInformationValueObject $pingInfo, int $configId): void
    {
        $model = new MonitoringInfo();
        $model->setMonitoringinfoHttpcode($pingInfo->statusCode);
        $model->setMonitoringinfoMonitoringconfigId($configId);
        $model->setMonitoringinfoSuccessful($pingInfo->isSuccessful);

        $this->entityManager->persist($model);
        $this->entityManager->flush();
    }
}
