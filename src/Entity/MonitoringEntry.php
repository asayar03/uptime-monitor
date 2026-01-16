<?php

declare(strict_types=1);

namespace App\Entity;

use App\Repository\MonitoringEntryRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: MonitoringEntryRepository::class)]
class MonitoringEntry
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $monitoringentry_id = null;

    #[ORM\Column(type: Types::SMALLINT)]
    private ?int $monitoringentry_httpcode = null;

    #[ORM\Column(type: Types::STRING, length: 255)]
    private ?string $monitoringentry_url = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE)]
    private ?\DateTime $monitoringentry_created = null;

    public function __construct()
    {
        $this->monitoringentry_created = new \DateTime();
    }

    public function getId(): ?int
    {
        return $this->monitoringentry_id;
    }

    public function getMonitoringentryId(): ?int
    {
        return $this->monitoringentry_id;
    }

    public function setMonitoringentryId(int $monitoringentry_id): static
    {
        $this->monitoringentry_id = $monitoringentry_id;

        return $this;
    }

    public function getMonitoringentryHttpcode(): ?int
    {
        return $this->monitoringentry_httpcode;
    }

    public function setMonitoringentryHttpcode(int $monitoringentry_httpcode): static
    {
        $this->monitoringentry_httpcode = $monitoringentry_httpcode;

        return $this;
    }

    public function getMonitoringentryUrl(): ?string
    {
        return $this->monitoringentry_url;
    }

    public function setMonitoringentryUrl(string $monitoringentry_url): static
    {
        $this->monitoringentry_url = $monitoringentry_url;

        return $this;
    }

    public function getMonitoringentryCreated(): ?\DateTime
    {
        return $this->monitoringentry_created;
    }

    public function setMonitoringentryCreated(\DateTime $monitoringentry_created): static
    {
        $this->monitoringentry_created = $monitoringentry_created;

        return $this;
    }
}
