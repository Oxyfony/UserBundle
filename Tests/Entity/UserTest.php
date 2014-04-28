<?php
/**
 * This file is part of the Oxyfony User Bundle
 *
 * (c) 2014 Oxyfony
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace O2\Bundle\UserBundle\Tests\Entity;

use O2\Bundle\UserBundle\Test\Doctrine\EntityManager as DoctrineEntityManagerTest;
use O2\Bundle\UserBundle\Entity\User;

/**
 * User Entity Test
 * 
 * @author Nicolas Claverie <info@artscore-studio.fr>
 *
 */
class UserTest extends \PHPUnit_Framework_TestCase
{
	use DoctrineEntityManagerTest;
		
	public function testPersist()
	{
		$entityManager = $this->getEntityManager();
		$datas = $entityManager->getRepository('O2UserBundle:User')->findAll();
		$this->assertEquals(0, count($datas), "Test can't work because sqlite database test isn't empty.");
		
		// Create
		$user = new User();
		$user->setUsername('test');
		$user->setPassword('test');
		$entityManager->persist($user);
		$entityManager->flush();
		
		// Test if in database
		$entityManager->clear();
		$datas = $entityManager->getRepository('O2UserBundle:User')->findAll();
		$this->assertEquals(1, count($datas), "Entity doesn't persist by the test Entity Manager.");
	}
}