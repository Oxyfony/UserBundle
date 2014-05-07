<?php

namespace O2\Bundle\UserBundle\Tests\Entity;

use FOS\UserBundle\Doctrine\UserManager;
use O2\Bundle\UserBundle\Tests\Fixtures\AppKernel;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\Tools\SchemaTool;
use Doctrine\Common\Cache\ArrayCache;
/**
 * Test of the entity user
 *
 * @author Laurent Chedanne <laurent@chedanne.pro>
 *
 */
class UserTest extends \PHPUnit_Framework_TestCase {
	
	public function testCreateUserSchema() {
		
		// Bundle namespace
		$bundleNamespace = explode('\\', __NAMESPACE__);
		array_pop($bundleNamespace); array_pop($bundleNamespace);
		$bundleNamespace = join('\\', $bundleNamespace);
		
		// doctrine xml configs and namespaces of entities
		$prefixList = array(); $aliasNsList = array();
		$ormXmlFolders = array(
			'O2UserBundle' => array('path' => __DIR__.'/../../Resources/config/doctrine', 'ns' => $bundleNamespace . '\Entity'),
		);
		foreach($ormXmlFolders as $alias => $ns) {
			if (is_dir($ns['path'])) {
				$prefixList[$ns['path']] = $ns['ns'];
				$aliasNsList[$alias] = $ns['ns'];
			}
		}
		
		// create drivers (that reads xml configs)
		$driver = new \Doctrine\ORM\Mapping\Driver\SimplifiedXmlDriver($prefixList);
		
		// create config object
		$config = new \Doctrine\ORM\Configuration();
		$config->setMetadataCacheImpl(new ArrayCache());
		$config->setMetadataDriverImpl($driver);
		$config->setEntityNamespaces($aliasNsList);
		$config->setAutoGenerateProxyClasses(true);
		$config->setProxyDir(__DIR__.'/TestProxies');
		$config->setProxyNamespace('O2\Bundle\UserBundle\Tests\TestProxies');
			
		// create entity manager
		$em = EntityManager::create(
			array(
				'driver' => 'pdo_sqlite',
				'path' => sys_get_temp_dir() . DIRECTORY_SEPARATOR . "user-schema.db"
			),
			$config
		);
		
		// Create schema
		$schemaTool = new SchemaTool($em);
		$cmf = $em->getMetadataFactory();
		$classes = $cmf->getMetadataFor('O2\Bundle\UserBundle\Entity\User');
		$schemaTool->dropDatabase();
		$schemaTool->createSchema(array($classes));
		
		$this->assertTrue(count($em->getRepository('O2UserBundle:User')->findAll()) == 0, "User error");
	}
	
}

