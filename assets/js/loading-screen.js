/**
 * Modern Loading Screen
 */

class LoadingScreen {
    constructor() {
        this.createLoadingScreen();
        this.init();
    }

    createLoadingScreen() {
        const loadingHTML = `
            <div id="loading-screen" class="loading-screen">
                <div class="loading-content">
                    <div class="loading-logo">
                        <img src="../assets/img/logo.png" alt="Logo" class="logo-img">
                    </div>
                    <div class="loading-spinner">
                        <div class="spinner-ring"></div>
                        <div class="spinner-ring"></div>
                        <div class="spinner-ring"></div>
                    </div>
                    <div class="loading-text">
                        <h3>Panel Yükleniyor</h3>
                        <p>Lütfen bekleyin...</p>
                    </div>
                    <div class="loading-progress">
                        <div class="progress-bar"></div>
                    </div>
                </div>
                <div class="loading-particles">
                    ${Array.from({ length: 20 }, () => '<div class="particle"></div>').join('')}
                </div>
            </div>
        `;

        document.body.insertAdjacentHTML('afterbegin', loadingHTML);
        this.addStyles();
    }

    static addStyles() {
        const style = document.createElement('style');
        style.textContent = `
            .loading-screen {
                position: fixed;
                top: 0;
                left: 0;
                width: 100%;
                height: 100%;
                background: linear-gradient(135deg, #0a0a0a 0%, #1a1a1a 100%);
                display: flex;
                align-items: center;
                justify-content: center;
                z-index: 9999;
                transition: opacity 0.5s ease, visibility 0.5s ease;
            }

            .loading-screen.fade-out {
                opacity: 0;
                visibility: hidden;
            }

            .loading-content {
                text-align: center;
                position: relative;
                z-index: 2;
            }

            .loading-logo {
                margin-bottom: 2rem;
                animation: logoFloat 3s ease-in-out infinite;
            }

            .logo-img {
                width: 80px;
                height: 80px;
                border-radius: 50%;
                box-shadow: 0 0 30px rgba(99, 102, 241, 0.5);
            }

            .loading-spinner {
                position: relative;
                width: 80px;
                height: 80px;
                margin: 2rem auto;
            }

            .spinner-ring {
                position: absolute;
                width: 100%;
                height: 100%;
                border: 2px solid transparent;
                border-top: 2px solid #6366f1;
                border-radius: 50%;
                animation: spin 1s linear infinite;
            }

            .spinner-ring:nth-child(2) {
                width: 60px;
                height: 60px;
                top: 10px;
                left: 10px;
                border-top-color: #8b5cf6;
                animation-duration: 1.5s;
                animation-direction: reverse;
            }

            .spinner-ring:nth-child(3) {
                width: 40px;
                height: 40px;
                top: 20px;
                left: 20px;
                border-top-color: #06b6d4;
                animation-duration: 2s;
            }

            .loading-text h3 {
                color: #ffffff;
                font-size: 1.5rem;
                font-weight: 600;
                margin-bottom: 0.5rem;
                animation: textGlow 2s ease-in-out infinite alternate;
            }

            .loading-text p {
                color: #a1a1aa;
                font-size: 1rem;
                margin-bottom: 2rem;
            }

            .loading-progress {
                width: 200px;
                height: 4px;
                background: rgba(255, 255, 255, 0.1);
                border-radius: 2px;
                margin: 0 auto;
                overflow: hidden;
            }

            .progress-bar {
                height: 100%;
                background: linear-gradient(90deg, #6366f1, #8b5cf6, #06b6d4);
                border-radius: 2px;
                animation: progressMove 2s ease-in-out infinite;
            }

            .loading-particles {
                position: absolute;
                top: 0;
                left: 0;
                width: 100%;
                height: 100%;
                pointer-events: none;
            }

            .particle {
                position: absolute;
                width: 4px;
                height: 4px;
                background: rgba(99, 102, 241, 0.6);
                border-radius: 50%;
                animation: particleFloat 4s ease-in-out infinite;
            }

            .particle:nth-child(odd) {
                background: rgba(139, 92, 246, 0.6);
                animation-duration: 6s;
            }

            .particle:nth-child(3n) {
                background: rgba(6, 182, 212, 0.6);
                animation-duration: 5s;
            }

            @keyframes logoFloat {
                0%, 100% { transform: translateY(0px); }
                50% { transform: translateY(-10px); }
            }

            @keyframes spin {
                0% { transform: rotate(0deg); }
                100% { transform: rotate(360deg); }
            }

            @keyframes textGlow {
                0% { text-shadow: 0 0 10px rgba(99, 102, 241, 0.5); }
                100% { text-shadow: 0 0 20px rgba(99, 102, 241, 0.8); }
            }

            @keyframes progressMove {
                0% { transform: translateX(-100%); }
                50% { transform: translateX(0%); }
                100% { transform: translateX(100%); }
            }

            @keyframes particleFloat {
                0% {
                    transform: translateY(100vh) translateX(0px) rotate(0deg);
                    opacity: 0;
                }
                10% {
                    opacity: 1;
                }
                90% {
                    opacity: 1;
                }
                100% {
                    transform: translateY(-100px) translateX(100px) rotate(360deg);
                    opacity: 0;
                }
            }
        `;

        document.head.appendChild(style);
    }

    init() {
        // Position particles randomly
        const particles = document.querySelectorAll('.particle');
        particles.forEach(particle => {
            particle.style.left = `${Math.random() * 100}%`;
            particle.style.animationDelay = `${Math.random() * 4}s`;
            particle.style.animationDuration = (Math.random() * 3 + 3) + 's';
        });

        // Hide loading screen when page is loaded
        window.addEventListener('load', () => {
            setTimeout(() => {
                this.hideLoadingScreen();
            }, 1500); // Show for at least 1.5 seconds
        });

        // Fallback: hide after 5 seconds regardless
        setTimeout(() => {
            this.hideLoadingScreen();
        }, 5000);
    }

    hideLoadingScreen() {
        const loadingScreen = document.getElementById('loading-screen');
        if (loadingScreen) {
            loadingScreen.classList.add('fade-out');
            setTimeout(() => {
                loadingScreen.remove();
            }, 500);
        }
    }
}

// Initialize loading screen immediately
if (document.readyState === 'loading') {
    new LoadingScreen();
} else {
    // If DOM is already loaded, show a quick loading animation
    document.addEventListener('DOMContentLoaded', () => {
        new LoadingScreen();
    });
}