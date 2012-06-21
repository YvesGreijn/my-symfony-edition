<?php

namespace Deuteron\Bundle\ProjectBundle\Command;

use \Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand,
    \Symfony\Component\Console\Input\InputArgument,
    \Symfony\Component\Console\Input\InputOption,
    \Symfony\Component\Console\Input\InputInterface,
    \Symfony\Component\Console\Input\ArrayInput,
    \Symfony\Component\Console\Output\OutputInterface
;

class InitCommand extends ContainerAwareCommand
{

    /**
     * @return void
     */
    protected function configure()
    {
        $this
            ->setName('project:init')
            ->setDescription('Initialisation du projet')
            ->setDefinition(array(
                new InputArgument('username', InputArgument::REQUIRED, 'The username'),
                new InputArgument('email', InputArgument::REQUIRED, 'The email'),
                new InputArgument('password', InputArgument::REQUIRED, 'The password'),
                new InputOption('super-admin', null, InputOption::VALUE_NONE, 'Set the user as super admin'),
            ))
        ;
    }

    /**
     * @param \Symfony\Component\Console\Input\InputInterface $input
     * @param \Symfony\Component\Console\Output\OutputInterface $output
     * @return void
     */
    protected function execute(InputInterface $input, OutputInterface $output)
    {
        // Génération des fichiers modèles et insertion en base
        $propelBuildCommand = $this->getApplication()->get('propel:table:drop');
        $propelBuildCommand->run(new ArrayInput(array(
                'command' => 'propel:table:drop',
                '--force'  => true
            )),
            $output
        );

        // Génération des fichiers modèles et insertion en base
        $propelBuildCommand = $this->getApplication()->get('propel:build');
        $propelBuildCommand->run(new ArrayInput(array(
                'command' => 'propel:build',
                '--insert-sql'  => true
            )),
            $output
        );

        // Création d'un utilisateur
        $fosUserCreateCommand = $this->getApplication()->get('fos:user:create');
        $fosUserCreateCommand->run($input,$output);

        // Installation des assets
        $propelBuildCommand = $this->getApplication()->get('assets:install');
        $propelBuildCommand->run(new ArrayInput(array(
                'command' => 'assets:install',
                '--symlink'  => true,
                'target'  => '../../../../web',
            )),
            $output
        );
    }
}
