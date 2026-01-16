<?php

declare(strict_types=1);

namespace App\Repository;

use App\Entity\MonitoringEntry;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<MonitoringEntry>
 */
class MonitoringEntryRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, MonitoringEntry::class);
    }
}
