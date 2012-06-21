<?php

namespace Admingenerated\DeuteronUserBundle\BaseUserController;

use Admingenerator\GeneratorBundle\Controller\Propel\BaseController as BaseController;
use Symfony\Component\HttpFoundation\RedirectResponse;use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Deuteron\Bundle\UserBundle\Form\Type\User\EditType;



class EditController extends BaseController
{
    public function indexAction($pk)
    {
        $User = $this->getObject($pk);

        

        if (!$User) {
            throw new NotFoundHttpException("The FOS\UserBundle\Propel\User with Id $pk can't be found");
        }

        echo "<pre>";
        var_dump($this->getEditType());
        echo "</pre>" . PHP_EOL;
        die("FFFFFUUUUUCCCCCKKKKK" . PHP_EOL);
        $form = $this->createForm($this->getEditType(), $User);

        return $this->render('DeuteronUserBundle:UserEdit:index.html.twig', array(
            "User" => $User,
            "form" => $form->createView(),
        ));
    }

    public function updateAction($pk)
    {
        $User = $this->getObject($pk);

        

        if (!$User) {
            throw new NotFoundHttpException("The FOS\UserBundle\Propel\User with Id $pk can't be found");
        }

        $this->preBindRequest($User);
        $form = $this->createForm($this->getEditType(), $User);
        $form->bindRequest($this->get('request'));

        if ($form->isValid()) {
            $this->preSave($form, $User);
            $this->saveObject($User);
            $this->postSave($form, $User);

            $this->get('session')->setFlash('success', $this->get('translator')->trans("object.saved.success", array(), 'Admingenerator') );

            return new RedirectResponse($this->generateUrl("Deuteron_Bundle_UserBundle_User_edit", array('pk' => $pk) ));

        } else {
            $this->get('session')->setFlash('error',  $this->get('translator')->trans("object.saved.error", array(), 'Admingenerator') );
        }

        return $this->render('DeuteronUserBundle:UserEdit:index.html.twig', array(
            "User" => $User,
            "form" => $form->createView(),
        ));
    }

    /**
    * This method is here to make your life better, so overwrite  it
    *
    * @param \FOS\UserBundle\Propel\User $User your \FOS\UserBundle\Propel\User object
    */
    public function preBindRequest(\FOS\UserBundle\Propel\User $User)
    {
    }

    /**
    * This method is here to make your life better, so overwrite  it
    *
    * @param \Symfony\Component\Form\Form $form the valid form
    * @param \FOS\UserBundle\Propel\User $User your \FOS\UserBundle\Propel\User object
    */
    public function preSave(\Symfony\Component\Form\Form $form, \FOS\UserBundle\Propel\User $User)
    {
    }

    /**
    * This method is here to make your life better, so overwrite  it
    *
    * @param \Symfony\Component\Form\Form $form the valid form
    * @param \FOS\UserBundle\Propel\User $User your \FOS\UserBundle\Propel\User object
    */
    public function postSave(\Symfony\Component\Form\Form $form, \FOS\UserBundle\Propel\User $User)
    {
    }


    protected function getEditType()
    {
        $type = new EditType();
        $type->setSecurityContext($this->get('security.context'));

        return $type;
    }

    protected function getObject($pk)
    {
        return \FOS\UserBundle\Propel\UserQuery::create()->findPk($pk);
    }

    protected function saveObject(\FOS\UserBundle\Propel\User $User)
    {
        $User->save();
    }
}
