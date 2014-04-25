<?php
/**
 * This file is part of the Oxyfony User Bundle
 *
 * (c) 2014 Oxyfony
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace O2\Bundle\UserBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

/**
 * Oxygen User Bundle Default Controller
 * 
 * @author Nicolas Claverie <info@artscore-studio.fr>
 *
 */
class DefaultController extends Controller
{
	/**
	 * Oxygen User Bundle Homepage COntroller
	 * 
	 * @param string $name
	 */
    public function indexAction($name = 'Oxyfony')
    {
        return $this->render('O2UserBundle:Default:index.html.twig', array('name' => $name));
    }
}
