<?php
namespace Deuteron\Bundle\UserBundle\Form\User;

use Symfony\Component\Form\AbstractType,
    Symfony\Component\Form\FormBuilderInterface
;

class Add extends AbstractType
{
    /**
     * @param \Symfony\Component\Form\FormBuilderInterface $builder
     * @param array $options
     * @return void
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('username')
            ->add('email')
            ->add('super_admin', 'checkbox', array('required' => false))
            ->add('password', 'password')
        ;
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'add_user';
    }
}