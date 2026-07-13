
<?php
 // DATABASE CONNECTION
class SystemComponent{

private $settings;

function getSetting(){
	
$settings['dbusername']='root';

$settings['dbpassword']=''; 

$settings['dbname']='pinnocent';

$settings['dbhost']='localhost';

return $settings;

	}

}
