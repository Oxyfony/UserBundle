<?php
/**
 * This file is part of the Oxyfony User Bundle
 *
 * (c) 2014 Oxyfony
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace O2\Bundle\UserBundle\Tests\DependencyInjection;

use O2\Bundle\UserBundle\Tests\AbstractO2UserExtensionTest;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Loader\XmlFileLoader;
use Symfony\Component\Config\FileLocator;

/**
 * This is the class that loads and manages your bundle configuration
 *
 * To learn more see {@link http://symfony.com/doc/current/cookbook/bundles/extension.html}
 */
class XmlO2UserExtensionTest extends AbstractO2UserExtensionTest
{
	/**
	 * (non-PHPdoc)
	 * @see \O2\Bundle\UserBundle\Tests\AbstractO2UserExtensionTest::loadConfiguration()
	 */
	protected function loadConfiguration(ContainerBuilder $container, $resource)
	{
		$container->loadFromExtension($this->extension->getAlias());
		$container->compile();
		
		$loader = new XmlFileLoader($container, new FileLocator(__DIR__ . '/../Fixtures/Xml/'));
		$loader->load('email_as_username.xml');
	}
}
