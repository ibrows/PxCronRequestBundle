<?php

namespace Px\CronRequestBundle\Command;

use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

/**
 * Class DumpCronKeysCommand
 * @package Px\CronRequestBundle\Command
 */
class DumpCronKeysCommand extends ContainerAwareCommand
{
    /**
     * @inheritdoc
     */
    public function configure()
    {
        $this->setName('px:cron-request:dump-keys');
    }

    /**
     * @param InputInterface  $input
     * @param OutputInterface $output
     * @return int|null
     */
    public function execute(InputInterface $input, OutputInterface $output)
    {
        $cronCommandManager = $this->getContainer()->get('px_cron_request.manager.cron_job');
        $cronCommandManager->processConfiguration();
        $cronCommandManager->outputConfiugration($output);

        return 1;
    }
}
