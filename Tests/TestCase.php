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

use Doctrine\ORM\Tools\SchemaTool;

/**
 * 
 * @author Nicolas Claverie <info@artscore-studio.fr>
 *
 */
abstract class TestCase extends \PHPUnit_Framework_TestCase
{	
	public function tearDown()
	{
		$this->kernel->shutdown();
	}
	
	public function generateSchema()
	{
		$metadata = $this->getMetaData();
		
		if ( !empty($metadata) ) {
			$tool = new SchemaTool($this->entityManager);
			$tool->createSchema($metadata);
		} else {
			throw new Doctrine\DBAL\Schema\SchemaException('No metadata classes to process.');
		}
	}
	
	public function getMetadata()
	{
		return $this->entityManager()->getMetadataFactory()->getAllMetadata();
	}
} 