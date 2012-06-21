<?php

namespace Admingenerated\DeuteronUserBundle\Form\BaseUserType;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use JMS\SecurityExtraBundle\Security\Authorization\Expression\Expression;

class FiltersType extends AbstractType
{
    protected $securityContext;

    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        
           $builder->add('username', 'text', array(  'required' => false,));

        
           $builder->add('email', 'text', array(  'required' => false,));

        
    }

    public function getName()
    {
        return 'filters_user';
    }

    public function setSecurityContext($securityContext)
    {
        $this->securityContext = $securityContext;
    }

}
