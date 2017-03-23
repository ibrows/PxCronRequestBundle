<?php

namespace Px\CronRequestBundle\Model;

/**
 * Class CronJob
 * @package Px\CronRequestBundle\Model
 */
class CronJob implements CronInterface
{
    /**
     * @var string
     */
    protected $name;

    /**
     * @var string
     */
    protected $job;

    /**
     * @var string
     */
    protected $key;

    /**
     * @var bool
     */
    protected $symfonyCommand = false;

    /**
     * CronJob constructor.
     * @param string $name
     * @param bool   $symfonyCommand
     * @param string $job
     */
    public function __construct($name, $symfonyCommand, $job)
    {
        $this->name = $name;
        $this->symfonyCommand = $symfonyCommand;
        $this->job = $job;
    }

    /**
     * @return string
     */
    public function getJob()
    {
        return $this->job;
    }

    /**
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @return string
     */
    public function getKey()
    {
        return $this->key;
    }

    /**
     * @param string $key
     * @return self
     */
    public function setKey($key)
    {
        $this->key = $key;

        return $this;
    }

    /**
     * @return bool
     */
    public function isSymfonyCommand()
    {
        return $this->symfonyCommand;
    }
}
