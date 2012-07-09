<?php

namespace Deuteron\Bundle\UserBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller,
    Sensio\Bundle\FrameworkExtraBundle\Configuration\Route,
    Sensio\Bundle\FrameworkExtraBundle\Configuration\Template,
    FOS\UserBundle\Propel as Model,
    Deuteron\Bundle\UserBundle\Form
;

class UserController extends Controller
{
    /**
     * @Route("/list/{page}", name="user_list", requirements={"page" = "\d+"}, defaults={"page" = 1})
     * @Route("/{page}", name="user_list", requirements={"page" = "\d+"}, defaults={"page" = 1})
     * @Template
     */
    public function listAction($page)
    {
        $userQuery = Model\UserQuery::create()
          ->select(array('Id', 'Username'))
        ;

        /** @var $paginator \Knp\Component\Pager\Paginator */
        $paginator = $this->get('knp_paginator');
        /** @var $pagination \Knp\Bundle\PaginatorBundle\Pagination\SlidingPagination */
        $pagination = $paginator->paginate(
            $userQuery,
            $page
        );

        return array(
          'pagination' => $pagination
        );
    }

    /**
     * @Route("/new", name="user_new")
     * @Template
     */
    public function newAction()
    {
        $form = $this->createForm(new Form\User\Add());

        $request = $this->getRequest();

        if('POST' === $request->getMethod())
        {
            $form->bindRequest($request);

            if($form->isValid())
            {
                try
                {
                    $formData = $form->getData();

                    /** @var $manipulator \FOS\UserBundle\Util\UserManipulator */
                    $manipulator = $this->get('fos_user.util.user_manipulator');
                    $newUser = $manipulator->create($formData['username'], $formData['password'], $formData['email'], true, $formData['super_admin']);

                    $this->get('session')->setFlash('success', 'Le compte utilisateur a été crée avec succès.');
                }
                catch(\Exception $exception)
                {
                    $this->get('session')->setFlash('error', 'La création du compte utilisateur a échoué.');
                }

                return $this->redirect($this->generateUrl('user_list'));
            }
        }

        return array(
            'form' => $form->createView(),
        );
    }

    /**
     * @Route("/edit/{id}", name="user_edit")
     * @Template
     */
    public function editAction(Model\User $user)
    {
        $form = $this->createForm(new Form\User\Edit(), $user);
        $request = $this->getRequest();

        if('POST' === $request->getMethod())
        {
            $form->bindRequest($request);

            if($form->isValid())
            {
                try
                {
                    $user->save();
                    $this->get('session')->setFlash('success', 'Le compte utilisateur a été modifié avec succès.');
                }
                catch(\Exception $exception)
                {
                    $this->get('session')->setFlash('error', 'La modification du compte utilisateur a échoué.');
                }

                return $this->redirect($this->generateUrl('user_list'));
            }
        }

        return array(
            'form' => $form->createView(),
            'user' => $user
        );
    }

    /**
     * @Route("/delete/{id}", name="user_delete", requirements={"page" = "\d+"})
     * @Template
     */
    public function deleteAction(Model\User $user)
    {
        try
        {
            $user->delete();

            $this->get('session')->setFlash('success', 'Le compte utilisateur a été supprimé avec succès.');
        }
        catch(\Exception $exception)
        {
            $this->get('session')->setFlash('error', 'La suppression du compte utilisateur a échoué.');
        }

        return $this->redirect($this->generateUrl('user_list'));
    }
}
