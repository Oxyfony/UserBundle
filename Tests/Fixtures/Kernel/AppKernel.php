<?php
namespace O2\Bundle\UserBundle\Tests\Fixtures\Kernel;

use Symfony\Component\HttpKernel\Kernel;
use Symfony\Component\Config\Loader\LoaderInterface;

/**
 * Minimal kernel for test
 *
 * @author Laurent Chedanne <laurent@chedanne.pro>
 *
 */
class AppKernel extends Kernel
{
	public function registerBundles()
	{
		$bundles = array(
			new \Symfony\Bundle\FrameworkBundle\FrameworkBundle(),
		);
		return $bundles;
	}
	
	public function registerContainerConfiguration(LoaderInterface $loader)
	{
		$loader->load(__DIR__.'/Resources/kernel/config_'.$this->getEnvironment().'.yml');
	}
}
