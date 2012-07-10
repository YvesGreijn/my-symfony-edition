<?php

namespace Deuteron\Bundle\ProjectBundle\Command;

use \Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand,
    \Symfony\Component\Console\Input\InputInterface,
    \Symfony\Component\Console\Input\ArrayInput,
    \Symfony\Component\Console\Output\OutputInterface
;

class InitDevCommand extends ContainerAwareCommand
{

    /**
    * @return void
    */
    protected function configure()
    {
        $this
            ->setName('project:init-dev')
            ->setDescription('Initialisation du projet')
        ;
    }

    /**
    * @param \Symfony\Component\Console\Input\InputInterface $input
    * @param \Symfony\Component\Console\Output\OutputInterface $output
    * @return void
    */
    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $propelLoadFixturesCommand = $this->getApplication()->get('project:init');
        $propelLoadFixturesCommand->run(new ArrayInput(array(
            'command'       => 'project:init',
            'username'      => 'admin',
            'email'         => 'admin@admin.com',
            'password'      => 'admin69',
            '--super-admin' => true
          )),
          $output
        );
    }
}