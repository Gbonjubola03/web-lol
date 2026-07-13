<?php require_once (dirname(dirname(__FILE__)).'/preload.php'); ?>
<?php if(!logged){
    header("Location:" .do_config(14));
    exit;
} if($member->role != 'admin'){
    header("Location:" .do_config(14).'user/dashboard');
    exit;
}?>
<!DOCTYPE html>
<html lang="en" data-theme="light">
<head>
    <meta http-equiv="Content-type" content="text/html; charset=UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <!-- Main CSS-->
    <link rel="stylesheet" type="text/css" href="<?php echo do_config(14); ?>assets/inc/css/main-cairo.css">
      <link rel="stylesheet" type="text/css" href="<?php echo do_config(14); ?>assets/inc/css/extra.css">
      <!-- Font-icon CSS-->
      <link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
      <link rel="apple-touch-icon" href="<?php echo do_config(14).do_config(9); ?>">
      <link rel="icon" href="<?php echo do_config(14).do_config(9); ?>">
    <style>
    .widget-small.ptc.coloured-icon {
        background-color: #222222;
        color: #fff;
        border-color: #000;
    }
    .widget-small.pending.coloured-icon {
        background-color: #a17b09;
        color: #fff;
        border-color: #a17b09;
    }
    .widget-small.completed.coloured-icon {
        background-color: #426e10;
        color: #fff;
        border-color: #426e10;
    }
    </style>
    <style>
        :root {
            --primary: #3b82f6;
            --primary-hover: #2563eb;
            --secondary: #64748b;
            --success: #10b981;
            --danger: #ef4444;
            --warning: #f59e0b;
            --info: #0ea5e9;
            
            /* Light theme */
            --bg-color: #f1f5f9;
            --sidebar-bg: #ffffff;
            --header-bg: #ffffff;
            --text-color: #1e293b;
            --text-muted: #64748b;
            --border-color: #e2e8f0;
            --shadow: 0 1px 3px 0 rgba(0, 0, 0, 0.1), 0 1px 2px 0 rgba(0, 0, 0, 0.06);
            
            /* Sizes */
            --header-height: 60px;
            --sidebar-width: 260px;
            --sidebar-collapsed-width: 70px;
            
            /* Other */
            --border-radius: 8px;
            --transition: all 0.25s ease;
        }
        
        [data-theme="dark"] {
            --bg-color: #0f172a;
            --sidebar-bg: #1e293b;
            --header-bg: #1e293b;
            --text-color: #f1f5f9;
            --text-muted: #94a3b8;
            --border-color: #334155;
            --shadow: 0 1px 3px 0 rgba(0, 0, 0, 0.3), 0 1px 2px 0 rgba(0, 0, 0, 0.2);
        }
        
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        
        body {
            font-family: 'Poppins', sans-serif;
            background-color: var(--bg-color);
            color: var(--text-color);
            transition: var(--transition);
            min-height: 100vh;
            line-height: 1.5;
        }
        
        /* Layout */
        .app-container {
            display: flex;
            min-height: 100vh;
            position: relative;
        }
        
        /* Sidebar */
        .sidebar {
            width: var(--sidebar-width);
            background-color: var(--sidebar-bg);
            border-right: 1px solid var(--border-color);
            position: fixed;
            top: 0;
            left: 0;
            height: 100%;
            z-index: 100;
            transition: var(--transition);
            overflow-y: auto;
            box-shadow: var(--shadow);
        }
        
        .sidebar-collapsed .sidebar {
            width: var(--sidebar-collapsed-width);
        }
        
        .sidebar-brand {
            height: var(--header-height);
            display: flex;
            align-items: center;
            padding: 0 1.5rem;
            border-bottom: 1px solid var(--border-color);
            overflow: hidden;
        }
        
        .sidebar-logo {
            font-size: 1.25rem;
            font-weight: 700;
            color: var(--primary);
            text-decoration: none;
            white-space: nowrap;
            transition: var(--transition);
            display: flex;
            align-items: center;
            gap: 0.75rem;
        }
        
        .sidebar-collapsed .sidebar-logo span {
            opacity: 0;
            width: 0;
            display: none;
        }
        
        .sidebar-menu {
            padding: 1.25rem 0;
            list-style: none;
        }
        
        .sidebar-item {
            margin-bottom: 0.375rem;
        }
        
        .sidebar-link {
            display: flex;
            align-items: center;
            padding: 0.75rem 1.5rem;
            color: var(--text-color);
            text-decoration: none;
            border-radius: 0.375rem;
            margin: 0 0.5rem;
            transition: var(--transition);
            position: relative;
            white-space: nowrap;
            font-weight: 500;
        }
        
        .sidebar-link:hover {
            background-color: rgba(59, 130, 246, 0.1);
            color: var(--primary);
        }
        
        .sidebar-link.active {
            background-color: rgba(59, 130, 246, 0.15);
            color: var(--primary);
            font-weight: 600;
        }
        
        .sidebar-link.active::before {
            content: '';
            position: absolute;
            left: -0.5rem;
            top: 50%;
            height: 2rem;
            width: 4px;
            background-color: var(--primary);
            border-radius: 0 4px 4px 0;
            transform: translateY(-50%);
        }
        
        .sidebar-icon {
            width: 1.5rem;
            height: 1.5rem;
            display: flex;
            align-items: center;
            justify-content: center;
            margin-right: 0.875rem;
            transition: var(--transition);
            font-size: 1.125rem;
        }
        
        .sidebar-collapsed .sidebar-icon {
            margin-right: 0;
        }
        
        .sidebar-text {
            transition: var(--transition);
        }
        
        .sidebar-collapsed .sidebar-text {
            opacity: 0;
            width: 0;
            display: none;
        }
        
        /* Header */
        .header {
            height: var(--header-height);
            background-color: var(--header-bg);
            border-bottom: 1px solid var(--border-color);
            display: flex;
            align-items: center;
            padding: 0 1.5rem;
            position: fixed;
            top: 0;
            right: 0;
            left: var(--sidebar-width);
            z-index: 99;
            transition: var(--transition);
            box-shadow: var(--shadow);
        }
        
        .sidebar-collapsed .header {
            left: var(--sidebar-collapsed-width);
        }
        
        .header-content {
            display: flex;
            align-items: center;
            justify-content: space-between;
            width: 100%;
        }
        
        .toggle-sidebar {
            background: none;
            border: none;
            color: var(--text-color);
            cursor: pointer;
            width: 2.5rem;
            height: 2.5rem;
            display: flex;
            align-items: center;
            justify-content: center;
            border-radius: 0.375rem;
            transition: var(--transition);
        }
        
        .toggle-sidebar:hover {
            background-color: rgba(0, 0, 0, 0.05);
        }
        
        [data-theme="dark"] .toggle-sidebar:hover {
            background-color: rgba(255, 255, 255, 0.05);
        }
        
        .header-actions {
            display: flex;
            align-items: center;
            gap: 1rem;
        }
        
        .theme-toggle {
            background: none;
            border: none;
            color: var(--text-color);
            cursor: pointer;
            width: 2.5rem;
            height: 2.5rem;
            display: flex;
            align-items: center;
            justify-content: center;
            border-radius: 0.375rem;
            transition: var(--transition);
            font-size: 1.125rem;
        }
        
        .theme-toggle:hover {
            background-color: rgba(0, 0, 0, 0.05);
        }
        
        [data-theme="dark"] .theme-toggle:hover {
            background-color: rgba(255, 255, 255, 0.05);
        }
        
        .signout-btn {
            background-color: var(--primary);
            color: white;
            border: none;
            border-radius: var(--border-radius);
            padding: 0.5rem 1rem;
            font-size: 0.875rem;
            font-weight: 500;
            cursor: pointer;
            transition: var(--transition);
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }
        
        .signout-btn:hover {
            background-color: var(--primary-hover);
        }
        
        /* Main Content */
        .main-content {
            margin-left: var(--sidebar-width);
            padding-top: var(--header-height);
            transition: var(--transition);
            width: calc(100% - var(--sidebar-width));
        }
        
        .sidebar-collapsed .main-content {
            margin-left: var(--sidebar-collapsed-width);
            width: calc(100% - var(--sidebar-collapsed-width));
        }
        
        /* Responsive */
        @media (max-width: 992px) {
            .sidebar {
                transform: translateX(-100%);
                box-shadow: none;
            }
            
            .header {
                left: 0;
            }
            
            .main-content {
                margin-left: 0;
                width: 100%;
            }
            
            .sidebar-open .sidebar {
                transform: translateX(0);
                box-shadow: 0 0 15px rgba(0, 0, 0, 0.2);
            }
            
            .sidebar-overlay {
                position: fixed;
                top: 0;
                left: 0;
                width: 100%;
                height: 100%;
                background-color: rgba(0, 0, 0, 0.5);
                z-index: 99;
                opacity: 0;
                visibility: hidden;
                transition: var(--transition);
            }
            
            .sidebar-open .sidebar-overlay {
                opacity: 1;
                visibility: visible;
            }
        }
    </style>
