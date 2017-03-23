<?php

namespace Px\CronRequestBundle\DependencyInjection;

use Symfony\Component\Config\Definition\Builder\TreeBuilder;
use Symfony\Component\Config\Definition\ConfigurationInterface;

/**
 * Class Configuration
 * @package Px\CronRequestBundle\DependencyInjection
 */
class Configuration implements ConfigurationInterface
{
    /**
     * Generates the configuration tree builder
     *
     * @return TreeBuilder
     */
    public function getConfigTreeBuilder()
    {
        $treeBuilder = new TreeBuilder();
        $node = $treeBuilder->root('px_cron_request');
        $node
            ->children()
                ->scalarNode('encryption_key')->isRequired()->end()
                ->arrayNode('cronjobs')
                    ->prototype('array')
                        ->children()
                            ->scalarNode('job')->isRequired()->end()
                            ->scalarNode('name')->isRequired()->end()
                            ->booleanNode('symfonyCommand')->defaultValue(false)->end()
                        ->end()
                    ->end()
                ->end()
            ->end();

        return $treeBuilder;
    }
}
