<?php

namespace Px\CronRequestBundle\DependencyInjection;

use Symfony\Component\Config\Definition\Processor;
use Symfony\Component\Config\FileLocator;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Loader\XmlFileLoader;
use Symfony\Component\HttpKernel\DependencyInjection\Extension;

/**
 * This is the class that loads and manages your bundle configuration.
 *
 * @link http://symfony.com/doc/current/cookbook/bundles/extension.html
 */
class PxCronRequestExtension extends Extension
{
    /**
     * @param array            $configs
     * @param ContainerBuilder $container
     */
    public function load(array $configs, ContainerBuilder $container)
    {
        $configPath = __DIR__.'/../Resources/config';

        $fileLocator = new FileLocator($configPath);

        $loader = new XmlFileLoader($container, $fileLocator);
        $loader->load('services.xml');

        $processor = new Processor();
        $config = $processor->processConfiguration($this->getConfiguration($configs, $container), $configs);

    	$cronjobs = array();
    	if (null !== $config['cronjobs']) {
    	    $cronjobs = $config['cronjobs'];
    	}
        $container->getDefinition('px_cron_request.manager.cron_job')
            ->replaceArgument(0, $cronjobs)
            ->replaceArgument(1, $config['encryption_key']);
    }
}
