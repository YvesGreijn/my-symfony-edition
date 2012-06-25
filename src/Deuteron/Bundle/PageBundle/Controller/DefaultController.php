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
     * @Template
     */
    public function indexAction()
    {
        return array();
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
