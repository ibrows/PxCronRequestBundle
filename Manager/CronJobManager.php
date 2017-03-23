<?php

namespace Px\CronRequestBundle\Manager;

use Px\CronRequestBundle\Exception\CronJobNotFoundException;
use Px\CronRequestBundle\Model\CronJob;
use Px\CronRequestBundle\Model\CronInterface;
use Symfony\Component\Console\Output\OutputInterface;

/**
 * Class CronJobManager
 * @package Px\CronRequestBundle\Manager
 */
class CronJobManager extends AbstractManager
{
    /**
     * @var CronJob[]
     */
    protected $jobs = array();

    /**
     * @param string $key
     * @return int
     */
    public function execute($key)
    {
        $job = $this->getJobByKey($key);
        $exec = $this->getExecutableScript($job);
        $pid = (int) shell_exec(sprintf('%s %s %s 2>&1 & echo $!', $exec, '>', '/dev/null'));

        return $pid;
    }

    /**
     * Converts configuration array into CronJob array
     */
    public function processConfiguration()
    {
        foreach ($this->configuration as $jobConfiguration) {
            $cronJob = $this->createCronJob($jobConfiguration);

            $this->jobs[$cronJob->getKey()] = $cronJob;
        }
    }

    /**
     * @param OutputInterface $output
     * @param string          $name
     */
    public function outputJobConfiugration(OutputInterface $output, $name)
    {
        $job = $this->getJobByName($name);
        $output->writeln('---');
        $output->writeln(sprintf('job: %s', $job->getName()));
        $output->writeln(sprintf('key: %s', $job->getKey()));
        $output->writeln('---');
    }

    /**
     * @param OutputInterface $output
     */
    public function outputConfiugration(OutputInterface $output)
    {
        $output->writeln('###############');
        $output->writeln('Available jobs:');
        $output->writeln('###############');
        foreach ($this->jobs as $job) {
            $output->writeln('---');
            $output->writeln(sprintf('job: %s', $job->getName()));
            $output->writeln(sprintf('key: %s', $job->getKey()));
        }
        $output->writeln('---');
    }

    /**
     * @param CronInterface|CronJob $cron
     * @return string
     */
    protected function getExecutableScript(CronInterface $cron)
    {
        $exec = '';
        if ($cron->isSymfonyCommand()) {
            $exec .= $this->getConsolePath().' ';
        }
        $exec .= $cron->getJob();

        return $exec;
    }

    /**
     * @param array $config
     * @return CronJob
     */
    protected function createCronJob($config)
    {
        $cronJob = new CronJob($config['name'], $config['symfonyCommand'], $config['job']);
        $this->generateKey($cronJob);

        return $cronJob;
    }

    /**
     * @param string $key
     * @return bool
     */
    protected function hasJobByKey($key)
    {
        if (!array_key_exists($key, $this->jobs)) {
            return false;
        }

        return true;
    }

    /**
     * @param string $name
     * @return bool
     */
    protected function hasJobByName($name)
    {
        foreach ($this->jobs as $job) {
            if ($name === $job->getName()) {
                return true;
            }
        }

        return false;
    }

    /**
     * @param $key
     * @param bool $throwException
     * @return null|CronJob
     * @throws CronJobNotFoundException
     */
    protected function getJobByKey($key, $throwException = true)
    {
        if (!$this->hasJobByKey($key)) {
            if ($throwException) {
                throw new CronJobNotFoundException($key);
            }

            return null;
        }

        return $this->jobs[$key];
    }

    /**
     * @param $name
     * @param bool $throwException
     * @return null|CronJob
     * @throws CronJobNotFoundException
     */
    protected function getJobByName($name, $throwException = true)
    {
        if (!$this->hasJobByName($name)) {
            if ($throwException) {
                throw new CronJobNotFoundException($name);
            }

            return null;
        }

        foreach ($this->jobs as $job) {
            if ($name === $job->getName()) {
                return $job;
            }
        }

        return null;
    }

    /**
     * @return string
     */
    protected function getConsolePath()
    {
        return $this->kernelDir.'/../bin/console';
    }
}
