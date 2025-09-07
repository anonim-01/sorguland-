<?php
error_reporting(0);
session_start();

include '../../server/database.php';
include '../../server/rolecontrol.php';

$sql = "SELECT * FROM messages ORDER BY time DESC LIMIT 10";
$stmt = $db->prepare($sql);
$stmt->execute();
$rows = $stmt->fetchAll(PDO::FETCH_ASSOC);

if (empty($rows)) {
    echo '<div class="no-messages">
            <i class="fas fa-comments"></i>
            <p>Henüz mesaj bulunmuyor. İlk mesajı siz gönderin!</p>
          </div>';
    exit;
}

foreach (array_reverse($rows) as $row) {
    $userImage = !empty($row['image']) ? $row['image'] : '../assets/img/default-avatar.png';
    $userName = htmlspecialchars($row['username']);
    $message = htmlspecialchars($row['message']);
    $time = date('H:i', strtotime($row['time']));
    
    // Determine user role and styling
    $userClass = 'user-normal';
    $userBadge = '';
    
    if ($row['admin'] == 1) {
        $userClass = 'user-admin';
        $userBadge = '<span class="user-badge admin">ADMIN</span>';
    } elseif ($row['premium'] == 1) {
        $userClass = 'user-premium';
        $userBadge = '<span class="user-badge premium">VIP</span>';
    }
    
    echo '<div class="message-item" data-message-id="' . $row['id'] . '">
            <div class="message-avatar">
                <img src="' . $userImage . '" alt="' . $userName . '" onerror="this.src=\'../assets/img/default-avatar.png\'">
                <div class="user-status online"></div>
            </div>
            <div class="message-content">
                <div class="message-header">
                    <span class="username ' . $userClass . '">' . $userName . '</span>
                    ' . $userBadge . '
                    <span class="message-time">' . $time . '</span>
                </div>
                <div class="message-text">' . $message . '</div>
            </div>
          </div>';
}
?>

<style>
.no-messages {
    text-align: center;
    padding: 3rem 1rem;
    color: var(--text-secondary);
}

.no-messages i {
    font-size: 3rem;
    margin-bottom: 1rem;
    opacity: 0.5;
}

.no-messages p {
    margin: 0;
    font-size: 1rem;
}

.message-item {
    display: flex;
    gap: 1rem;
    padding: 1rem;
    margin-bottom: 0.5rem;
    border-radius: 12px;
    background: var(--secondary-bg);
    transition: all 0.3s ease;
    animation: messageSlideIn 0.3s ease;
}

.message-item:hover {
    background: var(--border-color);
    transform: translateX(5px);
}

.message-avatar {
    position: relative;
    flex-shrink: 0;
}

.message-avatar img {
    width: 40px;
    height: 40px;
    border-radius: 50%;
    border: 2px solid var(--border-color);
    transition: all 0.3s ease;
}

.message-item:hover .message-avatar img {
    border-color: var(--accent-color);
    transform: scale(1.05);
}

.user-status {
    position: absolute;
    bottom: 2px;
    right: 2px;
    width: 12px;
    height: 12px;
    border-radius: 50%;
    border: 2px solid var(--card-bg);
}

.user-status.online {
    background: var(--success-color);
    box-shadow: 0 0 6px var(--success-color);
}

.message-content {
    flex: 1;
    min-width: 0;
}

.message-header {
    display: flex;
    align-items: center;
    gap: 0.5rem;
    margin-bottom: 0.25rem;
    flex-wrap: wrap;
}

.username {
    font-weight: 600;
    font-size: 0.9rem;
}

.username.user-admin {
    color: #ff4757;
    text-shadow: 0 0 10px rgba(255, 71, 87, 0.3);
}

.username.user-premium {
    color: #ffd700;
    text-shadow: 0 0 10px rgba(255, 215, 0, 0.3);
}

.username.user-normal {
    color: var(--text-primary);
}

.user-badge {
    font-size: 0.7rem;
    font-weight: 700;
    padding: 0.2rem 0.5rem;
    border-radius: 10px;
    text-transform: uppercase;
    letter-spacing: 0.5px;
}

.user-badge.admin {
    background: linear-gradient(135deg, #ff4757, #ff3742);
    color: white;
    box-shadow: 0 2px 8px rgba(255, 71, 87, 0.3);
}

.user-badge.premium {
    background: linear-gradient(135deg, #ffd700, #ffed4e);
    color: #333;
    box-shadow: 0 2px 8px rgba(255, 215, 0, 0.3);
}

.message-time {
    font-size: 0.75rem;
    color: var(--text-secondary);
    margin-left: auto;
}

.message-text {
    color: var(--text-primary);
    line-height: 1.4;
    word-wrap: break-word;
    font-size: 0.9rem;
}

@keyframes messageSlideIn {
    from {
        opacity: 0;
        transform: translateY(10px);
    }
    to {
        opacity: 1;
        transform: translateY(0);
    }
}

/* Responsive design */
@media (max-width: 768px) {
    .message-item {
        padding: 0.75rem;
        gap: 0.75rem;
    }
    
    .message-avatar img {
        width: 32px;
        height: 32px;
    }
    
    .message-header {
        font-size: 0.85rem;
    }
    
    .message-text {
        font-size: 0.85rem;
    }
}
</style>