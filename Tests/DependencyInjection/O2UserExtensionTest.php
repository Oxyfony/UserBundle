<?php
/**
 * This file is part of the Oxygen Bundle Package.
 *
 * (c) 2014 Oxyfony
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace O2\Bundle\UserBundle\Tests\DependencyInjection;

use O2\Bundle\UserBundle\DependencyInjection\O2UserExtension;
use Symfony\Component\DependencyInjection\ContainerBuilder;

/**
 * Unit test for O2ModelExtension class
 *
 * To learn more see {@link http://symfony.com/doc/current/cookbook/bundles/extension.html}
 */
class O2UserExtensionTest extends \PHPUnit_Framework_TestCase
{
	private $extension;
	private $container;
	
	protected function setUp()
	{
		$this->extension = new O2UserExtension();
		$this->container = new ContainerBuilder();
	}
	
	public function testRegister() {
		$this->container->registerExtension($this->extension);
		
		// 
	}
	
}
