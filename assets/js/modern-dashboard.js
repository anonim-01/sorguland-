/**
 * Modern Dashboard JavaScript
 * Enhanced interactions and animations
 */

class ModernDashboard {
    constructor() {
        this.init();
    }

    init() {
        this.setupAnimations();
        this.setupInteractions();
        this.setupTheme();
        this.setupNotifications();
        this.setupCounters();
        this.setupParticles();
    }

    setupAnimations() {
        // Intersection Observer for scroll animations
        const observerOptions = {
            threshold: 0.1,
            rootMargin: '0px 0px -50px 0px'
        };

        const observer = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    entry.target.classList.add('animate-in');
                }
            });
        }, observerOptions);

        // Observe all animatable elements
        document.querySelectorAll('.stats-card, .modern-card, .chat-container, .rules-container, .account-table, .news-container').forEach(el => {
            observer.observe(el);
        });
    }

    setupInteractions() {
        // Enhanced hover effects for stats cards
        document.querySelectorAll('.stats-card').forEach(card => {
            card.addEventListener('mouseenter', () => {
                this.animateStatsCard(card, true);
            });
            
            card.addEventListener('mouseleave', () => {
                this.animateStatsCard(card, false);
            });
        });

        // Smooth scrolling for navigation
        document.querySelectorAll('a[href^="#"]').forEach(anchor => {
            anchor.addEventListener('click', (e) => {
                e.preventDefault();
                const target = document.querySelector(anchor.getAttribute('href'));
                if (target) {
                    target.scrollIntoView({
                        behavior: 'smooth',
                        block: 'start'
                    });
                }
            });
        });

        // Enhanced button interactions
        document.querySelectorAll('.modern-btn').forEach(btn => {
            btn.addEventListener('click', (e) => {
                this.createRippleEffect(e, btn);
            });
        });
    }

    animateStatsCard(card, isHover) {
        const icon = card.querySelector('.stats-icon');
        const number = card.querySelector('.stats-number');
        
        if (isHover) {
            card.style.transform = 'translateY(-10px) scale(1.02)';
            card.style.boxShadow = '0 20px 40px rgba(0, 0, 0, 0.3)';
            if (icon) icon.style.transform = 'scale(1.1) rotate(5deg)';
            if (number) number.style.transform = 'scale(1.05)';
        } else {
            card.style.transform = 'translateY(0) scale(1)';
            card.style.boxShadow = '';
            if (icon) icon.style.transform = 'scale(1) rotate(0deg)';
            if (number) number.style.transform = 'scale(1)';
        }
    }

    createRippleEffect(event, element) {
        const ripple = document.createElement('span');
        const rect = element.getBoundingClientRect();
        const size = Math.max(rect.width, rect.height);
        const x = event.clientX - rect.left - size / 2;
        const y = event.clientY - rect.top - size / 2;
        
        ripple.style.cssText = `
            position: absolute;
            width: ${size}px;
            height: ${size}px;
            left: ${x}px;
            top: ${y}px;
            background: rgba(255, 255, 255, 0.3);
            border-radius: 50%;
            transform: scale(0);
            animation: ripple 0.6s ease-out;
            pointer-events: none;
        `;
        
        element.style.position = 'relative';
        element.style.overflow = 'hidden';
        element.appendChild(ripple);
        
        setTimeout(() => {
            ripple.remove();
        }, 600);
    }

    setupTheme() {
        // Dynamic theme switching
        const themeToggle = document.createElement('button');
        themeToggle.innerHTML = '<i class="fas fa-moon"></i>';
        themeToggle.className = 'theme-toggle';
        themeToggle.style.cssText = `
            position: fixed;
            top: 20px;
            right: 20px;
            width: 50px;
            height: 50px;
            border-radius: 50%;
            border: none;
            background: var(--gradient-primary);
            color: white;
            cursor: pointer;
            z-index: 1000;
            transition: all 0.3s ease;
            box-shadow: var(--shadow-lg);
        `;
        
        document.body.appendChild(themeToggle);
        
        themeToggle.addEventListener('click', () => {
            document.body.classList.toggle('light-theme');
            const icon = themeToggle.querySelector('i');
            icon.className = document.body.classList.contains('light-theme') 
                ? 'fas fa-sun' 
                : 'fas fa-moon';
        });
    }

    setupNotifications() {
        // Enhanced notification system
        window.showNotification = (message, type = 'info', duration = 5000) => {
            const notification = document.createElement('div');
            notification.className = `modern-notification ${type}`;
            notification.innerHTML = `
                <div class="notification-content">
                    <i class="fas fa-${this.getNotificationIcon(type)}"></i>
                    <span>${message}</span>
                </div>
                <button class="notification-close">
                    <i class="fas fa-times"></i>
                </button>
            `;
            
            notification.style.cssText = `
                position: fixed;
                top: 20px;
                right: 20px;
                background: var(--card-bg);
                border: 1px solid var(--border-color);
                border-radius: 12px;
                padding: 1rem;
                min-width: 300px;
                z-index: 1001;
                transform: translateX(100%);
                transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
                box-shadow: var(--shadow-lg);
            `;
            
            document.body.appendChild(notification);
            
            // Animate in
            setTimeout(() => {
                notification.style.transform = 'translateX(0)';
            }, 100);
            
            // Auto remove
            setTimeout(() => {
                this.removeNotification(notification);
            }, duration);
            
            // Manual close
            notification.querySelector('.notification-close').addEventListener('click', () => {
                this.removeNotification(notification);
            });
        };
    }

    getNotificationIcon(type) {
        const icons = {
            success: 'check-circle',
            error: 'exclamation-circle',
            warning: 'exclamation-triangle',
            info: 'info-circle'
        };
        return icons[type] || 'info-circle';
    }

    removeNotification(notification) {
        notification.style.transform = 'translateX(100%)';
        setTimeout(() => {
            notification.remove();
        }, 300);
    }

    setupCounters() {
        // Animated counters for stats
        const animateCounter = (element, target) => {
            let current = 0;
            const increment = target / 100;
            const timer = setInterval(() => {
                current += increment;
                if (current >= target) {
                    current = target;
                    clearInterval(timer);
                }
                element.textContent = Math.floor(current);
            }, 20);
        };

        // Observe stats numbers for animation
        const statsObserver = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    const target = parseInt(entry.target.textContent) || 0;
                    if (target > 0) {
                        animateCounter(entry.target, target);
                    }
                    statsObserver.unobserve(entry.target);
                }
            });
        });

        document.querySelectorAll('.stats-number').forEach(el => {
            if (!isNaN(parseInt(el.textContent))) {
                statsObserver.observe(el);
            }
        });
    }

    setupParticles() {
        // Create floating particles effect
        const particleContainer = document.createElement('div');
        particleContainer.className = 'particle-container';
        particleContainer.style.cssText = `
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            pointer-events: none;
            z-index: -1;
        `;
        
        document.body.appendChild(particleContainer);
        
        for (let i = 0; i < 20; i++) {
            this.createParticle(particleContainer);
        }
    }

    createParticle(container) {
        const particle = document.createElement('div');
        particle.className = 'particle';
        
        const size = Math.random() * 4 + 2;
        const x = Math.random() * window.innerWidth;
        const y = Math.random() * window.innerHeight;
        const duration = Math.random() * 20 + 10;
        
        particle.style.cssText = `
            position: absolute;
            width: ${size}px;
            height: ${size}px;
            background: rgba(99, 102, 241, 0.3);
            border-radius: 50%;
            left: ${x}px;
            top: ${y}px;
            animation: float ${duration}s infinite linear;
        `;
        
        container.appendChild(particle);
        
        // Remove and recreate after animation
        setTimeout(() => {
            particle.remove();
            this.createParticle(container);
        }, duration * 1000);
    }
}

