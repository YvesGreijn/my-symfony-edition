<?php

namespace Admingenerated\DeuteronUserBundle\BaseUserController;

use Admingenerator\GeneratorBundle\Controller\Propel\BaseController as BaseController;
use Symfony\Component\HttpFoundation\RedirectResponse;use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Deuteron\Bundle\UserBundle\Form\Type\User\NewType;


class NewController extends BaseController
{
    public function indexAction()
    {
        

        $User = $this->getNewObject();

        $form = $this->createForm($this->getNewType(), $User);

        return $this->render('DeuteronUserBundle:UserNew:index.html.twig', array(
            "User" => $User,
            "form" => $form->createView(),
        ));
    }

    public function createAction()
    {
        

        $User = $this->getNewObject();

        $form = $this->createForm($this->getNewType(), $User);
        $form->bindRequest($this->get('request'));

        if ($form->isValid()) {
            $this->preSave($form, $User);
            $this->saveObject($User);
            $this->postSave($form, $User);

            $this->get('session')->setFlash('success', $this->get('translator')->trans("object.saved.success", array(), 'Admingenerator') );

            return new RedirectResponse($this->generateUrl("Deuteron_Bundle_UserBundle_User_edit", array('pk' => $User->getId()) ));

        } else {
            $this->get('session')->setFlash('error', $this->get('translator')->trans("object.saved.error", array(), 'Admingenerator') );
        }

        return $this->render('DeuteronUserBundle:UserNew:index.html.twig', array(
            "User" => $User,
            "form" => $form->createView(),
        ));
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


    protected function getNewType()
    {
        $type = new NewType();
        $type->setSecurityContext($this->get('security.context'));

        return $type;
    }

    protected function getNewObject()
    {
        return new \FOS\UserBundle\Propel\User;
    }

    protected function saveObject(\FOS\UserBundle\Propel\User $User)
    {
        $User->save();
    }
}
