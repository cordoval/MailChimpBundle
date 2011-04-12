<?php

/*
 * This file is part of the JirafeMailChimpBundle.
 *
 * (c) 2011 Jirafe <http://www.jirafe.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Jirafe\Bundle\MailChimpBundle\DependencyInjection;

use Symfony\Component\DependencyInjection\Reference;
use Symfony\Component\HttpKernel\DependencyInjection\Extension;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Loader\XmlFileLoader;
use Symfony\Component\Config\FileLocator;

class JirafeMailChimpExtension extends Extension
{
    /**
     * {@inheritDoc}
     */
    public function load(array $configs, ContainerBuilder $container)
    {
        $loader = new XmlFileLoader($container, new FileLocator(__DIR__.'/../Resources/config'));
        $loader->load('mail_chimp.xml');

        $config = $this->mergeConfigs($configs);

        if (empty($config['api_key'])) {
            throw new \Exception('You must define the \'api_key\' parameter in the \'jirafe_mail_chimp\' configuration section.');
        }

        $container->setParameter('mail_chimp.api_key', $config['api_key']);

        $definition = $container->getDefinition('mail_chimp.client');
        $definition->addArgument(new Reference(sprintf('mail_chimp.connection.%s', $config['connection'])));
    }

    /**
     * Merges the given configurations
     *
     * @param  array $configs An array of configurations
     *
     * @return array The merged configuration
     */
    public function mergeConfigs(array $configs)
    {
        $merged = array('connection' => 'http');

        foreach ($configs as $config) {
            if (isset($config['api-key'])) {
                $merged['api_key'] = $config['api-key'];
            } else if (isset($config['api_key'])) {
                $merged['api_key'] = $config['api_key'];
            }

            if (isset($config['connection'])) {
                $merged['connection'] = $config['connection'];
            }
        }

        return $merged;
    }

    /**
     * {@inheritDoc}
     */
    public function getXsdValidationBasePath()
    {
        return __DIR__.'/../Resources/config/schema';
    }

    /**
     * {@inheritDoc}
     */
    public function getNamespace()
    {
        return 'http://www.jirafe.com/schema/dic/mail_chimp_bundle';
    }
}
