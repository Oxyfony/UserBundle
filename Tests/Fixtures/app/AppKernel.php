<?php
/**
 * This file is part of the Oxyfony User Bundle
 *
 * (c) 2014 Oxyfony
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
use Symfony\Component\HttpKernel\Kernel;
use Symfony\Component\Config\Loader\LoaderInterface;
use O2\Bundle\UIBundle\O2UIBundle;

class AppKernel extends Kernel
{
    public function registerBundles()
    {
        $bundles = array(
            new Symfony\Bundle\FrameworkBundle\FrameworkBundle(),
        	new Symfony\Bundle\SecurityBundle\SecurityBundle(),
        	new FOS\UserBundle\FOSUserBundle(),
        	new O2\Bundle\UserBundle\O2UserBundle()
        );

        return $bundles;
    }

    public function registerContainerConfiguration(LoaderInterface $loader)
    {
        $loader->load(__DIR__.'/config/config_'.$this->getEnvironment().'.yml');
    }
    
    public function getCacheDir()
    {
    	return sys_get_temp_dir() . '/O2UIBundle/cache';
    }
    
    public function getLogDir()
    {
    	return sys_get_temp_dir() . '/O2UIBundle/logs';
    }
}
