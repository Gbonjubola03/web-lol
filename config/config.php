<?php
    // Prevent multiple inclusions
    if (defined('CONFIG_LOADED')) {
        return;
    }
    define('CONFIG_LOADED', true);

    if (!defined('DS')) {
        define('DS', DIRECTORY_SEPARATOR);
    }
   
    //DEFINE
    if (!defined('APP')) define('APP', 'PINNOCENT');
    
    $date = date("Y");
    
    if (!defined('GA_TAG')) define('GA_TAG', '');
    if (!defined('dbperfix')) define('dbperfix', '');
    if (!defined('date')) define('date', $date);
    if (!defined('TimeZone')) define('TimeZone', 'UTC');
    if (!defined('Format')) define('Format', "d/m/y - H:i");
    
    $dateTime = new DateTime('now', new DateTimeZone(TimeZone));
    $dateForm = $dateTime->format(Format);
   
    //DEFINE PATHS
    if (!defined('ROOT')) define('ROOT', dirname(__DIR__));
    if (!defined('CONFIG')) define('CONFIG', ROOT . DS . 'config' . DS);
    if (!defined('APPS')) define('APPS', ROOT . DS . 'apps' . DS);
    if (!defined('LOGS')) define('LOGS', ROOT . DS . 'logs' . DS);
    if (!defined('FCP')) define('FCP', ROOT . DS . 'apps' . DS . 'Fcp' . DS);
    if (!defined('MODELS')) define('MODELS', ROOT . DS . 'config' . DS . 'models' . DS);
    if (!defined('CONNECT')) define('CONNECT', ROOT . DS . 'config' . DS . 'connection' . DS);
    if (!defined('LOCALE')) define('LOCALE', ROOT . DS . 'locale' . DS);
    if (!defined('MAILER')) define('MAILER', ROOT . DS . 'apps' . DS . 'Mailer' . DS);
    if (!defined('CBS')) define('CBS', ROOT . DS . 'apps' . DS . 'Cbs' . DS);
    if (!defined('PUBLIC_ROOT')) define('PUBLIC_ROOT', ROOT . DS . 'public' . DS);
   
    //INSTALLTION URLS
    if (!defined('HOST')) {
        define('HOST', isset($_SERVER['HTTP_HOST']) ? $_SERVER['HTTP_HOST'] : '');
    }
    
    if (!defined('REFERER')) {
        define('REFERER', isset($_SERVER['HTTP_REFERER']) ? $_SERVER['HTTP_REFERER'] : '');
    }
    
    if (!defined('FULLACCESS')) {
        define('FULLACCESS', isset($_SERVER['HTTP_HOST']) && isset($_SERVER['REQUEST_URI']) ? 
            $_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'] : '');
    }
    
    if (!defined('ACCESS')) {
        define('ACCESS', isset($_SERVER['REQUEST_URI']) ? $_SERVER['REQUEST_URI'] : '');
    }
    
    if (!defined('FILE')) {
        define('FILE', isset($_SERVER['SCRIPT_FILENAME']) ? basename(basename($_SERVER['SCRIPT_FILENAME'])) : '');
    }
    
    if (!defined('INSTALL_FILE')) define('INSTALL_FILE', DS.'installer'.DS.'index');
    if (!defined('DATABASE_FILE')) define('DATABASE_FILE', DS.'installer'.DS.'database');
    if (!defined('BUILD_FILE')) define('BUILD_FILE', DS.'installer'.DS.'build');
    if (!defined('ADMIN_FILE')) define('ADMIN_FILE', DS.'installer'.DS.'admin');
?>
