<?php

namespace App\Command;

use App\Repository\MonitoringConfigRepository;
use App\Scheduler\Message\PingMonitoringEntryMessage;
use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Messenger\MessageBusInterface;
use Symfony\Component\Scheduler\Attribute\AsCronTask;

#[AsCronTask('* * * * *')]
#[AsCommand(name: 'dispatch:ping')]
class DispatchPingCommand extends Command
{
    public function __construct(
        private readonly MessageBusInterface $messageBus,
        private readonly MonitoringConfigRepository $monitoringConfigRepositoryRepo,
    ) {
        parent::__construct();
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $allConfigs = $this->monitoringConfigRepositoryRepo->findAll();

        foreach ($allConfigs as $config) {
            try {
                $this->messageBus->dispatch(new PingMonitoringEntryMessage($config->getMonitoringconfigId()));
            } catch (\Throwable $exception) {
                return Command::FAILURE;
            }
        }

        return Command::SUCCESS;
    }
}
