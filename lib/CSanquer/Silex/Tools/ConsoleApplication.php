<?php

namespace CSanquer\Silex\Tools;

use \Silex\Application;
use \Symfony\Component\Console\Application as BaseApplication;
use Symfony\Component\Console\Input\InputOption;

class ConsoleApplication extends BaseApplication
{
    /**
     *
     * @var Application
     */
    protected $silex;

    /**
     *
     * @param Application $silex    Silex application
     * @param string      $name           default = 'UNKNOWN'
     * @param string      $version        $name default = 'UNKNOWN'
     */
    public function __construct(
        $silex,
        $name = 'UNKNOWN',
        $version = 'UNKNOWN'
    )
    {
        $this->setSilex($silex);
        parent::__construct($name, $version);
        
        $this->getDefinition()->addOption(new InputOption('--env', '-e', InputOption::VALUE_REQUIRED, 'The Environment name.', 'dev'));
        $this->getDefinition()->addOption(new InputOption('--no-debug', null, InputOption::VALUE_NONE, 'disabling debug'));
    }

    /**
     *
     * @return Application
     * @deprecated since v0.4
     */
    public function getSilexApplication()
    {
        return $this->getSilex();
    }

    /**
     *
     * @param  Application $application
     * @return ConsoleApplication
     * @deprecated since v0.4
     */
    public function setSilexApplication(Application $application)
    {
        return $this->setSilex($application);
    }
    
    /**
     *
     * @return Application
     */
    public function getSilex()
    {
        return $this->silex;
    }
    
    /**
     *
     * @param  Application $silex
     * @return ConsoleApplication
     */
    public function setSilex(Application $silex)
    {
        $this->silex = $silex;

        return $this;
    }

    /**
     * 
     * @param string $name
     * @return mixed
     */
    public function getSilexService($name)
    {
        return isset($this->silex[$name]) ? $this->silex[$name] : null;
    }
    
    /**
     * 
     * @return string
     */
    public function getRootDir()
    {
        return $this->getSilexService('root_dir');
    }

    /**
     * 
     * @return string
     */
    public function getAppDir()
    {
        return $this->getSilexService('app_dir');
    }

    /**
     * 
     * @return string
     */
    public function getVarDir()
    {
        return $this->getSilexService('var_dir');
    }

    /**
     * 
     * @return string
     */
    public function getConfigDir()
    {
        return $this->getSilexService('config_dir');
    }

    /**
     * 
     * @return string
     */
    public function getTranslationsDir()
    {
        return $this->getSilexService('translations_dir');
    }

    /**
     * 
     * @return string
     */
    public function getWebDir()
    {
        return $this->getSilexService('web_dir');
    }

    /**
     * 
     * @return string
     */
    public function getBinDir()
    {
        return $this->getSilexService('bin_dir');
    }

    /**
     * 
     * @return string
     */
    public function getCacheDir()
    {
        return $this->getSilexService('cache_dir');
    }

    /**
     * 
     * @return string
     */
    public function getLogDir()
    {
        return $this->getSilexService('log_dir');
    }
}
