<?php require_once (dirname(dirname(__FILE__)).'/preload.php'); ?>
<?php require_once ('./info/config.php'); ?>
<?php require_once (MODELS.'dataModel.php'); ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CREATE ADMIN USER</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <style>
        :root {
            --primary-color: #4e73df;
            --secondary-color: #f8f9fc;
            --success-color: #1cc88a;
            --danger-color: #e74a3b;
            --warning-color: #f6c23e;
            --info-color: #36b9cc;
        }
        
        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
        }
        
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: linear-gradient(135deg, #f5f7fa 0%, #c3cfe2 100%);
            height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 20px;
        }
        
        .container {
            max-width: 1000px;
            margin: 0 auto;
            display: flex;
            box-shadow: 0 15px 30px rgba(0, 0, 0, 0.1);
            border-radius: 10px;
            overflow: hidden;
        }
        
        .documentation {
            flex: 1;
            background-color: var(--primary-color);
            color: white;
            padding: 40px;
        }
        
        .documentation h2 {
            margin-bottom: 20px;
            font-size: 24px;
            border-bottom: 2px solid rgba(255, 255, 255, 0.2);
            padding-bottom: 10px;
        }
        
        .documentation ul {
            list-style-type: none;
            margin-bottom: 20px;
        }
        
        .documentation ul li {
            margin-bottom: 10px;
            display: flex;
            align-items: flex-start;
        }
        
        .documentation ul li i {
            margin-right: 10px;
            color: var(--warning-color);
            margin-top: 3px;
        }
        
        .documentation .step {
            background-color: rgba(255, 255, 255, 0.1);
            border-radius: 5px;
            padding: 15px;
            margin-bottom: 15px;
        }
        
        .documentation .step h3 {
            margin-bottom: 10px;
            display: flex;
            align-items: center;
        }
        
        .documentation .step h3 i {
            margin-right: 10px;
        }
        
        .login-box {
            flex: 1;
            background-color: white;
            padding: 40px;
            border-radius: 0 10px 10px 0;
        }
        
        .login-form .form-group {
            margin-bottom: 20px;
        }
        
        .login-form .control-label {
            display: block;
            margin-bottom: 8px;
            font-weight: 500;
            color: #444;
        }
        
        .login-form .form-control {
            width: 100%;
            padding: 12px 15px;
            border: 1px solid #ddd;
            border-radius: 4px;
            font-size: 14px;
            transition: border-color 0.2s;
        }
        
        .login-form .form-control:focus {
            border-color: var(--primary-color);
            outline: none;
            box-shadow: 0 0 0 3px rgba(78, 115, 223, 0.25);
        }
        
        .login-form .text-muted {
            display: block;
            margin-top: 5px;
            font-size: 12px;
            color: #6c757d;
        }
        
        .login-form .btn {
            display: inline-block;
            font-weight: 400;
            text-align: center;
            white-space: nowrap;
            vertical-align: middle;
            user-select: none;
            border: 1px solid transparent;
            padding: 12px 15px;
            font-size: 16px;
            line-height: 1.5;
            border-radius: 4px;
            transition: color 0.15s ease-in-out, background-color 0.15s ease-in-out, border-color 0.15s ease-in-out, box-shadow 0.15s ease-in-out;
            cursor: pointer;
            width: 100%;
        }
        
        .login-form .btn-primary {
            color: #fff;
            background-color: var(--primary-color);
            border-color: var(--primary-color);
        }
        
        .login-form .btn-primary:hover {
            background-color: #2e59d9;
            border-color: #2653d4;
        }
        
        .login-form .btn i {
            margin-right: 10px;
        }
        
        .alert {
            padding: 15px;
            margin-bottom: 20px;
            border: 1px solid transparent;
            border-radius: 4px;
        }
        
        .alert-info {
            color: #0c5460;
            background-color: #d1ecf1;
            border-color: #bee5eb;
        }
        
        .alert-danger {
            color: #721c24;
            background-color: #f8d7da;
            border-color: #f5c6cb;
        }
        
        .form-error {
            color: var(--danger-color);
            font-size: 12px;
            margin-top: 5px;
            display: none;
        }
        
        .logo {
            text-align: center;
            margin-bottom: 30px;
        }
        
        .logo h1 {
            color: var(--primary-color);
            font-size: 28px;
        }
        
        .logo p {
            color: #6c757d;
            font-size: 14px;
        }
        
        /* Responsive adjustments */
        @media (max-width: 900px) {
            .container {
                flex-direction: column;
                max-width: 500px;
            }
            
            .documentation, .login-box {
                border-radius: 0;
            }
            
            .documentation {
                border-radius: 10px 10px 0 0;
            }
            
            .login-box {
                border-radius: 0 0 10px 10px;
            }
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="documentation">
            <h2><i class="fas fa-book"></i> Documentation</h2>
            
            <div class="step">
                <h3><i class="fas fa-user-shield"></i> Admin Setup</h3>
                <p>Create your administrator account to manage your Pinnocent installation. This account will have full access to all features.</p>
            </div>
            
            <div class="step">
                <h3><i class="fas fa-key"></i> API Configuration</h3>
                <p>Your Pinnocent API integration requires two key pieces of information:</p>
                <ul>
                    <li><i class="fas fa-link"></i> <strong>API Link:</strong> The URL endpoint for API communication (e.g., https://pinnocent.com/api)</li>
                    <li><i class="fas fa-fingerprint"></i> <strong>API Key:</strong> Your unique identifier used for authentication and domain verification</li>
                </ul>
            </div>
            
            <div class="step">
                <h3><i class="fas fa-shield-alt"></i> Security Guidelines</h3>
                <p>Follow these security best practices:</p>
                <ul>
                    <li><i class="fas fa-check"></i> Use a strong, unique password</li>
                    <li><i class="fas fa-check"></i> Keep your API key confidential</li>
                    <li><i class="fas fa-check"></i> Use a business email for account recovery</li>
                </ul>
            </div>
            
            <div class="step">
                <h3><i class="fas fa-question-circle"></i> Need Help?</h3>
                <p>For additional support, visit our documentation portal or contact support at info@pinnocent.com</p>
            </div>
        </div>
        
        <div class="login-box">
            <div class="logo">
                <h1>Pinnocent Setup</h1>
                <p>Create your admin account to complete installation</p>
            </div>
            
            <?php
// Enable error reporting for debugging
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

$error_message = null;
$success_message = null;

if(isset($_POST['register'])) {
    try {
        $username = $_POST['username'];
        $password = md5($_POST['password']);
        $email = $_POST['email'];
        $passwordcheck = md5($_POST['passwordcheck']);
        $api_link = $_POST['api_link'];
        $api = $_POST['api'];
        
        //PASS MATCH
        if($password == $passwordcheck) {
            // Get IP address for logging
            $ip_address = get_ip();
            
            // Prepare data for API
            $info = [
                'register' => 'register',
                'username' => $_POST["username"],
                'email' => $_POST["email"],
                'password' => $_POST["password"],
                'passwordcheck' => $_POST["passwordcheck"],
                'api_link' => $api_link,
                'api' => $api
            ];
            
            // Send to API
            $ch = curl_init();
            curl_setopt($ch, CURLOPT_URL, $api_link);
            curl_setopt($ch, CURLOPT_POST, true);
            curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($info));
            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            $response = curl_exec($ch);
            
            // Check for cURL errors
            if(curl_errno($ch)) {
                $error_message = "cURL Error: " . curl_error($ch);
                curl_close($ch);
            } else {
                curl_close($ch);
                
                // Parse the API response
                $api_response = json_decode($response, true);
                
                if(isset($api_response['status']) && $api_response['status'] == 'success') {
                    // API registration was successful, now update local config
                    
                    // Process locally
                    if(!endsWith($api_link, '')):
                        $api_link = $api_link.DS;
                    endif;
                    
                    if(isset($_COOKIE["purchase_code"])){
                        $query->addquery('update','config','value=?','ss',[$_COOKIE["purchase_code"],'purchase_code'],'header=?');
                    }
                    
                    // Update api_link
                    $query->addquery('update','config','value=?','ss',[$api_link,'api_link'],'header=?');
                    
                    // Update the existing api field with user provided key
                    $query->addquery('update','config','value=?','ss',[$api,'api'],'header=?');
                    
                    $query->addquery('update','config','value=?','ss',[VERSION,'version'],'header=?');
                    $appConfig = get_app($api_link,'N/A','off',VERSION,csrf_token(),APP,'N/A','N/A');
                    write(CONFIG.'app.php',$appConfig,'w');
                    
                    $success_message = "Admin account created successfully!";
                    
                    // Redirect to signin page
                    header('location: /signin');
                    exit;
                } else {
                    // API registration failed
                    $error_message = isset($api_response['message']) ? $api_response['message'] : "Failed to create admin account via API";
                }
            }
        } else {
            //ERROR
            $error_message = "Passwords do not match";
        }
    } catch (Exception $e) {
        $error_message = "Error: " . $e->getMessage();
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CREATE ADMIN USER</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <!-- Rest of the head content -->
</head>
<body>
    <div class="container">
        <div class="documentation">
            <!-- Documentation content -->
        </div>
        
        <div class="login-box">
            <div class="logo">
                <h1>Pinnocent Setup</h1>
                <p>Create your admin account to complete installation</p>
            </div>
            
            <?php if($error_message): ?>
                <div class="alert alert-danger">
                    <p><strong>Error:</strong> <?php echo $error_message; ?></p>
                </div>
            <?php endif; ?>
            
            <?php if($success_message): ?>
                <div class="alert alert-success">
                    <p><strong>Success:</strong> <?php echo $success_message; ?></p>
                </div>
            <?php endif; ?>
            
            <form class="login-form" autocomplete="off" method="POST" id="adminForm">
                <input type="hidden" name="register" value="register">
                <input type="hidden" name="csrfToken" value="<?php echo csrf_token(); ?>">
                <input autocomplete="false" name="hidden" type="text" style="display:none;">
                
                <!-- Form fields -->
                <div class="form-group">
                    <label class="control-label" for="username">Username</label>
                    <input class="form-control" type="text" id="username" name="username" placeholder="Choose a username" required>
                    <div class="form-error" id="username-error">Username must be at least 3 characters</div>
                </div>
                
                <div class="form-group">
                    <label class="control-label" for="email">Email Address</label>
                    <input class="form-control" type="email" id="email" name="email" placeholder="Your email address" required>
                    <div class="form-error" id="email-error">Please enter a valid email address</div>
                </div>
                
                <div class="form-group">
                    <label class="control-label" for="password">Password</label>
                    <input class="form-control" type="password" id="password" name="password" placeholder="Create a secure password" required>
                    <div class="form-error" id="password-error">Password must be at least 8 characters</div>
                </div>
                
                <div class="form-group">
                    <label class="control-label" for="passwordcheck">Confirm Password</label>
                    <input class="form-control" type="password" id="passwordcheck" name="passwordcheck" placeholder="Confirm your password" required>
                    <div class="form-error" id="passwordcheck-error">Passwords don't match</div>
                </div>
                
                <div class="form-group">
                    <label class="control-label" for="api_link">Pinnocent API Link</label>
                    <input class="form-control" type="text" id="api_link" name="api_link" placeholder="e.g., https://pinnocent.com/api" required>
                    <small class="text-muted">Enter your Pinnocent API endpoint URL</small>
                    <div class="form-error" id="api_link-error">Please enter a valid API Link</div>
                </div>
                
                <div class="form-group">
                    <label class="control-label" for="api">Pinnocent API Key</label>
                    <input class="form-control" type="text" id="api" name="api" placeholder="Your Pinnocent API Key" required>
                    <small class="text-muted">Go to your Pinnocent dashboard to get your API key</small>
                    <div class="form-error" id="api-error">API key is required</div>
                </div>
                
                <div class="alert alert-info">
                    <p><strong>Important:</strong> Your API key is your identity. Do not share it with anybody. This key is used to verify your domain.</p>
                </div>
                
                <div class="form-group btn-container">
                    <button type="submit" class="btn btn-primary">
                        <i class="fas fa-user-plus"></i> CREATE ADMIN ACCOUNT
                    </button>
                </div>
            </form>
        </div>
    </div>

    <script>
        // JavaScript validation code
    </script>
</body>
</html>
