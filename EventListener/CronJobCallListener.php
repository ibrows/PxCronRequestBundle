<?php

namespace Px\CronRequestBundle\EventListener;

use Px\CronRequestBundle\Manager\CronJobManager;
use Symfony\Component\HttpKernel\Event\GetResponseEvent;

/**
 * Class CronJobCallListener
 * @package Px\CronRequestBundle\EventListener
 */
class CronJobCallListener
{
    /**
     * @var CronJobManager
     */
    protected $cronJobManager;

    /**
     * CronJobCallListener constructor.
     * @param CronJobManager $cronJobManager
     */
    public function __construct(CronJobManager $cronJobManager)
    {
        $this->cronJobManager = $cronJobManager;
    }

    /**
     * @param GetResponseEvent $event
     */
    public function onKernelRequest(GetResponseEvent $event)
    {
        $request = $event->getRequest();
        if ('px_cron_request_web_request' === $request->get('_route')) {
            $this->cronJobManager->processConfiguration();
        }
    }
}
