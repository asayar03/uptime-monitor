<?php

declare(strict_types=1);

namespace App\Repository;

use App\Entity\MonitoringInfo;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<MonitoringInfo>
 */
class MonitoringInfoRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, MonitoringInfo::class);
    }
}
