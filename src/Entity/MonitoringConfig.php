<?php

namespace App\Entity;

use App\Repository\MonitoringConfigRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: MonitoringConfigRepository::class)]
class MonitoringConfig
{
    private Collection $monitoringinfo;

    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $monitoringconfig_id = null;

    #[ORM\Column(length: 255)]
    private ?string $monitoringconfig_url = null;

    #[ORM\Column(type: Types::SMALLINT, nullable: true)]
    private ?int $monitoringconfig_expectedhttpcode = null;

    #[ORM\Column(length: 10, nullable: true)]
    private ?string $monitoringconfig_requestmethod = null;

    #[ORM\Column]
    private ?\DateTime $monitoringconfig_created = null;

    public function __construct()
    {
        $this->monitoringconfig_created = new \DateTime();
        $this->monitoringinfo = new ArrayCollection();
    }

    public function getMonitoringconfigId(): ?int
    {
        return $this->monitoringconfig_id;
    }

    public function getMonitoringconfigUrl(): ?string
    {
        return $this->monitoringconfig_url;
    }

    public function setMonitoringconfigUrl(string $monitoringconfig_url): static
    {
        $this->monitoringconfig_url = $monitoringconfig_url;

        return $this;
    }

    public function getMonitoringconfigExpectedhttpcode(): ?int
    {
        return $this->monitoringconfig_expectedhttpcode;
    }

    public function setMonitoringconfigExpectedhttpcode(?int $monitoringconfig_expectedhttpcode): static
    {
        $this->monitoringconfig_expectedhttpcode = $monitoringconfig_expectedhttpcode;

        return $this;
    }

    public function getMonitoringconfigRequestmethod(): ?string
    {
        return $this->monitoringconfig_requestmethod;
    }

    public function setMonitoringconfigRequestmethod(?string $monitoringconfig_requestmethod): static
    {
        $this->monitoringconfig_requestmethod = $monitoringconfig_requestmethod;

        return $this;
    }

    public function getMonitoringconfigCreated(): ?\DateTime
    {
        return $this->monitoringconfig_created;
    }

    public function setMonitoringconfigCreated(\DateTime $monitoringconfig_created): static
    {
        $this->monitoringconfig_created = $monitoringconfig_created;

        return $this;
    }
}
