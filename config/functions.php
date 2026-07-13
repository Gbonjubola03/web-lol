<?php

if (defined('FUNCTIONS_LOADED')) {
    return;
}
define('FUNCTIONS_LOADED', true);

?>

<?php

function do_install(){
    // Check if we're already on an installer page to prevent redirect loops
    if(strpos(ACCESS, '/installer/') === false && 
       !endsWith(ACCESS, INSTALL_FILE) && 
       !endsWith(ACCESS, DATABASE_FILE) && 
       !endsWith(ACCESS, BUILD_FILE) && 
       !endsWith(ACCESS, ADMIN_FILE)):
        
        header('location: installer/index');
        exit; // Add exit to stop execution after redirect
    
    endif;
}

 function get_time_ago( $time ){
    $time_difference = time() - $time;
    if( $time_difference < 1 ) { return 'less than 1 second ago'; }
    $condition = array( 12 * 30 * 24 * 60 * 60 =>  'year',
                30 * 24 * 60 * 60       =>  'month',
                24 * 60 * 60            =>  'day',
                60 * 60                 =>  'hour',
                60                      =>  'minute',
                1                       =>  'second'
    );
    foreach( $condition as $secs => $str ){
        $d = $time_difference / $secs;
        if( $d >= 1 ){
            $t = round( $d );
            return $t . ' ' . $str . ( $t > 1 ? 's' : '' ) . ' ago';
        }
    }
 }
 function do_winfo($t,$d=false,$k=false,$s=false){
     
     if(array_key_exists($t,metas())){
         define('SITE_TITLE',metas()[$t]);
     }else{
         define('SITE_TITLE',$t);
     }
     // Line 45 (approximately)
if (!defined('CANONICAL')) {
    define('CANONICAL', (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http") . "://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]");
}

     if(isset($d)){
         define('SITE_DESCR',$d);
         define('KEYW',$k);
     }
}
 function do_limit_text($text, $limit) {
   //short text
      if (str_word_count($text, 0) > $limit) {
          $words = str_word_count($text, 2);
          $pos = array_keys($words);
          $text = substr($text, 0, $pos[$limit]) . '***';
      }
      return $text;
}
function pages($perpage = 1000, $screen = 0){
    if (!isset($_GET['p']) || $_GET['p']==0 || !is_numeric($_GET['p'])) {
      // Default to screen 0 if p is not set, zero, or not numeric
    } else {
      $screen = max(0, intval($_GET['p']) - 1);  // Convert to integer and ensure it's not negative
    }
    $start = max(0, $screen * $perpage);  // Ensure start is never negative
    return array('perpage' => $perpage, 'screen' => $screen, 'start' => $start);
 }
 
 
 function paging($page,$last_page,$part,$custom=false){
 $paging = false;
 $l='<li class="page-item">';
 $li='</li>';
 $class="page-link";
 $active='<li class="page-item active">';
 
 if($page != 1){
 $paging.=$l.'<a class="'.$class.'" href="'.$part.($page - 1).'">&lsaquo;</a>'.$li;
 }
 if($page > 4){
 $paging.=$l.'<a class="'.$class.'" href="'.$part.($page-$page+1).'">&laquo;</a>'.$li;
 }
 for($i=4;$i>0;$i--)
 if($page-$i>0){
 $paging.=$l.'<a class="'.$class.'" href="'.$part.($page-$i).'">'.($page-$i).'</a>'.$li;
 }
 if ($page == 0){
 $paging.=$l.'<a class="'.$class.'">&rsaquo;</a>'.$li;
 }
 elseif($page == $last_page){
 $paging.=$active.'<a class="'.$class.'">&lsaquo;</a>'.$li;
 }
 else{
 $paging.=$l.'<a class="'.$class.'">'.$page.'</a>'.$li;
 }
 for($i=1 ; $i<5 ; $i++)
 if($last_page-($page+$i)>0){
 $paging.=$l.'<a class="'.$class.'" href="'.$part.($page+$i).'">'.($page+$i).'</a>'.$li;
 }
 if ($page < $last_page - 5){
 $paging.=$l.'<a class="'.$class.'" href="'.$part.($last_page - 1).'">&raquo;</a>'.$li;
 }
 if ($page != $last_page-1){
 $paging.=$l.'<a class="'.$class.'" href="'.$part.($page + 1).'">&rsaquo;</a>'.$li;
 }
  if($paging){
      return '<ul class="pagination">'.$paging.'</ul>';
  }
 }
 function do_token($num){
     $tk = bin2hex(openssl_random_pseudo_bytes($num));
     return $tk;
 }
 //print message API
 function do_print($msg){
   header('Content-Type: application/json;charset=utf-8');
   echo json_encode($msg);
   exit;
 }
 function reCaptcha($reCAPTCHA_secret_key=false){
 //recaptcha
 if(isset($_POST['g-recaptcha-response'])):
  $info = [
  'secret' => do_config(7),
  'response' => $_POST['g-recaptcha-response']
  ];
  
  $verify = curl_init();
 
  curl_setopt($verify, CURLOPT_URL, "https://www.google.com/recaptcha/api/siteverify");
  curl_setopt($verify, CURLOPT_POST, true);
  curl_setopt($verify, CURLOPT_POSTFIELDS, http_build_query($info));
  curl_setopt($verify, CURLOPT_SSL_VERIFYPEER, false);
  curl_setopt($verify, CURLOPT_RETURNTRANSFER, true);
  $response = curl_exec($verify);
  $data = json_decode($response);

  if(isset($data->success) && $data->success == true){
    return true;
  }elseif($data->error-codes || $data->challenge_ts || $data->hostname || $data->success == false){
    return false;
  }
 
 endif;
 }
 function csrf_token() {

		if(isset($_SESSION['csrfToken'])) 
			return $_SESSION['csrfToken']; 
		else{
			$token = bin2hex(openssl_random_pseudo_bytes(32));
			$_SESSION['csrfToken'] = $token;
			return $token;
		}
 }
 function alerts($session,$alert){
  //alerts
  if(isset($_SESSION[$session][$alert])){
   define($alert,true);
   unset($_SESSION[$session]);
  }else{
   define($alert,false);
   }
  }
 function do_btitle($string){

 $rep = str_replace('-','',strtolower($string));
 $rep = str_replace('  ','-',$rep);
 $rep = str_replace('   ','-',$rep);
 $rep = str_replace(' ','-',$rep);
 $rep = str_replace('_','-',$rep);
 $rep = str_replace('>','',$rep);
 $rep = str_replace('<','',$rep);
 $rep = str_replace('|','',$rep);
 $rep = str_replace(',','',$rep);
 return $rep;
 }
 function do_buildtags($tags){
     $arr = explode(",",$tags);
     $count = count($arr) - 1;
     $array = array();
     for($i=0; $i < count($arr); $i++):
         $build = '<a href="#"><span class="badge badge-secondary">'.$arr[$i].'</span></a>&nbsp;';
         array_push($array, $build);
         endfor;
         return implode('', $array);
 }
 function do_config($id){
    global $query;
    $option = $query->addquery('select','config','value','i', $id,'config_id=?');
    // Add a check before accessing the value property
    return (is_object($option) && property_exists($option, 'value')) ? $option->value : null;
}
 function do_uinfo($id){
     global $query;
     //var_export($id);exit;
     $user = $query->addquery('select','users','username','i', $id,'user_id=?');
     return $user->username;
 }
 function do_catparent($id){
     global $query;
     $cat = $query->addquery('select','categories','name','i', $id,'id=?');
     return $cat->name;
 }
 function do_catinfo($id,$col){
     global $query;
     $cat = $query->addquery('select','categories',$col,'i', $id,'id=?');
     return $cat->$col;
 }
 function do_iteminfo($id,$col){
     global $query;
     //fetch item
     $data = $query->addquery('select','linkS',$col,'i',$id,'id=?');
     return $data->$col;
 }
 function get_ip() {
 // Get client IP address
    if (getenv("HTTP_CF_CONNECTING_IP")) {
        $ip = getenv("HTTP_CF_CONNECTING_IP");
    } elseif (getenv("HTTP_CLIENT_IP")) {
        $ip = getenv("HTTP_CLIENT_IP");
    } elseif (getenv("HTTP_X_FORWARDED_FOR")) {
        $ip = getenv("HTTP_X_FORWARDED_FOR");
        if (strstr($ip, ',')) {
            $tmp = explode(',', $ip);
            $ip = trim($tmp[0]);
        }
    } else {
        $ip = getenv("REMOTE_ADDR");
    }

    return $ip;
 }
 function ip_visitor_country(){
    require_once(GEO.'geoiploc.php');
    // type can be "code" (default), "abbr", "name"
    $countryCode = getCountryFromIP(get_ip(), "code");
    
    // full name of country - spaces are trimmed
    $countryName = getCountryFromIP(get_ip(), " NamE ");
    return (object) ["code" => $countryCode,"name" => $countryName];
 }
 function detectDevice($deviceName = false){
    //detect device
	$userAgent = $_SERVER["HTTP_USER_AGENT"];
	$devicesTypes = array(
        "PC" => array("msie 10", "msie 9", "msie 8", "windows.*firefox", "windows.*chrome", "x11.*chrome", "x11.*firefox", "macintosh.*chrome", "macintosh.*firefox", "opera"),
        "MOBILE" => array("mobile ", "android.*mobile", "iphone", "ipod", "opera mobi", "opera mini","tablet", "android", "ipad", "tablet.*firefox"),
        "BOT" => array("googlebot", "mediapartners-google", "adsbot-google", "duckduckbot", "msnbot", "bingbot", "ask", "facebook", "yahoo", "addthis")

    );
 	foreach($devicesTypes as $deviceType => $devices) {           
        foreach($devices as $device) {
            if(preg_match("/" . $device . "/i", $userAgent)) {
                $deviceName = $deviceType;
            }
        }
    }
    return ucfirst($deviceName);
 }
 function btc_to_satoshi($a){
   return str_replace('.0','',($a)*(pow(10, 8)));
 }
 function satoshi_to_btc($a){
   return number_format(($a)*(pow(10, -8)), 8, '.', '');
 }
 function get_percentage($amount,$percent) {
    $total = do_amount($amount,false);
    $tax = do_amount(($percent / 100) * $total, false);
    return $tax;
 }
 function do_amount($a,$r=true){
      if($r) {
         if(do_config(19) == 'before') {
          return do_config(4).number_format($a, do_config(20), '.', '');
         }elseif(do_config(19) == 'after') {
          return number_format($a, do_config(20), '.', '').do_config(4);
         }
      } else {
          return number_format($a, do_config(20), '.', '');
      }  
 }
 //admin
  function fetch_users(){
      
      $url = do_config(127) . '?';
      $info = [
          'users' => true,
          'role' => 'admin',
          'api' => do_config(21)
      ];
      $msg = http_build_query($info);
      $url .= $msg;
      $ch = curl_init();
      curl_setopt($ch, CURLOPT_URL, $url);
     // curl_setopt($ch, CURLOPT_POST, true);
      //curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($info));
      //curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
      curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
      $response = curl_exec($ch);
    // Debugging output to check the raw response
    error_log("API Response: " . $response);
      $data = json_decode($response);
         //var_export($data->message);
         //exit;
      if($data->status == 'success'){
            $_SESSION['admin']['users'] = $data->message;
            return $data->message;
      }elseif($data->status == 'error'){
            return '<div class="alert alert-danger">'.$data->message.'</div>';
      }
  }



 function fetch_links(){
    $url = do_config(127) . '?';
    $info = [
        'links' => true,
        'p' => isset($_GET['p']) ? $_GET['p'] : 0,  // Check if 'p' exists before using it
        'api' => do_config(21)
    ];
    $msg = http_build_query($info);
    $url .= $msg;
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    $response = curl_exec($ch);
    $data = $response;
    if($data){
        $_SESSION['user']['links'] = $data;
        return $data;
    }
}
  function viewlinks($userid){
      
      $url = do_config(127) . '?';
      $info = [
          'viewlinks' => true,
          'user_id' => $userid,
          'api' => do_config(21)
      ];
      $msg = http_build_query($info);
      $url .= $msg;
      $ch = curl_init();
      curl_setopt($ch, CURLOPT_URL, $url);
     // curl_setopt($ch, CURLOPT_POST, true);
      //curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($info));
      //curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
      curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
      $response = curl_exec($ch);
      $data = $response;
      if($data){
          $_SESSION['user']['viewlinks'] = $data;
          return $data;
      }
  }
  function viewwithdrawhistory($userid) {
    // Ensure userid is not empty and is a valid integer
    if (empty($userid) || !is_numeric($userid) || intval($userid) <= 0) {
        return false;
    }
    
    // Convert to integer to ensure it's a valid ID
    $userid = intval($userid);
    
    $url = do_config(127) . '?';
    $info = [
        'viewwithdrawhistory' => 1,
        'user_id' => $userid,
        'api' => do_config(21)
    ];
    
    // Build the query string
    $msg = http_build_query($info);
    $url .= $msg;
    
    // Initialize cURL session
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_TIMEOUT, 30); // Add timeout to prevent hanging
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false); // Skip SSL verification if needed
    
    // Execute cURL request
    $response = curl_exec($ch);
    $http_code = curl_getinfo($ch, CURLINFO_HTTP_CODE);
    
    // Check for cURL errors
    $curl_error = curl_error($ch);
    curl_close($ch);
    
    if (!empty($curl_error)) {
        error_log("cURL Error in viewwithdrawhistory: " . $curl_error);
        return false;
    }
    
    // Check if response is valid and HTTP code is 200 (OK)
    if ($response && $http_code == 200) {
        // Store in session
        $_SESSION['user']['viewwithdrawhistory'] = $response;
        return $response;
    }
    
    // Log error if HTTP code is not 200
    if ($http_code != 200) {
        error_log("API Error in viewwithdrawhistory: HTTP Code $http_code, Response: $response");
    }
    
    return false;
}



  
 
  function viewservice($userid) {
    $url = do_config(127) . '?';
    $info = [
        'viewservice' => true,
        'user_id' => $userid,
        'api' => do_config(21)
    ];
    
    $msg = http_build_query($info);
    $url .= $msg;
    
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_TIMEOUT, 30);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
    
    $response = curl_exec($ch);
    
    if(curl_errno($ch)) {
        error_log("Curl error in viewservice: " . curl_error($ch));
        curl_close($ch);
        return '<div class="alert alert-danger">API Connection Error: ' . curl_error($ch) . '</div>';
    }
    
    curl_close($ch);
    
    if($response) {
        return $response;
    }
    
    return '<div class="alert alert-danger">No response from API</div>';
}