</head>
<body>
    <div class="app-container" id="appContainer">
        <!-- Sidebar Overlay -->
        <div class="sidebar-overlay" id="sidebarOverlay"></div>
        
        <!-- Sidebar -->
        <aside class="sidebar">
            <div class="sidebar-brand">
                <a href="<?php echo do_config(14);?>admin/dashboard" class="sidebar-logo">
                    <i class="fas fa-bolt sidebar-icon"></i>
                    <span><?php echo do_config(1); ?></span>
                </a>
            </div>
            
            <ul class="sidebar-menu">
                <li class="sidebar-item">
                    <a href="<?php echo do_config(14);?>admin/dashboard" class="sidebar-link">
                        <i class="fas fa-tachometer-alt sidebar-icon"></i>
                        <span class="sidebar-text">Dashboard</span>
                    </a>
                </li>
                
                <li class="sidebar-item">
                    <a href="<?php echo do_config(14);?>admin/services" class="sidebar-link">
                        <i class="fas fa-shopping-cart sidebar-icon"></i>
                        <span class="sidebar-text">Services</span>
                    </a>
                </li>
                
                <li class="sidebar-item">
                    <a href="<?php echo do_config(14);?>admin/orders" class="sidebar-link">
                        <i class="fas fa-globe sidebar-icon"></i>
                        <span class="sidebar-text">Orders</span>
                    </a>
                </li>
                
               
                
                <li class="sidebar-item">
                    <a href="<?php echo do_config(14);?>admin/web" class="sidebar-link">
                        <i class="fas fa-bell sidebar-icon"></i>
                        <span class="sidebar-text">Website Withdraw</span>
                    </a>
                </li>
                
                <li class="sidebar-item">
                    <a href="<?php echo do_config(14);?>admin/users" class="sidebar-link">
                        <i class="fas fa-users sidebar-icon"></i>
                        <span class="sidebar-text">Users</span>
                    </a>
                </li>
                
                <li class="sidebar-item">
                    <a href="<?php echo do_config(14);?>admin/invoices" class="sidebar-link">
                        <i class="fas fa-file-invoice-dollar sidebar-icon"></i>
                        <span class="sidebar-text">Invoices</span>
                    </a>
                </li>
              
                
                <li class="sidebar-item">
                    <a href="<?php echo do_config(14);?>admin/withdrawals" class="sidebar-link">
                        <i class="fas fa-money-bill-wave sidebar-icon"></i>
                        <span class="sidebar-text">Withdrawals</span>
                    </a>
                </li>

                <li class="sidebar-item">
                    <a href="<?php echo do_config(14);?>admin/css-js-editor" class="sidebar-link">
                    <i class="fas fa-palette sidebar-icon"></i>

                        <span class="sidebar-text">website designe</span>
                    </a>
                </li>
                
                <li class="sidebar-item">
                    <a href="<?php echo do_config(14);?>admin/pages" class="sidebar-link">
                        <i class="fas fa-file-alt sidebar-icon"></i>
                        <span class="sidebar-text">Pages</span>
                    </a>
                </li>
                
                <li class="sidebar-item">
                    <a href="<?php echo do_config(14);?>admin/articles" class="sidebar-link">
                        <i class="fas fa-newspaper sidebar-icon"></i>
                        <span class="sidebar-text">Articles</span>
                    </a>
                </li>
                
                <li class="sidebar-item">
                    <a href="<?php echo do_config(14);?>admin/announcements" class="sidebar-link">
                        <i class="fas fa-bullhorn sidebar-icon"></i>
                        <span class="sidebar-text">Announcements</span>
                    </a>
                </li>
                
                <li class="sidebar-item">
                    <a href="<?php echo do_config(14);?>admin/settings" class="sidebar-link">
                        <i class="fas fa-cog sidebar-icon"></i>
                        <span class="sidebar-text">App Setup</span>
                    </a>
                </li>
            </ul>
        </aside>
        
        <!-- Header -->
        <header class="header">
            <div class="header-content">
                <button type="button" class="toggle-sidebar" id="toggleSidebar">
                    <i class="fas fa-bars"></i>
                </button>
                
                <div class="header-actions">
                    <button type="button" class="theme-toggle" id="themeToggle">
                        <i class="fas fa-moon"></i>
                    </button>
                    
                    <a href="<?php echo do_config(14);?>signout" class="signout-btn">
                        <i class="fas fa-sign-out-alt"></i> Sign Out
                    </a>
                </div>
            </div>
        </header>
        
       

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Elements
            const appContainer = document.getElementById('appContainer');
            const toggleSidebar = document.getElementById('toggleSidebar');
            const sidebarOverlay = document.getElementById('sidebarOverlay');
            const themeToggle = document.getElementById('themeToggle');
            const themeIcon = themeToggle.querySelector('i');
            const html = document.documentElement;
            
            // Toggle sidebar
            toggleSidebar.addEventListener('click', function() {
                if (window.innerWidth < 992) {
                    appContainer.classList.toggle('sidebar-open');
                } else {
                    appContainer.classList.toggle('sidebar-collapsed');
                }
            });
            
            // Close sidebar when clicking overlay
            sidebarOverlay.addEventListener('click', function() {
                appContainer.classList.remove('sidebar-open');
            });
            
            // Theme toggle functionality
            function setTheme(theme) {
                html.setAttribute('data-theme', theme);
                localStorage.setItem('admin-theme', theme);
                
                if (theme === 'dark') {
                    themeIcon.classList.remove('fa-moon');
                    themeIcon.classList.add('fa-sun');
                } else {
                    themeIcon.classList.remove('fa-sun');
                    themeIcon.classList.add('fa-moon');
                }
            }
            
            // Check for saved theme preference
            const savedTheme = localStorage.getItem('admin-theme');
            const prefersDark = window.matchMedia('(prefers-color-scheme: dark)').matches;
            
            if (savedTheme) {
                setTheme(savedTheme);
            } else if (prefersDark) {
                setTheme('dark');
            }
            
            // Toggle theme on button click
            themeToggle.addEventListener('click', function() {
                const currentTheme = html.getAttribute('data-theme');
                const newTheme = currentTheme === 'dark' ? 'light' : 'dark';
                setTheme(newTheme);
            });
            
            // Handle responsive behavior
            function handleResize() {
                if (window.innerWidth < 992) {
                    appContainer.classList.remove('sidebar-collapsed');
                }
            }
            
            window.addEventListener('resize', handleResize);
            handleResize();
            
            // Set active menu item based on current URL
            const currentPath = window.location.pathname;
            const menuLinks = document.querySelectorAll('.sidebar-link');
            
            menuLinks.forEach(link => {
                const href = link.getAttribute('href');
                if (currentPath.includes(href)) {
                    link.classList.add('active');
                } else {
                    link.classList.remove('active');
                }
            });
        });
    </script>
