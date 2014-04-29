<?php
/**
 * This file is part of the Oxyfony User Bundle
 *
 * (c) 2014 Oxyfony
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace O2\Bundle\UserBundle\Tests;

use O2\Bundle\UserBundle\DependencyInjection\O2UserExtension;
use Symfony\Component\DependencyInjection\ContainerBuilder;
/**
 * Abstract Class for testing O2 User Bundle Dependency Injection
 * 
 * @author Nicolas Claverie <info@artscore-studio.fr>
 *
 */
abstract class AbstractO2UserExtensionTest extends \PHPUnit_Framework_TestCase
{
	private $extension;
	private $container;
	
	protected function setUp()
	{
		$this->extension = new O2UserExtension();
		$this->container = new ContainerBuilder();
		$this->container->registerExtension($this->extension);
	}
	
	/**
	 * @param ContainerBuilder $container
	 * @param string $resource
	 */
	abstract protected function loadConfiguration(ContainerBuilder $container, $resource);
	
	/**
	 * Test bundle without configuration
	 */
	public function testWithoutConfiguration()
	{
		$this->container->loadFromExtension($this->extension->getAlias());
		$this->container->compile();
		
		$this->assertFalse($this->container->has('o2_user.forms.registration'));
		$this->assertFalse($this->container->has('o2_user.forms.profile'));
	}
	
	/**
	 * Test bundle with email_as_username param set to false
	 */
	public function testDisabledConfiguration()
	{
		$this->loadConfiguration($this->container, 'disabled');
		$this->container->compile();
		
		$this->assertFalse($this->container->has('o2_user.forms.registration'));
		$this->assertFalse($this->container->has('o2_user.forms.profile'));
	}
	
	/**
	 * Test bundle with email_as_username param set to true
	 */
	public function testEnableConfiguration()
	{
		$this->loadConfiguration($this->container, 'enabled');
		$this->container->compile();
		
		$this->assertFalse($this->container->has('o2_user.forms.registration'));
		$this->assertFalse($this->container->has('o2_user.forms.profile'));
	}
}