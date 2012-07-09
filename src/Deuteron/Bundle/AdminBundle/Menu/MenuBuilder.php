<?php
namespace Deuteron\Bundle\AdminBundle\Menu;

use Knp\Menu\FactoryInterface;
use Symfony\Component\EventDispatcher\EventDispatcher;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Router;
use Symfony\Component\Security\Core\SecurityContext;
use Deuteron\Bundle\AdminBundle\Event\ConfigureMenuEvent;

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
    * @var \Symfony\Component\EventDispatcher\EventDispatcher
    */
    private $eventDispatcher;

    /**
     * @param \Knp\Menu\FactoryInterface $factory
     * @param \Symfony\Component\Security\Core\SecurityContext $securityContext
     * @param \Symfony\Component\EventDispatcher\EventDispatcher $eventDispatcher
     */
    public function __construct(FactoryInterface $factory, SecurityContext $securityContext, EventDispatcher $eventDispatcher)
    {
        $this->factory = $factory;

        $this->securityContext = $securityContext;

        $this->eventDispatcher = $eventDispatcher;
    }

    /**
     * @param \Symfony\Component\HttpFoundation\Request $request
     * @return mixed
     */
    public function createSideMenu(Request $request)
    {
        $menu = $this->factory->createItem('root', array('childrenAttributes' => array('class' => 'nav nav-list')));

        $menu->addChild('Deuteron', array('attributes' => array('class' => 'nav-header')));
        if(true === $this->securityContext->isGranted('ROLE_ADMIN'))
        {
            $menu->addChild('Overview', array('route' => 'admin_dashboard', 'extras' => array('safe_label' => true, 'icon_class' => 'fam_house')));
        }

        $this->eventDispatcher->dispatch(ConfigureMenuEvent::CONFIGURE, new ConfigureMenuEvent($this->factory, $menu));

        return $menu;
    }
}