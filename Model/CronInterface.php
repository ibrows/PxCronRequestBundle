<?php

namespace Px\CronRequestBundle\Model;

/**
 * Interface CronInterface
 * @package Px\CronRequestBundle\Model
 */
interface CronInterface
{
    /**
     * @return string
     */
    public function getName();

    /**
     * @param string $key
     * @return mixed
     */
    public function setKey($key);

    /**
     * @return string
     */
    public function getJob();
}
