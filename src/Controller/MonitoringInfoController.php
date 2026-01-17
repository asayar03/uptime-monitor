<?php

namespace App\Controller;

use App\Entity\MonitoringConfig;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Attribute\Route;

readonly class MonitoringInfoController
{
    public function __construct(
        private EntityManagerInterface $entityManager,
    ) {
    }

    #[Route('/monitoring-info/add/', name: 'monitoring_info_add', methods: ['POST'])]
    public function add(Request $request): JsonResponse
    {
        $data = json_decode($request->getContent(), true);
        if (!$this->validateData($data)) {
            throw new \InvalidArgumentException('Invalid data provided.');
        }

        $monitoringInfo = new MonitoringConfig();
        $monitoringInfo->setMonitoringconfigUrl($data['url']);
        $monitoringInfo->setMonitoringconfigExpectedhttpcode($data['statusCode']);
        $monitoringInfo->setMonitoringconfigRequestmethod($data['requestMethod'] ?? 'GET');

        $this->entityManager->persist($monitoringInfo);
        $this->entityManager->flush();

        return new JsonResponse(
            ['status' => 'Monitoring info added successfully.'],
            JsonResponse::HTTP_CREATED,
        );
    }

    private function validateData(array $data): bool
    {
        if (!isset($data['url']) || !filter_var($data['url'], FILTER_VALIDATE_URL)) {
            return false;
        }

        if (!isset($data['statusCode']) || !is_int($data['statusCode'])) {
            return false;
        }

        return true;
    }
}
