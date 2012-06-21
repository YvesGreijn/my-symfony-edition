<?php
namespace Deuteron\Bundle\UserBundle\Form\User;

use Symfony\Component\Form\AbstractType,
    Symfony\Component\Form\FormBuilderInterface
;

class Edit extends AbstractType
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
        ;
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'edit_user';
    }
}