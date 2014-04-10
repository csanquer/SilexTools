<?php

namespace CSanquer\Silex\Tools\Provider;

use Silex\Application;
use Silex\ServiceProviderInterface;
use Symfony\Component\Debug\DebugClassLoader;
use Symfony\Component\Debug\ErrorHandler;
use Symfony\Component\Debug\ExceptionHandler;
use Symfony\Component\Filesystem\Filesystem;

// get environment constants or set default
if (!defined('DS')) {
    define('DS', DIRECTORY_SEPARATOR);
}

if (!defined('SILEX_ENV')) {
    define('SILEX_ENV', 'dev');
}

if (!defined('SILEX_DEBUG')) {
    define('SILEX_DEBUG', true);
}

if (!defined('UMASK')) {
    define('UMASK', 0002);
}

//Debugging
if (SILEX_DEBUG) {
    error_reporting(-1);
//    error_reporting(E_ALL & E_STRICT);
    DebugClassLoader::enable();
    ErrorHandler::register();
    if ('cli' !== php_sapi_name()) {
        ExceptionHandler::register();
    }
} else {
    ini_set('display_errors', 0);
}

/**
 * SkeletonProvider provide the following services and variables
 * 
 * <ul>
 *   <li>umask</li>
 *   <li>file_mode</li>
 *   <li>debug</li>
 *   <li>env</li>
 *   <li>app_dir</li>
 *   <li>root_dir</li>
 *   <li>var_dir</li>
 *   <li>config_dir</li>
 *   <li>translations_dir</li>
 *   <li>web_dir</li>
 *   <li>bin_dir</li>
 *   <li>cache_dir</li>
 *   <li>log_dir</li>
 * </ul>
 * 
 * you could register the provider with the following variables :
 * 
 * ex. :
 * 
 * <pre><code>
 * array(
 *   'app_dir' => __DIR__, // project app_dir
 *   'umask' => 0002, //base umask
 *   'env' => 'dev',
 *   'debug' => true,
 *   'cached_dirs' => array(), // relative path form cache_dir of some cache subdirectories
 * )
 * </code></pre>
 *
 * @author Charles Sanquer <charles.sanquer@gmail.com>
 */
class SkeletonProvider implements ServiceProviderInterface
{

    public function register(Application $app)
    {
        // define default file write mode
        if (!isset($app['umask'])) {
            $app['umask'] = UMASK;
        }
        $app['file_mode'] = 0777 - $app['umask'];
        umask($app['umask']);

        // define environment variables
        if (!isset($app['debug'])) {
            $app['debug'] = (bool) SILEX_DEBUG;
        }
        
        if (!isset($app['env'])) {
            $app['env'] = SILEX_ENV;
        }

        // define main paths
        if (!isset($app['app_dir'])) {
            $app['app_dir'] = __DIR__.'/../../../../../../../../app';
        }
        
        $app['app_dir'] = realpath($app['app_dir']);
        $app['root_dir'] = realpath($app['app_dir'].DS.'..');
        
        $app['var_dir'] = $app['root_dir'].DS.'var';
        $app['config_dir'] = $app['app_dir'].DS.'config';
        $app['translations_dir'] = $app['app_dir'].DS.'translations';
        $app['web_dir'] = $app['root_dir'].DS.'web';
        $app['bin_dir'] = $app['root_dir'].DS.'bin';
        $app['log_dir'] = $app['var_dir'].DS.'logs';
        $app['cache_dir'] = $app['var_dir'].DS.'cache';
        
        $app['cached_dirs'] = array_merge([
            'config',
            'http',
            'twig',
            'profiler',
            'assetic'.DS.'formulae',
            'assetic'.DS.'twig',
        ], isset($app['cached_dirs']) ? (array) $app['cached_dirs'] : []);
        
        //create cache and logs directories
        $cacheDirectories = array(
            $app['log_dir'],
            $app['cache_dir'],
        );
        
        foreach ($app['cached_dirs'] as $dir ) {
            $cacheDirectories[] = $app['cache_dir'].DS.$dir;
        }

        unset($app['cached_dirs']);
        
        $fs = new Filesystem();
        
        if (!$fs->exists($cacheDirectories)) {
            $fs->mkdir($cacheDirectories, $app['file_mode']);
        }

        foreach ($cacheDirectories as $dir) {
            $fs->chmod($dir, $app['file_mode']);
        }
    }

    public function boot(Application $app)
    {
        
    }
}
