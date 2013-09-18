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
    
    protected $varDir;
    
    protected $configDir;
    
    protected $webDir;
    
    protected $cacheDir;
    
    protected $logsDir;
    
    protected $binDir;
    
    protected $translationDir;

    /**
     * 
     * @param \Silex\Application $application Silex application
     * @param string $rootDir project directory path
     * @param string $name default = 'UNKNOWN'
     * @param string $version $name default = 'UNKNOWN'
     * @param string $appDir $name default = '' directory in root directory that contain config , translation, views, php silex bootstrap files
     * @param string $varDir $name default = 'var' directory in root directory that contain cache and logs
     * @param string $configDir default = 'config' configuration directory name in app directory
     * @param string $webDir default = 'web' web document root directory name in root directory
     * @param string $cacheDir default = 'cache' cache directory name
     * @param string $logsDir default = 'logs' cache directory name
     * @param string $binDir default = 'bin' binaries directory name in root directory
     * @param string $translationDir = default = 'translation' translation directory name in app directory
     */
    public function __construct(
        $application,
        $rootDir, 
        $name = 'UNKNOWN', 
        $version = 'UNKNOWN',
        $appDir = '',
        $varDir = 'var',
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
        $this->varDir = $varDir;
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

    public function getVarDir()
    {
        return $this->getRootDir().( $this->varDir ? DS.$this->varDir : '');
    }
    
    public function getConfigDir()
    {
        return $this->getAppDir().DS.$this->configDir;
    }

    public function getTranslationDir()
    {
        return $this->getAppDir().DS.$this->translationDir;
    }
    
    public function getWebDir()
    {
        return $this->getRootDir().DS.$this->webDir;
    }

    public function getBinDir()
    {
        return $this->getRootDir().DS.$this->binDir;
    }
    
    public function getCacheDir()
    {
        return $this->getVarDir().DS.$this->cacheDir;
    }

    public function getLogsDir()
    {
        return $this->getVarDir().DS.$this->logsDir;
    }
}