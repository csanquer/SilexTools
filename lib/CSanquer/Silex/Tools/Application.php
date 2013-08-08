<?php

namespace CSanquer\Silex\Tools;

use Symfony\Component\Console\Application as BaseApplication;

class Application extends BaseApplication
{
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
    
    public function getRootDir()
    {
        return $this->rootDir;
    }

    public function getAppDir()
    {
        return $this->getRootDir().DS.$this->appDir;
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