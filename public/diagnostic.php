<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Start simple - no includes
echo "<h1>Installation Diagnostic Tool</h1>";

// Check PHP version
echo "<h2>PHP Environment</h2>";
echo "<ul>";
echo "<li>PHP Version: " . PHP_VERSION . "</li>";
echo "<li>Server: " . $_SERVER['SERVER_SOFTWARE'] . "</li>";
echo "<li>Document Root: " . $_SERVER['DOCUMENT_ROOT'] . "</li>";
echo "</ul>";

// Check request info
echo "<h2>Request Information</h2>";
echo "<ul>";
echo "<li>HTTP_HOST: " . (isset($_SERVER['HTTP_HOST']) ? $_SERVER['HTTP_HOST'] : 'Not set') . "</li>";
echo "<li>REQUEST_URI: " . (isset($_SERVER['REQUEST_URI']) ? $_SERVER['REQUEST_URI'] : 'Not set') . "</li>";
echo "<li>SCRIPT_NAME: " . (isset($_SERVER['SCRIPT_NAME']) ? $_SERVER['SCRIPT_NAME'] : 'Not set') . "</li>";
echo "</ul>";

// Check important files
echo "<h2>File Checks</h2>";
echo "<ul>";
$root_path = dirname(dirname(__FILE__));
$config_file = $root_path . '/config/app.php';
echo "<li>config/app.php: " . (file_exists($config_file) ? 'Exists' : 'Missing') . "</li>";

if (file_exists($config_file)) {
    // Try to parse the file to check installation status
    $file_content = file_get_contents($config_file);
    echo "<li>Installation status: ";
    if (strpos($file_content, "'install'=> 'on'") !== false) {
        echo "Not installed (on)";
    } else if (strpos($file_content, "'install'=> 'off'") !== false) {
        echo "Installed (off)";
    } else {
        echo "Unknown";
    }
    echo "</li>";
}

// Check extensions
echo "<h2>PHP Extensions</h2>";
echo "<ul>";
echo "<li>mysqli: " . (extension_loaded('mysqli') ? 'Loaded' : 'Not loaded') . "</li>";
echo "<li>openssl: " . (extension_loaded('openssl') ? 'Loaded' : 'Not loaded') . "</li>";
echo "<li>curl: " . (extension_loaded('curl') ? 'Loaded' : 'Not loaded') . "</li>";
echo "<li>zip: " . (extension_loaded('zip') ? 'Loaded' : 'Not loaded') . "</li>";
echo "</ul>";

echo "<p>If you're seeing redirect loops, try:</p>";
echo "<ol>";
echo "<li>Clearing your browser cookies and cache</li>";
echo "<li>Making sure config/app.php has 'install'=> 'on' during installation</li>";
echo "<li>Using these direct links:</li>";
echo "<ul>";
echo "<li><a href='index.php'>Start Installation</a></li>";
echo "<li><a href='database.php'>Database Setup</a></li>";
echo "<li><a href='build.php'>Build Database</a></li>";
echo "<li><a href='admin.php'>Create Admin</a></li>";
echo "</ul>";
echo "</ol>";
?>