function viewapi($userid) {
    $url = do_config(127) . '?';
    $info = [
        'viewapi' => true,
        'user_id' => $userid,
        'api' => do_config(21)
    ];
    
    $msg = http_build_query($info);
    $url .= $msg;
    
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_TIMEOUT, 30);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
    
    $response = curl_exec($ch);
    
    if(curl_errno($ch)) {
        error_log("Curl error in viewapi: " . curl_error($ch));
        curl_close($ch);
        return '<div class="alert alert-danger">API Connection Error: ' . curl_error($ch) . '</div>';
    }
    
    curl_close($ch);
    
    if($response) {
        return $response;
    }
    
    return '<div class="alert alert-danger">No response from API</div>';
}


function viewpapi($userid) {
    $url = do_config(127) . '?';
    $info = [
        'viewpapi' => true,
        'user_id' => $userid,
        'api' => do_config(21)
    ];
    
    $msg = http_build_query($info);
    $url .= $msg;
    
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_TIMEOUT, 30);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
    
    $response = curl_exec($ch);
    
    if(curl_errno($ch)) {
        error_log("Curl error in viewpapi: " . curl_error($ch));
        curl_close($ch);
        return '<div class="alert alert-danger">API Connection Error: ' . curl_error($ch) . '</div>';
    }
    
    curl_close($ch);
    
    if($response) {
        return $response;
    }
    
    return '<div class="alert alert-danger">No response from API</div>';
}



  function vieworders($userid) {
    $url = do_config(127) . '?';
    $info = [
        'vieworders' => true,
        'user_id' => $userid,
        'api' => do_config(21)
    ];
    $msg = http_build_query($info);
    $url .= $msg;
    
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    $response = curl_exec($ch);
    $data = $response;
    
    if($data) {
        $_SESSION['user']['vieworders'] = $data;
        return $data;
    }
}


function viewservices($userid) {
    $url = do_config(127) . '?';
    $info = [
        'viewservices' => true,
        'user_id' => $userid,
        'api' => do_config(21)
    ];
    $msg = http_build_query($info);
    $url .= $msg;
    
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    $response = curl_exec($ch);
    $data = $response;
    
    if($data) {
        $_SESSION['user']['viewservices'] = $data;
        return $data;
    }
}


function delete($user_id, $id, $api = null) {
    global $query;
    
    // First, check if the service exists and user has permission
    $data = $query->addquery('select', 'products', '*', 'i', $id, 'id=?');
    
    if (!$data) {
        return json_encode(['status' => 'error', 'message' => 'Service not found']);
    }
    
    // Check if user has permission
    if ($user_id && $data[0]['user_id'] != $user_id) {
        return json_encode(['status' => 'error', 'message' => 'You do not have permission to delete this service']);
    }
    
    // Try the API approach first
    $api_success = false;
    
    if ($api === null) {
        $api = do_config(21);
    }
    
    $url = do_config(127) . '?';
    $info = [
        'delete' => true,
        'id' => $id,
        'user_id' => $user_id,
        'api' => $api
    ];
    $msg = http_build_query($info);
    $url .= $msg;
    
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_TIMEOUT, 10); // Shorter timeout
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
    
    $response = curl_exec($ch);
    
    if (!curl_errno($ch) && !empty($response)) {
        // Try to decode the response to check if it's valid JSON
        $decoded = json_decode($response, true);
        if (json_last_error() === JSON_ERROR_NONE) {
            // Valid JSON response from API
            curl_close($ch);
            $_SESSION['user']['delete'] = $response;
            $api_success = true;
            
            // If API call was successful, return the response
            if (isset($decoded['status']) && $decoded['status'] === 'success') {
                return $response;
            }
        }
    }
    
    // Close cURL handle if still open
    if (isset($ch) && is_resource($ch)) {
        curl_close($ch);
    }
    
    // If API call failed or returned an error, fall back to direct database deletion
    if (!$api_success) {
        // Delete the service directly from database
        $result = $query->addquery('delete', 'products', false, 'i', $id, 'id=?');
        
        if ($result === false) {
            return json_encode(['status' => 'error', 'message' => 'Failed to delete service']);
        }
        
        // Return success response
        $success_response = json_encode(['status' => 'success', 'message' => 'Service was deleted successfully']);
        $_SESSION['user']['delete'] = $success_response;
        return $success_response;
    }
    
    // If we got here, something unexpected happened
    return json_encode(['status' => 'error', 'message' => 'An unexpected error occurred']);
}



  function viewcontact($user_id) {
    // API endpoint URL - using the pinnocent API
    $url = do_config(127) . '?';
    
    // API parameters
    $info = [
        'viewcontact' => true,
        'id' => $user_id,
        'api' => do_config(21)
    ];
    
    // Build the query string and append to URL
    $msg = http_build_query($info);
    $url .= $msg;
    
    // Make the API request
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    $response = curl_exec($ch);
    curl_close($ch);
    
    // Store the response in session for potential reuse
    if($response && !empty($response)) {
        $_SESSION['user']['viewcontact'] = $response;
        return $response;
    }
    
    return null;
}

function viewpurchase($order_id, $user_id = null) {
    // API endpoint URL - using the pinnocent API
$url = do_config(127);
    
    // API parameters
    $info = [
        'viewpurchase' => true,
        'id' => $order_id,
        'user_id' => $user_id,
        'api' => do_config(21)
    ];
    
    // Build the query string and append to URL with proper separator
    $msg = http_build_query($info);
    $url .= '?' . $msg;  // Add the '?' separator before query string
    
    // Make the API request
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_FAILONERROR, false); // Don't fail on HTTP error codes
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false); // Skip SSL verification if needed
    curl_setopt($ch, CURLOPT_TIMEOUT, 30); // Set a timeout
    
    $response = curl_exec($ch);
    
    // Check for errors
    if(curl_errno($ch)) {
        error_log('Curl error in viewpurchase(): ' . curl_error($ch) . ' for order ID: ' . $order_id);
        curl_close($ch);
        return json_encode([
            'status' => 'error',
            'message' => 'Connection error: ' . curl_error($ch)
        ]);
    }
    
    // Get HTTP status code
    $http_code = curl_getinfo($ch, CURLINFO_HTTP_CODE);
    curl_close($ch);
    
    if ($http_code >= 400) {
        error_log('HTTP error in viewpurchase(): ' . $http_code . ' for order ID: ' . $order_id);
        return json_encode([
            'status' => 'error',
            'message' => 'API returned error code: ' . $http_code
        ]);
    }
    
    // Check if response is empty
    if(empty($response)) {
        error_log('Empty response in viewpurchase() for order ID: ' . $order_id);
        return json_encode([
            'status' => 'error',
            'message' => 'Empty response from API'
        ]);
    }
    
    // Check if response is already valid JSON
    $json_test = json_decode($response, true);
    if (json_last_error() !== JSON_ERROR_NONE) {
        // Not valid JSON, wrap the HTML response in a JSON structure
        error_log('Non-JSON response received in viewpurchase() for order ID: ' . $order_id);
        $response = json_encode([
            'status' => 'success',
            'html' => $response
        ]);
    }
    
    // Store the response in session for potential reuse
    $_SESSION['user']['viewpurchase'] = $response;
    return $response;
}





function viewserviceid($id, $link) {
    // Get the Pinnocent API URL
    $api_url = do_config(127);
    
    // Build the API request URL for Pinnocent without user_id parameter
    $url = $api_url . '?viewserviceid&api=' . do_config(21) . '&id=' . $id . '&link=' . $link;
    
    // Make the API request to Pinnocent
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
    $response = curl_exec($ch);
    curl_close($ch);
    
    return $response;
}













  function viewheader($user_id) {
    $url = do_config(127) . '?';
    $info = [
        'viewheader' => true,
        'user_id' => $user_id,
        'api' => do_config(21)
    ];
    
    $msg = http_build_query($info);
    $url .= $msg;
    
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    $response = curl_exec($ch);
    
    // Check for cURL errors
    if (curl_errno($ch)) {
        curl_close($ch);
        return '<div class="alert alert-danger">Error: ' . curl_error($ch) . '</div>';
    }
    
    curl_close($ch);
    
    // Check if response is empty
    if (empty($response)) {
        return '<div class="alert alert-warning">No header data returned from API</div>';
    }
    
    // Store the response in session and return it
    if ($response) {
        $_SESSION['user']['header'] = $response;
        return $response;
    }
    
    return false;
}


