<?php
/**
 * This file is part of the Oxyfony User Bundle
 *
 * (c) 2014 Oxyfony
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace O2\Bundle\UserBundle\Entity;

use FOS\UserBundle\Model\User as BaseUser;
	
/**
 * User Entity
 *
 * @author Nicolas Claverie <info@artscore-studio.fr>
 *
 */
class User extends BaseUser
{
	const ROLE_MEMBER = 'ROLE_MEMBER';
}