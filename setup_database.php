<?php
// Database Setup Script
// Place this in C:\xampp\htdocs\setup_database.php and run it once

error_reporting(E_ALL);
ini_set('display_errors', 1);

echo "<h1>Database Setup</h1>";

try {
    // Connect to MySQL
    $pdo = new PDO("mysql:host=localhost", "root", "");
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
    echo "<p>✅ Connected to MySQL successfully!</p>";
    
    // Create database
    $pdo->exec("CREATE DATABASE IF NOT EXISTS agahyoutube CHARACTER SET utf8mb4 COLLATE utf8mb4_turkish_ci");
    echo "<p>✅ Database 'agahyoutube' created successfully!</p>";
    
    // Use the database
    $pdo->exec("USE agahyoutube");
    
    // Read and execute SQL file
    $sqlFile = __DIR__ . '/agahyoutube.sql';
    if (file_exists($sqlFile)) {
        $sql = file_get_contents($sqlFile);
        
        // Split SQL into individual statements
        $statements = array_filter(array_map('trim', explode(';', $sql)));
        
        foreach ($statements as $statement) {
            if (!empty($statement) && !preg_match('/^(\/\*|--|#)/', $statement)) {
                try {
                    $pdo->exec($statement);
                } catch (PDOException $e) {
                    // Ignore table already exists errors
                    if (strpos($e->getMessage(), 'already exists') === false) {
                        echo "<p>⚠️ Warning: " . $e->getMessage() . "</p>";
                    }
                }
            }
        }
        
        echo "<p>✅ SQL file imported successfully!</p>";
    } else {
        echo "<p>❌ SQL file not found: $sqlFile</p>";
    }
    
    // Test the tables
    $result = $pdo->query("SHOW TABLES");
    $tables = $result->fetchAll(PDO::FETCH_COLUMN);
    
    echo "<h3>Created Tables:</h3>";
    echo "<ul>";
    foreach ($tables as $table) {
        echo "<li>$table</li>";
    }
    echo "</ul>";
    
    // Check if admin user exists
    $stmt = $pdo->prepare("SELECT COUNT(*) FROM users WHERE k_rol = '1'");
    $stmt->execute();
    $adminCount = $stmt->fetchColumn();
    
    if ($adminCount == 0) {
        echo "<p>⚠️ No admin user found. Creating default admin...</p>";
        
        $stmt = $pdo->prepare("INSERT INTO users (k_ip, k_browser, k_os, k_time, k_key, k_adi, k_lastlogin, k_ekleyen, k_updatesync, k_rol, k_premium, k_image) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
        $stmt->execute([
            '127.0.0.1',
            'Chrome',
            'Windows',
            '2024-12-31',
            'admin123',
            'Admin',
            date('d.m.y H:i:s'),
            'System',
            date('d.m.y H:i'),
            '1',
            '1',
            'https://i.hizliresim.com/jehjlgr.jpg'
        ]);
        
        echo "<p>✅ Admin user created!</p>";
        echo "<p><strong>Admin Login Key:</strong> admin123</p>";
    } else {
        echo "<p>✅ Admin user already exists!</p>";
    }
    
    echo "<h3>🎉 Setup Complete!</h3>";
    echo "<p><a href='pages/login.php?alert=success' style='background: #4CAF50; color: white; padding: 10px 20px; text-decoration: none; border-radius: 5px;'>Go to Login Page</a></p>";
    echo "<p><a href='/' style='background: #2196F3; color: white; padding: 10px 20px; text-decoration: none; border-radius: 5px; margin-left: 10px;'>Go to Home</a></p>";
    
} catch (PDOException $e) {
    echo "<p>❌ Database Error: " . $e->getMessage() . "</p>";
    echo "<p>Make sure MySQL is running in XAMPP Control Panel.</p>";
}
?>

<style>
body {
    font-family: Arial, sans-serif;
    max-width: 800px;
    margin: 50px auto;
    padding: 20px;
    background: #f5f5f5;
}
h1 {
    color: #333;
    text-align: center;
}
p {
    background: white;
    padding: 10px;
    border-radius: 5px;
    margin: 10px 0;
}
ul {
    background: white;
    padding: 20px;
    border-radius: 5px;
}
</style>