function fetch_service($serviceid, $servicelink) {
    // Validate inputs
    if (empty($serviceid) || empty($servicelink)) {
        return false;
    }

    $url = do_config(127) . '?';
    $info = [
        'service' => true,
        'serviceid' => $serviceid,
        'servicelink' => $servicelink,
        'api' => do_config(21),
        // Add user_id if available in session
        'user_id' => isset($_SESSION['user']['id']) ? $_SESSION['user']['id'] : null
    ];
    
    $msg = http_build_query($info);
    $url .= $msg;
    
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_TIMEOUT, 30); // Set timeout to 30 seconds
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false); // Skip SSL verification if needed
    curl_setopt($ch, CURLOPT_FAILONERROR, false); // Don't fail on HTTP error codes
    
    $response = curl_exec($ch);
    
    // Check for cURL errors
    if (curl_errno($ch)) {
        $error = curl_error($ch);
        curl_close($ch);
        error_log("cURL Error in fetch_service: " . $error);
        return '<div class="alert alert-danger">Connection error: ' . $error . '</div>';
    }
    
    $http_code = curl_getinfo($ch, CURLINFO_HTTP_CODE);
    curl_close($ch);
    
    // Check for HTTP errors
    if ($http_code >= 400) {
        error_log("HTTP Error in fetch_service: " . $http_code);
        return '<div class="alert alert-danger">API returned error code: ' . $http_code . '</div>';
    }
    
    // Check if response is empty
    if (empty($response)) {
        error_log("Empty response in fetch_service");
        return '<div class="alert alert-danger">Empty response from API</div>';
    }
    
    // Try to decode the JSON response
    $data = json_decode($response);
    
    // Check if JSON decoding failed
    if (json_last_error() !== JSON_ERROR_NONE) {
        error_log("JSON decode error in fetch_service: " . json_last_error_msg());
        return '<div class="alert alert-danger">Invalid response format from API</div>';
    }
    
    // Process the response
    if (isset($data->status) && $data->status === 'success') {
        // Store in session for potential reuse
        $_SESSION['service'][$serviceid] = $data->message;
        return $data->message;
    } elseif (isset($data->status) && $data->status === 'error') {
        return '<div class="alert alert-danger">' . $data->message . '</div>';
    } else {
        return '<div class="alert alert-danger">Unexpected response from API</div>';
    }
}

  function fetch_profile($username,$type){

      $url = do_config(127) . '?';
      $info = [
          $type => true,
          'username' => $username,
          'api' => do_config(21)
      ];
      $msg = http_build_query($info);
      $url .= $msg;
      $ch = curl_init();
      curl_setopt($ch, CURLOPT_URL, $url);
     // curl_setopt($ch, CURLOPT_POST, true);
      //curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($info));
      //curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
      curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
      $response = curl_exec($ch);
      $data = json_decode($response);
      if($data->status == 'success'){
            //$_SESSION['user']['userstats'] = $data->message;
            return $data->message;
      }elseif($data->status == 'error'){
            echo '<div class="alert alert-danger">'.$data->message.'</div>';
            exit;
      }
  }
  function view_victim($userid){
    // Base URL
$url = do_config(127);
    
    // Parameters
    $params = [
        'viewvictim' => true,
        'user_id' => $userid,
        'api' => do_config(21)
    ];
    
    // Append parameters to URL
    $url = $url . '?' . http_build_query($params);
    
    // Initialize cURL
    $ch = curl_init();
    
    // Set cURL options
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
    
    // Execute cURL request
    $response = curl_exec($ch);
    
    // Close cURL
    curl_close($ch);
    
    // Process response
    if($response){
        $_SESSION['user']['viewvictim'] = $response;
        return $response;
    }
    
    return false;
}

  function atm_victim($userid){
      
      $url = do_config(127) . '?';
      $info = [
          'atmvictim' => true,
          'user_id' => $userid,
          'p' => isset($_GET['p']) ? $_GET['p'] : 0,
          'api' => do_config(21)
      ];
      $msg = http_build_query($info);
      $url .= $msg;
      $ch = curl_init();
      curl_setopt($ch, CURLOPT_URL, $url);
     // curl_setopt($ch, CURLOPT_POST, true);
      //curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($info));
      //curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
      curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
      $response = curl_exec($ch);
      $data = $response;
      if($data){
          $_SESSION['user']['atmvictim'] = $data;
          return $data;
      }
  }

function invoice_view($invoice_id) {
    $url = do_config(127) . '?';
    
    $info = [
        'invoice_view' => true,
        'id' => $invoice_id,
        'api' => do_config(21)
    ];
    
    $msg = http_build_query($info);
    $url .= $msg;
    
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    $response = curl_exec($ch);
    curl_close($ch);
    
    if ($response) {
        // Decode the JSON response
        $data = json_decode($response, true);
        
        // Check if the response was successful
        if (isset($data['status']) && $data['status'] === 'success') {
            // Store in session for potential reuse
            $_SESSION['invoice'][$invoice_id] = $data['message'];
            return $data['message'];
        }
    }
    
    return false;
}


function viewproductform($user_id) {
    $url = do_config(127) . '?';
    
    $info = [
        'viewproductform' => true,
        'user_id' => $user_id,
        'api' => do_config(21)
    ];
    
    $msg = http_build_query($info);
    $url .= $msg;
    
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    $response = curl_exec($ch);
    curl_close($ch);
    
    if ($response) {
        // Decode the JSON response
        $data = json_decode($response, true);
        
        // Check if the response was successful
        if (isset($data['status']) && $data['status'] === 'success') {
            // Store in session for potential reuse
            $_SESSION['viewproductform'][$user_id] = $data['message'];
            return $data['message'];
        }
    }
    
    return false;
}


function viewshipment($user_id) {
    if (empty($user_id)) {
        return false;
    }
    
    $url = do_config(127) . '?';
    
    $info = [
        'viewshipment' => true,
        'user_id' => $user_id,
        'api' => do_config(21)
    ];
    
    $msg = http_build_query($info);
    $url .= $msg;
    
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_TIMEOUT, 30); // Add timeout to prevent hanging
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false); // Skip SSL verification if needed
    
    $response = curl_exec($ch);
    
    // Check for cURL errors
    if(curl_errno($ch)) {
        error_log('Curl error in viewshipment(): ' . curl_error($ch));
        curl_close($ch);
        return false;
    }
    
    curl_close($ch);
    
    if ($response) {
        // Try to decode the JSON response
        $data = json_decode($response, true);
        
        // Check if JSON decoding failed
        if (json_last_error() !== JSON_ERROR_NONE) {
            // If not valid JSON, it might be direct HTML content
            $_SESSION['viewshipment'][$user_id] = $response;
            return $response;
        }
        
        // Check if the response was successful
        if (isset($data['status']) && $data['status'] === 'success') {
            if (isset($data['message'])) {
                // Store in session for potential reuse
                $_SESSION['viewshipment'][$user_id] = $data['message'];
                return $data['message'];
            } else if (isset($data['html'])) {
                // Some APIs return 'html' instead of 'message'
                $_SESSION['viewshipment'][$user_id] = $data['html'];
                return $data['html'];
            }
        }
    }
    
    return false;
}





function shipmentpage($user_id) {
    if (empty($user_id)) {
        return false;
    }
    
    $url = do_config(127) . '?';
    
    $info = [
        'shipmentpage' => true,
        'user_id' => $user_id,
        'api' => do_config(21)
    ];
    
    $msg = http_build_query($info);
    $url .= $msg;
    
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_TIMEOUT, 30); // Add timeout to prevent hanging
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false); // Skip SSL verification if needed
    
    $response = curl_exec($ch);
    
    // Check for cURL errors
    if(curl_errno($ch)) {
        error_log('Curl error in shipmentpage(): ' . curl_error($ch));
        curl_close($ch);
        return false;
    }
    
    curl_close($ch);
    
    if ($response) {
        // Try to decode the JSON response
        $data = json_decode($response, true);
        
        // Check if JSON decoding failed
        if (json_last_error() !== JSON_ERROR_NONE) {
            // If not valid JSON, it might be direct HTML content
            $_SESSION['shipmentpage'][$user_id] = $response;
            return $response;
        }
        
        // Check if the response was successful
        if (isset($data['status']) && $data['status'] === 'success') {
            if (isset($data['message'])) {
                // Store in session for potential reuse
                $_SESSION['shipmentpage'][$user_id] = $data['message'];
                return $data['message'];
            } else if (isset($data['html'])) {
                // Some APIs return 'html' instead of 'message'
                $_SESSION['shipmentpage'][$user_id] = $data['html'];
                return $data['html'];
            }
        }
    }
    
    return false;
}








function viewprint($id) {
    if (empty($id)) {
        return '<div class="alert alert-danger">Invalid shipment ID</div>';
    }
    
    $url = do_config(127) . '?';
    $info = [
        'viewprint' => true,
        'id' => $id,
        'api' => do_config(21)
    ];
    
    $msg = http_build_query($info);
    $url .= $msg;
    
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_TIMEOUT, 30); // Add timeout to prevent hanging
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false); // Skip SSL verification if needed
    
    $response = curl_exec($ch);
    
    // Check for cURL errors
    if(curl_errno($ch)) {
        error_log('Curl error in viewprint(): ' . curl_error($ch));
        curl_close($ch);
        return '<div class="alert alert-danger">Connection error: ' . curl_error($ch) . '</div>';
    }
    
    curl_close($ch);
    
    if ($response) {
        // Try to decode the JSON response
        $data = json_decode($response, true);
        
        // Check if JSON decoding failed
        if (json_last_error() !== JSON_ERROR_NONE) {
            // If not valid JSON, it might be direct HTML content
            $_SESSION['viewprint'][$id] = $response;
            return $response;
        }
        
        // Check if the response was successful
        if (isset($data['status']) && $data['status'] === 'success') {
            if (isset($data['message'])) {
                // Store in session for potential reuse
                $_SESSION['viewprint'][$id] = $data['message'];
                return $data['message'];
            } else if (isset($data['html'])) {
                // Some APIs return 'html' instead of 'message'
                $_SESSION['viewprint'][$id] = $data['html'];
                return $data['html'];
            }
        } else if (isset($data['status']) && $data['status'] === 'error') {
            return '<div class="alert alert-danger">' . $data['message'] . '</div>';
        }
    }
    
    return '<div class="alert alert-danger">No response from API</div>';
}

function viewadminedit_users($edit_id, $user_id = null) {
    if (empty($edit_id)) {
        error_log("viewadminedit_users: Empty edit_id provided");
        return false;
    }
    
    // Make sure we have a user_id (admin making the request)
    if (empty($user_id) && isset($_SESSION['user_id'])) {
        $user_id = $_SESSION['user_id'];
    }
    
    if (empty($user_id)) {
        error_log("viewadminedit_users: No user_id available");
        return false;
    }
    
    $url = do_config(127) . '?';
    $info = [
        'viewadminedit-users' => true,
        'id' => $edit_id,           // ID of the user being edited
        'user_id' => $user_id,      // ID of the admin user making the edit
        'api' => do_config(21)
    ];
    
    $msg = http_build_query($info);
    $url .= $msg;
    
    error_log("viewadminedit_users: Calling URL: " . $url);
    
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    $response = curl_exec($ch);
    
    if (curl_errno($ch)) {
        error_log("viewadminedit_users: cURL error: " . curl_error($ch));
        curl_close($ch);
        return false;
    }
    
    curl_close($ch);
    
    error_log("viewadminedit_users: Raw response: " . substr($response, 0, 200) . "...");
    
    if ($response) {
        // Try to decode the JSON response
        $decoded = json_decode($response, true);
        
        if ($decoded === null) {
            error_log("viewadminedit_users: JSON decode error: " . json_last_error_msg());
            return false;
        }
        
        if (isset($decoded['status']) && $decoded['status'] === 'success') {
            // Store the successful HTML content in session
            $_SESSION['viewadminedit-users'][$edit_id] = $decoded['message'];
            return $decoded['message'];
        } else {
            // Log error message from API
            $errorMsg = isset($decoded['message']) ? $decoded['message'] : 'Unknown error';
            error_log("viewadminedit_users: API error: " . $errorMsg);
            return false;
        }
    }
    
    error_log("viewadminedit_users: Empty response from server");
    return false;
}


function updatetracking($id, $user_id = null) {
    if (empty($id)) {
        return false;
    }
    
    $url = do_config(127) . '?';
    $info = [
        'updatetracking' => true,
        'id' => $id,
        'user_id' => $user_id,
        'api' => do_config(21)
    ];
    
    $msg = http_build_query($info);
    $url .= $msg;
    
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    $response = curl_exec($ch);
    curl_close($ch);
    
    if ($response) {
        $_SESSION['updatetracking'][$id] = $response;
        return $response;
    }
    
    return false;
}



function updateuser($id, $user_id = null) {
    if (empty($id)) {
        return false;
    }
    
    $url = do_config(127) . '?';
    $info = [
        'updateuser' => true,
        'id' => $id,
        'user_id' => $user_id,
        'api' => do_config(21)
    ];
    
    $msg = http_build_query($info);
    $url .= $msg;
    
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    $response = curl_exec($ch);
    curl_close($ch);
    
    if ($response) {
        $_SESSION['updateuser'][$id] = $response;
        return $response;
    }
    
    return false;
}
 

