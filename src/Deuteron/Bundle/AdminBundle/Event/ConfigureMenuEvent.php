<?php
namespace Deuteron\Bundle\AdminBundle\Event;

use Knp\Menu\FactoryInterface;
use Knp\Menu\ItemInterface;
use Symfony\Component\EventDispatcher\Event;

class ConfigureMenuEvent extends Event
{
    const CONFIGURE = 'deuteron_admin.menu.side.configure';

    /**
     * @var \Knp\Menu\FactoryInterface
     */
    private $factory;

    /**
     * @var \Knp\Menu\ItemInterface
     */
    private $menu;

    /**
     * @param \Knp\Menu\FactoryInterface $factory
     * @param \Knp\Menu\ItemInterface $menu
     */
    public function __construct(FactoryInterface $factory, ItemInterface $menu)
    {
        $this->factory  = $factory;
        $this->menu     = $menu;
    }

    /**
     * @return \Knp\Menu\FactoryInterface
     */
    public function getFactory()
    {
        return $this->factory;
    }

    /**
     * @return \Knp\Menu\ItemInterface
     */
    public function getMenu()
    {
        return $this->menu;
    }
}