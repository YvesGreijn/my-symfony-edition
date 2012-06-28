<?php
namespace Deuteron\Bundle\UserBundle\EventListener;

use Deuteron\Bundle\AdminBundle\Event\ConfigureMenuEvent;

class ConfigureMenuListener
{
    /**
     * @param \Deuteron\Bundle\AdminBundle\Event\ConfigureMenuEvent $event
     */
    public function onMenuConfigure(ConfigureMenuEvent $event)
    {
        $menu = $event->getMenu();

        $menu->addChild('Users', array('route' => 'user_list', 'extras' => array('safe_label' => true, 'icon_class' => 'fam_user')));
        $menu->addChild('Your Account', array('attributes' => array('class' => 'nav-header')));
        $menu->addChild('Profile', array('route' => 'fos_user_profile_show', 'extras' => array('safe_label' => true, 'icon_class' => 'fam_report_user')));
    }
}