</body>
</html>
<style>
:root {
  /* Core color palette - vibrant and modern */
  --primary: #6366f1;
  --primary-dark: #4f46e5;
  --primary-light: #a5b4fc;
  --secondary: #10b981;
  --secondary-dark: #059669;
  --secondary-light: #6ee7b7;
  --accent: #f59e0b;
  --accent-dark: #d97706;
  --accent-light: #fcd34d;
  --success: #22c55e;
  --info: #3b82f6;
  --warning: #f59e0b;
  --danger: #ef4444;
  
  /* Neutral colors */
  --white: #ffffff;
  --gray-50: #f9fapn;
  --gray-100: #f3f4f6;
  --gray-200: #e5e7eb;
  --gray-300: #d1d5db;
  --gray-400: #9ca3af;
  --gray-500: #6b7280;
  --gray-600: #4b5563;
  --gray-700: #374151;
  --gray-800: #1f2937;
  --gray-900: #111827;
  --black: #000000;
  
  /* Typography */
  --font-sans: 'Inter', -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Helvetica, Arial, sans-serif;
  --font-serif: 'Merriweather', Georgia, Cambria, 'Times New Roman', Times, serif;
  --font-mono: 'Fira Code', Menlo, Monaco, Consolas, 'Liberation Mono', 'Courier New', monospace;
  
  /* Spacing */
  --spacing-xs: 0.25rem;
  --spacing-sm: 0.5rem;
  --spacing-md: 1rem;
  --spacing-lg: 1.5rem;
  --spacing-xl: 2rem;
  --spacing-2xl: 3rem;
  --spacing-3xl: 4rem;
  
  /* Borders */
  --radius-sm: 0.25rem;
  --radius-md: 0.5rem;
  --radius-lg: 0.75rem;
  --radius-xl: 1rem;
  --radius-2xl: 1.5rem;
  --radius-full: 9999px;
  
  /* Shadows */
  --shadow-sm: 0 1px 2px 0 rgba(0, 0, 0, 0.05);
  --shadow-md: 0 4px 6px -1px rgba(0, 0, 0, 0.1), 0 2px 4px -1px rgba(0, 0, 0, 0.06);
  --shadow-lg: 0 10px 15px -3px rgba(0, 0, 0, 0.1), 0 4px 6px -2px rgba(0, 0, 0, 0.05);
  --shadow-xl: 0 20px 25px -5px rgba(0, 0, 0, 0.1), 0 10px 10px -5px rgba(0, 0, 0, 0.04);
  --shadow-2xl: 0 25px 50px -12px rgba(0, 0, 0, 0.25);
  --shadow-inner: inset 0 2px 4px 0 rgba(0, 0, 0, 0.06);
  
  /* Transitions */
  --transition-fast: 150ms cubic-bezier(0.4, 0, 0.2, 1);
  --transition-normal: 300ms cubic-bezier(0.4, 0, 0.2, 1);
  --transition-slow: 500ms cubic-bezier(0.4, 0, 0.2, 1);
  --transition-bounce: 500ms cubic-bezier(0.34, 1.56, 0.64, 1);
  
  /* Z-index layers */
  --z-0: 0;
  --z-10: 10;
  --z-20: 20;
  --z-30: 30;
  --z-40: 40;
  --z-50: 50;
  --z-auto: auto;
}

