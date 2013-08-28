<?php
namespace CeptGallery;

use Zend\ModuleManager\Feature\ConsoleBannerProviderInterface;
use \Zend\ModuleManager\Feature\ConsoleUsageProviderInterface;
use Zend\Console\Adapter\AdapterInterface as Console;

class Module implements ConsoleBannerProviderInterface, ConsoleUsageProviderInterface
{

    public function getConfig()
    {
        return include __DIR__ . '/config/module.config.php';

    }

    public function getAutoloaderConfig()
    {
        return [
            'Zend\Loader\StandardAutoloader' => array(
                'namespaces' => array(
                    __NAMESPACE__ => __DIR__ . '/src/' . __NAMESPACE__,
                ),
            ),
        ];
    }

    public function getConsoleBanner(Console $console)
    {
        return
                "==------------------------------------------------------==\n" .
                "        Welcome to my Gallery app             \n" .
                "==------------------------------------------------------==\n" .
                "Version 0.0.1\n"
        ;

    }

    public function getConsoleUsage(Console $console)
    {
        return [
            'indexer <path>' => 'Index gallery',
        ];
    }
}
