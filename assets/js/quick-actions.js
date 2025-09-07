/**
 * Quick Actions Widget
 * Floating action button with quick access to common features
 */

class QuickActions {
    constructor() {
        this.isOpen = false;
        this.createWidget();
        this.init();
    }

    createWidget() {
        const quickActionsHTML = `
            <div id="quick-actions" class="quick-actions">
                <div class="quick-actions-backdrop"></div>
                <div class="quick-actions-menu">
                    <a href="tcsorgu" class="quick-action-item" data-tooltip="TC Sorgu">
                        <i class="fas fa-search"></i>
                    </a>
                    <a href="gsmtc" class="quick-action-item" data-tooltip="GSM Sorgu">
                        <i class="fas fa-mobile-alt"></i>
                    </a>
                    <a href="adres" class="quick-action-item" data-tooltip="Adres Sorgu">
                        <i class="fas fa-map-marker-alt"></i>
                    </a>
                    <a href="ailesorgu" class="quick-action-item" data-tooltip="Aile Sorgu">
                        <i class="fas fa-users"></i>
                    </a>
                    <a href="paketler" class="quick-action-item" data-tooltip="Market">
                        <i class="fas fa-shopping-cart"></i>
                    </a>
                </div>
                <button class="quick-actions-toggle" id="quick-actions-toggle">
                    <i class="fas fa-plus"></i>
                </button>
            </div>
        `;

        document.body.insertAdjacentHTML('beforeend', quickActionsHTML);
        this.addStyles();
    }

    addStyles() {
        const style = document.createElement('style');
        style.textContent = `
            .quick-actions {
                position: fixed;
                bottom: 30px;
                right: 30px;
                z-index: 1000;
            }

            .quick-actions-backdrop {
                position: fixed;
                top: 0;
                left: 0;
                width: 100%;
                height: 100%;
                background: rgba(0, 0, 0, 0.3);
                opacity: 0;
                visibility: hidden;
                transition: all 0.3s ease;
                z-index: -1;
            }

            .quick-actions.open .quick-actions-backdrop {
                opacity: 1;
                visibility: visible;
            }

            .quick-actions-menu {
                position: absolute;
                bottom: 70px;
                right: 0;
                display: flex;
                flex-direction: column;
                gap: 15px;
                opacity: 0;
                visibility: hidden;
                transform: translateY(20px);
                transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            }

            .quick-actions.open .quick-actions-menu {
                opacity: 1;
                visibility: visible;
                transform: translateY(0);
            }

            .quick-action-item {
                width: 50px;
                height: 50px;
                border-radius: 50%;
                background: var(--gradient-primary);
                color: white;
                display: flex;
                align-items: center;
                justify-content: center;
                text-decoration: none;
                font-size: 1.2rem;
                box-shadow: 0 4px 15px rgba(0, 0, 0, 0.2);
                transition: all 0.3s ease;
                position: relative;
                transform: scale(0);
                animation: quickActionPop 0.3s ease forwards;
            }

            .quick-action-item:nth-child(1) { animation-delay: 0.1s; }
            .quick-action-item:nth-child(2) { animation-delay: 0.15s; }
            .quick-action-item:nth-child(3) { animation-delay: 0.2s; }
            .quick-action-item:nth-child(4) { animation-delay: 0.25s; }
            .quick-action-item:nth-child(5) { animation-delay: 0.3s; }

            .quick-action-item:hover {
                transform: scale(1.1);
                box-shadow: 0 6px 20px rgba(0, 0, 0, 0.3);
                color: white;
                text-decoration: none;
            }

            .quick-action-item::before {
                content: attr(data-tooltip);
                position: absolute;
                right: 60px;
                top: 50%;
                transform: translateY(-50%);
                background: var(--card-bg);
                color: var(--text-primary);
                padding: 8px 12px;
                border-radius: 6px;
                font-size: 0.875rem;
                white-space: nowrap;
                opacity: 0;
                visibility: hidden;
                transition: all 0.3s ease;
                border: 1px solid var(--border-color);
                box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
            }

            .quick-action-item:hover::before {
                opacity: 1;
                visibility: visible;
                transform: translateY(-50%) translateX(-5px);
            }

            .quick-actions-toggle {
                width: 60px;
                height: 60px;
                border-radius: 50%;
                background: var(--gradient-primary);
                border: none;
                color: white;
                font-size: 1.5rem;
                cursor: pointer;
                box-shadow: 0 6px 20px rgba(0, 0, 0, 0.2);
                transition: all 0.3s ease;
                position: relative;
                overflow: hidden;
            }

            .quick-actions-toggle::before {
                content: '';
                position: absolute;
                top: 0;
                left: 0;
                width: 100%;
                height: 100%;
                background: rgba(255, 255, 255, 0.1);
                border-radius: 50%;
                transform: scale(0);
                transition: transform 0.3s ease;
            }

            .quick-actions-toggle:hover::before {
                transform: scale(1);
            }

            .quick-actions-toggle:hover {
                transform: scale(1.05);
                box-shadow: 0 8px 25px rgba(0, 0, 0, 0.3);
            }

            .quick-actions.open .quick-actions-toggle {
                transform: rotate(45deg);
                background: var(--gradient-secondary);
            }

            @keyframes quickActionPop {
                0% {
                    transform: scale(0);
                    opacity: 0;
                }
                80% {
                    transform: scale(1.1);
                }
                100% {
                    transform: scale(1);
                    opacity: 1;
                }
            }

            /* Mobile responsive */
            @media (max-width: 768px) {
                .quick-actions {
                    bottom: 20px;
                    right: 20px;
                }

                .quick-actions-toggle {
                    width: 50px;
                    height: 50px;
                    font-size: 1.2rem;
                }

                .quick-action-item {
                    width: 45px;
                    height: 45px;
                    font-size: 1rem;
                }

                .quick-actions-menu {
                    bottom: 60px;
                }

                .quick-action-item::before {
                    display: none;
                }
            }

            /* Hide on very small screens */
            @media (max-width: 480px) {
                .quick-actions {
                    display: none;
                }
            }
        `;

        document.head.appendChild(style);
    }