/* Base styles */
body {
  font-family: var(--font-sans);
  color: var(--gray-700);
  background-color: var(--gray-50);
  line-height: 1.6;
  overflow-x: hidden;
  scroll-behavior: smooth;
}

/* Typography enhancements */
h1, h2, h3, h4, h5, h6 {
  font-weight: 700;
  line-height: 1.2;
  color: var(--gray-900);
}

.display-1 {
  font-size: clamp(2.5rem, 5vw, 4.5rem);
  font-weight: 800;
  letter-spacing: -0.02em;
  line-height: 1.1;
}

.display-2 {
  font-size: clamp(2rem, 4vw, 3.5rem);
  font-weight: 800;
  letter-spacing: -0.02em;
}

.display-3 {
  font-size: clamp(1.75rem, 3vw, 2.5rem);
  font-weight: 700;
}

.lead {
  font-size: clamp(1.125rem, 2vw, 1.25rem);
  font-weight: 400;
  color: var(--gray-600);
}

/* Custom scrollbar */
::-webkit-scrollbar {
  width: 10px;
  height: 10px;
}

::-webkit-scrollbar-track {
  background: var(--gray-100);
}

::-webkit-scrollbar-thumb {
  background: var(--gray-300);
  border-radius: var(--radius-full);
}

::-webkit-scrollbar-thumb:hover {
  background: var(--gray-400);
}

/* Buttons */
.btn {
  display: inline-flex;
  align-items: center;
  justify-content: center;
  padding: 0.75rem 1.5rem;
  font-weight: 600;
  border-radius: var(--radius-full);
  transition: all var(--transition-normal);
  text-decoration: none;
  line-height: 1;
  position: relative;
  overflow: hidden;
  z-index: 1;
  border: none;
  cursor: pointer;
}

.btn::after {
  content: '';
  position: absolute;
  bottom: 0;
  left: 0;
  width: 100%;
  height: 0;
  background-color: rgba(255, 255, 255, 0.1);
  transition: height var(--transition-normal);
  z-index: -1;
}

.btn:hover::after {
  height: 100%;
}

.btn-primary {
  background-color: var(--primary);
  color: white;
  box-shadow: 0 4px 14px rgba(99, 102, 241, 0.4);
}

.btn-primary:hover {
  background-color: var(--primary-dark);
  transform: translateY(-2px);
  box-shadow: 0 6px 20px rgba(99, 102, 241, 0.6);
  color: white;
}

.btn-secondary {
  background-color: var(--secondary);
  color: white;
  box-shadow: 0 4px 14px rgba(16, 185, 129, 0.4);
}

.btn-secondary:hover {
  background-color: var(--secondary-dark);
  transform: translateY(-2px);
  box-shadow: 0 6px 20px rgba(16, 185, 129, 0.6);
  color: white;
}

.btn-accent {
  background-color: var(--accent);
  color: white;
  box-shadow: 0 4px 14px rgba(245, 158, 11, 0.4);
}

.btn-accent:hover {
  background-color: var(--accent-dark);
  transform: translateY(-2px);
  box-shadow: 0 6px 20px rgba(245, 158, 11, 0.6);
  color: white;
}

.btn-outline {
  background-color: transparent;
  border: 2px solid currentColor;
}

.btn-outline-primary {
  color: var(--primary);
  border-color: var(--primary);
}

.btn-outline-primary:hover {
  background-color: var(--primary);
  color: white;
  transform: translateY(-2px);
  box-shadow: 0 6px 20px rgba(99, 102, 241, 0.4);
}

.btn-outline-white {
  color: white;
  border-color: white;
}

.btn-outline-white:hover {
  background-color: white;
  color: var(--primary);
  transform: translateY(-2px);
  box-shadow: 0 6px 20px rgba(255, 255, 255, 0.4);
}

.btn-lg {
  padding: 1rem 2rem;
  font-size: 1.125rem;
}

.btn-sm {
  padding: 0.5rem 1rem;
  font-size: 0.875rem;
}

.btn-icon {
  display: inline-flex;
  align-items: center;
  justify-content: center;
  width: 2.5rem;
  height: 2.5rem;
  padding: 0;
  border-radius: var(--radius-full);
}

.btn-icon-sm {
  width: 2rem;
  height: 2rem;
}

.btn-icon-lg {
  width: 3rem;
  height: 3rem;
}

/* Cards */
.card {
  background-color: white;
  border-radius: var(--radius-lg);
  box-shadow: var(--shadow-lg);
  overflow: hidden;
  transition: transform var(--transition-normal), box-shadow var(--transition-normal);
  height: 100%;
  position: relative;
  border: none;
}

.card:hover {
  transform: translateY(-8px);
  box-shadow: var(--shadow-xl);
}

.card-hover-effect {
  position: relative;
  overflow: hidden;
}

.card-hover-effect::before {
  content: '';
  position: absolute;
  top: 0;
  left: 0;
  width: 100%;
  height: 100%;
  background: linear-gradient(to bottom right, var(--primary-light), var(--secondary-light));
  opacity: 0;
  transition: opacity var(--transition-normal);
  z-index: 0;
}

.card-hover-effect:hover::before {
  opacity: 0.05;
}

/* Announcement ticker */
.announcement-ticker {
  background-color: white;
  border-radius: var(--radius-lg);
  box-shadow: var(--shadow-lg);
  margin-bottom: var(--spacing-xl);
  overflow: hidden;
  position: relative;
  border-left: 4px solid var(--primary);
}

