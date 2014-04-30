<?php
/**
 * This file is part of the Oxyfony User Bundle
 *
 * (c) 2014 Oxyfony
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace O2\Bundle\UserBundle\EventListener;

use Doctrine\ORM\Event\LifecycleEventArgs;
use O2\Bundle\UserBundle\Entity\User;

/**
 * User Listener
 * 
 * @author Nicolas Claverie <info@artscore-studio.fr>
 *
 */
class UserListener
{
	/**
	 * @var boolean
	 */
	protected $email_as_username;
	
	/**
	 * @param boolean $email_as_username
	 */
	public function  __construct($email_as_username)
	{
		$this->email_as_username = $email_as_username;
	}
	
	/**
	 * @param LifecycleEventArgs $event
	 */
	public function prePersist(LifecycleEventArgs $event)
	{
		$entity = $event->getEntity();
		$entityManager = $event->getEntityManager();
		
		/*
		 * If O2UserBundle config parameter "email_as_username" is set to true,
		 * we create username bases on email.
		 */
		if ($entity instanceof User && true === $this->email_as_username && is_null($entity->getId())) {
			$entity->setUsername($entity->getEmail());
			$entity->setUsernameCanonical($entity->getEmail());
		}
	}
}