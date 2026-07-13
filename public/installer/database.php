<?php require_once (dirname(dirname(__FILE__)).'/preload.php'); ?>
<?php require_once (PUBLIC_ROOT.'installer/info/config.php'); ?>
<?php require_once (MODELS.'dataModel.php'); ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>DATABASE DETAILS</title>
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
        
        .help-sidebar {
            margin-top: 50px;
            background: rgba(0,0,0,0.1);
            padding: 20px;
            border-radius: 8px;
        }
        
        .help-sidebar h3 {
            font-size: 16px;
            margin-bottom: 10px;
            display: flex;
            align-items: center;
        }
        
        .help-sidebar h3 i {
            margin-right: 8px;
        }
        
        .help-sidebar p {
            font-size: 13px;
            opacity: 0.9;
            line-height: 1.6;
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
        
        .form-group {
            margin-bottom: 20px;
        }
        
        .control-label {
            display: block;
            margin-bottom: 8px;
            font-weight: 500;
            font-size: 14px;
            color: var(--dark);
        }
        
        .form-control {
            width: 100%;
            height: 45px;
            padding: 10px 15px;
            font-size: 14px;
            font-weight: 400;
            line-height: 1.5;
            color: var(--dark);
            background-color: #fff;
            background-clip: padding-box;
            border: 1px solid #e3e6f0;
            border-radius: 5px;
            transition: border-color .15s ease-in-out, box-shadow .15s ease-in-out;
        }
        
        .form-control:focus {
            color: var(--dark);
            background-color: #fff;
            border-color: #bac8f3;
            outline: 0;
            box-shadow: 0 0 0 0.2rem rgba(78, 115, 223, 0.25);
        }
        
        .alert {
            padding: 15px 20px;
            border-radius: 5px;
            margin-bottom: 20px;
            font-size: 14px;
            text-align: center;
            animation: fadeIn 0.5s ease;
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
            padding: 12px 24px;
            font-size: 15px;
            line-height: 1.5;
            border-radius: 5px;
            transition: all 0.2s ease-in-out;
            cursor: pointer;
            width: 100%;
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
        
        .btn-block {
            display: block;
            width: 100%;
        }
        
        .database-icon {
            text-align: center;
            margin-bottom: 25px;
        }
        
        .database-icon i {
            font-size: 50px;
            color: var(--primary);
            opacity: 0.8;
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
            
            .help-sidebar {
                display: none;
            }
        }
    </style>
</head>
<body>

<?php
if(isset($_POST['install'])) {
  $host = $_POST['host'];
  $user = $_POST['user'];
  $pass = $_POST['pass'];
  $dbname = $_POST['dbname'];
  
  if(check_conn_db($host,$user,$pass,$dbname)){
    $error_message = '<div class="alert alert-danger">Error: Wrong database details</div>';
  } else {
    $system = get_system($host,$user,$pass,$dbname);
    write(CONNECT.'system.class.php',$system,'w');
    header('location: build');
    exit;
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
                <div class="step">
                    <div class="step-number"><i class="fas fa-check"></i></div>
                    <div class="step-text">System Requirements</div>
                </div>
                
                <div class="step active">
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
            
            <div class="help-sidebar">
                <h3><i class="fas fa-info-circle"></i> Need Help?</h3>
                <p>These are the MySQL database details. If you're not sure about these values, please contact your hosting provider. Typically, 'localhost' works for most configurations as the host.</p>
            </div>
        </div>
    </div>
    
    <div class="login-box">
        <div class="login-form">
            <h3><i class="fas fa-database"></i> Database Configuration</h3>
            
            <div class="database-icon">
                <i class="fas fa-server"></i>
            </div>
            
            <?php if(isset($error_message)): ?>
                <?php echo $error_message; ?>
            <?php endif; ?>
            
            <form autocomplete="off" method="POST">
                <input type="hidden" name="install" value="install">
                <input type="hidden" name="csrfToken" value="<?php echo csrf_token(); ?>">
                <input autocomplete="false" name="hidden" type="text" style="display:none;">
                
                <div class="form-group">
                    <label class="control-label" for="host">Database Host</label>
                    <input class="form-control" type="text" id="host" name="host" value="localhost" required>
                </div>
                
                <div class="form-group">
                    <label class="control-label" for="dbname">Database Name</label>
                    <input class="form-control" type="text" id="dbname" name="dbname" placeholder="Enter your database name" required>
                </div>
                
                <div class="form-group">
                    <label class="control-label" for="user">Database Username</label>
                    <input class="form-control" type="text" id="user" name="user" placeholder="Enter database username" required>
                </div>
                
                <div class="form-group">
                    <label class="control-label" for="pass">Database Password</label>
                    <input class="form-control" type="password" id="pass" name="pass" placeholder="Enter database password">
                </div>
                
                <div class="form-group btn-container">
                    <button type="submit" class="btn btn-primary btn-block">
                        <i class="fas fa-arrow-right"></i> Continue
                    </button>
                </div>
            </form>
            
            <div class="powered-by">
                Powered by <a href="https://pinnocent.com" target="_blank">Pinnocent</a> • Version 1.0.0
            </div>
        </div>
    </div>
</div>

</body>
</html>