function viewwithdraw($user_id = null) {
    // Make sure we have a valid API key and user ID
    $api_key = do_config(21);
    if (empty($api_key)) {
        error_log("API Key is missing for viewwithdraw");
        return "<div class='alert alert-danger'>API Key is not configured</div>";
    }
    
    if (empty($user_id)) {
        error_log("User ID is missing for viewwithdraw");
        return "<div class='alert alert-danger'>User ID is required</div>";
    }
    
    // Build the API URL
    $url = do_config(127) . '?';
    $info = [
        'viewwithdraw' => true,
        'user_id' => $user_id,
        'api' => $api_key
    ];
    
    // Add additional parameters if provided
    if (isset($_POST['confirm_withdraw']) && $_POST['confirm_withdraw'] === 'yes') {
        $info['confirm_withdraw'] = 'yes';
        $info['amount'] = $_POST['amount'] ?? '';
        $info['phone_number'] = $_POST['phone_number'] ?? '';
        $info['bank_code'] = $_POST['bank_code'] ?? '';
        $info['account_number'] = $_POST['account_number'] ?? '';
        $info['method'] = $_POST['method'] ?? '';
        $info['transaction_id'] = $_POST['transaction_id'] ?? md5(uniqid($user_id . time(), true));
    }
    
    // Build the query string
    $query_string = http_build_query($info);
    $api_url = $url . $query_string;
    
    error_log("Calling API URL: " . $api_url);
    
    // Initialize cURL session
    $ch = curl_init();
    
    // Set cURL options
    curl_setopt($ch, CURLOPT_URL, $api_url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_TIMEOUT, 30);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
    
    // If it's a POST request with form data
    if (isset($_POST['confirm_withdraw'])) {
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $info);
    }

    // Execute cURL session and get the response
    $response = curl_exec($ch);
    
    // Check for cURL errors
    if (curl_errno($ch)) {
        $error = curl_error($ch);
        error_log("cURL Error in viewwithdraw: " . $error);
        curl_close($ch);
        return "<div class='alert alert-danger'>Error connecting to API: " . $error . "</div>";
    }
    
    // Get HTTP status code
    $http_code = curl_getinfo($ch, CURLINFO_HTTP_CODE);
    
    // Close cURL session
    curl_close($ch);
    
    // Check if response is empty
    if (empty($response)) {
        error_log("Empty response from API");
        return "<div class='alert alert-danger'>Empty response from API</div>";
    }
    
    // Try to decode the JSON response
    $result = json_decode($response, true);
    
    // Check if the response is valid JSON
    if (json_last_error() !== JSON_ERROR_NONE) {
        error_log("JSON decode error: " . json_last_error_msg());
        error_log("Response that failed to decode (first 500 chars): " . substr($response, 0, 500));
        
        // If there's HTML in the response, it might be an error page
        if (strpos($response, '<html') !== false || strpos($response, '<body') !== false) {
            return "<div class='alert alert-danger'>The API returned an HTML error page instead of JSON. Please try again later.</div>";
        }
        
        // Return the raw response if it's short enough, otherwise a generic error
        if (strlen($response) < 200) {
            return "<div class='alert alert-danger'>Invalid JSON response: " . htmlspecialchars($response) . "</div>";
        } else {
            return "<div class='alert alert-danger'>Invalid JSON response from API. Please try again later.</div>";
        }
    }
    
    // Check if the response has the expected structure
    if (!isset($result['status'])) {
        error_log("API response missing 'status' field: " . print_r($result, true));
        return "<div class='alert alert-danger'>Invalid API response format (missing status field)</div>";
    }
    
    // Check if the API request was successful
    if ($result['status'] === 'error') {
        $error_message = isset($result['message']) ? $result['message'] : 'Unknown error';
        error_log("API Error in viewwithdraw: " . $error_message);
        return "<div class='alert alert-danger'>" . $error_message . "</div>";
    }
    
    // Return the HTML content if successful
    if ($result['status'] === 'success' && isset($result['html'])) {
        return $result['html'];
    }
    
    // Return the message if HTML is not available
    if ($result['status'] === 'success' && isset($result['message'])) {
        return "<div class='alert alert-success'>" . $result['message'] . "</div>";
    }
    
    // Fallback for unexpected response format
    error_log("Unexpected API response format in viewwithdraw: " . print_r($result, true));
    return "<div class='alert alert-warning'>Unexpected response from API. Please try again.</div>";
}

/**
 * Get withdrawal status for a user
 * 
 * @param int $user_id The user ID
 * @param int $withdrawal_id Optional withdrawal ID to check specific withdrawal
 * @return array Withdrawal status information
 */
function get_withdrawal_status($user_id, $withdrawal_id = null) {
    global $query;
    
    $conditions = 'user_id=?';
    $params = ['i', $user_id];
    
    if ($withdrawal_id) {
        $conditions .= ' AND id=?';
        $params = ['ii', $user_id, $withdrawal_id];
    }
    
    // Get the latest withdrawal or specific withdrawal
    $order = $withdrawal_id ? '' : 'ORDER BY created DESC LIMIT 1';
    $withdrawal = $query->addquery('select', 'withdrawal', '*', $params[0], array_slice($params, 1), $conditions . ' ' . $order);
    
    if (!$withdrawal) {
        return [
            'has_withdrawal' => false,
            'message' => 'No withdrawal found',
            'status_code' => 0,
            'status_text' => 'None',
            'amount' => 0,
            'date' => '',
            'method' => '',
            'account' => ''
        ];
    }
    
    // Determine status text based on status code
    $status_text = 'Unknown';
    switch ($withdrawal->status) {
        case 1:
            $status_text = 'Processing';
            break;
        case 2:
            $status_text = 'Completed';
            break;
        case 3:
            $status_text = 'Cancelled';
            break;
        case 4:
            $status_text = 'Failed';
            break;
    }
    
    return [
        'has_withdrawal' => true,
        'withdrawal_id' => $withdrawal->id,
        'status_code' => $withdrawal->status,
        'status_text' => $status_text,
        'amount' => $withdrawal->amount,
        'date' => $withdrawal->created,
        'method' => $withdrawal->method,
        'account' => $withdrawal->account,
        'transaction_id' => $withdrawal->transaction_id ?? ''
    ];
}

/**
 * Display withdrawal status on dashboard
 * 
 * @param int $user_id The user ID
 * @return string HTML to display withdrawal status
 */
function display_withdrawal_status($user_id) {
    $status = get_withdrawal_status($user_id);
    
    if (!$status['has_withdrawal']) {
        return '';
    }
    
    $status_class = 'secondary';
    switch ($status['status_code']) {
        case 1:
            $status_class = 'info';
            break;
        case 2:
            $status_class = 'success';
            break;
        case 3:
            $status_class = 'warning';
            break;
        case 4:
            $status_class = 'danger';
            break;
    }
    
    $html = '<div class="card mb-4">';
    $html .= '<div class="card-header"><h5 class="card-title">Recent Withdrawal</h5></div>';
    $html .= '<div class="card-body">';
    $html .= '<div class="d-flex justify-content-between align-items-center mb-3">';
    $html .= '<span>Amount:</span><strong>₦' . number_format($status['amount'], 2) . '</strong>';
    $html .= '</div>';
    $html .= '<div class="d-flex justify-content-between align-items-center mb-3">';
    $html .= '<span>Date:</span><span>' . date('M d, Y H:i', strtotime($status['date'])) . '</span>';
    $html .= '</div>';
    $html .= '<div class="d-flex justify-content-between align-items-center mb-3">';
    $html .= '<span>Method:</span><span>' . ucfirst($status['method']) . '</span>';
    $html .= '</div>';
    $html .= '<div class="d-flex justify-content-between align-items-center">';
    $html .= '<span>Status:</span><span class="badge bg-' . $status_class . '">' . $status['status_text'] . '</span>';
    $html .= '</div>';
    $html .= '</div>';
    $html .= '</div>';
    
    return $html;
}





function viewsignup() {
    $url = do_config(127) . '?';
    
    $info = [
        'viewsignup' => true,
        'api' => do_config(21)
    ];
    
    $msg = http_build_query($info);
    $url .= $msg;
    
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    $response = curl_exec($ch);
    curl_close($ch);
    
    if ($response) {
        // Decode the JSON response
        $data = json_decode($response, true);
        
        // Check if the response was successful
        if (isset($data['status']) && $data['status'] === 'success') {
            // No longer storing by user_id since we don't have it
            $_SESSION['signup_content'] = $data['message'];
            return $data['message'];
        }
    }
    
    return false;
}


function deposit_view($user_id) {
    $url = do_config(127) . '?';
    
    $info = [
        'deposit_view' => true,
        'user_id' => $user_id,
        'api' => do_config(21)
    ];
    
    $msg = http_build_query($info);
    $url .= $msg;
    
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    $response = curl_exec($ch);
    curl_close($ch);
    
    if ($response) {
        // Decode the JSON response
        $data = json_decode($response, true);
        
        // Check if the response was successful
        if (isset($data['status']) && $data['status'] === 'success') {
            // Store in session for potential reuse
            $_SESSION['deposit'][$user_id] = $data['message'];
            return $data['message'];
        }
    }
    
    return false;
}


function viewtransaction() {
    global $member; // Access the current user object
    
    if (!isset($member) || !isset($member->user_id)) {
        return "User not authenticated";
    }
    
    $url = do_config(127) . '?';
    
    $info = [
        'viewtransaction' => true,
        'user_id' => $member->user_id,
        'api' => do_config(21)
    ];
    
    $msg = http_build_query($info);
    $url .= $msg;
    
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    $response = curl_exec($ch);
    curl_close($ch);
    
    // Simply return the raw response without trying to parse it
    return $response;
}







function viewwire($wire_id) {
    global $member; // Access the current user object
    
    // Validate wire_id
    if (empty($wire_id)) {
        return false;
    }
    
    $url = do_config(127) . '?';
    
    $info = [
        'viewwire' => true,
        'wire_id' => $wire_id,
        'api' => do_config(21)
    ];
    
    $msg = http_build_query($info);
    $url .= $msg;
    
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_TIMEOUT, 30); // Add timeout to prevent hanging
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false); // Skip SSL verification if needed
    
    $response = curl_exec($ch);
    
    // Check for cURL errors
    if(curl_errno($ch)) {
        error_log('Curl error in viewwire(): ' . curl_error($ch));
        curl_close($ch);
        return false;
    }
    
    curl_close($ch);
    
    if ($response) {
        // Decode the JSON response
        $data = json_decode($response, true);
        
        // Check if the response was successful
        if (isset($data['status']) && $data['status'] === 'success') {
            if (isset($data['html'])) {
                return $data['html'];
            } else if (isset($data['message'])) {
                return $data['message'];
            }
        }
    }
    
    return false;
}





  function viewdashboard($user_id) {
    $url = do_config(127) . '?';
    $info = [
        'viewdashboard' => true,
        'user_id' => $user_id,
        'api' => do_config(21)
    ];
    
    $msg = http_build_query($info);
    $url .= $msg;
    
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    $response = curl_exec($ch);
    curl_close($ch);
    
    if ($response) {
        $_SESSION['user']['dashboard'] = $response;
        return $response;
    } else {
        return false;
    }
}

function viewpremium($user_id) {
    $url = do_config(127) . '?';
    $info = [
        'viewpremium' => true,
        'user_id' => $user_id,
        'api' => do_config(21)
    ];
    
    $msg = http_build_query($info);
    $url .= $msg;
    
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    $response = curl_exec($ch);
    curl_close($ch);
    
    if ($response) {
        $decoded = json_decode($response, true);
        if ($decoded && isset($decoded['status']) && $decoded['status'] === 'success') {
            $_SESSION['user']['premium'] = $decoded['message'];
            return $decoded['message'];
        }
    }
    
    return false;
}


function viewadmindashboard($user_id = null) {
    // Make sure we have a valid API key and user ID
    $api_key = do_config(21);
    if (empty($api_key)) {
        error_log("API Key is missing for viewadmindashboard");
        return "<div class='alert alert-danger'>API Key is not configured</div>";
    }
    
    if (empty($user_id)) {
        error_log("User ID is missing for viewadmindashboard");
        return "<div class='alert alert-danger'>User ID is required</div>";
    }
    
    // Build the API URL with the correct parameter name
    $url = do_config(127) . '?';
    $info = [
        'viewadmindashboard' => true, // This matches the parameter in your API
        'user_id' => $user_id,
        'api' => $api_key
    ];
    
    $msg = http_build_query($info);
    $url .= $msg;
    
    // Log the API URL for debugging
    error_log("Admin Dashboard API URL: " . $url);
    
    // Initialize cURL
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_TIMEOUT, 30);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
    
    // Execute the request
    $response = curl_exec($ch);
    
    // Check for cURL errors
    if (curl_errno($ch)) {
        $error = "cURL Error in viewadmindashboard(): " . curl_error($ch);
        error_log($error);
        curl_close($ch);
        return "<div class='alert alert-danger'>" . $error . "</div>";
    }
    
    curl_close($ch);
    
    // If we got a response, process it
    if ($response) {
        // Try to decode the JSON response
        $data = json_decode($response, true);
        
        // Check if JSON decoding failed
        if (json_last_error() !== JSON_ERROR_NONE) {
            error_log("JSON decode error: " . json_last_error_msg());
            return "<div class='alert alert-danger'>Invalid response format from API</div>";
        }
        
        // Process the JSON response
        if (isset($data['status']) && $data['status'] === 'success') {
            if (isset($data['message'])) {
                // Store in admin session namespace
                $_SESSION['admin']['dashboard'] = $data['message'];
                return $data['message'];
            }
        } else if (isset($data['status']) && $data['status'] === 'error') {
            $error = "API Error: " . (isset($data['message']) ? $data['message'] : 'Unknown error');
            error_log($error);
            return "<div class='alert alert-danger'>" . $error . "</div>";
        }
    }
    
    // If we reach here, something went wrong
    return "<div class='alert alert-warning'>No admin dashboard data available. Please check the server logs for details.</div>";
}