.announcement-ticker::before {
  content: '';
  position: absolute;
  top: 0;
  left: 0;
  width: 100%;
  height: 100%;
  background: linear-gradient(135deg, rgba(99, 102, 241, 0.05) 0%, rgba(16, 185, 129, 0.05) 100%);
  z-index: 0;
}

.announcement-header {
  display: flex;
  align-items: center;
  padding: var(--spacing-md) var(--spacing-lg);
  border-bottom: 1px solid var(--gray-200);
  position: relative;
  z-index: 1;
}

.announcement-icon {
  width: 40px;
  height: 40px;
  border-radius: var(--radius-full);
  background: linear-gradient(135deg, var(--primary) 0%, var(--primary-dark) 100%);
  color: white;
  display: flex;
  align-items: center;
  justify-content: center;
  font-size: 1.2rem;
  margin-right: var(--spacing-md);
  box-shadow: 0 4px 10px rgba(99, 102, 241, 0.3);
}

.announcement-title {
  font-weight: 700;
  font-size: 1.1rem;
  color: var(--gray-900);
  margin: 0;
}

.announcement-subtitle {
  font-size: 0.875rem;
  color: var(--gray-500);
  margin: 0;
}

.ticker-container {
  position: relative;
  height: 80px;
  overflow: hidden;
  padding: 0 var(--spacing-lg);
}

.ticker-items {
  position: absolute;
  top: 0;
  left: 0;
  width: 100%;
  transition: transform var(--transition-normal);
}

.ticker-item {
  height: 80px;
  width: 100%;
  display: flex;
  align-items: center;
  padding: 0 var(--spacing-lg);
  position: relative;
  z-index: 1;
}

.ticker-item-content {
  display: flex;
  align-items: center;
  width: 100%;
}

.ticker-thumbnail {
  width: 60px;
  height: 60px;
  border-radius: var(--radius-md);
  object-fit: cover;
  margin-right: var(--spacing-md);
  box-shadow: var(--shadow-md);
  background-color: var(--gray-100);
  display: flex;
  align-items: center;
  justify-content: center;
  color: var(--primary);
  font-size: 1.5rem;
}

.ticker-text {
  flex: 1;
}

.ticker-title {
  font-weight: 600;
  font-size: 1rem;
  color: var(--gray-900);
  margin-bottom: 4px;
  display: -webkit-box;
  -webkit-line-clamp: 1;
  -webkit-box-orient: vertical;
  overflow: hidden;
}

.ticker-excerpt {
  font-size: 0.875rem;
  color: var(--gray-600);
  display: -webkit-box;
  -webkit-line-clamp: 1;
  -webkit-box-orient: vertical;
  overflow: hidden;
  margin-bottom: 4px;
}

.ticker-link {
  display: inline-flex;
  align-items: center;
  color: var(--primary);
  font-weight: 600;
  font-size: 0.875rem;
  text-decoration: none;
  transition: color var(--transition-fast);
}

.ticker-link:hover {
  color: var(--primary-dark);
}

.ticker-link-icon {
  margin-left: 4px;
  transition: transform var(--transition-fast);
}

.ticker-link:hover .ticker-link-icon {
  transform: translateX(3px);
}

.ticker-controls {
  display: flex;
  justify-content: center;
  padding: var(--spacing-sm) 0;
  border-top: 1px solid var(--gray-200);
  position: relative;
  z-index: 1;
}

.ticker-dot {
  width: 8px;
  height: 8px;
  border-radius: var(--radius-full);
  background-color: var(--gray-300);
  margin: 0 4px;
  cursor: pointer;
  transition: all var(--transition-normal);
}

.ticker-dot.active {
  background-color: var(--primary);
  transform: scale(1.3);
}

/* Hero section */
.hero-section {
  position: relative;
  padding: var(--spacing-3xl) 0;
  overflow: hidden;
  background: linear-gradient(135deg, var(--gray-50) 0%, var(--gray-100) 100%);
}

.hero-section::before {
  content: '';
  position: absolute;
  top: 0;
  left: 0;
  width: 100%;
  height: 100%;
  background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='100' height='100' viewBox='0 0 100 100'%3E%3Cg fill-rule='evenodd'%3E%3Cg fill='%236366f1' fill-opacity='0.05'%3E%3Cpath opacity='.5' d='M96 95h4v1h-4v4h-1v-4h-9v4h-1v-4h-9v4h-1v-4h-9v4h-1v-4h-9v4h-1v-4h-9v4h-1v-4h-9v4h-1v-4h-9v4h-1v-4h-9v4h-1v-4H0v-1h15v-9H0v-1h15v-9H0v-1h15v-9H0v-1h15v-9H0v-1h15v-9H0v-1h15v-9H0v-1h15v-9H0v-1h15v-9H0v-1h15V0h1v15h9V0h1v15h9V0h1v15h9V0h1v15h9V0h1v15h9V0h1v15h9V0h1v15h9V0h1v15h9V0h1v15h4v1h-4v9h4v1h-4v9h4v1h-4v9h4v1h-4v9h4v1h-4v9h4v1h-4v9h4v1h-4v9h4v1h-4v9zm-1 0v-9h-9v9h9zm-10 0v-9h-9v9h9zm-10 0v-9h-9v9h9zm-10 0v-9h-9v9h9zm-10 0v-9h-9v9h9zm-10 0v-9h-9v9h9zm-10 0v-9h-9v9h9zm-10 0v-9h-9v9h9zm-9-10h9v-9h-9v9zm10 0h9v-9h-9v9zm10 0h9v-9h-9v9zm10 0h9v-9h-9v9zm10 0h9v-9h-9v9zm10 0h9v-9h-9v9zm10 0h9v-9h-9v9zm10 0h9v-9h-9v9zm9-10v-9h-9v9h9zm-10 0v-9h-9v9h9zm-10 0v-9h-9v9h9zm-10 0v-9h-9v9h9zm-10 0v-9h-9v9h9zm-10 0v-9h-9v9h9zm-10 0v-9h-9v9h9zm-10 0v-9h-9v9h9zm-9-10h9v-9h-9v9zm10 0h9v-9h-9v9zm10 0h9v-9h-9v9zm10 0h9v-9h-9v9zm10 0h9v-9h-9v9zm10 0h9v-9h-9v9zm10 0h9v-9h-9v9zm10 0h9v-9h-9v9zm9-10v-9h-9v9h9zm-10 0v-9h-9v9h9zm-10 0v-9h-9v9h9zm-10 0v-9h-9v9h9zm-10 0v-9h-9v9h9zm-10 0v-9h-9v9h9zm-10 0v-9h-9v9h9zm-10 0v-9h-9v9h9zm-9-10h9v-9h-9v9zm10 0h9v-9h-9v9zm10 0h9v-9h-9v9zm10 0h9v-9h-9v9zm10 0h9v-9h-9v9zm10 0h9v-9h-9v9zm10 0h9v-9h-9v9zm10 0h9v-9h-9v9zm9-10v-9h-9v9h9zm-10 0v-9h-9v9h9zm-10 0v-9h-9v9h9zm-10 0v-9h-9v9h9zm-10 0v-9h-9v9h9zm-10 0v-9h-9v9h9zm-10 0v-9h-9v9h9zm-10 0v-9h-9v9h9zm-9-10h9v-9h-9v9zm10 0h9v-9h-9v9zm10 0h9v-9h-9v9zm10 0h9v-9h-9v9zm10 0h9v-9h-9v9zm10 0h9v-9h-9v9zm10 0h9v-9h-9v9zm10 0h9v-9h-9v9z'/%3E%3C/g%3E%3C/g%3E%3C/svg%3E");
  opacity: 0.8;
  z-index: 0;
}