    init() {
        const toggle = document.getElementById('quick-actions-toggle');
        const quickActions = document.getElementById('quick-actions');
        const backdrop = document.querySelector('.quick-actions-backdrop');

        toggle.addEventListener('click', (e) => {
            e.stopPropagation();
            this.toggleMenu();
        });

        backdrop.addEventListener('click', () => {
            this.closeMenu();
        });

        // Close menu when clicking outside
        document.addEventListener('click', (e) => {
            if (!quickActions.contains(e.target)) {
                this.closeMenu();
            }
        });

        // Close menu on escape key
        document.addEventListener('keydown', (e) => {
            if (e.key === 'Escape') {
                this.closeMenu();
            }
        });

        // Add ripple effect to action items
        document.querySelectorAll('.quick-action-item').forEach(item => {
            item.addEventListener('click', (e) => {
                this.createRipple(e, item);
            });
        });
    }

    toggleMenu() {
        const quickActions = document.getElementById('quick-actions');
        this.isOpen = !this.isOpen;
        
        if (this.isOpen) {
            quickActions.classList.add('open');
            this.resetAnimations();
        } else {
            quickActions.classList.remove('open');
        }
    }

    closeMenu() {
        if (this.isOpen) {
            const quickActions = document.getElementById('quick-actions');
            quickActions.classList.remove('open');
            this.isOpen = false;
        }
    }

    resetAnimations() {
        // Reset animations for action items
        const items = document.querySelectorAll('.quick-action-item');
        items.forEach(item => {
            item.style.animation = 'none';
            item.offsetHeight; // Trigger reflow
            item.style.animation = null;
        });
    }

    createRipple(event, element) {
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
}

// Initialize Quick Actions when DOM is loaded
document.addEventListener('DOMContentLoaded', () => {
    new QuickActions();
});

// Add ripple animation CSS
const rippleStyle = document.createElement('style');
rippleStyle.textContent = `
    @keyframes ripple {
        to {
            transform: scale(4);
            opacity: 0;
        }
    }
`;
document.head.appendChild(rippleStyle);