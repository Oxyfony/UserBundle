<?php
/**
 * This file is part of the Oxyfony User Bundle
 *
 * (c) 2014 Oxyfony
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace O2\Bundle\UserBundle\Test\Doctrine;

use Doctrine\ORM\EntityManager as DoctrineEntityManager;
use Doctrine\Common\EventManager;
use Doctrine\ORM\Configuration;
use Doctrine\Common\Cache\ArrayCache;
use Doctrine\ORM\Tools\SchemaTool;

/**
 * Trait to provide tools of isolating atabase bundle test
 * 
 * @author Nicolas Claverie <info@artscore-studio.fr>
 *
 */
trait EntityManager
{
	private $entityManager = null;
	
	/**
	 * Return the EntityManager with database schema created in SQLite
	 * 
	 * @return DoctrineEntityManager
	 */
	protected function getEntityManager()
	{
		if ( is_null($this->entityManager) ) {
			$this->entityManager = $this->createEntityManager();
		}
		return $this->entityManager;
	}
	
	protected function createEntityManager($override_database = true)
	{
		$bundleNamespace = explode('\\', __NAMESPACE__);
		array_pop($bundleNamespace); array_pop($bundleNamespace);
		$bundleNamespace = join('\\', $bundleNamespace);
		
		$eventManager = new EventManager();
		
		$prefixList = array(); $aliasNsList = array();
		$ormXmlFolders = array(
			'O2UserBundle' => array('path' => __DIR__ . '/../../Resources/config/doctrine', 'ns' => $bundleNamespace . '\Entity'),
		);
		
		foreach($ormXmlFolders as $alias => $ns) {
			if ( is_dir($ns['path']) ) {
				$prefixList[$ns['path']] = $ns['ns'];
				$aliasNsList[$alias] = $ns['ns'];
			}
		}
		
		$driver = new \Doctrine\ORM\Mapping\Driver\SimplifiedXmlDriver($prefixList);
		
		$config = new Configuration();
		$config->setMetadataCacheImpl(new ArrayCache());
		$config->setMetadataDriverImpl($driver);
		$config->setProxyDir(__DIR__ . '/testProxies');
		$config->setProxyNamespace('O2\Bundle\UserBundle\Tests\TestProxies');
		$config->setAutoGenerateProxyClasses(true);
		$config->setEntityNamespaces($aliasNsList);
		
		$entityManager = DoctrineEntityManager::create(
			array(
				'driver' => 'pdo_sqlite',
				'path' => sys_get_temp_dir() . DIRECTORY_SEPARATOR . "o2-user-test.db"
			),
			$config,
			$eventManager
		);
		
		$schemaTool = new SchemaTool($entityManager);
		$cmf = $entityManager->getMetadataFactory();
		$classes = $cmf->getAllMetadata();
		if ( $override_database ) {
			$schemaTool->dropDatabase();
			$schemaTool->createSchema($classes);
		}
		
		return $entityManager;
	}
}