// Enhanced Chat System
class ModernChat {
    constructor() {
        this.container = document.getElementById('chat-container');
        this.form = document.getElementById('chat-form');
        this.input = document.getElementById('chat-message');
        this.init();
    }

    init() {
        if (!this.container || !this.form || !this.input) return;
        
        this.setupEventListeners();
        this.setupAutoResize();
        this.setupTypingIndicator();
        this.fetchMessages();
        this.startAutoRefresh();
    }

    setupEventListeners() {
        this.form.addEventListener('submit', (e) => {
            e.preventDefault();
            this.sendMessage();
        });

        this.input.addEventListener('keydown', (e) => {
            if (e.key === 'Enter' && !e.shiftKey) {
                e.preventDefault();
                this.sendMessage();
            }
        });
    }

    setupAutoResize() {
        this.input.addEventListener('input', () => {
            this.input.style.height = 'auto';
            this.input.style.height = (this.input.scrollHeight) + 'px';
        });
    }

    setupTypingIndicator() {
        let typingTimer;
        this.input.addEventListener('input', () => {
            clearTimeout(typingTimer);
            this.showTypingIndicator();
            
            typingTimer = setTimeout(() => {
                this.hideTypingIndicator();
            }, 1000);
        });
    }

    showTypingIndicator() {
        // Implementation for typing indicator
    }

    hideTypingIndicator() {
        // Implementation for hiding typing indicator
    }

