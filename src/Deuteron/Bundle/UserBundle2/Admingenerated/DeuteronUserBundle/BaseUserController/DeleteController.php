<?php

namespace Admingenerated\DeuteronUserBundle\BaseUserController;

use Admingenerator\GeneratorBundle\Controller\Propel\BaseController as BaseController;
use Symfony\Component\HttpFoundation\RedirectResponse;



class DeleteController extends BaseController
{
    public function indexAction($pk)
    {
        try {
            $User = $this->getObject($pk);

            

            $this->preRemove($User);
            $this->process($User);
            $this->postRemove($User);

            $this->get('session')->setFlash('success', $this->get('translator')->trans("object.deleted.success", array(), 'Admingenerator') );
        } catch (\InvalidArgumentException $e) {
            $this->get('session')->setFlash('error', $this->get('translator')->trans("object.deleted.error", array(), 'Admingenerator') );
        }

        return new RedirectResponse($this->generateUrl("Deuteron_Bundle_UserBundle_User_list"));
    }

    /**
    * This method is here to make your life better, so overwrite it
    *
    * @param \FOS\UserBundle\Propel\User $User your \FOS\UserBundle\Propel\User object
    */
    public function preRemove(\FOS\UserBundle\Propel\User $User)
    {
    }

    /**
    * This method is here to make your life better, so overwrite it
    *
    * @param \FOS\UserBundle\Propel\User $User your \FOS\UserBundle\Propel\User object
    */
    public function postRemove(\FOS\UserBundle\Propel\User $User)
    {
    }


    protected function getObject($pk)
    {
        $User = \FOS\UserBundle\Propel\UserQuery::create()->findPk($pk);

        if (!$User) {
            throw new \InvalidArgumentException("No FOS\UserBundle\Propel\User found on Id : $pk");
        }

        return $User;
    }

    protected function process(\FOS\UserBundle\Propel\User $User)
    {
        $User->delete();
    }

}