function viewadmininvoice($user_id = null) {
    // Make sure we have a valid API key and user ID
    $api_key = do_config(21);
    if (empty($api_key)) {
        error_log("API Key is missing for viewadmininvoice");
        return "<div class='alert alert-danger'>API Key is not configured</div>";
    }
    
    if (empty($user_id)) {
        error_log("User ID is missing for viewadmininvoice");
        return "<div class='alert alert-danger'>User ID is required</div>";
    }
    
    // Build the API URL with the correct parameter name
    $url = do_config(127) . '?';
    $info = [
        'viewadmininvoice' => true, // This matches the parameter in your API
        'user_id' => $user_id,
        'api' => $api_key
    ];
    
    // Add status filter if provided
    if (isset($_GET['status'])) {
        $info['status'] = $_GET['status'];
    }
    
    // Add paid or reject parameters if provided
    if (isset($_GET['paid'])) {
        $info['paid'] = $_GET['paid'];
    }
    
    if (isset($_GET['reject'])) {
        $info['reject'] = $_GET['reject'];
    }
    
    $msg = http_build_query($info);
    $url .= $msg;
    
    // Log the API URL for debugging
    error_log("Admin Invoice API URL: " . $url);
    
    // Initialize cURL
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_TIMEOUT, 30);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
    
    // Execute the request
    $response = curl_exec($ch);
    
    // Check for cURL errors
    if (curl_errno($ch)) {
        $error = "cURL Error in viewadmininvoice(): " . curl_error($ch);
        error_log($error);
        curl_close($ch);
        return "<div class='alert alert-danger'>" . $error . "</div>";
    }
    
    curl_close($ch);
    
    // If we got a response, process it
    if ($response) {
        // Try to decode the JSON response
        $data = json_decode($response, true);
        
        // Check if JSON decoding failed
        if (json_last_error() !== JSON_ERROR_NONE) {
            error_log("JSON decode error: " . json_last_error_msg());
            return "<div class='alert alert-danger'>Invalid response format from API</div>";
        }
        
        // Process the JSON response
        if (isset($data['status']) && $data['status'] === 'success') {
            if (isset($data['message'])) {
                // Store in admin session namespace
                $_SESSION['admin']['invoice'] = $data['message'];
                return $data['message'];
            }
        } else if (isset($data['status']) && $data['status'] === 'error') {
            $error = "API Error: " . (isset($data['message']) ? $data['message'] : 'Unknown error');
            error_log($error);
            return "<div class='alert alert-danger'>" . $error . "</div>";
        }
    }
    
    // If we reach here, something went wrong
    return "<div class='alert alert-warning'>No invoice data available. Please check the server logs for details.</div>";
}

function viewadminservices($user_id = null) {
    // Make sure we have a valid API key and user ID
    $api_key = do_config(21);
    if (empty($api_key)) {
        error_log("API Key is missing for viewadminservices");
        return "<div class='alert alert-danger'>API Key is not configured</div>";
    }
    
    if (empty($user_id)) {
        error_log("User ID is missing for viewadminservices");
        return "<div class='alert alert-danger'>User ID is required</div>";
    }
    
    // Build the API URL with the correct parameter name
    $url = do_config(127) . '?';
    $info = [
        'viewadminservices' => true,
        'user_id' => $user_id,
        'api' => $api_key,
        // Request raw HTML directly to avoid JSON processing issues
        'raw' => 'true'
    ];
    
    // Add activate or deactivate parameters if provided
    if (isset($_GET['activate'])) {
        $info['activate'] = $_GET['activate'];
    }
    
    if (isset($_GET['deactivate'])) {
        $info['deactivate'] = $_GET['deactivate'];
    }
    
    // Add search parameter if provided
    if (isset($_GET['username'])) {
        $info['username'] = $_GET['username'];
    }
    
    $msg = http_build_query($info);
    $url .= $msg;
    
    // Log the API URL for debugging
    error_log("Admin Services API URL: " . $url);
    
    // Initialize cURL
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_TIMEOUT, 120); // 2 minutes
    curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 15);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
    
    // Request gzip encoding to speed up large responses
    curl_setopt($ch, CURLOPT_ENCODING, 'gzip, deflate');
    
    // Execute the request
    $response = curl_exec($ch);
    $curl_errno = curl_errno($ch);
    $curl_error = curl_error($ch);
    $http_code = curl_getinfo($ch, CURLINFO_HTTP_CODE);
    
    // Close the cURL handle
    curl_close($ch);
    
    // If there was a cURL error
    if ($curl_errno > 0) {
        error_log("cURL Error in viewadminservices: " . $curl_error);
        return get_fallback_services($user_id) ?: 
               "<div class='alert alert-warning'>Could not connect to the service. Please try again later.</div>";
    }
    
    // If we got a successful HTTP response
    if ($http_code == 200 && !empty($response)) {
        // Check if it looks like HTML
        if (substr(trim($response), 0, 1) === '<') {
            // It seems to be HTML, return it directly
            return $response;
        }
        
        // Check if it's a JSON response
        $data = json_decode($response, true);
        if (json_last_error() === JSON_ERROR_NONE) {
            // We have valid JSON
            if (isset($data['status']) && $data['status'] === 'success') {
                if (isset($data['message'])) {
                    $message = $data['message'];
                    
                    // Check if the message is just whitespace/empty
                    if (trim($message) === '') {
                        error_log("Received empty message in JSON response");
                        return get_fallback_services($user_id) ?:
                               "<div class='alert alert-warning'>Received empty data from server. Please try again later.</div>";
                    }
                    
                    // Valid message content, return it
                    return $message;
                }
            } else if (isset($data['status']) && $data['status'] === 'error') {
                $error = isset($data['message']) ? $data['message'] : 'Unknown error';
                error_log("API Error: " . $error);
                return get_fallback_services($user_id) ?:
                       "<div class='alert alert-danger'>API Error: " . htmlspecialchars($error) . "</div>";
            }
        } else {
            // Not valid JSON, log the error and response for debugging
            error_log("JSON decode error: " . json_last_error_msg());
            error_log("Raw response: " . substr($response, 0, 500));
            
            // Try to return the response directly if it seems to be HTML-like
            if (preg_match('/<[a-z][\s\S]*>/i', $response)) {
                return $response;
            }
            
            // Otherwise use fallback
            return get_fallback_services($user_id) ?:
                   "<div class='alert alert-danger'>The server response was not in the expected format.</div>";
        }
    }
    
    // If all else fails, use the fallback
    return get_fallback_services($user_id) ?:
           "<div class='alert alert-warning'>No data was received from the service. Please try again later.</div>";
}

function get_fallback_services($user_id) {
    global $query, $db;
    error_log("Using fallback services data for user_id: " . $user_id);
    
    try {
        // Direct database query (adjust table/column names to match your schema)
        $services = [];
        $result = null;
        
        if (isset($db) && $db) {
            $result = $db->query("SELECT * FROM services ORDER BY id DESC LIMIT 100");
        } elseif (isset($query)) {
            $result = $query->addquery('select', 'services', '*', null, null, '1 ORDER BY id DESC LIMIT 100');
        }
        
        if ($result) {
            $html = '<div class="alert alert-info">Displaying cached data. Some features may be limited.</div>';
            $html .= '<div class="table-responsive"><table class="table table-hover">';
            $html .= '<thead><tr><th>ID</th><th>Name</th><th>Status</th><th>Actions</th></tr></thead><tbody>';
            
            while ($row = $result instanceof mysqli_result ? $result->fetch_assoc() : $result->fetch_assoc()) {
                $status = isset($row['status']) ? (int)$row['status'] : 0;
                $status_text = $status ? 'Active' : 'Inactive';
                $status_badge = $status ? 'success' : 'danger';
                
                $html .= '<tr>';
                $html .= '<td>' . htmlspecialchars($row['id']) . '</td>';
                $html .= '<td>' . htmlspecialchars($row['name'] ?? 'Unknown') . '</td>';
                $html .= '<td><span class="badge bg-' . $status_badge . '">' . $status_text . '</span></td>';
                $html .= '<td>View Details</td>';
                $html .= '</tr>';
            }
            
            $html .= '</tbody></table></div>';
            return $html;
        }
    } catch (Exception $e) {
        error_log("Fallback error: " . $e->getMessage());
    }
    
    return false;
}



function viewadminwithdrawals($user_id = null) {
    // Make sure we have a valid API key and user ID
    $api_key = do_config(21);
    if (empty($api_key)) {
        error_log("API Key is missing for viewadminwithdrawals");
        return "<div class='alert alert-danger'>API Key is not configured</div>";
    }
    
    if (empty($user_id)) {
        error_log("User ID is missing for viewadminwithdrawals");
        return "<div class='alert alert-danger'>User ID is required</div>";
    }
    
    // Build the API URL with the correct parameter name
    $url = do_config(127) . '?';
    $info = [
        'viewadminwithdrawals' => true, // Changed from viewadminservices
        'user_id' => $user_id,
        'api' => $api_key
    ];
    
    // Add paid or refund parameters if provided
    if (isset($_GET['paid'])) {
        $info['paid'] = $_GET['paid'];
    }
    
    if (isset($_GET['refund'])) {
        $info['refund'] = $_GET['refund'];
    }
    
    // Add search parameter if provided
    if (isset($_GET['username'])) {
        $info['username'] = $_GET['username'];
    }
    
    // Add status filter if provided
    if (isset($_GET['status']) && is_numeric($_GET['status'])) {
        $info['status'] = $_GET['status'];
    }
    
    $msg = http_build_query($info);
    $url .= $msg;
    
    // Log the API URL for debugging
    error_log("Admin Withdrawals API URL: " . $url);
    
    // Initialize cURL
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_TIMEOUT, 30);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
    
    // Execute the request
    $response = curl_exec($ch);
    
    // Check for cURL errors
    if (curl_errno($ch)) {
        $error = "cURL Error in viewadminwithdrawals(): " . curl_error($ch);
        error_log($error);
        curl_close($ch);
        return "<div class='alert alert-danger'>" . $error . "</div>";
    }
    
    curl_close($ch);
    
    // If we got a response, process it
    if ($response) {
        // Try to decode the JSON response
        $data = json_decode($response, true);
        
        // Check if JSON decoding failed
        if (json_last_error() !== JSON_ERROR_NONE) {
            error_log("JSON decode error: " . json_last_error_msg());
            return "<div class='alert alert-danger'>Invalid response format from API</div>";
        }
        
        // Process the JSON response
        if (isset($data['status']) && $data['status'] === 'success') {
            if (isset($data['message'])) {
                // Store in admin session namespace
                $_SESSION['admin']['withdrawals'] = $data['message'];
                return $data['message'];
            }
        } else if (isset($data['status']) && $data['status'] === 'error') {
            $error = "API Error: " . (isset($data['message']) ? $data['message'] : 'Unknown error');
            error_log($error);
            return "<div class='alert alert-danger'>" . $error . "</div>";
        }
    }
    
    // If we reach here, something went wrong
    return "<div class='alert alert-warning'>No withdrawal data available. Please check the server logs for details.</div>";
}



