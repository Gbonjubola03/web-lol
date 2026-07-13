<?php
    if (!defined('DS')) {
        define('DS', DIRECTORY_SEPARATOR);
    }
    
    //DEFINE
    define('APP','PINNOCENT');
    $date = date("Y");
    define('GA_TAG', '');
    define('dbperfix','cm_');
    define('date',$date);
    define('HOST','');
    define('TimeZone', 'UTC');
    define('Format', "d/m/y - H:i");
    $dateTime = new DateTime('now', new DateTimeZone(TimeZone));
    $dateForm = $dateTime->format(Format);
    
    //DEFINE PATHS
    define('ROOT', dirname(__DIR__));
    define('CONFIG', ROOT . DS . 'config' . DS);
    define('APPS', ROOT . DS . 'apps' . DS);
    define('LOGS', ROOT . DS . 'logs' . DS);
    define('PPL', ROOT . DS . 'apps' . DS . 'Ppl' . DS);
    define('MODELS', ROOT . DS . 'config' . DS . 'models' . DS);
    define('CONNECT', ROOT . DS . 'config' . DS . 'connection' . DS);
    define('LOCALE', ROOT . DS . 'locale' . DS);
    define('MAILER', ROOT . DS . 'apps' . DS . 'Mailer' . DS);
    define('CBS', ROOT . DS . 'apps' . DS . 'Cbs' . DS);
    define('PUBLIC_ROOT', ROOT . DS . 'public' . DS);

    //INSTALLTION URLS
    define('REFERER',$_SERVER['HTTP_REFERER']);
    define('FULLACCESS',$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI']);
    define('ACCESS',$_SERVER['REQUEST_URI']);
    define('FILE',basename(basename($_SERVER['SCRIPT_FILENAME'])));
    define('INSTALL_FILE',DS.'installer'.DS.'index');
    define('DATABASE_FILE',DS.'installer'.DS.'database');
    define('BUILD_FILE',DS.'installer'.DS.'build');
    define('ADMIN_FILE',DS.'installer'.DS.'admin');

    //LOAD FILES
    require_once (MODELS.'dataModel.php');

    //APP INFORMATION
    $info = (object)
        [
        'install'=> 'off',
        'app'=> 'PINNOCENT',

         ];