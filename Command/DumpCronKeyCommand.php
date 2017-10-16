<?php

namespace Px\CronRequestBundle\Command;

use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

/**
 * Class DumpCronKeyCommand
 * @package Px\CronRequestBundle\Command
 */
class DumpCronKeyCommand extends ContainerAwareCommand
{
    /**
     * @inheritdoc
     */
    public function configure()
    {
        $this->setName('px:cron-request:dump-key')
            ->addArgument('job-name', InputArgument::REQUIRED);
    }

    /**
     * @param InputInterface  $input
     * @param OutputInterface $output
     */
    public function execute(InputInterface $input, OutputInterface $output)
    {
        $jobName = $input->getArgument('job-name');

        $cronCommandManager = $this->getContainer()->get('px_cron_request.manager.cron_job');
        $cronCommandManager->processConfiguration();
        $cronCommandManager->outputJobConfiugration($output, $jobName);
    }
}