function viewadminorders($user_id = null) {
    // Make sure we have a valid API key and user ID
    $api_key = do_config(21);
    if (empty($api_key)) {
        error_log("API Key is missing for viewadminorders");
        return "<div class='alert alert-danger'>API Key is not configured</div>";
    }
    
    if (empty($user_id)) {
        error_log("User ID is missing for viewadminorders");
        return "<div class='alert alert-danger'>User ID is required</div>";
    }
    
    // Build the API URL with the correct parameter name
    $url = do_config(127) . '?';
    $info = [
        'viewadminorders' => true, // This matches the parameter in your API
        'user_id' => $user_id,
        'api' => $api_key
    ];
    
    // Add release or refund parameters if provided
    if (isset($_GET['release'])) {
        $info['release'] = $_GET['release'];
    }
    
    if (isset($_GET['refund'])) {
        $info['refund'] = $_GET['refund'];
    }
    
    // Add search parameter if provided
    if (isset($_GET['search'])) {
        $info['search'] = $_GET['search'];
    }
    
    $msg = http_build_query($info);
    $url .= $msg;
    
    // Log the API URL for debugging
    error_log("Admin Orders API URL: " . $url);
    
    // Initialize cURL
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_TIMEOUT, 30);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
    
    // Execute the request
    $response = curl_exec($ch);
    
    // Check for cURL errors
    if (curl_errno($ch)) {
        $error = "cURL Error in viewadminorders(): " . curl_error($ch);
        error_log($error);
        curl_close($ch);
        return "<div class='alert alert-danger'>" . $error . "</div>";
    }
    
    curl_close($ch);
    
    // If we got a response, process it
    if ($response) {
        // Try to decode the JSON response
        $data = json_decode($response, true);
        
        // Check if JSON decoding failed
        if (json_last_error() !== JSON_ERROR_NONE) {
            error_log("JSON decode error: " . json_last_error_msg());
            return "<div class='alert alert-danger'>Invalid response format from API</div>";
        }
        
        // Process the JSON response
        if (isset($data['status']) && $data['status'] === 'success') {
            if (isset($data['message'])) {
                // Store in admin session namespace
                $_SESSION['admin']['orders'] = $data['message'];
                return $data['message'];
            }
        } else if (isset($data['status']) && $data['status'] === 'error') {
            $error = "API Error: " . (isset($data['message']) ? $data['message'] : 'Unknown error');
            error_log($error);
            return "<div class='alert alert-danger'>" . $error . "</div>";
        }
    }
    
    // If we reach here, something went wrong
    return "<div class='alert alert-warning'>No orders data available. Please check the server logs for details.</div>";
}



function viewadminusers($user_id = null) {
    // Check for cached response first
    $cache_key = 'adminusers_' . $user_id;
    if (isset($_GET['activate']) || isset($_GET['deactivate'])) {
        // Don't use cache for actions that modify data
        $use_cache = false;
    } else {
        $use_cache = true;
        
        // Try to get from cache if it exists and is less than 5 minutes old
        if (isset($_SESSION[$cache_key]) && 
            isset($_SESSION[$cache_key . '_time']) && 
            (time() - $_SESSION[$cache_key . '_time']) < 300) {
            
            error_log("Using cached response for viewadminusers");
            return $_SESSION[$cache_key];
        }
    }
    
    // Make sure we have a valid API key and user ID
    $api_key = do_config(21);
    if (empty($api_key)) {
        error_log("API Key is missing for viewadminusers");
        return "<div class='alert alert-danger'>API Key is not configured</div>";
    }
    
    if (empty($user_id)) {
        error_log("User ID is missing for viewadminusers");
        return "<div class='alert alert-danger'>User ID is required</div>";
    }
    
    // Build the API URL with the correct parameter name
    $url = do_config(127) . '?';
    $info = [
        'viewadminusers' => true,
        'user_id' => $user_id,
        'api' => $api_key,
        // Request raw HTML directly to avoid JSON processing issues
        'raw' => 'true'
    ];
    
    // Add additional parameters if provided
    if (isset($_GET['activate'])) {
        $info['activate'] = $_GET['activate'];
    }
    
    if (isset($_GET['deactivate'])) {
        $info['deactivate'] = $_GET['deactivate'];
    }
    
    if (isset($_GET['ajax_search'])) {
        $info['ajax_search'] = $_GET['ajax_search'];
        if (isset($_GET['search_term'])) {
            $info['search_term'] = $_GET['search_term'];
        }
    }
    
    if (isset($_GET['page'])) {
        $info['page'] = intval($_GET['page']);
    }
    
    if (!isset($info['limit']) && !isset($_GET['limit'])) {
        $info['limit'] = 50;
    } elseif (isset($_GET['limit'])) {
        $info['limit'] = intval($_GET['limit']);
    }
    
    $msg = http_build_query($info);
    $url .= $msg;
    
    // Log the API URL for debugging
    error_log("Admin Users API URL: " . $url);
    
    // Initialize cURL
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_TIMEOUT, 120); // 2 minutes
    curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 15);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
    
    // Request gzip encoding to speed up large responses
    curl_setopt($ch, CURLOPT_ENCODING, 'gzip, deflate');
    
    // Execute the request
    $response = curl_exec($ch);
    $curl_errno = curl_errno($ch);
    $curl_error = curl_error($ch);
    $http_code = curl_getinfo($ch, CURLINFO_HTTP_CODE);
    
    // Close the cURL handle
    curl_close($ch);
    
    // If there was a cURL error
    if ($curl_errno > 0) {
        error_log("cURL Error in viewadminusers: " . $curl_error);
        return get_fallback_users($user_id) ?: 
               "<div class='alert alert-warning'>Could not connect to the service. Please try again later.</div>";
    }
    
    // If we got a successful HTTP response
    if ($http_code == 200 && !empty($response)) {
        // Check if it looks like HTML
        if (substr(trim($response), 0, 1) === '<') {
            // It seems to be HTML, return it directly
            if ($use_cache) {
                $_SESSION[$cache_key] = $response;
                $_SESSION[$cache_key . '_time'] = time();
            }
            return $response;
        }
        
        // Check if it's a JSON response
        $data = json_decode($response, true);
        if (json_last_error() === JSON_ERROR_NONE) {
            // We have valid JSON
            if (isset($data['status']) && $data['status'] === 'success') {
                if (isset($data['message'])) {
                    $message = $data['message'];
                    
                    // Check if the message is just whitespace/empty
                    if (trim($message) === '') {
                        error_log("Received empty message in JSON response");
                        return get_fallback_users($user_id) ?:
                               "<div class='alert alert-warning'>Received empty data from server. Please try again later.</div>";
                    }
                    
                    // Valid message content, return it
                    if ($use_cache) {
                        $_SESSION[$cache_key] = $message;
                        $_SESSION[$cache_key . '_time'] = time();
                    }
                    return $message;
                } else if (isset($data['html'])) {
                    // Some APIs return 'html' instead of 'message'
                    $html = $data['html'];
                    
                    if (trim($html) === '') {
                        error_log("Received empty HTML in JSON response");
                        return get_fallback_users($user_id) ?:
                               "<div class='alert alert-warning'>Received empty data from server. Please try again later.</div>";
                    }
                    
                    if ($use_cache) {
                        $_SESSION[$cache_key] = $html;
                        $_SESSION[$cache_key . '_time'] = time();
                    }
                    return $html;
                }
            } else if (isset($data['status']) && $data['status'] === 'error') {
                $error = isset($data['message']) ? $data['message'] : 'Unknown error';
                error_log("API Error: " . $error);
                return get_fallback_users($user_id) ?:
                       "<div class='alert alert-danger'>API Error: " . htmlspecialchars($error) . "</div>";
            }
        } else {
            // Not valid JSON, log the error and response for debugging
            error_log("JSON decode error: " . json_last_error_msg());
            error_log("Raw response: " . substr($response, 0, 500));
            
            // Try to return the response directly if it seems to be HTML-like
            if (preg_match('/<[a-z][\s\S]*>/i', $response)) {
                if ($use_cache) {
                    $_SESSION[$cache_key] = $response;
                    $_SESSION[$cache_key . '_time'] = time();
                }
                return $response;
            }
            
            // Otherwise use fallback
            return get_fallback_users($user_id) ?:
                   "<div class='alert alert-danger'>The server response was not in the expected format.</div>";
        }
    }
    
    // If all else fails, use the fallback
    return get_fallback_users($user_id) ?:
           "<div class='alert alert-warning'>No data was received from the service. Please try again later.</div>";
}

function get_fallback_users($user_id) {
    global $query, $db;
    error_log("Using fallback users data for user_id: " . $user_id);
    
    try {
        // Direct database query (adjust table/column names to match your schema)
        $users = [];
        $result = null;
        
        if (isset($db) && $db) {
            $result = $db->query("SELECT * FROM users ORDER BY user_id DESC LIMIT 50");
        } elseif (isset($query)) {
            $result = $query->addquery('select', 'users', '*', null, null, '1 ORDER BY user_id DESC LIMIT 50');
        }
        
        if ($result) {
            $html = '<div class="alert alert-info">Displaying cached data. Some features may be limited.</div>';
            $html .= '<div class="table-responsive"><table class="table table-hover">';
            $html .= '<thead><tr><th>ID</th><th>Username</th><th>Email</th><th>Role</th><th>Status</th></tr></thead><tbody>';
            
            while ($row = $result instanceof mysqli_result ? $result->fetch_assoc() : $result->fetch_assoc()) {
                $status = isset($row['status']) ? (int)$row['status'] : 1;
                $status_text = $status ? 'Active' : 'Inactive';
                $status_badge = $status ? 'success' : 'danger';
                
                $html .= '<tr>';
                $html .= '<td>' . htmlspecialchars($row['user_id']) . '</td>';
                $html .= '<td>' . htmlspecialchars($row['username'] ?? 'Unknown') . '</td>';
                $html .= '<td>' . htmlspecialchars($row['email'] ?? '') . '</td>';
                $html .= '<td>' . htmlspecialchars($row['role'] ?? 'user') . '</td>';
                $html .= '<td><span class="badge bg-' . $status_badge . '">' . $status_text . '</span></td>';
                $html .= '</tr>';
            }
            
            $html .= '</tbody></table></div>';
            $html .= '<div class="alert alert-warning mt-3">Note: User management actions are not available in this limited view.</div>';
            return $html;
        }
    } catch (Exception $e) {
        error_log("Fallback users error: " . $e->getMessage());
    }
    
    return false;
}




function viewadminwithdraw($user_id = null) {
    // Make sure we have a valid API key and user ID
    $api_key = do_config(21);
    if (empty($api_key)) {
        error_log("API Key is missing for viewadminwithdraw");
        return "<div class='alert alert-danger'>API Key is not configured</div>";
    }
    
    if (empty($user_id)) {
        error_log("User ID is missing for viewadminwithdraw");
        return "<div class='alert alert-danger'>User ID is required</div>";
    }
    
    // Build the API URL
    $url = do_config(127) . '?';
    $info = [
        'viewadminwithdraw' => true,
        'user_id' => $user_id,
        'api' => $api_key
    ];
    
    // Add additional parameters if provided
    if (isset($_POST['confirm_withdraw']) && $_POST['confirm_withdraw'] === 'yes') {
        $info['confirm_withdraw'] = 'yes';
        $info['amount'] = $_POST['amount'] ?? '';
        $info['phone_number'] = $_POST['phone_number'] ?? '';
        $info['bank_code'] = $_POST['bank_code'] ?? '';
        $info['account_number'] = $_POST['account_number'] ?? '';
        $info['method'] = $_POST['method'] ?? '';
    }
    
    // Build the query string
    $query_string = http_build_query($info);
    $api_url = $url . $query_string;
    
    error_log("Calling API URL: " . $api_url);
    
    // Initialize cURL session
    $ch = curl_init();
    
    // Set cURL options
    curl_setopt($ch, CURLOPT_URL, $api_url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_TIMEOUT, 30);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
    
    // If it's a POST request with form data
    if (isset($_POST['confirm_withdraw'])) {
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $info);
    }
    
    // Execute cURL session and get the response
    $response = curl_exec($ch);
    
    // Log the raw response for debugging
    error_log("Raw API Response: " . $response);
    
    // Check for cURL errors
    if (curl_errno($ch)) {
        $error = curl_error($ch);
        error_log("cURL Error in viewadminwithdraw: " . $error);
        curl_close($ch);
        return "<div class='alert alert-danger'>Error connecting to API: " . $error . "</div>";
    }
    
    // Close cURL session
    curl_close($ch);
    
    // Try to decode the JSON response
    $result = json_decode($response, true);
    
    // Check if the response is valid JSON
    if (json_last_error() !== JSON_ERROR_NONE) {
        error_log("JSON decode error: " . json_last_error_msg());
        error_log("Response that failed to decode: " . $response);
        return "<div class='alert alert-danger'>Invalid JSON response from API: " . json_last_error_msg() . "</div>";
    }
    
    // Check if the response has the expected structure
    if (!isset($result['status'])) {
        error_log("API response missing 'status' field: " . print_r($result, true));
        return "<div class='alert alert-danger'>Invalid API response format (missing status field)</div>";
    }
    
    // Check if the API request was successful
    if ($result['status'] === 'error') {
        $error_message = isset($result['message']) ? $result['message'] : 'Unknown error';
        error_log("API Error in viewadminwithdraw: " . $error_message);
        return "<div class='alert alert-danger'>" . $error_message . "</div>";
    }
    
    // Return the HTML content if successful
    if ($result['status'] === 'success' && isset($result['html'])) {
        // Cache the successful response in session
        $_SESSION['admin']['withdrawal'] = $result['html'];
        return $result['html'];
    }
    
    // Fallback for unexpected response format
    error_log("Unexpected API response format in viewadminwithdraw: " . print_r($result, true));
    return "<div class='alert alert-warning'>Unexpected response from API</div>";
}




