<?php

namespace CSanquer\Silex\Tools;

use Symfony\Component\Console\Application as BaseApplication;

class Application extends BaseApplication
{
    /**
     *
     * @var \Silex\Application
     */
    protected $silexApplication;

    protected $rootDir;
    
    protected $appDir;
    
    protected $configDir;
    
    protected $webDir;
    
    protected $cacheDir;
    
    protected $logsDir;
    
    protected $binDir;
    
    protected $translationDir;

    /**
     * 
     * @param \Silex\Application $application
     * @param string $rootDir
     * @param string $name
     * @param string $version
     * @param string $appDir
     * @param string $configDir
     * @param string $webDir
     * @param string $cacheDir
     * @param string $logsDir
     * @param string $binDir
     * @param string $translationDir
     */
    public function __construct(
        $application,
        $rootDir, 
        $name = 'UNKNOWN', 
        $version = 'UNKNOWN',
        $appDir = '',
        $configDir = 'config', 
        $webDir = 'web', 
        $cacheDir = 'cache', 
        $logsDir = 'logs', 
        $binDir = 'bin', 
        $translationDir = 'translation'
    )
    {
        $this->setSilexApplication($application);
        $this->rootDir = realpath($rootDir);
        $this->appDir = $appDir;
        $this->configDir = $configDir;
        $this->webDir = $webDir;
        $this->cacheDir = $cacheDir;
        $this->logsDir = $logsDir;
        $this->binDir = $binDir;
        $this->translationDir = $translationDir;
        parent::__construct($name, $version);
    }
    
    /**
     * 
     * @return \Silex\Application
     */
    public function getSilexApplication()
    {
        return $this->silexApplication;
    }

    /**
     * 
     * @param \Silex\Application $application
     * @return Application
     */
    public function setSilexApplication(\Silex\Application $application)
    {
        $this->silexApplication = $application;
        return $this;
    }

    public function getRootDir()
    {
        return $this->rootDir;
    }

    public function getAppDir()
    {
        return $this->getRootDir().( $this->appDir ? DS.$this->appDir : '');
    }

    public function getConfigDir()
    {
        return $this->getAppDir().DS.$this->configDir;
    }

    public function getWebDir()
    {
        return $this->getRootDir().DS.$this->webDir;
    }

    public function getCacheDir()
    {
        return $this->getAppDir().DS.$this->cacheDir;
    }

    public function getLogsDir()
    {
        return $this->getAppDir().DS.$this->logsDir;
    }

    public function getBinDir()
    {
        return $this->getRootDir().DS.$this->binDir;
    }

    public function getTranslationDir()
    {
        return $this->getAppDir().DS.$this->translationDir;
    }
}