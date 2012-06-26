<?php

namespace Deuteron\Bundle\ProjectBundle\Menu;

use Knp\Menu\FactoryInterface,
    Symfony\Component\HttpFoundation\Request,
    Symfony\Component\Routing\Router,
    Symfony\Component\Security\Core\SecurityContext
;

class MenuBuilder
{
  /**
   * @var \Knp\Menu\FactoryInterface
   */
  private $factory;

  /**
   * @var \Symfony\Component\Security\Core\SecurityContext
   */
  private $securityContext;

  /**
   * @param \Knp\Menu\FactoryInterface $factory
   * @param \Symfony\Component\Security\Core\SecurityContext $securityContext
   */
  public function __construct(FactoryInterface $factory, SecurityContext $securityContext)
  {
    $this->factory = $factory;

    $this->securityContext = $securityContext;
  }

  /**
   * @param \Symfony\Component\HttpFoundation\Request $request
   * @return mixed
   */
  public function createMainMenu(Request $request)
  {
    $menu = $this->factory->createItem('root', array('childrenAttributes' => array('class' => 'nav')));

    $menu->addChild('A propos',  array('route' => 'about'));

    if(true === $this->securityContext->isGranted('ROLE_SUPER_ADMIN'))
    {
      $menu
        ->addChild('Administration',  array('route' => 'admin_dashboard'))
      ;
    }

    return $menu;
  }
}