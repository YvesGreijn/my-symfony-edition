<?php

namespace Admingenerated\DeuteronUserBundle\Form\BaseUserType;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use JMS\SecurityExtraBundle\Security\Authorization\Expression\Expression;

class EditType extends AbstractType
{
    protected $securityContext;

    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        
           $builder->add('id', 'integer', array(  'required' => true,));

        
           $builder->add('username', 'text', array(  'required' => false,));

        
           $builder->add('username_canonical', 'text', array(  'required' => false,));

        
           $builder->add('email', 'text', array(  'required' => false,));

        
           $builder->add('email_canonical', 'text', array(  'required' => false,));

        
           $builder->add('enabled', 'checkbox', array(  'required' => false,));

        
           $builder->add('salt', 'text', array(  'required' => true,));

        
           $builder->add('password', 'text', array(  'required' => true,));

        
           $builder->add('last_login', 'datetime', array(  'required' => false,));

        
           $builder->add('locked', 'checkbox', array(  'required' => false,));

        
           $builder->add('expired', 'checkbox', array(  'required' => false,));

        
           $builder->add('expires_at', 'datetime', array(  'required' => false,));

        
           $builder->add('confirmation_token', 'text', array(  'required' => false,));

        
           $builder->add('password_requested_at', 'datetime', array(  'required' => false,));

        
           $builder->add('credentials_expired', 'checkbox', array(  'required' => false,));

        
           $builder->add('credentials_expire_at', 'datetime', array(  'required' => false,));

        
           $builder->add('roles', 'collection', array(  'allow_add' => true,  'allow_delete' => true,  'by_reference' => false,));

        
    }

    public function getName()
    {
        return 'edit_user';
    }

    public function setSecurityContext($securityContext)
    {
        $this->securityContext = $securityContext;
    }

}
