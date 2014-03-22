<?php

namespace CSanquer\Silex\Tools\Command;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

/**
 *  assetic assets dump command
 *
 * @author Charles Sanquer <charles.sanquer@gmail.com>
 *
 */
class AsseticDumpCommand extends Command
{
    protected function configure()
    {
        $this
            ->setName('assetic:dump')
            ->setDescription('dump assets registered by assetic')
        ;
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $app = $this->getApplication()->getSilexApplication();

        $dumper = $app['assetic.dumper'];
        if ($dumper) {
            if (isset($app['twig'])) {
                $dumper->addTwigAssets();
            }
            $dumper->dumpAssets();
            $output->writeln('<info>Assets dumped.</info>');
        }
    }
}
