<?php

namespace Px\CronRequestBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;

/**
 * Class CronJobController
 */
class CronJobController extends Controller
{
    /**
     * @param string $key
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function webRequestAction($env, $key)
    {
        $cronCommandMananger = $this->container->get('px_cron_request.manager.cron_job');
        $processId = $cronCommandMananger->execute($env, $key);

        return new JsonResponse([
            'id' => $processId,
        ]);
    }
}
