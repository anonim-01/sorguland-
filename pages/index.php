<?php
require '../server/database.php';

$customCSS = array(
    '<link href="../assets/plugins/apexcharts/apexcharts.css" rel="stylesheet">',
    '<link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">'
);

$customJAVA = array(
    '<script src="../assets/plugins/apexcharts/apexcharts.min.js"></script>',
    '<script src="../assets/plugins/sparkline/jquery.sparkline.min.js"></script>',
    '<script src="../assets/js/pages/dashboard.js"></script>'
);

$page_title = 'Panel';

include('inc/header_main.php');
include('inc/header_sidebar.php');
include('inc/header_native.php');

$TotalAccountQry = $db->query("SELECT * FROM users");
$TotalAccountCount = $TotalAccountQry->rowCount();

$OnlineTimezone = date('d.m.y H:i');
$OnlineAccountQry = $db->query("SELECT * FROM users WHERE k_updatesync = '$OnlineTimezone'");
$OnlineCount = $OnlineAccountQry->rowCount();

$MembershipSSID = $_SESSION['GET_USER_SSID'];
$MemberhsipQuery = $db->query("SELECT * FROM users WHERE k_key = '$MembershipSSID'");

while ($MembershipData = $MemberhsipQuery->fetch()) {
    $Level = $MembershipData['k_rol'];
    $getNick = $MembershipData['k_adi'];
    $short = substr($MembershipData['k_time'], 0, 11);
    $short2 = str_replace("-", ".", $short);
    $endtime = $short2;
}

if ($Level == "1") {
    $membership = "Administrator";
} else {
    $membership = "Normal Üye";
}
?>

<div class="animated-bg"></div>

<!-- Basitleştirilmiş Snow Effect -->
<div class="snow-container" style="display: none;"> <!-- Varsayılan olarak gizli -->
    <?php for ($i = 0; $i < 20; $i++): ?> <!-- 50'den 20'ye düşürüldü -->
        <i class="snow" style="
            --sw-f: <?= rand(0, 1) ?>px;
            --sw-s: <?= rand(3, 8) ?>px;
            --sw-l: <?= rand(0, 100) ?>vw;
            --sw25-tx: <?= rand(-4, 4) ?>rem;
            --sw75-tx: <?= rand(-4, 4) ?>rem;
            --sw-d: <?= rand(1, 10) ?>.<?= rand(0, 9) ?>s;
            --sw-t: <?= rand(10, 60) ?>s;
        "></i>
    <?php endfor; ?>
</div>

