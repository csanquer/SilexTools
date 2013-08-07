<?php

namespace CSanquer\Silex\Tools\Command;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Filesystem\Filesystem;
use Symfony\Component\Finder\Finder;

/**
 *  cache directory cleaning command
 *
 * @author Charles Sanquer <charles.sanquer@gmail.com>
 *
 */
class CacheClearCommand extends Command
{
    
    protected function configure()
    {
        $this
                ->setName('cache:clear')
                ->setDescription('cache directory clearing command')
//            ->addArgument('name', InputArgument::OPTIONAL, '')
//            ->addOption('opt', null, InputOption::VALUE_NONE, '')
        ;
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $finder = new Finder();
        $fs = new Filesystem();
        
        $output->writeln('Clearing Application cache ...');
        
        $files = $finder->directories()->depth('== 0')->in($this->getApplication()->getAppDir().'/cache');
        $fs->remove($files);
    }
}
