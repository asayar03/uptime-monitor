<?php

declare(strict_types=1);

namespace App\Entity;

use App\Repository\MonitoringInfoRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: MonitoringInfoRepository::class)]
class MonitoringInfo
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $monitoringinfo_id = null;

    #[ORM\Column(type: Types::SMALLINT)]
    private ?int $monitoringinfo_httpcode = null;

    #[ORM\ManyToOne(targetEntity: MonitoringConfig::class)]
    #[ORM\Column(type: Types::INTEGER)]
    private int $monitoringinfo_monitoringconfig_id;

    #[ORM\Column(type: Types::SMALLINT)]
    private ?int $monitoringinfo_successful = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE)]
    private ?\DateTime $monitoringinfo_created = null;

    public function __construct()
    {
        $this->monitoringinfo_created = new \DateTime();
    }

    public function getId(): ?int
    {
        return $this->monitoringinfo_id;
    }

    public function getMonitoringinfoId(): ?int
    {
        return $this->monitoringinfo_id;
    }

    public function setMonitoringinfoId(int $monitoringinfo_id): static
    {
        $this->monitoringinfo_id = $monitoringinfo_id;

        return $this;
    }

    public function getMonitoringinfoHttpcode(): ?int
    {
        return $this->monitoringinfo_httpcode;
    }

    public function setMonitoringinfoHttpcode(int $monitoringinfo_httpcode): static
    {
        $this->monitoringinfo_httpcode = $monitoringinfo_httpcode;

        return $this;
    }

    public function getMonitoringinfoSuccessful(): ?int
    {
        return $this->monitoringinfo_successful;
    }

    public function setMonitoringinfoSuccessful(int $monitoringinfo_successful): static
    {
        $this->monitoringinfo_successful = $monitoringinfo_successful;

        return $this;
    }

    public function getMonitoringinfoCreated(): ?\DateTime
    {
        return $this->monitoringinfo_created;
    }

    public function setMonitoringinfoCreated(\DateTime $monitoringinfo_created): static
    {
        $this->monitoringinfo_created = $monitoringinfo_created;

        return $this;
    }

    public function getMonitoringinfoMonitoringconfigId(): int
    {
        return $this->monitoringinfo_monitoringconfig_id;
    }

    public function setMonitoringinfoMonitoringconfigId(int $monitoringinfo_monitoringconfig_id): static
    {
        $this->monitoringinfo_monitoringconfig_id = $monitoringinfo_monitoringconfig_id;

        return $this;
    }
}
