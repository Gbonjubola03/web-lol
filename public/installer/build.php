<?php require_once (dirname(dirname(__FILE__)).'/preload.php'); ?>
<?php require_once ('./info/config.php'); ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>BUILD DATABASE</title>
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
        
        .alert {
            padding: 20px;
            border-radius: 8px;
            margin-bottom: 25px;
            font-size: 15px;
            line-height: 1.5;
            display: flex;
            align-items: center;
        }
        
        .alert i {
            font-size: 24px;
            margin-right: 15px;
        }
        
        .alert-warning {
            background-color: rgba(246, 194, 62, 0.1);
            color: #a47e25;
            border-left: 4px solid var(--warning);
        }
        
        .alert-info {
            background-color: rgba(54, 185, 204, 0.1);
            color: #2a8795;
            border-left: 4px solid var(--info);
        }
        
        .divider {
            height: 1px;
            background-color: #e3e6f0;
            margin: 25px 0;
            position: relative;
        }
        
        .divider::after {
            content: 'Ready to Build';
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            background-color: white;
            padding: 0 15px;
            color: var(--dark);
            font-size: 12px;
            opacity: 0.7;
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
            padding: 15px 30px;
            font-size: 16px;
            line-height: 1.5;
            border-radius: 5px;
            transition: all 0.3s ease-in-out;
            cursor: pointer;
            width: 100%;
            position: relative;
            overflow: hidden;
            display: flex;
            align-items: center;
            justify-content: center;
        }
        
        .btn i {
            margin-right: 10px;
            font-size: 20px;
        }
        
        .btn-info {
            color: #fff;
            background-color: var(--info);
            border-color: var(--info);
            box-shadow: 0 4px 10px rgba(54, 185, 204, 0.3);
        }
        
        .btn-info:hover {
            background-color: #2a9ab1;
            border-color: #2a9ab1;
            transform: translateY(-2px);
            box-shadow: 0 6px 15px rgba(54, 185, 204, 0.4);
        }
        
        .btn-block {
            display: block;
            width: 100%;
        }
        
        .build-icon {
            text-align: center;
            margin-bottom: 30px;
        }
        
        .build-icon i {
            font-size: 60px;
            color: var(--info);
            opacity: 0.8;
        }
        
        .table-list {
            background-color: var(--light);
            border-radius: 8px;
            padding: 20px;
            margin-bottom: 25px;
        }
        
        .table-list h4 {
            font-size: 16px;
            margin-bottom: 15px;
            color: var(--dark);
            display: flex;
            align-items: center;
        }
        
        .table-list h4 i {
            margin-right: 8px;
            color: var(--primary);
        }
        
        .table-list ul {
            list-style-type: none;
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 10px;
        }
        
        .table-list ul li {
            font-size: 14px;
            padding: 6px 0;
            display: flex;
            align-items: center;
        }
        
        .table-list ul li i {
            color: var(--info);
            margin-right: 8px;
            font-size: 12px;
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
            
            .table-list ul {
                grid-template-columns: 1fr;
            }
        }
    </style>
</head>
<body>

<?php
if(isset($_POST['build'])) {
  // FILE==SQL
  $filename = ('./info/data.sql');
  $templine = '';
  $lines = file($filename);
  
  foreach ($lines as $line) {
    // Skip comments and empty lines
    if (substr($line, 0, 2) == '--' || $line == '')
      continue;
    
    // Add the line to the current command
    $templine .= $line;
    
    // If it has a semicolon at the end, it's the end of the query
    if (substr(trim($line), -1, 1) == ';') {
      // Fix the character set issue before executing
      $templine = preg_replace('/SET\s+character_set_client\s*=\s*NULL/i', 'SET character_set_client = utf8', $templine);
      $templine = preg_replace('/SET\s+character_set_results\s*=\s*NULL/i', 'SET character_set_results = utf8', $templine);
      $templine = preg_replace('/SET\s+collation_connection\s*=\s*NULL/i', 'SET collation_connection = utf8_general_ci', $templine);
      
      // Only execute non-empty queries
      if (trim($templine) != '') {
        try {
          $query->normal($templine);
        } catch (Exception $e) {
          // Log error but continue with other queries
          error_log("SQL Error: " . $e->getMessage() . " in query: " . $templine);
        }
      }
      
      $templine = '';
    }
  }
  
  header('location: admin');
  exit;
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
                
                <div class="step">
                    <div class="step-number"><i class="fas fa-check"></i></div>
                    <div class="step-text">Database Configuration</div>
                </div>
                
                <div class="step active">
                    <div class="step-number">3</div>
                    <div class="step-text">Install Application</div>
                </div>
                
                <div class="step">
                    <div class="step-number">4</div>
                    <div class="step-text">Administrator Setup</div>
                </div>
            </div>
            
            <div class="help-sidebar">
                <h3><i class="fas fa-exclamation-triangle"></i> Important</h3>
                <p>This step will create all the necessary database tables for your application. Please do not refresh the page or interrupt the process once it has started.</p>
            </div>
        </div>
    </div>
    
    <div class="login-box">
        <div class="login-form">
            <h3><i class="fas fa-cogs"></i> Build Database</h3>
            
            <div class="build-icon">
                <i class="fas fa-database"></i>
            </div>
            
            <div class="alert alert-warning">
                <i class="fas fa-exclamation-circle"></i>
                <div>
                    <strong>Database Build Process</strong>
                    <p>This will create all the necessary tables in your database. Click the button below to start the process.</p>
                </div>
            </div>
            
            <div class="table-list">
                <h4><i class="fas fa-table"></i> Tables to be created</h4>
                <ul>
                    <li><i class="fas fa-dot-circle"></i> Users</li>
                    <li><i class="fas fa-dot-circle"></i> Config</li>
                    <li><i class="fas fa-dot-circle"></i> Campaigns</li>
                    <li><i class="fas fa-dot-circle"></i> Payments</li>
                    <li><i class="fas fa-dot-circle"></i> Websites</li>
                    <li><i class="fas fa-dot-circle"></i> Statistics</li>
                    <li><i class="fas fa-dot-circle"></i> Logs</li>
                    <li><i class="fas fa-dot-circle"></i> Notifications</li>
                </ul>
            </div>
            
            <div class="alert alert-info">
                <i class="fas fa-info-circle"></i>
                <div>
                    <strong>Note:</strong> Once you click the Build button, the process will begin. Please be patient and do not close this page.
                </div>
            </div>
            
            <div class="divider"></div>
            
            <form autocomplete="off" method="POST">
                <input type="hidden" name="build" value="build">
                <input type="hidden" name="csrfToken" value="<?php echo csrf_token(); ?>">
                <input autocomplete="false" name="hidden" type="text" style="display:none;">
                
                <div class="btn-container">
                    <button type="submit" class="btn btn-info btn-block">
                        <i class="fas fa-hammer"></i> BUILD DATABASE
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