    async fetchMessages() {
        try {
            const response = await fetch('api/get_messages.php');
            const data = await response.text();
            this.container.innerHTML = data;
            this.scrollToBottom();
        } catch (error) {
            this.container.innerHTML = `
                <div class="error-message">
                    <i class="fas fa-exclamation-triangle"></i>
                    Mesajlar yüklenirken hata oluştu.
                </div>
            `;
        }
    }

    async sendMessage() {
        const message = this.input.value.trim();
        if (!message) return;

        const sendBtn = this.form.querySelector('button[type="submit"]');
        this.toggleSendButton(sendBtn, true);

        try {
            const response = await fetch('api/send_message.php', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/x-www-form-urlencoded',
                },
                body: `message=${encodeURIComponent(message)}`
            });

            const result = await response.text();
            this.handleSendResponse(result);
            
            if (result === 'success' || !['swear', 'limit', 'numeric', 'special'].includes(result)) {
                this.input.value = '';
                this.fetchMessages();
            }
        } catch (error) {
            window.showNotification('Mesaj gönderilirken hata oluştu.', 'error');
        } finally {
            this.toggleSendButton(sendBtn, false);
        }
    }

    handleSendResponse(response) {
        const messages = {
            swear: 'Küfür etmek yasaktır.',
            limit: 'Hız limiti aşıldı, lütfen bir süre bekleyin.',
            numeric: 'Sohbetimizde sayısal veri kullanımına izin vermiyoruz.',
            special: 'Özel karakterler kullanılamaz.'
        };

        if (messages[response]) {
            window.showNotification(messages[response], 'error');
        } else {
            window.showNotification('Mesaj gönderildi!', 'success');
        }
    }

    toggleSendButton(button, isLoading) {
        if (isLoading) {
            button.disabled = true;
            button.innerHTML = '<i class="fas fa-spinner fa-spin"></i>';
        } else {
            button.disabled = false;
            button.innerHTML = '<i class="fas fa-paper-plane"></i>';
        }
    }

    scrollToBottom() {
        this.container.scrollTop = this.container.scrollHeight;
    }

    startAutoRefresh() {
        setInterval(() => {
            this.fetchMessages();
        }, 3000);
    }
}

// Initialize when DOM is loaded
document.addEventListener('DOMContentLoaded', () => {
    new ModernDashboard();
    new ModernChat();
});

// Add CSS animations
const style = document.createElement('style');
style.textContent = `
    @keyframes ripple {
        to {
            transform: scale(4);
            opacity: 0;
        }
    }

    @keyframes float {
        0%, 100% {
            transform: translateY(0px) rotate(0deg);
        }
        50% {
            transform: translateY(-20px) rotate(180deg);
        }
    }

    .animate-in {
        animation: fadeInUp 0.8s ease forwards;
    }

    .modern-notification {
        border-left: 4px solid var(--accent-color);
    }

    .modern-notification.success {
        border-left-color: var(--success-color);
    }

    .modern-notification.error {
        border-left-color: var(--danger-color);
    }

    .modern-notification.warning {
        border-left-color: var(--warning-color);
    }

    .notification-content {
        display: flex;
        align-items: center;
        gap: 0.75rem;
        color: var(--text-primary);
    }

    .notification-close {
        position: absolute;
        top: 0.5rem;
        right: 0.5rem;
        background: none;
        border: none;
        color: var(--text-secondary);
        cursor: pointer;
        padding: 0.25rem;
        border-radius: 4px;
        transition: all 0.2s ease;
    }

    .notification-close:hover {
        background: var(--border-color);
        color: var(--text-primary);
    }

    .error-message {
        text-align: center;
        color: var(--danger-color);
        padding: 2rem;
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 0.5rem;
    }

    .theme-toggle:hover {
        transform: scale(1.1);
        box-shadow: 0 8px 25px rgba(0, 0, 0, 0.3);
    }

    /* Light theme styles */
    .light-theme {
        --primary-bg: #ffffff;
        --secondary-bg: #f8fafc;
        --card-bg: #ffffff;
        --text-primary: #1a202c;
        --text-secondary: #4a5568;
        --border-color: #e2e8f0;
    }

    .light-theme .animated-bg::before {
        background: 
            radial-gradient(circle at 20% 80%, rgba(120, 119, 198, 0.1) 0%, transparent 50%),
            radial-gradient(circle at 80% 20%, rgba(255, 119, 198, 0.1) 0%, transparent 50%),
            radial-gradient(circle at 40% 40%, rgba(120, 219, 255, 0.1) 0%, transparent 50%);
    }
`;

document.head.appendChild(style);