.hero-content {
  position: relative;
  z-index: 1;
}

.hero-title {
  margin-bottom: var(--spacing-lg);
  position: relative;
}

.hero-title::after {
  content: '';
  position: absolute;
  bottom: -10px;
  left: 0;
  width: 80px;
  height: 4px;
  background: linear-gradient(to right, var(--primary), var(--secondary));
  border-radius: var(--radius-full);
}

.hero-subtitle {
  margin-bottom: var(--spacing-xl);
}

.hero-buttons {
  display: flex;
  flex-wrap: wrap;
  gap: var(--spacing-md);
  margin-bottom: var(--spacing-xl);
}

.hero-image-container {
  position: relative;
  height: 100%;
  display: flex;
  align-items: center;
  justify-content: center;
}

.hero-image {
  max-width: 100%;
  height: auto;
  border-radius: var(--radius-lg);
  box-shadow: var(--shadow-xl);
  position: relative;
  z-index: 1;
}

.hero-shape-1 {
  position: absolute;
  top: -20px;
  right: -20px;
  width: 120px;
  height: 120px;
  background: linear-gradient(135deg, var(--primary) 0%, var(--primary-dark) 100%);
  border-radius: var(--radius-lg);
  opacity: 0.2;
  z-index: 0;
  animation: float 6s ease-in-out infinite;
}

.hero-shape-2 {
  position: absolute;
  bottom: -30px;
  left: -30px;
  width: 150px;
  height: 150px;
  background: linear-gradient(135deg, var(--secondary) 0%, var(--secondary-dark) 100%);
  border-radius: var(--radius-full);
  opacity: 0.2;
  z-index: 0;
  animation: float 8s ease-in-out infinite reverse;
}

@keyframes float {
  0% {
    transform: translateY(0);
  }
  50% {
    transform: translateY(-20px);
  }
  100% {
    transform: translateY(0);
  }
}

/* Stats section */
.stats-section {
  padding: var(--spacing-3xl) 0;
  position: relative;
  background-color: white;
}

.stats-section::before {
  content: '';
  position: absolute;
  top: 0;
  left: 0;
  width: 100%;
  height: 100%;
  background-image: url("data:image/svg+xml,%3Csvg width='60' height='60' viewBox='0 0 60 60' xmlns='http://www.w3.org/2000/svg'%3E%3Cg fill='none' fill-rule='evenodd'%3E%3Cg fill='%236366f1' fill-opacity='0.05'%3E%3Cpath d='M36 34v-4h-2v4h-4v2h4v4h2v-4h4v-2h-4zm0-30V0h-2v4h-4v2h4v4h2V6h4V4h-4zM6 34v-4H4v4H0v2h4v4h2v-4h4v-2H6zM6 4V0H4v4H0v2h4v4h2V6h4V4H6z'/%3E%3C/g%3E%3C/g%3E%3C/svg%3E");
  opacity: 0.5;
}

.stats-header {
  text-align: center;
  margin-bottom: var(--spacing-2xl);
  position: relative;
  z-index: 1;
}

.stats-title {
  margin-bottom: var(--spacing-md);
  position: relative;
  display: inline-block;
}

.stats-title::after {
  content: '';
  position: absolute;
  bottom: -10px;
  left: 50%;
  transform: translateX(-50%);
  width: 80px;
  height: 4px;
  background: linear-gradient(to right, var(--primary), var(--secondary));
  border-radius: var(--radius-full);
}

.stats-subtitle {
  max-width: 600px;
  margin: 0 auto;
}

.stats-card {
  background-color: white;
  border-radius: var(--radius-lg);
  padding: var(--spacing-xl);
  box-shadow: var(--shadow-lg);
  text-align: center;
  transition: transform var(--transition-normal), box-shadow var(--transition-normal);
  position: relative;
  z-index: 1;
  overflow: hidden;
  height: 100%;
  border: 1px solid var(--gray-200);
}

.stats-card::before {
  content: '';
  position: absolute;
  top: 0;
  left: 0;
  width: 100%;
  height: 100%;
  background: linear-gradient(135deg, rgba(99, 102, 241, 0.05) 0%, rgba(16, 185, 129, 0.05) 100%);
  z-index: -1;
}

.stats-card:hover {
  transform: translateY(-10px);
  box-shadow: var(--shadow-xl);
}

.stats-icon-wrapper {
  width: 80px;
  height: 80px;
  border-radius: var(--radius-full);
  display: flex;
  align-items: center;
  justify-content: center;
  margin: 0 auto var(--spacing-lg);
  position: relative;
}

