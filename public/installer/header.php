<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    
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
        
        .logo {
            text-align: center;
            margin-bottom: 30px;
            display: flex;
            flex-direction: column;
            align-items: center;
        }
        
        .logo a {
            text-decoration: none;
            display: flex;
            flex-direction: column;
            align-items: center;
        }
        
        .logo-icon {
            width: 60px;
            height: 60px;
            background-color: var(--primary);
            color: white;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 36px;
            font-weight: 700;
            margin-bottom: 10px;
            box-shadow: 0 4px 12px rgba(78, 115, 223, 0.25);
            position: relative;
            overflow: hidden;
        }
        
        .logo-icon::after {
            content: '';
            position: absolute;
            width: 100%;
            height: 100%;
            background: linear-gradient(135deg, rgba(255,255,255,0.2) 0%, rgba(255,255,255,0) 60%);
            top: 0;
            left: 0;
        }
        
        .logo-text {
            font-size: 24px;
            font-weight: 600;
            color: var(--primary);
            letter-spacing: 1px;
        }
        
        .logo-subtext {
            font-size: 14px;
            color: var(--dark);
            opacity: 0.7;
            margin-top: 5px;
        }
        
        .login-content {
            display: flex;
            flex-direction: column;
            align-items: center;
            max-width: 1000px;
            width: 100%;
        }
        
        .login-box {
            background: white;
            border-radius: 10px;
            box-shadow: var(--shadow);
            padding: 40px;
            width: 100%;
            max-width: 450px;
            animation: fadeIn 0.5s ease;
        }
        
        .alert {
            padding: 15px 20px;
            border-radius: 8px;
            margin-bottom: 20px;
            font-size: 14px;
            line-height: 1.5;
        }
        
        .alert-warning {
            background-color: rgba(246, 194, 62, 0.1);
            color: #a47e25;
            border-left: 4px solid var(--warning);
        }
        
        .alert-danger {
            background-color: rgba(231, 74, 59, 0.1);
            color: #721c24;
            border-left: 4px solid var(--danger);
        }
        
        .alert-success {
            background-color: rgba(28, 200, 138, 0.1);
            color: #155724;
            border-left: 4px solid var(--success);
        }
        
        .alert-info {
            background-color: rgba(54, 185, 204, 0.1);
            color: #0c5460;
            border-left: 4px solid var(--info);
        }
        
        .badge-primary {
            color: #FFF;
            background-color: var(--primary);
            border-radius: 4px;
            padding: 4px 8px;
            font-size: 12px;
        }
        
        .badge-warning {
            color: #212529;
            background-color: var(--warning);
            border-radius: 4px;
            padding: 4px 8px;
            font-size: 12px;
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
        
        .btn-info {
            color: #fff;
            background-color: var(--info);
            border-color: var(--info);
        }
        
        .btn-info:hover {
            background-color: #2a9ab1;
            border-color: #2a9ab1;
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(54, 185, 204, 0.3);
        }
        
        .btn-block {
            display: block;
            width: 100%;
        }
        
        .red-color {
            color: var(--danger);
        }
        
        .green-color {
            color: var(--success);
        }
        
        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(10px); }
            to { opacity: 1; transform: translateY(0); }
        }
        
        @media (max-width: 768px) {
            .login-box {
                padding: 30px;
            }
        }
    </style>
</head>
<body>
    <section class="login-content">
        <div class="logo">
            <a href="#">
                <div class="logo-icon">p</div>
                <div class="logo-text">pinnocent</div>
                <div class="logo-subtext">Installation Wizard</div>
            </a>
        </div>
