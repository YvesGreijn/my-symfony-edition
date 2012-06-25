<?php

namespace Deuteron\Bundle\AdminBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;

class DefaultController extends Controller
{
    /**
     * @Route("/", name="adminDashboard")
     * @Template()
     */
    public function indexAction()
    {
        $links = array(
            array(
                'url'   => 'user_list',
                'label' => 'Gestion des utilisateurs'
            )
        );
        return array('links' => $links);
    }
}
