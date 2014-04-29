<?php
/**
 * This file is part of the Oxyfony User Bundle
 *
 * (c) 2014 Oxyfony
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace O2\Bundle\UserBundle\Form\Type;

use Symfony\Component\Form\FormBuilderInterface;
use FOS\UserBundle\Form\Type\ProfileFormType as FOSProfileFormType;

/**
 * Profile Form Type
 * 
 * @author Nicolas Claverie <info@artscore-studio.fr>
 *
 */
class ProfileFormType extends FOSProfileFormType
{
	/**
	 * (non-PHPdoc)
	 * @see \FOS\UserBundle\Form\Type\ProfileFormType::buildForm()
	 */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        parent::buildForm($builder, $options);
        $builder->remove('username');
    }
    
    /**
     * (non-PHPdoc)
     * @see \FOS\UserBundle\Form\Type\ProfileFormType::getName()
     */
	public function getName()
    {
        return 'o2_user_profile';
    }
}
