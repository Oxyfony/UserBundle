<?php
/**
 * This file is part of the Oxyfony User Bundle
 *
 * (c) 2014 Oxyfony
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace O2\Bundle\UserBundle\DependencyInjection;

use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\Config\FileLocator;
use Symfony\Component\HttpKernel\DependencyInjection\Extension;
use Symfony\Component\DependencyInjection\Loader;
use Symfony\Component\DependencyInjection\Extension\PrependExtensionInterface;

/**
 * This is the class that loads and manages your bundle configuration
 *
 * To learn more see {@link http://symfony.com/doc/current/cookbook/bundles/extension.html}
 */
class O2UserExtension extends Extension implements PrependExtensionInterface
{
    /**
     * {@inheritDoc}
     */
    public function load(array $configs, ContainerBuilder $container)
    {
        $configuration = new Configuration();
        $config = $this->processConfiguration($configuration, $configs);
		
        $loader = new Loader\XmlFileLoader($container, new FileLocator(__DIR__.'/../Resources/config'));
        
        if ( isset($config['email_as_username']) && true === $config['email_as_username'] ) {
        	$container->setParameter('o2_user.email_as_username', $config['email_as_username']);
        	$loader->load('services/email_as_username.xml');
        	
        }
        
        $loader->load('services.xml');
    }
    
    /**
     * @param ContainerBuilder $container
     */
    public function prepend(ContainerBuilder $container)
    {
    	// Get Application bundles list
    	$bundles = $container->getParameter('kernel.bundles');
    	
    	// Get O2UserBundle Configuration
    	$configuration = new Configuration();
    	$configs = $container->getExtensionConfig($this->getAlias());
    	$config = $this->processConfiguration($configuration, $configs);
    	
    	// If email as username is defined, update FOSUserBundle 
    	if ( isset($config['email_as_username']) && true === $config['email_as_username'] ) {
    		$config = array(
    			'registration' => array(
    				'form' => array(
    					'type' => 'o2_user_registration',
    					'validation_groups' => array('o2UserRegistration')
    				)
    			),
				'profile' => array(
					'form' => array(
						'type' => 'o2_user_profile',
						'validation_groups' => array('o2UserProfile')
					)
				)
    		);
    		
    		foreach($container->getExtensions() as $name => $extension) {
    			if ( 'fos_user' === $name ) {
    				$container->prependExtensionConfig($name, $config);
    			}
    		}
    	}
    }
}
