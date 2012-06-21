<?php

namespace Deuteron\Bundle\UserBundle\Controller;

use
  Symfony\Bundle\FrameworkBundle\Controller\Controller,
  Sensio\Bundle\FrameworkExtraBundle\Configuration\Route,
  Sensio\Bundle\FrameworkExtraBundle\Configuration\Template
;


class DefaultController extends Controller
{
  /**
   * @Route("/unauthorized", name="unauthorized")
   * @Template
   */
  public function unauthorizedAction()
  {
    return array();
  }
}