function forgetpassword() {
    $url = do_config(127) . '?';
    $info = [
        'forgetpassword' => true,
        'user_id' => isset($_GET['user_id']) ? $_GET['user_id'] : '',
        'id' => isset($_GET['id']) ? $_GET['id'] : '',
        'api' => do_config(21)
    ];
    
    $msg = http_build_query($info);
    $url .= $msg;
    
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    $response = curl_exec($ch);
    
    // Check for cURL errors
    if (curl_errno($ch)) {
        error_log("cURL Error in forgetpassword(): " . curl_error($ch));
        curl_close($ch);
        return "<div class='alert alert-danger'>Connection error: " . curl_error($ch) . "</div>";
    }
    
    curl_close($ch);
    
    if ($response) {
        // Try to decode the JSON response
        $data = json_decode($response, true);
        
        // Check if it's valid JSON and has the expected structure
        if (json_last_error() === JSON_ERROR_NONE && isset($data['status']) && isset($data['message'])) {
            // Store the raw response in session
            $_SESSION['user']['forget'] = $response;
            
            // If it's a success response, return just the message part
            if ($data['status'] === 'success') {
                return $data['message'];
            } else {
                // For error responses, format as an alert
                return "<div class='alert alert-danger'>" . $data['message'] . "</div>";
            }
        } else {
            // If not valid JSON, return the raw response
            $_SESSION['user']['forget'] = $response;
            return $response;
        }
    } else {
        return "<div class='alert alert-danger'>No response from server</div>";
    }
}


function viewmarket($products = null) {
    $url = do_config(127) . '?';
    $info = [
        'viewmarket' => true,
        'api' => do_config(21)
    ];
    
    $msg = http_build_query($info);
    $url .= $msg;
    
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    $response = curl_exec($ch);
    curl_close($ch);
    
    if ($response) {
        // Decode the JSON response
        $decoded = json_decode($response, true);
        
        // Check if the response is valid JSON and has a 'message' field
        if (json_last_error() === JSON_ERROR_NONE && isset($decoded['status']) && $decoded['status'] === 'success' && isset($decoded['message'])) {
            // Store the HTML content from the 'message' field
            $_SESSION['user']['market'] = $decoded['message'];
            return $decoded['message'];
        } else {
            // If not valid JSON or missing 'message', store and return the raw response
            $_SESSION['user']['market'] = $response;
            return $response;
        }
    } else {
        return false;
    }
}


function viewsearch($products = null) {
    $url = do_config(127) . '?';
    $info = [
        'viewsearch' => true,
        'api' => do_config(21)
    ];
    
    $msg = http_build_query($info);
    $url .= $msg;
    
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    $response = curl_exec($ch);
    curl_close($ch);
    
    if ($response) {
        // Decode the JSON response
        $decoded = json_decode($response, true);
        
        // Check if the response is valid JSON and has a 'message' field
        if (json_last_error() === JSON_ERROR_NONE && isset($decoded['status']) && $decoded['status'] === 'success' && isset($decoded['message'])) {
            // Store the HTML content from the 'message' field
            $_SESSION['user']['market'] = $decoded['message'];
            return $decoded['message'];
        } else {
            // If not valid JSON or missing 'message', store and return the raw response
            $_SESSION['user']['search'] = $response;
            return $response;
        }
    } else {
        return false;
    }
}





function viewadminusersearch($products = null) {
    $url = do_config(127) . '?';
    $info = [
        'viewadminusersearch' => true,
        'api' => do_config(21)
    ];
    
    $msg = http_build_query($info);
    $url .= $msg;
    
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    $response = curl_exec($ch);
    curl_close($ch);
    
    if ($response) {
        // Decode the JSON response
        $decoded = json_decode($response, true);
        
        // Check if the response is valid JSON and has a 'html' field
        if (json_last_error() === JSON_ERROR_NONE && isset($decoded['status']) && $decoded['status'] === 'success' && isset($decoded['html'])) {
            // Store the HTML content from the 'html' field
            $_SESSION['user']['admin_users'] = $decoded['html'];
            return $decoded['html'];
        } else {
            // If not valid JSON or missing 'html', store and return the raw response
            $_SESSION['user']['admin_users'] = $response;
            return $response;
        }
    } else {
        return false;
    }
}






  function view_atm_victim($userid){
      
      $url = do_config(127) . '?';
      $info = [
          'viewatmvictim' => true,
          'user_id' => $userid,
          'p' => isset($_GET['p']) ? $_GET['p'] : 0,
          'api' => do_config(21)
      ];
      $msg = http_build_query($info);
      $url .= $msg;
      $ch = curl_init();
      curl_setopt($ch, CURLOPT_URL, $url);
     // curl_setopt($ch, CURLOPT_POST, true);
      //curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($info));
      //curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
      curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
      $response = curl_exec($ch);
      $data = $response;
      if($data){
          $_SESSION['user']['viewatmvictim'] = $data;
          return $data;
      }
  }

 function fetch_tbl_users($user_id = null) {
    // Get the current API key
    $api = do_config(21);
    
    // Build the request URL
    $url = do_config(127) . '?';
    $info = [
        'tbl_users' => true,
        'p' => isset($_GET['p']) ? $_GET['p'] : 0,
        'api' => $api
    ];
    
    // Add user_id to the query if provided
    if ($user_id !== null) {
        $info['user_id'] = $user_id;
    }
    
    $msg = http_build_query($info);
    $url .= $msg;
    
    // Log the request URL for debugging
    error_log("Fetch tbl_users request: " . $url);
    
    // Initialize cURL
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
    curl_setopt($ch, CURLOPT_TIMEOUT, 30);
    
    // Execute the request
    $response = curl_exec($ch);
    
    // Check for curl errors
    if (curl_errno($ch)) {
        error_log("cURL Error in fetch_tbl_users: " . curl_error($ch));
        curl_close($ch);
        return '<div class="alert alert-danger">Error: Connection failed - ' . curl_error($ch) . '</div>';
    }
    
    // Get HTTP status code
    $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
    curl_close($ch);
    
    // Log the response for debugging
    error_log("Fetch tbl_users response code: " . $httpCode);
    error_log("Fetch tbl_users response (first 200 chars): " . substr($response, 0, 200));
    
    // Check if response is valid
    if ($httpCode != 200) {
        return '<div class="alert alert-danger">Error: Server returned HTTP code ' . $httpCode . '</div>';
    }
    
    if (empty($response)) {
        return '<div class="alert alert-danger">Error: Empty response from server</div>';
    }
    
    // Save response to session and return
    $_SESSION['user']['tbl_users'] = $response;
    return $response;
}

function fetch_account($id) {
    $url = do_config(127) . '?';
    $info = [
        'get_account' => true,
        'id' => $id,
        'api' => do_config(21)
    ];
    
    $msg = http_build_query($info);
    $url .= $msg;
    
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    $response = curl_exec($ch);
    
    // Check for cURL errors
    if (curl_errno($ch)) {
        curl_close($ch);
        return '<div class="alert alert-danger">Error: ' . curl_error($ch) . '</div>';
    }
    
    curl_close($ch);
    
    // Check if response is empty
    if (empty($response)) {
        return '<div class="alert alert-warning">No data returned from API</div>';
    }
    
    // Decode the JSON response
    $data = json_decode($response);
    
    // Check if the response is valid JSON and has the expected structure
    if (json_last_error() !== JSON_ERROR_NONE) {
        return '<div class="alert alert-danger">Error: Invalid JSON response from API</div>';
    }
    
    // Check if the API returned an error
    if ($data->status === 'error') {
        return '<div class="alert alert-danger">Error: ' . $data->message . '</div>';
    }
    
    // If successful, store the account data in the session and return it
    $_SESSION['user']['account'] = $data->message;
    return $data->message;
}







/**
 * Fetch verification purchase page content from API
 * 
 * @param int $userid User ID to fetch verification for
 * @return string HTML content or error message
 */
function purchaseverification($userid) {
    // Validate user ID
    if (empty($userid)) {
        return '<div class="alert alert-danger">Invalid user ID</div>';
    }
    
    // Build API URL
    $url = do_config(127) . '?';
    $info = [
        'purchaseverification' => true,
        'user_id' => $userid,
        'api' => do_config(21)
    ];
    
    // Build query string and append to URL
    $msg = http_build_query($info);
    $url .= $msg;
    
    // Initialize cURL session
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_TIMEOUT, 30);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
    
    // Execute cURL request
    $response = curl_exec($ch);
    
    // Check for cURL errors
    if (curl_errno($ch)) {
        $error = curl_error($ch);
        curl_close($ch);
        error_log("cURL Error in purchaseverification: " . $error);
        return '<div class="alert alert-danger">Connection error: ' . $error . '</div>';
    }
    
    curl_close($ch);
    
    // Check if response is empty
    if (empty($response)) {
        return '<div class="alert alert-danger">Empty response from API</div>';
    }
    
    // Try to decode JSON response
    $data = json_decode($response);
    
    // Check if JSON decoding failed
    if (json_last_error() !== JSON_ERROR_NONE) {
        // If not valid JSON, it might be direct HTML content
        error_log("JSON decode error in purchaseverification, treating as HTML: " . json_last_error_msg());
        $_SESSION['user']['verification'] = $response;
        return $response;
    }
    
    // Process the JSON response
    if (isset($data->status) && $data->status == 'success') {
        // Store in session for potential reuse
        $_SESSION['user']['verification'] = $data->message;
        return $data->message;
    } elseif (isset($data->status) && $data->status == 'error') {
        return '<div class="alert alert-danger">' . $data->message . '</div>';
    } else {
        return '<div class="alert alert-danger">Unexpected response format from API</div>';
    }
}









  function user_verification($userid){
      
      $url = do_config(127) . '?';
      $info = [
          'userverification' => true,
          'user_id' => $userid,
          'api' => do_config(21)
      ];
      $msg = http_build_query($info);
      $url .= $msg;
      $ch = curl_init();
      curl_setopt($ch, CURLOPT_URL, $url);
     // curl_setopt($ch, CURLOPT_POST, true);
      //curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($info));
      //curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
      curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
      $response = curl_exec($ch);
      $data = json_decode($response);
      if($data->status == 'success'){
            $_SESSION['user']['userverification'] = $data->message;
            return $data->message;
      }elseif($data->status == 'error'){
            return '<div class="alert alert-danger">'.$data->message.'</div>';
      }
  }
  function uservices($userid){
      
      $url = do_config(127) . '?';
      $info = [
          'uservices' => true,
          'user_id' => $userid,
          'p' => isset($_GET['p']) ? $_GET['p'] : 0,
          'api' => do_config(21)
      ];
      $msg = http_build_query($info);
      $url .= $msg;
      $ch = curl_init();
      curl_setopt($ch, CURLOPT_URL, $url);
     // curl_setopt($ch, CURLOPT_POST, true);
      //curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($info));
      //curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
      curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
      $response = curl_exec($ch);
      $data = $response;
      if($data){
          $_SESSION['user']['uservices'] = $data;
          return $data;
      }
  }


  
  function fetch_user_stats($userid){
      
    $url = do_config(127) . '?';
    $info = [
        'userstats' => true,
        'user_id' => $userid,
        'api' => do_config(21)
    ];
    $msg = http_build_query($info);
    $url .= $msg;
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
   // curl_setopt($ch, CURLOPT_POST, true);
    //curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($info));
    //curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    $response = curl_exec($ch);
    $data = json_decode($response);
    if($data->status == 'success'){
          $_SESSION['user']['userstats'] = $data->message;
          return $data->message;
    }elseif($data->status == 'error'){
          return '<div class="alert alert-danger">'.$data->message.'</div>';
    }
}


  function fetch_user($user_id){

      $url = do_config(127) . '?';
      $info = [
          'user' => true,
          'user_id' => $user_id,
          'api' => do_config(21)
      ];
      $msg = http_build_query($info);
      $url .= $msg;
      $ch = curl_init();
      curl_setopt($ch, CURLOPT_URL, $url);
     // curl_setopt($ch, CURLOPT_POST, true);
      //curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($info));
      //curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
      curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
      $response = curl_exec($ch);
      $data = json_decode($response);
      if($data->status == 'success'){
            //$_SESSION['user']['userstats'] = $data->message;
            return $data->message;
      }elseif($data->status == 'error'){
            echo '<div class="alert alert-danger">'.$data->message.'</div>';
            exit;
      }
  }
  function file_get_curl($etc) {
      
      $url = 'https://min-api.cryptocompare.com/'.$etc;
      $ch = curl_init();
      curl_setopt($ch, CURLOPT_HEADER, 0);
      curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
      curl_setopt($ch, CURLOPT_URL, $url);
      $data = curl_exec($ch);
      curl_close($ch);
      return $data;
  }
  function cal_percentage($amount, $percentage) {
      $finale = ($percentage / 100) * $amount;
      return do_amount($finale, FALSE);
  }
  function do_404(){
      do_winfo('PAGE_NOT_FOUND');
      require_once (PUBLIC_ROOT.'pages/404.php');
      exit;
  }