.stats-icon-wrapper::before {
  content: '';
  position: absolute;
  top: 0;
  left: 0;
  width: 100%;
  height: 100%;
  border-radius: inherit;
  background: currentColor;
  opacity: 0.1;
}

.stats-icon-wrapper.primary {
  color: var(--primary);
}

.stats-icon-wrapper.secondary {
  color: var(--secondary);
}

.stats-icon-wrapper.accent {
  color: var(--accent);
}

.stats-icon {
  font-size: 2rem;
  color: currentColor;
}

.stats-number {
  font-size: 2.5rem;
  font-weight: 800;
  margin-bottom: var(--spacing-sm);
  background: linear-gradient(to right, var(--primary), var(--secondary));
  -webkit-background-clip: text;
  -webkit-text-fill-color: transparent;
  display: inline-block;
}

.stats-label {
  font-size: 1.125rem;
  font-weight: 600;
  color: var(--gray-700);
  margin-bottom: var(--spacing-md);
}

.stats-description {
  color: var(--gray-600);
  font-size: 0.875rem;
}

/* Blog section */
.blog-section {
  padding: var(--spacing-3xl) 0;
  background-color: var(--gray-50);
  position: relative;
}

.blog-header {
  display: flex;
  align-items: center;
  justify-content: space-between;
  margin-bottom: var(--spacing-2xl);
  flex-wrap: wrap;
  gap: var(--spacing-md);
}

.blog-title-wrapper {
  max-width: 600px;
}

.blog-title {
  margin-bottom: var(--spacing-sm);
  position: relative;
}

.blog-title::after {
  content: '';
  position: absolute;
  bottom: -10px;
  left: 0;
  width: 80px;
  height: 4px;
  background: linear-gradient(to right, var(--primary), var(--secondary));
  border-radius: var(--radius-full);
}

.blog-subtitle {
  color: var(--gray-600);
}

.blog-grid {
  display: grid;
  grid-template-columns: repeat(auto-fill, minmax(300px, 1fr));
  gap: var(--spacing-xl);
}

.blog-card {
  background-color: white;
  border-radius: var(--radius-lg);
  overflow: hidden;
  box-shadow: var(--shadow-lg);
  transition: transform var(--transition-normal), box-shadow var(--transition-normal);
  height: 100%;
  display: flex;
  flex-direction: column;
  border: 1px solid var(--gray-200);
}

.blog-card:hover {
  transform: translateY(-10px);
  box-shadow: var(--shadow-xl);
}

.blog-card-image-wrapper {
  position: relative;
  overflow: hidden;
  height: 200px;
}

.blog-card-image {
  width: 100%;
  height: 100%;
  object-fit: cover;
  transition: transform var(--transition-normal);
}

.blog-card:hover .blog-card-image {
  transform: scale(1.05);
}

.blog-card-category {
  position: absolute;
  top: var(--spacing-md);
  right: var(--spacing-md);
  background: linear-gradient(135deg, var(--primary) 0%, var(--primary-dark) 100%);
  color: white;
  padding: 0.25rem 0.75rem;
  border-radius: var(--radius-full);
  font-size: 0.75rem;
  font-weight: 600;
  text-transform: uppercase;
  letter-spacing: 0.5px;
  box-shadow: var(--shadow-md);
}

.blog-card-content {
  padding: var(--spacing-lg);
  display: flex;
  flex-direction: column;
  flex-grow: 1;
}

.blog-card-meta {
  display: flex;
  align-items: center;
  margin-bottom: var(--spacing-md);
}

.blog-card-author-image {
  width: 30px;
  height: 30px;
  border-radius: var(--radius-full);
  object-fit: cover;
  margin-right: var(--spacing-sm);
  border: 2px solid var(--gray-200);
}

.blog-card-author {
  font-size: 0.875rem;
  font-weight: 600;
  color: var(--gray-700);
}

.blog-card-date {
  margin-left: auto;
  font-size: 0.875rem;
  color: var(--gray-500);
  display: flex;
  align-items: center;
}

.blog-card-date i {
  margin-right: 4px;
}

.blog-card-title {
  font-size: 1.25rem;
  font-weight: 700;
  margin-bottom: var(--spacing-md);
  color: var(--gray-900);
  transition: color var(--transition-fast);
  line-height: 1.4;
}

.blog-card-title a {
  color: inherit;
  text-decoration: none;
}

.blog-card-title:hover {
  color: var(--primary);
}

.blog-card-excerpt {
  color: var(--gray-600);
  font-size: 0.875rem;
  margin-bottom: var(--spacing-md);
  flex-grow: 1;
}

.blog-card-footer {
  margin-top: auto;
}

.blog-card-link {
  display: inline-flex;
  align-items: center;
  color: var(--primary);
  font-weight: 600;
  font-size: 0.875rem;
  text-decoration: none;
  transition: color var(--transition-fast);
}

.blog-card-link:hover {
  color: var(--primary-dark);
}

.blog-card-link-icon {
  margin-left: 4px;
  transition: transform var(--transition-fast);
}

.blog-card-link:hover .blog-card-link-icon {
  transform: translateX(3px);
}

/* CTA section */
.cta-section {
  padding: var(--spacing-3xl) 0;
  background: linear-gradient(135deg, var(--primary) 0%, var(--primary-dark) 100%);
  color: white;
  position: relative;
  overflow: hidden;
}

.cta-section::before {
  content: '';
  position: absolute;
  top: 0;
  left: 0;
  width: 100%;
  height: 100%;
  background-image: url("data:image/svg+xml,%3Csvg width='52' height='26' viewBox='0 0 52 26' xmlns='http://www.w3.org/2000/svg'%3E%3Cg fill='none' fill-rule='evenodd'%3E%3Cg fill='%23ffffff' fill-opacity='0.1'%3E%3Cpath d='M10 10c0-2.21-1.79-4-4-4-3.314 0-6-2.686-6-6h2c0 2.21 1.79 4 4 4 3.314 0 6 2.686 6 6 0 2.21 1.79 4 4 4 3.314 0 6 2.686 6 6 0 2.21 1.79 4 4 4v2c-3.314 0-6-2.686-6-6 0-2.21-1.79-4-4-4-3.314 0-6-2.686-6-6zm25.464-1.95l8.486 8.486-1.414 1.414-8.486-8.486 1.414-1.414z' /%3E%3C/g%3E%3C/g%3E%3C/svg%3E");
  opacity: 0.3;
}

