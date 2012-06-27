<?php

namespace Deuteron\Bundle\ProjectBundle\Composer;

use Composer\Script\Event;

class ScriptHandler extends \Sensio\Bundle\DistributionBundle\Composer\ScriptHandler
{
    public static function postInstallInitProject(Event $event)
    {
        $options = self::getOptions($event);

        static::executeCommand($event, $options['symfony-app-dir'], 'propel:build --insert-sql');
    }

    public static function postUpdateInitProject(Event $event)
    {
        $options = self::getOptions($event);

        static::executeCommand($event, $options['symfony-app-dir'], 'propel:build');
    }
}
