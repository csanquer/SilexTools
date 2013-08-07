<?php

namespace CSanquer\Silex\Tools;

use Symfony\Component\Console\Application as BaseApplication;

class Application extends BaseApplication
{
    protected $projectDir;

    public function __construct($name = 'UNKNOWN', $version = 'UNKNOWN', $projectRootDir = null)
    {
        parent::__construct($name, $version);
        $this->projectDir = realpath($projectRootDir);
    }

    public function getProjectDir()
    {
        return $this->projectDir;
    }

    public function getBinDir()
    {
        return $this->projectDir.DS.'bin';
    }
    
    public function getAppDir()
    {
        return $this->projectDir.DS.'app';
    }
    
    public function getConfigDir()
    {
        return $this->getAppDir().DS.'config';
    }
    
    public function getWebDir()
    {
        return $this->projectDir.DS.'web';
    }
}