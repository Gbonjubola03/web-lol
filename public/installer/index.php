<?php require_once (dirname(dirname(__FILE__)).'/preload.php'); ?>
<?php require_once (PUBLIC_ROOT.'installer/info/config.php'); ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>WELCOME TO INSTALLATION</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <style>
        :root {
            --primary: #4e73df;
            --primary-dark: #3a56b7;
            --secondary: #f8f9fc;
            --success: #1cc88a;
            --danger: #e74a3b;
            --warning: #f6c23e;
            --info: #36b9cc;
            --dark: #5a5c69;
            --light: #f8f9fc;
            --shadow: 0 4px 20px rgba(0, 0, 0, 0.08);
        }
        
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        
        body {
            font-family: 'Poppins', sans-serif;
            background: linear-gradient(135deg, #f5f7fa 0%, #c3cfe2 100%);
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            color: var(--dark);
            padding: 20px;
        }
        
        .container {
            display: flex;
            max-width: 1000px;
            width: 100%;
            background: white;
            border-radius: 10px;
            overflow: hidden;
            box-shadow: var(--shadow);
        }
        
        .sidebar {
            width: 40%;
            background: var(--primary);
            color: white;
            padding: 40px;
            position: relative;
            overflow: hidden;
        }
        
        .sidebar::before {
            content: '';
            position: absolute;
            top: -50%;
            left: -50%;
            width: 200%;
            height: 200%;
            background: linear-gradient(45deg, rgba(255,255,255,0.1) 0%, rgba(255,255,255,0) 100%);
            transform: rotate(45deg);
            z-index: 1;
        }
        
        .sidebar-content {
            position: relative;
            z-index: 2;
        }
        
        .logo {
            margin-bottom: 40px;
        }
        
        .logo h1 {
            font-size: 28px;
            font-weight: 700;
            margin-bottom: 5px;
        }
        
        .logo p {
            opacity: 0.8;
            font-size: 14px;
        }
        
        .steps {
            margin-top: 40px;
        }
        
        .step {
            display: flex;
            align-items: center;
            margin-bottom: 20px;
            opacity: 0.7;
        }
        
        .step.active {
            opacity: 1;
        }
        
        .step-number {
            width: 30px;
            height: 30px;
            border-radius: 50%;
            background: rgba(255,255,255,0.2);
            display: flex;
            align-items: center;
            justify-content: center;
            margin-right: 15px;
            font-weight: 600;
            font-size: 14px;
        }
        
        .step.active .step-number {
            background: white;
            color: var(--primary);
        }
        
        .step-text {
            font-size: 15px;
        }
        
        .login-box {
            width: 60%;
            padding: 40px;
        }
        
        .login-form h3 {
            font-size: 24px;
            margin-bottom: 20px;
            display: flex;
            align-items: center;
            color: var(--primary);
        }
        
        .login-form h3 i {
            margin-right: 10px;
        }
        
        .system-check {
            margin: 30px 0;
        }
        
        .check-item {
            display: flex;
            align-items: center;
            padding: 12px 15px;
            border-radius: 5px;
            margin-bottom: 10px;
            background: var(--light);
            transition: all 0.3s ease;
        }
        
        .check-item i {
            font-size: 18px;
            margin-right: 15px;
        }
        
        .check-item.success i {
            color: var(--success);
        }
        
        .check-item.error i {
            color: var(--danger);
        }
        
        .check-item p {
            font-size: 14px;
        }
        
        .alert {
            padding: 15px 20px;
            border-radius: 5px;
            margin-bottom: 20px;
            font-size: 14px;
            text-align: center;
            animation: fadeIn 0.5s ease;
        }
        
        .alert-success {
            background-color: rgba(28, 200, 138, 0.1);
            color: var(--success);
            border-left: 4px solid var(--success);
        }
        
        .alert-danger {
            background-color: rgba(231, 74, 59, 0.1);
            color: var(--danger);
            border-left: 4px solid var(--danger);
        }
        
        .btn-container {
            margin-top: 30px;
        }
        
        .btn {
            display: inline-block;
            font-weight: 500;
            text-align: center;
            white-space: nowrap;
            vertical-align: middle;
            user-select: none;
            border: 1px solid transparent;
            padding: 14px 28px;
            font-size: 16px;
            line-height: 1.5;
            border-radius: 5px;
            transition: all 0.2s ease-in-out;
            cursor: pointer;
            width: 100%;
            text-decoration: none;
            display: flex;
            align-items: center;
            justify-content: center;
        }
        
        .btn i {
            margin-right: 10px;
        }
        
        .btn-primary {
            color: #fff;
            background-color: var(--primary);
            border-color: var(--primary);
        }
        
        .btn-primary:hover {
            background-color: var(--primary-dark);
            border-color: var(--primary-dark);
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(78, 115, 223, 0.3);
        }
        
        .powered-by {
            text-align: center;
            margin-top: 30px;
            font-size: 13px;
            color: #888;
        }
        
        .powered-by a {
            color: var(--primary);
            text-decoration: none;
        }
        
        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(10px); }
            to { opacity: 1; transform: translateY(0); }
        }
        
        @media (max-width: 768px) {
            .container {
                flex-direction: column;
                max-width: 450px;
            }
            
            .sidebar, .login-box {
                width: 100%;
            }
            
            .sidebar {
                padding: 30px;
            }
        }
    </style>
</head>
<body>

<?php
$check = true;
define('build',false);

