<?php
    // Sets the value of a configuration option
    // string ini_set ( string $varname , string $newvalue )
    ini_set('default_charset','UTF-8');
    //ini_set('display_errors', 1);
   //error_reporting( E_ALL );
    
    // Send a raw HTTP header
    header ('Content-Type: text/html; charset=UTF-8');
    
    $date = date("Y");
    define('GA_TAG', '');
    define('dbperfix','');
    define('date',$date);

    define('TimeZone', 'UTC');
    define('Format', "d/m/y - H:i");
    $dateTime = new DateTime('now', new DateTimeZone(TimeZone));
    $dateForm = $dateTime->format(Format);
    
    //start session
    session_name('PINNOCENT');
    session_start();
    ob_start();
    
    if (!defined('DS')) {
        define('DS', DIRECTORY_SEPARATOR);
    }
    
    //define paths
    define('ROOT', dirname(__DIR__));
    define('CONFIG', ROOT . DS . 'config' . DS);
    define('APPS', ROOT . DS . 'apps' . DS);
    define('LOGS', ROOT . DS . 'logs' . DS);
    define('MODELS', ROOT . DS . 'config' . DS . 'models' . DS);
    define('CONNECT', ROOT . DS . 'config' . DS . 'connection' . DS);
    define('LOCALE', ROOT . DS . 'locale' . DS);
    define('MAILER', ROOT . DS . 'apps' . DS . 'Mailer' . DS);
    define('GEO', ROOT . DS . 'apps' . DS . 'Geo' . DS);
    define('QR', ROOT . DS . 'apps' . DS . 'Qrcode' . DS . 'php' . DS);
    define('PUBLIC_ROOT', ROOT . DS . 'public' . DS);
    

    if (!file_exists(dirname(__DIR__).'/config/app.php')){
      require_once (dirname(__DIR__).'/config/models/configModel.php');
    }else{
      require_once (dirname(__DIR__).'/config/app.php');
      require_once (dirname(__DIR__).'/config/config.php');
    }

    //CONNECTION
    if(file_exists(CONNECT.'system.class.php')){
        require CONNECT.'dbconnect.class.php';
        require_once (MODELS.'queryModel.php');
    }
    if($info->install == 'off'){
        
    //REQUIRED FILES
    require "functions.php";
    require LOCALE.do_config(13).'/meta.php';
    require LOCALE.do_config(13).'/labels.php';
    require LOCALE.do_config(13).'/messages.php';
    define('perpge',pages());

    if(isset($_SESSION['user']['logged'])) {
        define('logged', $_SESSION['user']['logged']);
        define('uid', $_SESSION['user']['uid']);
        $host = isset($_SERVER['host']) ? $_SERVER['host'] : '';
        
        // Fetch user information - prioritize session data if available
        if(isset($_SESSION['user']['account'])) {
            $member = $_SESSION['user']['account'];
        } else {
            // Fallback to database query if session data is not available
            $member = $query->addquery('select', 'admin', '*', 'i', uid, 'user_id=?');
            // Store in session for future use
            $_SESSION['user']['account'] = $member;
        }

          //staff permessions
       if(endsWith($_SERVER['REQUEST_URI'],'admin/users') && $member->admin == 2){
           echo 'ERROR: THIS PAGE PROTECTED.';
           exit;
       }
       if(endsWith($_SERVER['REQUEST_URI'],'admin/add-user') && $member->admin == 2){
           echo 'ERROR: THIS PAGE PROTECTED.';
           exit;
       }
       if(endsWith($_SERVER['REQUEST_URI'],'admin/top-earning') && $member->admin == 2){
           echo 'ERROR: THIS PAGE PROTECTED.';
           exit;
       }
       if(endsWith($_SERVER['REQUEST_URI'],'admin/top-referrers') && $member->admin == 2){
           echo 'ERROR: THIS PAGE PROTECTED.';
           exit;
       }
       if(endsWith($_SERVER['REQUEST_URI'],'admin/services') && $member->services == 2){
           echo 'ERROR: THIS PAGE PROTECTED.';
           exit;
       }
       if(endsWith($_SERVER['REQUEST_URI'],'admin/verifications') && $member->verifications == 2){
           echo 'ERROR: THIS PAGE PROTECTED.';
           exit;
       }
       if(endsWith($_SERVER['REQUEST_URI'],'admin/websites') && $member->websites == 2){
           echo 'ERROR: THIS PAGE PROTECTED.';
           exit;
       }
       if(endsWith($_SERVER['REQUEST_URI'],'admin/campaigns') && $member->campaigns == 2){
           echo 'ERROR: THIS PAGE PROTECTED.';
           exit;
       }
       if(endsWith($_SERVER['REQUEST_URI'],'admin/links') && $member->links == 2){
           echo 'ERROR: THIS PAGE PROTECTED.';
           exit;
       }
       if(endsWith($_SERVER['REQUEST_URI'],'admin/statements') && $member->statements == 2){
           echo 'ERROR: THIS PAGE PROTECTED.';
           exit;
       }
       if(endsWith($_SERVER['REQUEST_URI'],'admin/invoices') && $member->invoices == 2){
           echo 'ERROR: THIS PAGE PROTECTED.';
           exit;
       }
       if(endsWith($_SERVER['REQUEST_URI'],'admin/withdrawals') && $member->withdrawals == 2){
           echo 'ERROR: THIS PAGE PROTECTED.';
           exit;
       }
       if(endsWith($_SERVER['REQUEST_URI'],'admin/settings') && $member->settings == 2){
           echo 'ERROR: THIS PAGE PROTECTED.';
           exit;
       }
    }else{
        define('logged',false);
    }
    
    $pages = $query->normal("select * from ".dbperfix."pages WHERE status='1' and protect='2' ORDER BY id asc  LIMIT 0,8");
    $announcements = $query->normal("select * from ".dbperfix."announcements WHERE status='1' ORDER BY RAND() LIMIT 1");
    }else{
       //REQUIRED FILES
       require_once "functions.php";
       //install
       do_install();
    }
?>
