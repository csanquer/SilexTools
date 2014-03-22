<?php

namespace CSanquer\Silex\Tools\Command;

use \Symfony\Component\Console\Application;
use \Symfony\Component\Console\Command\Command;
use \Symfony\Component\Console\Input\InputArgument;
use \Symfony\Component\Console\Input\InputInterface;
use \Symfony\Component\Console\Input\InputOption;
use \Symfony\Component\Console\Output\OutputInterface;
use \Symfony\Component\Process\ProcessBuilder;

/**
 *  run PHP 5.4 builtin web server for development and testing
 *
 * Port of Symfony2 server run command
 *
 * @author Michał Pipa <michal.pipa.xsolve@gmail.com>
 * @author Charles Sanquer <charles.sanquer@gmail.com>
 *
 */
class ServerRunCommand extends Command
{
    public function setApplication(Application $application = null)
    {
        parent::setApplication($application);
    }

    protected function configure()
    {
        $this
            ->setName('server:run')
            ->setDescription('run PHP builtin web server for development and testing')
            ->setHelp(<<<EOF
The <info>%command.name%</info> runs PHP built-in web server:

  <info>%command.full_name%</info>

To change default bind address and port use the <info>address</info> argument:

  <info>%command.full_name% 127.0.0.1:8080</info>

To change default docroot directory use the <info>--docroot</info> option:

  <info>%command.full_name% --docroot=htdocs/</info>

If you have custom docroot directory layout, you can specify your own
router script using <info>--router</info> option:

  <info>%command.full_name% --router=app/config/router.php</info>

See also: http://www.php.net/manual/en/features.commandline.webserver.php
EOF
            )
            ->addArgument('address', InputArgument::OPTIONAL, 'Address:port', 'localhost:8000')
            ->addOption('docroot', 'd', InputOption::VALUE_REQUIRED, 'Document root', 'web/')
            ->addOption('router', 'r', InputOption::VALUE_REQUIRED, 'Path to custom router script')
        ;
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $env = $input->getOption('env');
        $address = $input->getArgument('address');
        $docroot = $input->getOption('docroot') ? realpath($input->getOption('docroot')) : $this->getApplication()->getWebDir();
        $router = $input->getOption('router') ? $input->getArgument('router') : realpath(__DIR__.'/../Resources/config/router_'.$env.'.php');

        $output->writeln('running PHP built-in server on <info>'.$address.'</info> in <comment>'.$env.'</comment> silex environment ');

        $builder = new ProcessBuilder(array(PHP_BINARY, '-S', $input->getArgument('address'), $router));
        $builder->setWorkingDirectory($docroot);
        $builder->setTimeout(null);
        $builder->getProcess()->run(function ($type, $buffer) use ($output) {
            if (OutputInterface::VERBOSITY_VERBOSE <= $output->getVerbosity()) {
                $output->write($buffer);
            }
        });
    }
}
