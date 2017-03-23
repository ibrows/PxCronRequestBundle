<?php

namespace Px\CronRequestBundle\Exception;

/**
 * Class CronJobNotFoundException
 * @package Px\CronRequestBundle\Exception
 */
class CronJobNotFoundException extends \Exception
{

    /**
     * CronJobNotFoundException constructor.
     * @param string $key
     */
    public function __construct($key)
    {
        $this->message = 'Job '.$key.' was not found';
    }
}
