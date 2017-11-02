<?php

namespace Px\CronRequestBundle\Manager;

use Px\CronRequestBundle\Model\CronInterface;
use Symfony\Component\Console\Output\OutputInterface;

/**
 * Interface CronManagerInterface
 * @package Px\CronRequestBundle\Manager
 */
interface CronManagerInterface
{
    /**
     * @param string $env
     * @param string $key
     * @return int
     */
    public function execute($env, $key);

    /**
     * Converts configuration array into CronJob array
     */
    public function processConfiguration();

    /**
     * @param OutputInterface $output
     */
    public function outputConfiugration(OutputInterface $output);

    /**
     * @param OutputInterface $output
     * @param string          $name
     */
    public function outputJobConfiugration(OutputInterface $output, $name);
}