.cta-content {
  position: relative;
  z-index: 1;
  text-align: center;
}

.cta-badge {
  display: inline-block;
  background-color: rgba(255, 255, 255, 0.2);
  color: white;
  padding: 0.5rem 1rem;
  border-radius: var(--radius-full);
  font-weight: 600;
  font-size: 0.875rem;
  margin-bottom: var(--spacing-lg);
  backdrop-filter: blur(4px);
}

.cta-title {
  font-size: clamp(2rem, 5vw, 3.5rem);
  font-weight: 800;
  margin-bottom: var(--spacing-lg);
  line-height: 1.2;
}

.cta-description {
  font-size: 1.25rem;
  opacity: 0.9;
  max-width: 700px;
  margin: 0 auto var(--spacing-xl);
}

.cta-buttons {
  display: flex;
  flex-wrap: wrap;
  gap: var(--spacing-md);
  justify-content: center;
}

/* Modal */
.modal-overlay {
  position: fixed;
  top: 0;
  left: 0;
  width: 100%;
  height: 100%;
  background-color: rgba(0, 0, 0, 0.7);
  backdrop-filter: blur(4px);
  z-index: var(--z-50);
  display: flex;
  align-items: center;
  justify-content: center;
  padding: var(--spacing-md);
}

.modal {
  background-color: white;
  border-radius: var(--radius-lg);
  box-shadow: var(--shadow-2xl);
  width: 100%;
  max-width: 500px;
  max-height: 90vh;
  overflow: hidden;
  display: flex;
  flex-direction: column;
  animation: modalFadeIn 0.3s ease-out;
}

@keyframes modalFadeIn {
  from {
    opacity: 0;
    transform: scale(0.95) translateY(10px);
  }
  to {
    opacity: 1;
    transform: scale(1) translateY(0);
  }
}

.modal-header {
  display: flex;
  align-items: center;
  justify-content: space-between;
  padding: var(--spacing-lg);
  background: linear-gradient(135deg, var(--primary) 0%, var(--primary-dark) 100%);
  color: white;
}

.modal-title {
  font-weight: 700;
  font-size: 1.25rem;
  margin: 0;
}

.modal-close {
  background: none;
  border: none;
  color: white;
  font-size: 1.5rem;
  cursor: pointer;
  display: flex;
  align-items: center;
  justify-content: center;
  width: 32px;
  height: 32px;
  border-radius: var(--radius-full);
  transition: background-color var(--transition-fast);
}

.modal-close:hover {
  background-color: rgba(255, 255, 255, 0.2);
}

.modal-body {
  padding: var(--spacing-lg);
  overflow-y: auto;
}

.modal-image {
  width: 100%;
  border-radius: var(--radius-md);
  margin-bottom: var(--spacing-md);
}

.modal-content {
  color: var(--gray-700);
  line-height: 1.6;
}

.modal-footer {
  display: flex;
  justify-content: flex-end;
  gap: var(--spacing-md);
  padding: var(--spacing-md) var(--spacing-lg);
  background-color: var(--gray-50);
  border-top: 1px solid var(--gray-200);
}

/* Animation utilities */
.fade-in {
  animation: fadeIn 1s ease-out;
}

.slide-up {
  animation: slideUp 1s ease-out;
}

.slide-down {
  animation: slideDown 1s ease-out;
}

.slide-left {
  animation: slideLeft 1s ease-out;
}

.slide-right {
  animation: slideRight 1s ease-out;
}

.zoom-in {
  animation: zoomIn 1s ease-out;
}

.bounce {
  animation: bounce 1s ease-out;
}

@keyframes fadeIn {
  from { opacity: 0; }
  to { opacity: 1; }
}

@keyframes slideUp {
  from { transform: translateY(50px); opacity: 0; }
  to { transform: translateY(0); opacity: 1; }
}

@keyframes slideDown {
  from { transform: translateY(-50px); opacity: 0; }
  to { transform: translateY(0); opacity: 1; }
}

@keyframes slideLeft {
  from { transform: translateX(50px); opacity: 0; }
  to { transform: translateX(0); opacity: 1; }
}

@keyframes slideRight {
  from { transform: translateX(-50px); opacity: 0; }
  to { transform: translateX(0); opacity: 1; }
}

@keyframes zoomIn {
  from { transform: scale(0.9); opacity: 0; }
  to { transform: scale(1); opacity: 1; }
}

@keyframes bounce {
  0%, 20%, 50%, 80%, 100% { transform: translateY(0); }
  40% { transform: translateY(-20px); }
  60% { transform: translateY(-10px); }
}

/* Responsive adjustments */
@media (max-width: 992px) {
  .hero-image-container {
    margin-top: var(--spacing-2xl);
  }
  
  .stats-card {
    margin-bottom: var(--spacing-lg);
  }
  
  .cta-title {
    font-size: 2.5rem;
  }
}

@media (max-width: 768px) {
  .hero-title {
    font-size: 2.5rem;
  }
  
  .hero-buttons {
    flex-direction: column;
  }
  
  .hero-buttons .btn {
    width: 100%;
  }
  
  .blog-header {
    flex-direction: column;
    align-items: flex-start;
  }
  
  .cta-buttons {
    flex-direction: column;
  }
  
  .cta-buttons .btn {
    width: 100%;
  }
}

@media (max-width: 576px) {
  .display-1 {
    font-size: 2rem;
  }
  
  .display-2 {
    font-size: 1.75rem;
  }
  
  .display-3 {
    font-size: 1.5rem;
  }
  
  .lead {
    font-size: 1rem;
  }
  
  .stats-number {
    font-size: 2rem;
  }
  
  .cta-title {
    font-size: 2rem;
  }
  
  .cta-description {
    font-size: 1rem;
  }
}
</style>

