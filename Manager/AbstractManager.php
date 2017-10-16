<?php

namespace Px\CronRequestBundle\Manager;

use Px\CronRequestBundle\Model\CronInterface;

/**
 * Class AbstractManager
 * @package Px\CronRequestBundle\Manager
 */
abstract class AbstractManager implements CronManagerInterface
{
    /**
     * @var array
     */
    protected $configuration;

    /**
     * @var string
     */
    protected $accessKey;

    /**
     * @var string
     */
    protected $kernelDir;

    /**
     * AbstractManager constructor.
     * @param array  $configuration
     * @param string $accessKey
     * @param string $kernelDir
     */
    public function __construct(array $configuration, $accessKey, $kernelDir)
    {
        $this->configuration = $configuration;
        $this->accessKey = $accessKey;
        $this->kernelDir = $kernelDir;
    }

    /**
     * @param CronInterface $cron
     */
    protected function generateKey(CronInterface $cron)
    {
        $options = array(
            'cost' => 4,
            'salt' => $this->accessKey,
        );
        $key = str_replace(
            '/',
            '_',
            password_hash(hash('sha256', sprintf('%s_%s', $cron->getName(), $cron->getJob())), PASSWORD_BCRYPT, $options)
        );
        $cron->setKey($key);
    }
}
