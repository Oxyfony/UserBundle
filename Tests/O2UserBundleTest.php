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

use O2\Bundle\UserBundle\O2UserBundle;
use Symfony\Component\DependencyInjection\ContainerBuilder;

/**
 * O2 User Bundle Unit Test
 *  
 * @author Nicolas Claverie <info@artscore-studio.fr>
 *
 */
class O2UserBundleTest extends \PHPUnit_Framework_TestCase
{
	/**
	 * Registering test
	 */
	public function testRegistering()
	{
		$container = new ContainerBuilder();
		
		$bundle = new O2UserBundle();
		$bundle->boot();
		$bundle->build($container);
		$bundle->shutdown();
	}
}