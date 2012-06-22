<?php

namespace Deuteron\Bundle\ProjectBundle\Composer;

use Symfony\Component\ClassLoader\ClassCollectionLoader;
use Symfony\Component\Process\Process;
use Symfony\Component\Process\PhpExecutableFinder;

class ScriptHandler extends \Sensio\Bundle\DistributionBundle\Composer\ScriptHandler
{
    public static function initProject($event)
    {
        $options = self::getOptions($event);

        static::executeCommand($event, $options['symfony-app-dir'], 'propel:build --insert-sql');
    }
}
