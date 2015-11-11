<?php

namespace Optii\LolApiBundle\DependencyInjection;

use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\Config\FileLocator;
use Symfony\Component\HttpKernel\DependencyInjection\Extension;
use Symfony\Component\DependencyInjection\Loader;

/**
 * This is the class that loads and manages your bundle configuration
 *
 * To learn more see {@link http://symfony.com/doc/current/cookbook/bundles/extension.html}
 */
class OptiLolApiExtension extends Extension
{

    /**
     * {@inheritdoc}
     */
    public function load(array $configs, ContainerBuilder $container)
    {
        $configuration = new Configuration($this->getAlias());
        $config = $this->processConfiguration($configuration, $configs);

        $loader = new Loader\XmlFileLoader($container, new FileLocator(__DIR__.'/../Resources/config'));
        $loader->load('services.xml');

        if (!$config['key']) {
            throw new \InvalidArgumentException('The "key" option must be set');
        }

        $container->setParameter('opti_lol_api.key', $config['key']);
        $container->setParameter('opti_lol_api.cache', $config['cache']);
        $container->setParameter('opti_lol_api.endpoints', $config['endpoints']);
        $container->setParameter('opti_lol_api.region', $config['region']);
        $container->setParameter('opti_lol_api.throttle', $config['throttle']);
    }

    public function getAlias()
    {
        return 'opti_lol_api';
    }
}