function checkProxyconfirm($ip){
  
              require APPS.'/Bots/proxychecker.php';
              
              // Input your options for this query including your optional API Key and query flags.
              $proxycheck_options = array(
                'API_KEY' => 's698o1-1v6on4-8782e7-1415ux', // Your API Key.
                'ASN_DATA' => 1, // Enable ASN data response.
                'DAY_RESTRICTOR' => 7, // Restrict checking to proxies seen in the past # of days.
                'VPN_DETECTION' => 1, // Check for both VPN's and Proxies instead of just Proxies.
                'RISK_DATA' => 1, // 0 = Off, 1 = Risk Score (0-100), 2 = Risk Score & Attack History.
                'INF_ENGINE' => 1, // Enable or disable the real-time inference engine.
                'TLS_SECURITY' => 0, // Enable or disable transport security (TLS).
                'QUERY_TAGGING' => 1, // Enable or disable query tagging.
                'MASK_ADDRESS' => 1, // Anonymises the local-part of an email address (e.g. anonymous@domain.tld)
                'CUSTOM_TAG' => '', // Specify a custom query tag instead of the default (Domain+Page).
                'BLOCKED_COUNTRIES' => array('Wakanda', 'WA'), // Specify an array of countries or isocodes to be blocked.
                'ALLOWED_COUNTRIES' => array('Azeroth', 'AJ') // Specify an array of countries or isocodes to be allowed.
              );
              $result_array = \proxycheck\proxycheck::check($ip, $proxycheck_options);
              if ( $result_array['block'] == "yes" ) {
                // Example of a block and the reason why.
                return true;
              } else {
                return false;
              }
}
function checkProxy($ip){
  $contactEmail="jhard4360@gmail.com"; //you must change this to your own email address
  $timeout=5; //by default, wait no longer than 5 secs for a response
  $banOnProbability=0.80; //if getIPIntel returns a value higher than this, function returns true, set to 0.99 by default
  
		//init and set cURL options
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		curl_setopt($ch, CURLOPT_TIMEOUT, $timeout);

		//if you're using custom flags (like flags=m), change the URL below
		curl_setopt($ch, CURLOPT_URL, "http://check.getipintel.net/check.php?ip=$ip&contact=$contactEmail&flags=b");
		$response=curl_exec($ch);
		curl_close($ch);
		
		
		if ($response > $banOnProbability) {
				return true;
		} else {
			if ($response < 0 || strcmp($response, "") == 0 ) {
				//The server returned an error, you might want to do something
				//like write to a log file or email yourself
				//This could be true due to an invalid input or you've exceeded
				//the number of allowed queries. Figure out why this is happening
				//because you aren't protected by the system anymore
				//Leaving this section blank is dangerous because you assume
				//that you're still protected, which is incorrect
				//and you might think GetIPIntel isn't accurate anymore
				//which is also incorrect.

				//failure to implement error handling is bad for the both of us
			}
				return false;
		}
}
 function isproxy($ip){
     $ports = array(80,81,553,554,1080,3128,4480,6588,8000,8080);
     foreach ($ports as $port) {
         if (@fsockopen($ip, $port, $errno, $errstr, 5)) {
             return true;
         }else{
             $headers = array('CLIENT_IP','FORWARDED','FORWARDED_FOR','FORWARDED_FOR_IP','VIA','X_FORWARDED','X_FORWARDED_FOR','HTTP_CLIENT_IP','HTTP_FORWARDED','HTTP_FORWARDED_FOR','HTTP_FORWARDED_FOR_IP','HTTP_PROXY_CONNECTION','HTTP_VIA','HTTP_X_FORWARDED','HTTP_X_FORWARDED_FOR');
             foreach ($headers as $header){
                 if (isset($_SERVER[$header])) {
                     return true;
                 }else{
                     return false;
                 }
             } 
         }
 } 
} 
function do_rate($amount) {
    $rate = do_config(103);
    $amount = round($amount / $rate, 2);
    return do_amount($amount, FALSE);
}
function baseurl($url) {
  $result = parse_url($url);
  return $result['host'];
}
function do_countip($id,$tp){
 global $query,$member;

  $interval = "24 HOUR";// default interval 
  $data = $query->normal("SELECT count(id) FROM ".dbperfix."claims as claims WHERE user_id='$member->user_id' AND prv_id='$id' AND type='$tp' AND ago > NOW() - INTERVAL ".$interval." AND status='1'");
  $data = $data->fetch_assoc();
  return number_format($data['count(id)']);
}
function levelprogress($l) {
  $count = number_format($l * 10);
  $level = number_format($count * 2); 
  return $level;
}
function do_countmsg($id){
 global $query,$member;

  $data = $query->normal("SELECT count(id) FROM ".dbperfix."messages as msg WHERE reciever_user_id='$member->user_id' and parent_id='$id' or parent_id='0' and order_id='0' AND isread='2'");
  $data = $data->fetch_assoc();
  return number_format($data['count(id)']);
}
function do_countmsgsender($id){
 global $query,$member;

  $data = $query->normal("SELECT count(id) FROM ".dbperfix."messages as msg WHERE reciever_user_id='$member->user_id' and parent_id='$id' or parent_id='0' and order_id='0' AND isread='2'");
  $data = $data->fetch_assoc();
  return number_format($data['count(id)']);
}
 function fetch($path = ''){
     /* Template */
     ob_start();
     $temp = include (ROOT.$path);
     $temp = ob_get_clean();
     return $temp;
 }
 function mailer($mailer,$debug=false){
 
    //mailer
    require_once (MAILER.'PHPMailer.php');
    require_once (MAILER.'POP3.php');
    require_once (MAILER.'OAuth.php');
    require_once (MAILER.'SMTP.php');
    $mailAPP = new PHPMailer;
    
    switch(do_config(31)):
     case 'smtp':
     //use smtp
     $mailAPP->isSMTP();
     //$mailAPP->SMTPDebug = 3;
     $mailAPP->Host = do_config(33);
     $mailAPP->Port = do_config(34);
     $mailAPP->SMTPSecure = do_config(35);
     $mailAPP->SMTPAuth = true;
     $mailAPP->Username = do_config(32);
     $mailAPP->Password = do_config(36);
     break;
    endswitch;
   
     $mailAPP->setFrom($mailer['from'], do_config(1));
     $mailAPP->addReplyTo($mailer['from'], do_config(1));
     $mailAPP->addAddress($mailer['to'], $mailer['subject']);
     $mailAPP->Subject = $mailer['subject'];
     $mailAPP->isHTML(true); 
     $mailAPP->msgHTML($mailer['msg']);
     $response = $mailAPP->send();
     ob_flush();
     flush();
     ob_end_flush();
     //$mail->clearAddresses();
     //$mail->clearAttachments();
     
      /*if(!$response){
         if($debug){
            var_export($mailAPP->ErrorInfo);exit;
         }else {
            return FALSE;
         }
      }*/
   }
   function do_maildata($r, $arr = []) {
    // Use global variables instead of constants
    global $mail_data;
    
    // Initialize mail_data as an array
    $mail_data = [];
    
    // Set common values
    $mail_data['m_role'] = $r;
    $mail_data['m_user'] = isset($arr['m_user']) ? $arr['m_user'] : '';
    $mail_data['m_subject'] = isset($arr['m_subject']) ? $arr['m_subject'] : '';
    
    // Set specific values based on role
    switch($r) {
        case 'comment':
        case 'review':
            $mail_data['m_username'] = isset($arr['m_username']) ? $arr['m_username'] : '';
            $mail_data['m_avatar'] = isset($arr['m_avatar']) ? $arr['m_avatar'] : '';
            $mail_data['m_comment'] = isset($arr['m_comment']) ? $arr['m_comment'] : '';
            $mail_data['m_link'] = isset($arr['m_link']) ? $arr['m_link'] : '';
            $mail_data['m_icon'] = isset($arr['m_icon']) ? $arr['m_icon'] : '';
            $mail_data['m_title'] = isset($arr['m_title']) ? $arr['m_title'] : '';
            break;
            
        case 'withdraw':
            $mail_data['m_currency'] = isset($arr['m_currency']) ? $arr['m_currency'] : '';
            $mail_data['m_amount'] = isset($arr['m_amount']) ? $arr['m_amount'] : '';
            $mail_data['m_method'] = isset($arr['m_method']) ? $arr['m_method'] : '';
            break;
            
        case 'message':
            $mail_data['m_name'] = isset($arr['m_name']) ? $arr['m_name'] : '';
            $mail_data['m_email'] = isset($arr['m_email']) ? $arr['m_email'] : '';
            $mail_data['m_comment'] = isset($arr['m_comment']) ? $arr['m_comment'] : '';
            $mail_data['m_username'] = isset($arr['m_username']) ? $arr['m_username'] : '';
            $mail_data['m_avatar'] = isset($arr['m_avatar']) ? $arr['m_avatar'] : '';
            break;
            
        case 'activate':
        case 'recover':
            $mail_data['m_token'] = isset($arr['m_token']) ? $arr['m_token'] : '';
            $mail_data['m_email'] = isset($arr['m_email']) ? $arr['m_email'] : '';
            break;
            
        case 'gpass':
            $mail_data['m_password'] = isset($arr['m_password']) ? $arr['m_password'] : '';
            break;
            
        case 'support':
            $mail_data['m_comment'] = isset($arr['m_comment']) ? $arr['m_comment'] : '';
            $mail_data['m_support'] = isset($arr['m_support']) ? $arr['m_support'] : '';
            break;
    }
    
    return $mail_data;
}

 function contains($haystack, $needle){
    // string contains specific word
    if (strpos($haystack, $needle) !== false) {
        return true;
     } else {
        return false;
     }
  }
 function startsWith($haystack, $needle) {
    // search backwards starting from haystack length characters from the end
    return $needle === "" || strrpos($haystack, $needle, -strlen($haystack)) !== false;
 }

 function endsWith($haystack, $needle) {
    // search forward starting from end minus needle length characters
    return $needle === "" || (($temp = strlen($haystack) - strlen($needle)) >= 0 && strpos($haystack, $needle, $temp) !== false);
 }
 
 function write($file,$content,$mode){
    // create a file and write content into it
   $fp = fopen($file,$mode);
        fwrite($fp,$content);
        fclose($fp);
  }
  function labels($r,$i,$d=false) {
      if(!$d) {
          if (!defined('_'.$r)) define('_'.$r,$i);
      } else {
          if (!defined('_'.$r)) define('_'.$r,$i);
          if (!defined('__'.$r)) define('__'.$r,$d);
      }
  }function messages($r,$i,$d=false){
    if (!defined('_'.$r)) define('_'.$r,$i);
    if($i=='danger' || $i=='warnings') {
        if (!defined('__'.$r)) define('__'.$r,'Error: '.$d);
    } else {
        if (!defined('__'.$r)) define('__'.$r,$d);
    }
}
