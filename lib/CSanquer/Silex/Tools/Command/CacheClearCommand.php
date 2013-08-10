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
    protected $cacheDir;
            
    public function __construct($name = null, $cacheDir = null)
    {
        parent::__construct($name);
        if ($cacheDir) {
            $this->cacheDir = $cacheDir;
        }
    }
    
    public function setApplication(\Symfony\Component\Console\Application $application = null)
    {
        parent::setApplication($application);
        if (!$this->cacheDir && method_exists($application, 'getCacheDir')) {
            $this->cacheDir = $application->getCacheDir();
        }
    }
    
    protected function configure()
    {
        $this
            ->setName('cache:clear')
            ->setDescription('cache directory clearing command')
        ;
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $finder = new Finder();
        $fs = new Filesystem();
        
        $files = $finder->in($this->cacheDir);
        $fs->remove($files);
        $output->writeln('Cache directory <info>'.$this->cacheDir.'</info> cleared.');
    }
}
