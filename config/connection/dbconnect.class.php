<?php

  require_once ('system.class.php');

 /*
 |--------------------------------------------------------------------------
 | Dbh Class
 |--------------------------------------------------------------------------
 |
 | Here we get the connection to your database and use it for our query
 | For all our queries you can see queryModel.php in Models section
 |
 */
 
 class Dbh extends SystemComponent{
     
    private $servername;
    private $username;
    private $password;
    private $dbname;
    var $dbperfix;

    protected function connect(){
    $this->settings=parent::getSetting();
    $this->servername = $this->settings['dbhost'];
    $this->username = $this->settings['dbusername'];
    $this->password = $this->settings['dbpassword'];
    $this->dbname = $this->settings['dbname'];
    $this->dbperfix = 'cm_';

    if (!function_exists('mysqli_init') && !extension_loaded('mysqli')) {
        echo 'PLEASE ACTIVATE MYSQLI EXTENSION';
        exit;
    }

    // Set a maximum number of retry attempts
    $maxRetries = 3;
    $retryCount = 0;
    $conn = null;

    while ($retryCount < $maxRetries) {
        try {
            $conn = new \MySQLi($this->servername, $this->username, $this->password, $this->dbname);
            
            if (!$conn->connect_errno) {
                $conn->set_charset('utf8mb4');
                return $conn;
            }
            
            // If connection failed, wait before retrying
            sleep(1);
            $retryCount++;
        } catch (\Exception $e) {
            // Wait before retrying
            sleep(1);
            $retryCount++;
        }
    }

    // If we get here, all retries failed
    die('Unable to connect to database [' . ($conn ? $conn->connect_error : 'Maximum retry attempts reached') . ']');
      }

  }