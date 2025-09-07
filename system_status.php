<?php
// System Status Check
header('Content-Type: text/html; charset=utf-8');
?>
<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Sistem Durumu - Panel Checker</title>
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: linear-gradient(135deg, #0a0a0a 0%, #1a1a1a 100%);
            color: #fff;
            margin: 0;
            padding: 20px;
            min-height: 100vh;
        }
        .container {
            max-width: 1000px;
            margin: 0 auto;
        }
        .header {
            text-align: center;
            margin-bottom: 40px;
        }
        .header h1 {
            color: #6366f1;
            font-size: 2.5rem;
            margin-bottom: 10px;
        }
        .status-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
            gap: 20px;
            margin-bottom: 30px;
        }
        .status-card {
            background: rgba(255, 255, 255, 0.05);
            border: 1px solid rgba(255, 255, 255, 0.1);
            border-radius: 15px;
            padding: 20px;
            backdrop-filter: blur(10px);
        }
        .status-card h3 {
            color: #6366f1;
            margin-top: 0;
            display: flex;
            align-items: center;
            gap: 10px;
        }
        .status-item {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 10px 0;
            border-bottom: 1px solid rgba(255, 255, 255, 0.1);
        }
        .status-item:last-child {
            border-bottom: none;
        }
        .status-ok {
            color: #10b981;
            font-weight: bold;
        }
        .status-error {
            color: #ef4444;
            font-weight: bold;
        }
        .status-warning {
            color: #f59e0b;
            font-weight: bold;
        }
        .btn {
            display: inline-block;
            padding: 12px 24px;
            background: linear-gradient(135deg, #6366f1, #8b5cf6);
            color: white;
            text-decoration: none;
            border-radius: 8px;
            font-weight: 500;
            transition: all 0.3s ease;
            margin: 5px;
        }
        .btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 10px 20px rgba(99, 102, 241, 0.3);
            color: white;
            text-decoration: none;
        }
        .btn.success {
            background: linear-gradient(135deg, #10b981, #059669);
        }
        .btn.warning {
            background: linear-gradient(135deg, #f59e0b, #d97706);
        }
        .actions {
            text-align: center;
            margin-top: 30px;
        }
        .info-box {
            background: rgba(59, 130, 246, 0.1);
            border: 1px solid #3b82f6;
            border-radius: 8px;
            padding: 15px;
            margin: 20px 0;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h1>🚀 Sistem Durumu</h1>
            <p>Panel Checker - Sistem Kontrol Paneli</p>
        </div>

        <div class="status-grid">
            <!-- PHP Status -->
            <div class="status-card">
                <h3>🐘 PHP Durumu</h3>
                <div class="status-item">
                    <span>PHP Versiyonu</span>
                    <span class="status-ok"><?= phpversion() ?></span>
                </div>
                <div class="status-item">
                    <span>PDO MySQL</span>
                    <span class="<?= extension_loaded('pdo_mysql') ? 'status-ok' : 'status-error' ?>">
                        <?= extension_loaded('pdo_mysql') ? '✅ Aktif' : '❌ Pasif' ?>
                    </span>
                </div>
                <div class="status-item">
                    <span>Session</span>
                    <span class="<?= extension_loaded('session') ? 'status-ok' : 'status-error' ?>">
                        <?= extension_loaded('session') ? '✅ Aktif' : '❌ Pasif' ?>
                    </span>
                </div>
            </div>

            <!-- Database Status -->
            <div class="status-card">
                <h3>🗄️ Veritabanı Durumu</h3>
                <?php
                try {
                    $pdo = new PDO("mysql:host=localhost", "root", "");
                    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                    echo '<div class="status-item"><span>MySQL Bağlantısı</span><span class="status-ok">✅ Başarılı</span></div>';
                    
                    // Check if database exists
                    $result = $pdo->query("SHOW DATABASES LIKE 'agahyoutube'");
                    $dbExists = $result->rowCount() > 0;
                    echo '<div class="status-item"><span>agahyoutube DB</span><span class="' . ($dbExists ? 'status-ok' : 'status-error') . '">' . ($dbExists ? '✅ Mevcut' : '❌ Yok') . '</span></div>';
                    
                    if ($dbExists) {
                        $pdo->exec("USE agahyoutube");
                        $result = $pdo->query("SHOW TABLES");
                        $tableCount = $result->rowCount();
                        echo '<div class="status-item"><span>Tablo Sayısı</span><span class="status-ok">' . $tableCount . '</span></div>';
                        
                        // Check users table
                        try {
                            $result = $pdo->query("SELECT COUNT(*) FROM users");
                            $userCount = $result->fetchColumn();
                            echo '<div class="status-item"><span>Kullanıcı Sayısı</span><span class="status-ok">' . $userCount . '</span></div>';
                        } catch (Exception $e) {
                            echo '<div class="status-item"><span>Users Tablosu</span><span class="status-error">❌ Hata</span></div>';
                        }
                    }
                } catch (PDOException $e) {
                    echo '<div class="status-item"><span>MySQL Bağlantısı</span><span class="status-error">❌ Başarısız</span></div>';
                    echo '<div class="status-item"><span>Hata</span><span class="status-error">' . $e->getMessage() . '</span></div>';
                }
                ?>
            </div>

            <!-- File System Status -->
            <div class="status-card">
                <h3>📁 Dosya Sistemi</h3>
                <div class="status-item">
                    <span>XAMPP Dizini</span>
                    <span class="<?= is_dir('C:/xampp') ? 'status-ok' : 'status-error' ?>">
                        <?= is_dir('C:/xampp') ? '✅ Mevcut' : '❌ Yok' ?>
                    </span>
                </div>
                <div class="status-item">
                    <span>htdocs Yazılabilir</span>
                    <span class="<?= is_writable(__DIR__) ? 'status-ok' : 'status-warning' ?>">
                        <?= is_writable(__DIR__) ? '✅ Evet' : '⚠️ Hayır' ?>
                    </span>
                </div>
                <div class="status-item">
                    <span>Assets Klasörü</span>
                    <span class="<?= is_dir(__DIR__ . '/assets') ? 'status-ok' : 'status-error' ?>">
                        <?= is_dir(__DIR__ . '/assets') ? '✅ Mevcut' : '❌ Yok' ?>
                    </span>
                </div>
                <div class="status-item">
                    <span>Pages Klasörü</span>
                    <span class="<?= is_dir(__DIR__ . '/pages') ? 'status-ok' : 'status-error' ?>">
                        <?= is_dir(__DIR__ . '/pages') ? '✅ Mevcut' : '❌ Yok' ?>
                    </span>
                </div>
            </div>

            <!-- Server Status -->
            <div class="status-card">
                <h3>🌐 Sunucu Durumu</h3>
                <div class="status-item">
                    <span>Server Software</span>
                    <span class="status-ok"><?= $_SERVER['SERVER_SOFTWARE'] ?? 'Bilinmiyor' ?></span>
                </div>
                <div class="status-item">
                    <span>Document Root</span>
                    <span class="status-ok"><?= $_SERVER['DOCUMENT_ROOT'] ?? 'Bilinmiyor' ?></span>
                </div>
                <div class="status-item">
                    <span>Server Port</span>
                    <span class="status-ok"><?= $_SERVER['SERVER_PORT'] ?? 'Bilinmiyor' ?></span>
                </div>
                <div class="status-item">
                    <span>HTTPS</span>
                    <span class="<?= (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on') ? 'status-ok' : 'status-warning' ?>">
                        <?= (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on') ? '✅ Aktif' : '⚠️ Pasif' ?>
                    </span>
                </div>
            </div>
        </div>

        <div class="info-box">
            <h4>📋 Sistem Bilgileri</h4>
            <p><strong>Zaman:</strong> <?= date('d.m.Y H:i:s') ?></p>
            <p><strong>Timezone:</strong> <?= date_default_timezone_get() ?></p>
            <p><strong>Memory Limit:</strong> <?= ini_get('memory_limit') ?></p>
            <p><strong>Max Execution Time:</strong> <?= ini_get('max_execution_time') ?> saniye</p>
        </div>

        <div class="actions">
            <a href="/" class="btn">🏠 Ana Sayfa</a>
            <a href="pages/login.php?alert=error" class="btn success">🔐 Giriş Yap</a>
            <a href="setup_database.php" class="btn warning">🛠️ Veritabanı Kurulumu</a>
            <a href="?refresh=1" class="btn">🔄 Yenile</a>
        </div>
    </div>
</body>
</html>