//PHP==VERSION
if (version_compare(PHP_VERSION, '7.0.0', '>=')) {
    $php_version_check = true;
} else {
    $php_version_check = false;
    $check = false;
    define('msg','<div class="alert alert-danger">Your PHP version must be equal or higher than 7.0.0 to use our script. Please ask your hosting company to update it.</div>');
}

//EXTENSION==OPENSSL
if (!extension_loaded('openssl')) {
    $openssl_check = false;
    $check = false;
    define('msg','<div class="alert alert-danger">We didn\'t find OpenSSL extension enabled. Please ask your hosting company to enable it.</div>');
} else {
    $openssl_check = true;
}

//EXTENSION==CURL
if (!extension_loaded('curl')) {
    $curl_check = false;
    $check = false;
    define('msg','<div class="alert alert-danger">We didn\'t find curl extension enabled. Please ask your hosting company to enable it.</div>');
} else {
    $curl_check = true;
}

//EXTENSION==MYSQLI
if (!extension_loaded('mysqli')) {
    $mysqli_check = false;
    $check = false;
    define('msg','<div class="alert alert-danger">We didn\'t find mysqli extension enabled. Please ask your hosting company to enable it.</div>');
} else {
    $mysqli_check = true;
}

//EXTENSION==ndmysqli
if (!function_exists('mysqli_stmt_get_result')) {
    $nd_mysqli_check = false;
    $check = false;
    define('msg','<div class="alert alert-danger">We didn\'t find nd_mysqli extension enabled. Please ask your hosting company to enable it.</div>');
} else {
    $nd_mysqli_check = true;
}

//EXTENSION==ZIP
if (!extension_loaded('zip')) {
    $zip_check = false;
    $check = false;
    define('msg','<div class="alert alert-danger">We didn\'t find ZIP extension enabled. Please ask your hosting company to enable it.</div>');
} else {
    $zip_check = true;
}

//CHECK==OK
if($check){
    if(!defined('build')) {
        define('build', true);
    }
    if(!defined('msg')) {
        define('msg', '<div class="alert alert-success">All requirements passed! Installation can continue now.</div>');
    }
}
?>

<div class="container">
    <div class="sidebar">
        <div class="sidebar-content">
            <div class="logo">
                <h1>Pinnocent</h1>
                <p>Installation Wizard</p>
            </div>
            
            <div class="steps">
                <div class="step active">
                    <div class="step-number">1</div>
                    <div class="step-text">System Requirements Check</div>
                </div>
                
                <div class="step">
                    <div class="step-number">2</div>
                    <div class="step-text">Database Configuration</div>
                </div>
                
                <div class="step">
                    <div class="step-number">3</div>
                    <div class="step-text">Install Application</div>
                </div>
                
                <div class="step">
                    <div class="step-number">4</div>
                    <div class="step-text">Administrator Setup</div>
                </div>
            </div>
        </div>
    </div>
    
    <div class="login-box">
        <div class="login-form">
            <h3><i class="fas fa-server"></i> System Requirements</h3>
            
            <div class="system-check">
                <div class="check-item <?php echo $php_version_check ? 'success' : 'error'; ?>">
                    <i class="fas <?php echo $php_version_check ? 'fa-check-circle' : 'fa-times-circle'; ?>"></i>
                    <p>PHP Version ≥ 7.0.0 <span class="version">(Current: <?php echo PHP_VERSION; ?>)</span></p>
                </div>
                
                <div class="check-item <?php echo $openssl_check ? 'success' : 'error'; ?>">
                    <i class="fas <?php echo $openssl_check ? 'fa-check-circle' : 'fa-times-circle'; ?>"></i>
                    <p>OpenSSL Extension</p>
                </div>
                
                <div class="check-item <?php echo $curl_check ? 'success' : 'error'; ?>">
                    <i class="fas <?php echo $curl_check ? 'fa-check-circle' : 'fa-times-circle'; ?>"></i>
                    <p>cURL Extension</p>
                </div>
                
                <div class="check-item <?php echo $mysqli_check ? 'success' : 'error'; ?>">
                    <i class="fas <?php echo $mysqli_check ? 'fa-check-circle' : 'fa-times-circle'; ?>"></i>
                    <p>MySQLi Extension</p>
                </div>
                
                <div class="check-item <?php echo $nd_mysqli_check ? 'success' : 'error'; ?>">
                    <i class="fas <?php echo $nd_mysqli_check ? 'fa-check-circle' : 'fa-times-circle'; ?>"></i>
                    <p>MySQLi Native Driver</p>
                </div>
                
                <div class="check-item <?php echo $zip_check ? 'success' : 'error'; ?>">
                    <i class="fas <?php echo $zip_check ? 'fa-check-circle' : 'fa-times-circle'; ?>"></i>
                    <p>ZIP Extension</p>
                </div>
            </div>
            
            <?php echo msg; ?>
            
            <div class="btn-container">
                <?php if($check){ ?>
                    <a href="database" class="btn btn-primary">
                        <i class="fas fa-arrow-right"></i> Continue to Database Setup
                    </a>
                <?php } else { ?>
                    <button type="button" class="btn btn-primary" disabled style="opacity: 0.6; cursor: not-allowed;">
                        <i class="fas fa-times-circle"></i> Please Fix Requirements First
                    </button>
                <?php } ?>
            </div>
            
            <div class="powered-by">
                Powered by <a href="https://pinnocent.com" target="_blank">Pinnocent</a> • Version 1.0.0
            </div>
        </div>
    </div>
</div>

</body>
</html>
