<?php
namespace Deuteron\Bundle\AdminBundle\Menu;

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
    public function createSideMenu(Request $request)
    {
        $menu = $this->factory->createItem('root', array('childrenAttributes' => array('class' => 'nav nav-list')));

        $menu->addChild('Deuteron', array('attributes' => array('class' => 'nav-header')));
        $menu->addChild('<i class="icon-white icon-home"></i> Overview', array('attributes' => array('class' => 'active'), 'route' => 'admin_dashboard', 'extras' => array('safe_label' => true)));
        $menu->addChild('<i class="icon-user"></i> Users', array('route' => 'user_list', 'extras' => array('safe_label' => true)));
        $menu->addChild('Your Account', array('attributes' => array('class' => 'nav-header')));
        $menu->addChild('<i class="icon-user"></i> Profile', array('route' => 'fos_user_profile_show', 'extras' => array('safe_label' => true)));

        return $menu;
    }
}