<div class="main-wrapper" style="padding: 2rem;">
    <!-- Welcome Section -->
    <div class="row mb-4">
        <div class="col-12">
            <div class="modern-card" style="text-align: center; animation: fadeInUp 0.8s ease;">
                <h1 style="font-size: 3rem; font-weight: 700; margin-bottom: 1rem; background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); -webkit-background-clip: text; -webkit-text-fill-color: transparent; background-clip: text;">
                    Hoş Geldiniz, <?= $getNick ?>
                </h1>
                <p style="font-size: 1.2rem; color: var(--text-secondary); margin-bottom: 2rem;">
                    Gelişmiş sorgu sistemine hoş geldiniz. Güvenli ve hızlı sorgulama deneyimi için hazırız.
                </p>
                <div style="display: flex; gap: 1rem; justify-content: center; flex-wrap: wrap;">
                    <a href="tcsorgu" class="modern-btn">
                        <i class="fas fa-search"></i>
                        TC Sorgu
                    </a>
                    <a href="gsmtc" class="modern-btn secondary">
                        <i class="fas fa-mobile-alt"></i>
                        GSM Sorgu
                    </a>
                    <a href="adres" class="modern-btn success">
                        <i class="fas fa-map-marker-alt"></i>
                        Adres Sorgu
                    </a>
                </div>
            </div>
        </div>
    </div>

    <!-- Statistics Cards -->
    <div class="row mb-4">
        <div class="col-lg-3 col-md-6 mb-4">
            <div class="stats-card">
                <div class="stats-icon">
                    <i class="fas fa-users"></i>
                </div>
                <div class="stats-number"><?= $TotalAccountCount ?></div>
                <div class="stats-label">Kayıtlı Kullanıcılar</div>
            </div>
        </div>
        <div class="col-lg-3 col-md-6 mb-4">
            <div class="stats-card success">
                <div class="stats-icon success">
                    <i class="fas fa-rocket"></i>
                </div>
                <div class="stats-number"><?= $OnlineCount ?></div>
                <div class="stats-label">Aktif Kullanıcılar</div>
            </div>
        </div>
        <div class="col-lg-3 col-md-6 mb-4">
            <div class="stats-card warning">
                <div class="stats-icon warning">
                    <i class="fas fa-wallet"></i>
                </div>
                <div class="stats-number">0 $</div>
                <div class="stats-label">Toplam Bakiye</div>
            </div>
        </div>
        <div class="col-lg-3 col-md-6 mb-4">
            <div class="stats-card danger">
                <div class="stats-icon danger">
                    <i class="fas fa-crown"></i>
                </div>
                <div class="stats-number" style="font-size: 1.5rem;"><?= $membership ?></div>
                <div class="stats-label">Üyelik Durumu</div>
            </div>
        </div>
    </div>

    <!-- Main Content Row -->
    <div class="row">
        <!-- Chat Section -->
        <div class="col-lg-8 mb-4">
            <div class="chat-container">
                <div class="chat-header">
                    <h3>Genel Sohbet</h3>
                    <div class="chat-status">
                        <span>Çevrimiçi</span>
                    </div>
                </div>
                <div class="chat-messages" id="chat-container">
                    <div class="loading-spinner"></div>
                </div>
                <div class="chat-input-container">
                    <form id="chat-form" style="display: flex; gap: 1rem; width: 100%;">
                        <input type="text" class="chat-input" id="chat-message" autocomplete="off" maxlength="75" minlength="1" name="message" placeholder="Mesajınızı yazın..." required>
                        <button type="submit" class="chat-send-btn">
                            <i class="fas fa-paper-plane"></i>
                        </button>
                    </form>
                </div>
            </div>
        </div>

        <!-- Rules Section -->
        <div class="col-lg-4 mb-4">
            <div class="rules-container">
                <div class="rules-header">
                    <div class="rules-icon">
                        <i class="fas fa-shield-alt"></i>
                    </div>
                    <h3 class="rules-title">Kurallar</h3>
                </div>
                <div class="rules-list">
                    <div class="rule-item">
                        <div class="rule-number">1</div>
                        <div class="rule-text">Hesabınızı başka birisi ile paylaştığınızda kalıcı bir şekilde banlanıcaksınız.</div>
                    </div>
                    <div class="rule-item">
                        <div class="rule-number">2</div>
                        <div class="rule-text">Ünlülere ve devlet yetkililerine sorgu atmak kesinlikle yasaktır.</div>
                    </div>
                    <div class="rule-item">
                        <div class="rule-number">3</div>
                        <div class="rule-text">Başka birinin ucuza hesabı sattığı üyelikler, fark edilirse kalıcı şekilde ban yiyecektir.</div>
                    </div>
                    <div class="rule-item">
                        <div class="rule-number">4</div>
                        <div class="rule-text">Herhangi bir teknik sorunda iade geçilmez.</div>
                    </div>
                    <div class="rule-item">
                        <div class="rule-number">5</div>
                        <div class="rule-text">Ban yiyen kişiler tekrar üyelik satın alabilirler.</div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Account Information -->
    <div class="row mb-4">
        <div class="col-12">
            <div class="account-table">
                <div class="table-header">
                    <h3 class="table-title">
                        <div class="table-icon">
                            <i class="fas fa-user-circle"></i>
                        </div>
                        Hesap Bilgileriniz
                    </h3>
                </div>
                <div class="table-responsive">
                    <table class="modern-table">
                        <thead>
                            <tr>
                                <th>Kullanıcı Adı</th>
                                <th>Kalan Zaman</th>
                                <th>İşletim Sistemi</th>
                                <th>Tarayıcı</th>
                                <th>Son Giriş Tarihi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $query = $db->query("SELECT * FROM `users` WHERE `k_key` = '$MembershipSSID'");
                            while ($getvar = $query->fetch()) {
                                $uyetarih = $getvar['k_time'];
                                if ($uyetarih != "") {
                                    $nowDate = date("Y-m-d");
                                    $d1 = new DateTime($nowDate);
                                    $d2 = new DateTime($uyetarih);
                                    $gun = $d1->diff($d2)->days;
                                }
                            ?>
                                <tr>
                                    <td>
                                        <div style="display: flex; align-items: center; gap: 0.5rem;">
                                            <div style="width: 32px; height: 32px; border-radius: 50%; background: var(--gradient-primary); display: flex; align-items: center; justify-content: center; color: white; font-weight: 600;">
                                                <?= strtoupper(substr($getvar['k_adi'], 0, 1)) ?>
                                            </div>
                                            <?= $getvar['k_adi'] ?>
                                        </div>
                                    </td>
                                    <td>
                                        <span style="background: var(--gradient-success); color: white; padding: 0.25rem 0.75rem; border-radius: 20px; font-size: 0.875rem; font-weight: 500;">
                                            <?= $gun ?> Gün
                                        </span>
                                    </td>
                                    <td>
                                        <div class="platform_icon"><?php getos($getvar['k_os']) ?></div>
                                    </td>
                                    <td><?= $getvar['k_browser'] ?></td>
                                    <td>
                                        <span style="color: var(--text-secondary); font-size: 0.875rem;">
                                            <?= $getvar['k_lastlogin'] ?>
                                        </span>
                                    </td>
                                </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <!-- News Section -->
    <div class="row mb-4">
        <div class="col-12">
            <div class="news-container">
                <div class="news-header">
                    <h3 class="news-title">
                        <div class="news-icon">
                            <i class="fas fa-bullhorn"></i>
                        </div>
                        Duyuru Paneli
                    </h3>
                </div>
                <div class="news-list">
                    <?php
                    $query = $db->query("SELECT * FROM `news` ORDER BY id DESC LIMIT 3");
                    while ($getvar = $query->fetch()) {
                    ?>
                        <div class="news-item">
                            <div class="news-content"><?= $getvar['d_icerik'] ?></div>
                            <div class="news-date">
                                <i class="fas fa-calendar-alt"></i>
                                <?= $getvar['d_time'] ?>
                            </div>
                        </div>
                    <?php } ?>
                </div>
            </div>
        </div>
    </div>

    <!-- Footer -->
    <div class="modern-footer">
        <div class="container">
            <div class="footer-content">
                <div class="footer-quote">
                    <i class="fas fa-quote-left"></i>
                    Courage leads to heaven, fear leads to death.
                </div>
                <div class="footer-copyright">
                    Panel Adı Checker © <?= date('Y') ?>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Enhanced Chat JavaScript -->
<script>
    $(function() {
        var chatContainer = $('#chat-container');
        var chatForm = $('#chat-form');
        var chatMessage = $('#chat-message');

        function fetchMessages() {
            $.ajax({
                url: 'api/get_messages_enhanced.php',
                type: 'GET',
                success: function(data) {
                    chatContainer.html(data);
                    chatContainer.scrollTop(chatContainer.prop('scrollHeight'));
                },
                error: function() {
                    chatContainer.html('<div class="error-message"><i class="fas fa-exclamation-triangle"></i>Mesajlar yüklenirken hata oluştu.</div>');
                }
            });
        }

        // Initial load
        fetchMessages();

        // Auto refresh every 5 seconds (3'ten 5'e çıkarıldı)
        setInterval(fetchMessages, 5000);

        chatForm.on('submit', function(event) {
            event.preventDefault();
            var message = chatMessage.val().trim();

            if (message === '') return;

            // Disable send button temporarily
            var sendBtn = chatForm.find('button[type="submit"]');
            sendBtn.prop('disabled', true);
            sendBtn.html('<i class="fas fa-spinner fa-spin"></i>');

            $.ajax({
                url: 'api/send_message.php',
                type: 'POST',
                data: {
                    message: message
                },
                success: function(response) {
                    if (response == "swear") {
                        toastr.error('Küfür etmek yasaktır.');
                    } else if (response == "limit") {
                        toastr.error("Hız limiti aşıldı, lütfen bir süre bekleyin.");
                    } else if (response == "numeric") {
                        toastr.error("Sohbetimizde sayısal veri kullanımına izin vermiyoruz.");
                    } else if (response == "special") {
                        toastr.error("Özel karakterler kullanılamaz.");
                    } else {
                        toastr.success('Mesaj gönderildi!');
                        fetchMessages(); // Refresh messages immediately
                    }
                    chatMessage.val('');
                },
                error: function() {
                    toastr.error('Mesaj gönderilirken hata oluştu.');
                },
                complete: function() {
                    // Re-enable send button
                    sendBtn.prop('disabled', false);
                    sendBtn.html('<i class="fas fa-paper-plane"></i>');
                }
            });
        });

        // Auto-resize chat input
        chatMessage.on('input', function() {
            this.style.height = 'auto';
            this.style.height = (this.scrollHeight) + 'px';
        });
    });

    // Intersection Observer'ı kaldırıldı - performans için
    // Sadece gerekli olan event listener'lar eklendi
    document.addEventListener('DOMContentLoaded', function() {
        // Basit hover efekti
        document.querySelectorAll('.stats-card').forEach(card => {
            card.addEventListener('mouseenter', function() {
                this.style.transform = 'translateY(-5px)';
            });

            card.addEventListener('mouseleave', function() {
                this.style.transform = 'translateY(0)';
            });
        });
    });

    // Configure toastr
    toastr.options = {
        "closeButton": true,
        "debug": false,
        "newestOnTop": true,
        "progressBar": true,
        "positionClass": "toast-top-right",
        "preventDuplicates": false,
        "onclick": null,
        "showDuration": "300",
        "hideDuration": "1000",
        "timeOut": "5000",
        "extendedTimeOut": "1000",
        "showEasing": "swing",
        "hideEasing": "linear",
        "showMethod": "fadeIn",
        "hideMethod": "fadeOut"
    };

    // Snow effect toggle - kullanıcı tercihine bağlı
    function toggleSnowEffect() {
        const snowContainer = document.querySelector('.snow-container');
        if (snowContainer.style.display === 'none') {
            snowContainer.style.display = 'block';
            localStorage.setItem('snowEffect', 'enabled');
        } else {
            snowContainer.style.display = 'none';
            localStorage.setItem('snowEffect', 'disabled');
        }
    }

    // Sayfa yüklendiğinde kar efekti tercihini kontrol et
    document.addEventListener('DOMContentLoaded', function() {
        const snowEffect = localStorage.getItem('snowEffect');
        const snowContainer = document.querySelector('.snow-container');

        if (snowEffect === 'disabled') {
            snowContainer.style.display = 'none';
        }
    });
</script>

<style>
    /* Performans iyileştirmeleri */
    * {
        box-sizing: border-box;
    }

    .stats-card,
    .modern-card,
    .chat-container,
    .rules-container,
    .account-table,
    .news-container {
        will-change: transform;
        backface-visibility: hidden;
    }

    /* Additional responsive styles */
    @media (max-width: 768px) {
        .main-wrapper {
            padding: 1rem !important;
        }

        .chat-container {
            height: 400px;
        }

        .stats-number {
            font-size: 2rem !important;
        }

        .modern-card h1 {
            font-size: 2rem !important;
        }

        .modern-card p {
            font-size: 1rem !important;
        }

        .modern-card>div {
            flex-direction: column !important;
        }

        .modern-btn {
            width: 100%;
            justify-content: center;
        }
    }

    /* Custom toastr styles */
    .toast-success {
        background: var(--gradient-success) !important;
    }

    .toast-error {
        background: var(--gradient-secondary) !important;
    }

    .toast-info {
        background: var(--gradient-primary) !important;
    }

    .toast-warning {
        background: var(--gradient-warning) !important;
    }

    /* Logo gizleme */
    .header-logo,
    .logo,
    .navbar-brand,
    [class*="logo"] {
        display: none !important;
    }
</style>

<?php include('inc/footer_main.php'); ?>