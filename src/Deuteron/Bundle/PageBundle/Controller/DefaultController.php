<?php

namespace Deuteron\Bundle\PageBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller,
    Sensio\Bundle\FrameworkExtraBundle\Configuration\Route,
    Sensio\Bundle\FrameworkExtraBundle\Configuration\Template,
    JMS\SecurityExtraBundle\Annotation\Secure
;

class DefaultController extends Controller
{
    /**
     * @Route("/", name="index"),
     * @Route("/page/{page}", name="index_page", requirements={"page" = "\d+"})
     * @Template
     */
    public function indexAction($page = 1)
    {
        return array(
            'page'              => $page,
            'paginationOptions' => array(
                'firstLinkLabel'        => 'Les plus récents',
                'previousLinkLabel'     => 'Plus récent',
                'nextLinkLabel'         => 'Plus vieux',
                'lastLinkLabel'         => 'Les plus vieux',
                'displayFirstLinks'     => false,
                'displayLastLinks'      => false
            )
        );
    }

    /**
     * @Route("/admin", name="adminDashBoard")
     * @Template
     * @Secure(roles="ROLE_SUPER_ADMIN ")
     */
    public function dashboardAction()
    {
        $links = array(
            array(
                'url'   => 'user_list',
                'label' => 'Gestion des utilisateurs'
            )
        );
        return array('links' => $links);
    }

    /**
     * @Route("/about", name="about")
     * @Template
     */
    public function aboutAction()
    {
        return array();
    }
}
