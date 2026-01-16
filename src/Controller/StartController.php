<?php

declare(strict_types=1);

namespace App\Controller;

use App\Entity\MonitoringEntry;
use App\Repository\MonitoringEntryRepository;
use App\Service\PingService;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Contracts\HttpClient\HttpClientInterface;

class StartController
{
    public const string URL_PARAM_KEY = 'url';

    public function __construct(
        private readonly PingService $pingService,
        private readonly EntityManagerInterface $entityManager,
    ) {
    }

    #[Route('/start', name: 'start')]
    public function index(Request $request): Response
    {
        $info = $this->pingService->ping($request->query->get(self::URL_PARAM_KEY));

        $monitoringEntry = new MonitoringEntry();
        $monitoringEntry->setMonitoringentryHttpcode($info->statusCode);
        $monitoringEntry->setMonitoringentryUrl($info->url);

        $this->entityManager->persist($monitoringEntry);
        $this->entityManager->flush();

        return new JsonResponse([
            'statusCode' => 200,
        ]);
    }
}
