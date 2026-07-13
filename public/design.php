<style>
/* Cosmic Interface Override Styles - Will force apply to all elements */
:root {
  --cosmic-dark-bg: #0a0a1a;
  --cosmic-dark-text: #e0e0ff;
  --cosmic-light-bg: #f0f5ff;
  --cosmic-light-text: #121225;
  --cosmic-primary: #00ccff;
  --cosmic-secondary: #ff00ff;
  --cosmic-tertiary: #ffff00;
  --cosmic-glow: 0 0 20px;
  --cosmic-accent: #7b68ee;
}

/* Force override for all elements */
* {
  transition: background-color 0.3s ease, color 0.3s ease, box-shadow 0.3s ease, border-color 0.3s ease !important;
}

/* Body styles based on theme */
body {
  margin: 0 !important;
  padding: 0 !important;
  font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif !important;
  -webkit-font-smoothing: antialiased !important;
  -moz-osx-font-smoothing: grayscale !important;
  position: relative !important;
  overflow-x: hidden !important;
}

body.cosmic-dark {
  background-color: var(--cosmic-dark-bg) !important;
  color: var(--cosmic-dark-text) !important;
  background-image: 
    url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='400' height='400' viewBox='0 0 800 800'%3E%3Cg fill='none' stroke='%23032437' stroke-width='1'%3E%3Cpath d='M769 229L1037 260.9M927 880L731 737 520 660 309 538 40 599 295 764 126.5 879.5 40 599-197 493 102 382-31 229 126.5 79.5-69-63'/%3E%3Cpath d='M-31 229L237 261 390 382 603 493 308.5 537.5 101.5 381.5M370 905L295 764'/%3E%3Cpath d='M520 660L578 842 731 737 840 599 603 493 520 660 295 764 309 538 390 382 539 269 769 229 577.5 41.5 370 105 295 -36 126.5 79.5 237 261 102 382 40 599 -69 737 127 880'/%3E%3Cpath d='M520-140L578.5 42.5 731-63M603 493L539 269 237 261 370 105M902 382L539 269M390 382L102 382'/%3E%3Cpath d='M-222 42L126.5 79.5 370 105 539 269 577.5 41.5 927 80 769 229 902 382 603 493 731 737M295-36L577.5 41.5M578 842L295 764M40-201L127 80M102 382L-261 269'/%3E%3C/g%3E%3Cg fill='%2300264d'%3E%3Ccircle cx='769' cy='229' r='5'/%3E%3Ccircle cx='539' cy='269' r='5'/%3E%3Ccircle cx='603' cy='493' r='5'/%3E%3Ccircle cx='731' cy='737' r='5'/%3E%3Ccircle cx='520' cy='660' r='5'/%3E%3Ccircle cx='309' cy='538' r='5'/%3E%3Ccircle cx='295' cy='764' r='5'/%3E%3Ccircle cx='40' cy='599' r='5'/%3E%3Ccircle cx='102' cy='382' r='5'/%3E%3Ccircle cx='127' cy='80' r='5'/%3E%3Ccircle cx='370' cy='105' r='5'/%3E%3Ccircle cx='578' cy='42' r='5'/%3E%3Ccircle cx='237' cy='261' r='5'/%3E%3Ccircle cx='390' cy='382' r='5'/%3E%3C/g%3E%3C/svg%3E"),
    radial-gradient(circle at 10% 20%, rgba(0, 255, 255, 0.08) 0%, transparent 30%),
    radial-gradient(circle at 90% 50%, rgba(255, 0, 255, 0.08) 0%, transparent 35%),
    radial-gradient(circle at 50% 80%, rgba(255, 255, 0, 0.08) 0%, transparent 40%) !important;
  background-attachment: fixed !important;
  background-size: cover !important;
}

body.cosmic-light {
  background-color: var(--cosmic-light-bg) !important;
  color: var(--cosmic-light-text) !important;
  background-image: 
    url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='400' height='400' viewBox='0 0 800 800'%3E%3Cg fill='none' stroke='%23e6f0ff' stroke-width='1'%3E%3Cpath d='M769 229L1037 260.9M927 880L731 737 520 660 309 538 40 599 295 764 126.5 879.5 40 599-197 493 102 382-31 229 126.5 79.5-69-63'/%3E%3Cpath d='M-31 229L237 261 390 382 603 493 308.5 537.5 101.5 381.5M370 905L295 764'/%3E%3Cpath d='M520 660L578 842 731 737 840 599 603 493 520 660 295 764 309 538 390 382 539 269 769 229 577.5 41.5 370 105 295 -36 126.5 79.5 237 261 102 382 40 599 -69 737 127 880'/%3E%3Cpath d='M520-140L578.5 42.5 731-63M603 493L539 269 237 261 370 105M902 382L539 269M390 382L102 382'/%3E%3Cpath d='M-222 42L126.5 79.5 370 105 539 269 577.5 41.5 927 80 769 229 902 382 603 493 731 737M295-36L577.5 41.5M578 842L295 764M40-201L127 80M102 382L-261 269'/%3E%3C/g%3E%3Cg fill='%23cce0ff'%3E%3Ccircle cx='769' cy='229' r='5'/%3E%3Ccircle cx='539' cy='269' r='5'/%3E%3Ccircle cx='603' cy='493' r='5'/%3E%3Ccircle cx='731' cy='737' r='5'/%3E%3Ccircle cx='520' cy='660' r='5'/%3E%3Ccircle cx='309' cy='538' r='5'/%3E%3Ccircle cx='295' cy='764' r='5'/%3E%3Ccircle cx='40' cy='599' r='5'/%3E%3Ccircle cx='102' cy='382' r='5'/%3E%3Ccircle cx='127' cy='80' r='5'/%3E%3Ccircle cx='370' cy='105' r='5'/%3E%3Ccircle cx='578' cy='42' r='5'/%3E%3Ccircle cx='237' cy='261' r='5'/%3E%3Ccircle cx='390' cy='382' r='5'/%3E%3C/g%3E%3C/svg%3E"),
    radial-gradient(circle at 10% 20%, rgba(0, 102, 255, 0.08) 0%, transparent 30%),
    radial-gradient(circle at 90% 50%, rgba(102, 0, 255, 0.08) 0%, transparent 35%),
    radial-gradient(circle at 50% 80%, rgba(0, 204, 255, 0.08) 0%, transparent 40%) !important;
  background-attachment: fixed !important;
  background-size: cover !important;
}

/* Session notification styles */
.session-notification {
  position: fixed !important;
  top: 80px !important;
  right: 20px !important;
  padding: 15px 25px !important;
  border-radius: 10px !important;
  z-index: 9998 !important;
  transform: translateX(150%) !important;
  animation: slide-in 0.5s forwards, fade-out 0.5s 5s forwards !important;
  box-shadow: 0 5px 15px rgba(0, 0, 0, 0.3) !important;
  max-width: 350px !important;
  backdrop-filter: blur(10px) !important;
  -webkit-backdrop-filter: blur(10px) !important;
}

body.cosmic-dark .session-notification.success {
  background: rgba(0, 50, 20, 0.8) !important;
  border-left: 5px solid #00ff9d !important;
  color: #e0ffe0 !important;
}

body.cosmic-dark .session-notification.error {
  background: rgba(50, 0, 0, 0.8) !important;
  border-left: 5px solid #ff5555 !important;
  color: #ffe0e0 !important;
}

body.cosmic-dark .session-notification.info {
  background: rgba(0, 20, 50, 0.8) !important;
  border-left: 5px solid #55aaff !important;
  color: #e0e0ff !important;
}

body.cosmic-light .session-notification.success {
  background: rgba(240, 255, 240, 0.9) !important;
  border-left: 5px solid #00cc66 !important;
  color: #006633 !important;
}

body.cosmic-light .session-notification.error {
  background: rgba(255, 240, 240, 0.9) !important;
  border-left: 5px solid #cc0000 !important;
  color: #660000 !important;
}

body.cosmic-light .session-notification.info {
  background: rgba(240, 240, 255, 0.9) !important;
  border-left: 5px solid #0066cc !important;
  color: #003366 !important;
}

@keyframes slide-in {
  100% { transform: translateX(0%); }
}

@keyframes fade-out {
  0% { opacity: 1; }
  100% { opacity: 0; }
}

/* Theme toggle button */
.cosmic-theme-toggle {
  position: fixed !important;
  top: 20px !important;
  left: 20px !important; /* Changed from right to left */
  z-index: 9999 !important;
  width: 50px !important;
  height: 50px !important;
  border-radius: 50% !important;
  display: flex !important;
  align-items: center !important;
  justify-content: center !important;
  cursor: pointer !important;
  box-shadow: var(--cosmic-glow) rgba(0, 255, 255, 0.5) !important;
  border: 2px solid var(--cosmic-primary) !important;
  background-color: transparent !important;
  overflow: hidden !important;
}

body.cosmic-dark .cosmic-theme-toggle {
  color: #fff !important;
}

body.cosmic-light .cosmic-theme-toggle {
  color: #000 !important;
}

.cosmic-theme-toggle:hover {
  transform: scale(1.1) !important;
}

/* Cosmic particles container */
.cosmic-particles {
  position: fixed !important;
  top: 0 !important;
  left: 0 !important;
  width: 100% !important;
  height: 100% !important;
  pointer-events: none !important;
  z-index: -1 !important;
}


/* Override for all containers */
.signup-container,
.reset-password-container,
.recover-account-container,
.withdraw-container,
.withdraw-history-container,
.view-links-container,
.view-orders-container,
.view-services-container .service-card,
.invoice-container,
.terminal-section, /* Added for marketplace */
.hacker-card, /* Added for marketplace */
.search-form, /* Added for marketplace */
.grid-container /* Added for marketplace */ {
  position: relative !important;
  overflow: hidden !important;
  border-radius: 15px !important;
  box-shadow: 0 10px 30px rgba(0, 0, 0, 0.3) !important;
  transform: translateZ(0) !important;
  backdrop-filter: blur(10px) !important;
  -webkit-backdrop-filter: blur(10px) !important;
}

/* Dark mode container styles */
body.cosmic-dark .signup-container,
body.cosmic-dark .reset-password-container,
body.cosmic-dark .recover-account-container,
body.cosmic-dark .withdraw-container,
body.cosmic-dark .withdraw-history-container,
body.cosmic-dark .view-links-container,
body.cosmic-dark .view-orders-container,
body.cosmic-dark .view-services-container .service-card,
body.cosmic-dark .invoice-container,
body.cosmic-dark .terminal-section, /* Added for marketplace */
body.cosmic-dark .hacker-card, /* Added for marketplace */
body.cosmic-dark .search-form /* Added for marketplace */ {
  background-color: rgba(18, 18, 37, 0.8) !important;
  border: 1px solid rgba(0, 255, 255, 0.2) !important;
  color: var(--cosmic-dark-text) !important;
}

/* Light mode container styles */
body.cosmic-light .signup-container,
body.cosmic-light .reset-password-container,
body.cosmic-light .recover-account-container,
body.cosmic-light .withdraw-container,
body.cosmic-light .withdraw-history-container,
body.cosmic-light .view-links-container,
body.cosmic-light .view-orders-container,
body.cosmic-light .view-services-container .service-card,
body.cosmic-light .invoice-container,
body.cosmic-light .terminal-section, /* Added for marketplace */
body.cosmic-light .hacker-card, /* Added for marketplace */
body.cosmic-light .search-form /* Added for marketplace */ {
  background-color: rgba(255, 255, 255, 0.8) !important;
  border: 1px solid rgba(0, 102, 255, 0.2) !important;
  color: var(--cosmic-light-text) !important;
}

/* Cosmic glow effect for all containers */
.signup-container::before,
.reset-password-container::before,
.recover-account-container::before,
.withdraw-container::before,
.withdraw-history-container::before,
.view-links-container::before,
.view-orders-container::before,
.view-services-container .service-card::before,
.invoice-container::before,
.terminal-section::before, /* Added for marketplace */
.hacker-card::before /* Added for marketplace */ {
  content: "" !important;
  position: absolute !important;
  top: -50% !important;
  left: -50% !important;
  width: 200% !important;
  height: 200% !important;
  background: conic-gradient(
    transparent, 
    rgba(0, 255, 255, 0.1), 
    transparent 30%,
    transparent 70%,
    rgba(255, 0, 255, 0.1),
    transparent
  ) !important;
  animation: cosmic-rotate 10s linear infinite !important;
  z-index: -1 !important;
}

/* Headings */
h1, h2, h3, h4, h5, h6,
.section-title, /* Added for marketplace */
.card-title /* Added for marketplace */ {
  position: relative !important;
  display: inline-block !important;
  margin-bottom: 20px !important;
}

body.cosmic-dark h1, 
body.cosmic-dark h2, 
body.cosmic-dark h3, 
body.cosmic-dark h4, 
body.cosmic-dark h5, 
body.cosmic-dark h6,
body.cosmic-dark .section-title, /* Added for marketplace */
body.cosmic-dark .card-title /* Added for marketplace */ {
  color: var(--cosmic-primary) !important;
  text-shadow: 0 0 10px rgba(0, 255, 255, 0.5) !important;
}

body.cosmic-light h1, 
body.cosmic-light h2, 
body.cosmic-light h3, 
body.cosmic-light h4, 
body.cosmic-light h5, 
body.cosmic-light h6,
body.cosmic-light .section-title, /* Added for marketplace */
body.cosmic-light .card-title /* Added for marketplace */ {
  color: #0066cc !important;
  text-shadow: 0 0 10px rgba(0, 102, 204, 0.3) !important;
}

/* Input fields */
input[type="text"],
input[type="email"],
input[type="password"],
input[type="number"],
#search-input /* Added for marketplace */ {
  width: 100% !important;
  padding: 12px 15px !important;
  margin: 10px 0 !important;
  border-radius: 8px !important;
  font-size: 1rem !important;
  transition: all 0.3s ease !important;
  position: relative !important;
}

body.cosmic-dark input[type="text"],
body.cosmic-dark input[type="email"],
body.cosmic-dark input[type="password"],
body.cosmic-dark input[type="number"],
body.cosmic-dark #search-input /* Added for marketplace */ {
  background: rgba(0, 0, 0, 0.2) !important;
  border: 1px solid rgba(0, 255, 255, 0.3) !important;
  color: #fff !important;
  box-shadow: inset 0 0 5px rgba(0, 255, 255, 0.2) !important;
}

body.cosmic-light input[type="text"],
body.cosmic-light input[type="email"],
body.cosmic-light input[type="password"],
body.cosmic-light input[type="number"],
body.cosmic-light #search-input /* Added for marketplace */ {
  background: rgba(255, 255, 255, 0.8) !important;
  border: 1px solid rgba(0, 102, 255, 0.3) !important;
  color: #000 !important;
  box-shadow: inset 0 0 5px rgba(0, 102, 255, 0.2) !important;
}

body.cosmic-dark input[type="text"]:focus,
body.cosmic-dark input[type="email"]:focus,
body.cosmic-dark input[type="password"]:focus,
body.cosmic-dark input[type="number"]:focus,
body.cosmic-dark #search-input:focus /* Added for marketplace */ {
  background: rgba(0, 0, 0, 0.3) !important;
  border-color: var(--cosmic-primary) !important;
  box-shadow: 0 0 10px var(--cosmic-primary) !important;
  outline: none !important;
}

body.cosmic-light input[type="text"]:focus,
body.cosmic-light input[type="email"]:focus,
body.cosmic-light input[type="password"]:focus,
body.cosmic-light input[type="number"]:focus,
body.cosmic-light #search-input:focus /* Added for marketplace */ {
  background: rgba(255, 255, 255, 1) !important;
  border-color: #0066cc !important;
  box-shadow: 0 0 10px rgba(0, 102, 255, 0.5) !important;
  outline: none !important;
}

/* Buttons */
button,
.buy-button, /* Added for marketplace */
.view-all, /* Added for marketplace */
#search-button /* Added for marketplace */ {
  background: linear-gradient(45deg, #00ccff, #0066ff) !important;
  border: none !important;
  padding: 12px 25px !important;
  border-radius: 8px !important;
  font-size: 1rem !important;
  font-weight: bold !important;
  cursor: pointer !important;
  position: relative !important;
  overflow: hidden !important;
  transition: all 0.3s ease !important;
  z-index: 1 !important;
}

body.cosmic-dark button,
body.cosmic-dark .buy-button, /* Added for marketplace */
body.cosmic-dark .view-all, /* Added for marketplace */
body.cosmic-dark #search-button /* Added for marketplace */ {
  color: #000 !important;
  box-shadow: 0 0 15px rgba(0, 204, 255, 0.5) !important;
}

body.cosmic-light button,
body.cosmic-light .buy-button, /* Added for marketplace */
body.cosmic-light .view-all, /* Added for marketplace */
body.cosmic-light #search-button /* Added for marketplace */ {
  color: #fff !important;
  box-shadow: 0 0 15px rgba(0, 102, 255, 0.5) !important;
}

button::before,
.buy-button::before, /* Added for marketplace */
.view-all::before, /* Added for marketplace */
#search-button::before /* Added for marketplace */ {
  content: "" !important;
  position: absolute !important;
  top: 0 !important;
  left: -100% !important;
  width: 100% !important;
  height: 100% !important;
  background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.2), transparent) !important;
  transition: left 0.7s ease !important;
  z-index: -1 !important;
}

button:hover,
.buy-button:hover, /* Added for marketplace */
.view-all:hover, /* Added for marketplace */
#search-button:hover /* Added for marketplace */ {
  transform: translateY(-3px) !important;
}

button:hover::before,
.buy-button:hover::before, /* Added for marketplace */
.view-all:hover::before, /* Added for marketplace */
#search-button:hover::before /* Added for marketplace */ {
  left: 100% !important;
}

/* Marketplace specific styles */
body.cosmic-dark .hacker-title {
  color: var(--cosmic-primary) !important;
  text-shadow: 0 0 10px rgba(0, 255, 255, 0.5) !important;
}

body.cosmic-light .hacker-title {
  color: #0066cc !important;
  text-shadow: 0 0 10px rgba(0, 102, 204, 0.3) !important;
}

body.cosmic-dark .card-content {
  background-color: rgba(10, 10, 26, 0.8) !important;
}

body.cosmic-light .card-content {
  background-color: rgba(240, 245, 255, 0.8) !important;
}

body.cosmic-dark .primary-text {
  color: var(--cosmic-primary) !important;
}

body.cosmic-light .primary-text {
  color: #0066cc !important;
}

body.cosmic-dark .card-price {
  background-color: rgba(0, 255, 255, 0.05) !important;
}

body.cosmic-light .card-price {
  background-color: rgba(0, 102, 255, 0.05) !important;
}

body.cosmic-dark .terminal-header {
  background-color: rgba(0, 0, 0, 0.5) !important;
}

body.cosmic-light .terminal-header {
  background-color: rgba(0, 102, 255, 0.1) !important;
}

/* Tables */
table {
  width: 100% !important;
  border-collapse: collapse !important;
  margin: 20px 0 !important;
  overflow: hidden !important;
  border-radius: 10px !important;
}

body.cosmic-dark table {
  background-color: rgba(0, 0, 0, 0.2) !important;
  box-shadow: 0 0 20px rgba(0, 255, 255, 0.1) !important;
}

body.cosmic-light table {
  background-color: rgba(255, 255, 255, 0.8) !important;
  box-shadow: 0 0 20px rgba(0, 102, 255, 0.1) !important;
}

th, td {
  padding: 12px 15px !important;
  text-align: left !important;
}

body.cosmic-dark th {
  background-color: rgba(0, 255, 255, 0.1) !important;
  color: var(--cosmic-primary) !important;
  border-bottom: 1px solid rgba(0, 255, 255, 0.2) !important;
}

body.cosmic-light th {
  background-color: rgba(0, 102, 255, 0.1) !important;
  color: #0066cc !important;
  border-bottom: 1px solid rgba(0, 102, 255, 0.2) !important;
}

body.cosmic-dark td {
  border-bottom: 1px solid rgba(255, 255, 255, 0.05) !important;
}

body.cosmic-light td {
  border-bottom: 1px solid rgba(0, 0, 0, 0.05) !important;
}

body.cosmic-dark tr:hover {
  background-color: rgba(0, 255, 255, 0.05) !important;
}

body.cosmic-light tr:hover {
  background-color: rgba(0, 102, 255, 0.05) !important;
}

/* Animations */
@keyframes cosmic-rotate {
  0% {
    transform: rotate(0deg);
  }
  100% {
    transform: rotate(360deg);
  }
}

@keyframes cosmic-pulse {
  0%, 100% {
    opacity: 0.5;
  }
  50% {
    opacity: 1;
  }
}

@keyframes cosmic-float {
  0%, 100% {
    transform: translateY(0);
  }
  50% {
    transform: translateY(-10px);
  }
}

/* Responsive adjustments */
@media (max-width: 768px) {
  .signup-container,
  .reset-password-container,
  .recover-account-container,
  .withdraw-container,
  .withdraw-history-container,
  .view-links-container,
  .view-orders-container,
  .invoice-container,
  .terminal-section, /* Added for marketplace */
  .grid-container /* Added for marketplace */ {
    padding: 20px !important;
    margin: 30px auto !important;
  }
  
  h2, .section-title /* Added for marketplace */ {
    font-size: 1.8rem !important;
  }
  
  .cosmic-theme-toggle {
    top: 10px !important;
    right: 10px !important;
    width: 40px !important;
    height: 40px !important;
  }
}


// Add hover effects to buttons
function addButtonEffects() {
  const buttons = document.querySelectorAll('button, .buy-button, .view-all, #search-button');
  
  buttons.forEach(button => {
    // Skip the theme toggle button
    if (button.classList.contains('cosmic-theme-toggle')) return;
    
    button.addEventListener('mouseover', function() {
      const isDark = document.body.classList.contains('cosmic-dark');
      this.style.boxShadow = isDark ? 
        '0 0 20px rgba(0, 255, 255, 0.8)' : 
        '0 0 20px rgba(0, 102, 255, 0.8)';
    });
    
    button.addEventListener('mouseout', function() {
      const isDark = document.body.classList.contains('cosmic-dark');
      this.style.boxShadow = isDark ? 
        '0 0 15px rgba(0, 204, 255, 0.5)' : 
        '0 0 15px rgba(0, 102, 255, 0.5)';
    });
  });
}

// Add floating animation to containers
function addFloatingEffect() {
  const containers = document.querySelectorAll('.signup-container, .reset-password-container, .recover-account-container, .withdraw-container, .withdraw-history-container, .view-links-container, .view-orders-container, .view-services-container .service-card, .invoice-container');
  
  // Note: removed .terminal-section, .hacker-card from the selector above
  
  containers.forEach(container => {
    container.style.animation = `cosmic-float ${Math.random() * 2 + 8}s infinite ease-in-out`;
    container.style.animationDelay = `${Math.random() * 2}s`;
  });
}

// Set up observer for dynamically loaded content
function setupDynamicContentObserver() {
  // Create a MutationObserver to watch for new content
  const observer = new MutationObserver(function(mutations) {
    mutations.forEach(function(mutation) {
      if (mutation.addedNodes && mutation.addedNodes.length > 0) {
        // Check for newly added marketplace elements
        const marketplaceElements = document.querySelectorAll('.terminal-section, .hacker-card, .buy-button, .view-all, #search-button');
        if (marketplaceElements.length > 0) {
          // Apply effects to new elements
          addButtonEffects();
          addFloatingEffect();
          
          // Apply cosmic theme to new elements
          applyCosmicThemeToNewContent();
        }
      }
    });
  });
  
  // Start observing the document with the configured parameters
  observer.observe(document.body, { childList: true, subtree: true });
}


/* Override for all containers */
.signup-container,
.reset-password-container,
.recover-account-container,
.withdraw-container,
.withdraw-history-container,
.view-links-container,
.view-orders-container,
.view-services-container .service-card,
.invoice-container,
.block-container {
  position: relative !important;
  overflow: hidden !important;
  border-radius: 15px !important;
  box-shadow: 0 10px 30px rgba(0, 0, 0, 0.3) !important;
  transform: translateZ(0) !important;
  backdrop-filter: blur(10px) !important;
  -webkit-backdrop-filter: blur(10px) !important;
  margin: 30px auto !important;
  padding: 30px !important;
  max-width: 1200px !important;
}

/* Dark mode container styles */
body.cosmic-dark .signup-container,
body.cosmic-dark .reset-password-container,
body.cosmic-dark .recover-account-container,
body.cosmic-dark .withdraw-container,
body.cosmic-dark .withdraw-history-container,
body.cosmic-dark .view-links-container,
body.cosmic-dark .view-orders-container,
body.cosmic-dark .view-services-container .service-card,
body.cosmic-dark .invoice-container,
body.cosmic-dark .block-container {
  background: linear-gradient(135deg, rgba(18, 18, 37, 0.8), rgba(10, 10, 30, 0.9)) !important;
  border: 1px solid rgba(0, 255, 255, 0.2) !important;
  color: var(--cosmic-dark-text) !important;
}

/* Light mode container styles */
body.cosmic-light .signup-container,
body.cosmic-light .reset-password-container,
body.cosmic-light .recover-account-container,
body.cosmic-light .withdraw-container,
body.cosmic-light .withdraw-history-container,
body.cosmic-light .view-links-container,
body.cosmic-light .view-orders-container,
body.cosmic-light .view-services-container .service-card,
body.cosmic-light .invoice-container,
body.cosmic-light .block-container {
  background: linear-gradient(135deg, rgba(255, 255, 255, 0.8), rgba(240, 245, 255, 0.9)) !important;
  border: 1px solid rgba(0, 102, 255, 0.2) !important;
  color: var(--cosmic-light-text) !important;
}

/* Cosmic glow effect for all containers */
.signup-container::before,
.reset-password-container::before,
.recover-account-container::before,
.withdraw-container::before,
.withdraw-history-container::before,
.view-links-container::before,
.view-orders-container::before,
.view-services-container .service-card::before,
.invoice-container::before,
.block-container::before {
  content: "" !important;
  position: absolute !important;
  top: -50% !important;
  left: -50% !important;
  width: 200% !important;
  height: 200% !important;
  background: conic-gradient(
    transparent, 
    rgba(0, 255, 255, 0.1), 
    transparent 30%,
    transparent 70%,
    rgba(255, 0, 255, 0.1),
    transparent
  ) !important;
  animation: cosmic-rotate 10s linear infinite !important;
  z-index: -1 !important;
}

/* Block elements styling */
.block {
  position: relative !important;
  margin: 20px 0 !important;
  padding: 20px !important;
  border-radius: 10px !important;
  overflow: hidden !important;
}

body.cosmic-dark .block {
  background: rgba(0, 0, 0, 0.2) !important;
  border-left: 3px solid var(--cosmic-primary) !important;
}

body.cosmic-light .block {
  background: rgba(255, 255, 255, 0.5) !important;
  border-left: 3px solid var(--cosmic-accent) !important;
}

.block-title {
  font-size: 1.2rem !important;
  margin-bottom: 15px !important;
  font-weight: bold !important;
  display: flex !important;
  align-items: center !important;
}

body.cosmic-dark .block-title {
  color: var(--cosmic-primary) !important;
}

body.cosmic-light .block-title {
  color: var(--cosmic-accent) !important;
}

.block-title i {
  margin-right: 10px !important;
}

.block-content {
  position: relative !important;
}

/* Headings */
h1, h2, h3, h4, h5, h6 {
  position: relative !important;
  display: inline-block !important;
  margin-bottom: 20px !important;
  font-weight: 600 !important;
  letter-spacing: 0.5px !important;
}

body.cosmic-dark h1, 
body.cosmic-dark h2, 
body.cosmic-dark h3, 
body.cosmic-dark h4, 
body.cosmic-dark h5, 
body.cosmic-dark h6 {
  color: var(--cosmic-primary) !important;
  text-shadow: 0 0 10px rgba(0, 204, 255, 0.5) !important;
}

body.cosmic-light h1, 
body.cosmic-light h2, 
body.cosmic-light h3, 
body.cosmic-light h4, 
body.cosmic-light h5, 
body.cosmic-light h6 {
  color: var(--cosmic-accent) !important;
  text-shadow: 0 0 10px rgba(123, 104, 238, 0.3) !important;
}

/* Text styles */
p, span, div, li, a {
  line-height: 1.6 !important;
}

body.cosmic-dark p, 
body.cosmic-dark span, 
body.cosmic-dark div, 
body.cosmic-dark li {
  color: var(--cosmic-dark-text) !important;
}

body.cosmic-light p, 
body.cosmic-light span, 
body.cosmic-light div, 
body.cosmic-light li {
  color: var(--cosmic-light-text) !important;
}

/* Links */
a {
  text-decoration: none !important;
  position: relative !important;
  transition: all 0.3s ease !important;
}

body.cosmic-dark a {
  color: var(--cosmic-primary) !important;
}

body.cosmic-light a {
  color: var(--cosmic-accent) !important;
}

a::after {
  content: '' !important;
  position: absolute !important;
  width: 100% !important;
  height: 1px !important;
  bottom: -2px !important;
  left: 0 !important;
  transform: scaleX(0) !important;
  transform-origin: bottom right !important;
  transition: transform 0.3s ease !important;
}

body.cosmic-dark a::after {
  background-color: var(--cosmic-primary) !important;
}

body.cosmic-light a::after {
  background-color: var(--cosmic-accent) !important;
}

a:hover::after {
  transform: scaleX(1) !important;
  transform-origin: bottom left !important;
}

/* Input fields */
input[type="text"],
input[type="email"],
input[type="password"],
input[type="number"],
textarea,
select {
  width: 100% !important;
  padding: 12px 15px !important;
  margin: 10px 0 !important;
  border-radius: 8px !important;
  font-size: 1rem !important;
  transition: all 0.3s ease !important;
  position: relative !important;
}

body.cosmic-dark input[type="text"],
body.cosmic-dark input[type="email"],
body.cosmic-dark input[type="password"],
body.cosmic-dark input[type="number"],
body.cosmic-dark textarea,
body.cosmic-dark select {
  background: rgba(0, 0, 0, 0.2) !important;
  border: 1px solid rgba(0, 255, 255, 0.3) !important;
  color: #fff !important;
  box-shadow: inset 0 0 5px rgba(0, 255, 255, 0.2) !important;
}

body.cosmic-light input[type="text"],
body.cosmic-light input[type="email"],
body.cosmic-light input[type="password"],
body.cosmic-light input[type="number"],
body.cosmic-light textarea,
body.cosmic-light select {
  background: rgba(255, 255, 255, 0.8) !important;
  border: 1px solid rgba(123, 104, 238, 0.3) !important;
  color: #000 !important;
  box-shadow: inset 0 0 5px rgba(123, 104, 238, 0.2) !important;
}

body.cosmic-dark input[type="text"]:focus,
body.cosmic-dark input[type="email"]:focus,
body.cosmic-dark input[type="password"]:focus,
body.cosmic-dark input[type="number"]:focus,
body.cosmic-dark textarea:focus,
body.cosmic-dark select:focus {
  background: rgba(0, 0, 0, 0.3) !important;
  border-color: var(--cosmic-primary) !important;
  box-shadow: 0 0 10px var(--cosmic-primary) !important;
  outline: none !important;
}

body.cosmic-light input[type="text"]:focus,
body.cosmic-light input[type="email"]:focus,
body.cosmic-light input[type="password"]:focus,
body.cosmic-light input[type="number"]:focus,
body.cosmic-light input[type="text"]:focus,
body.cosmic-light input[type="email"]:focus,
body.cosmic-light input[type="password"]:focus,
body.cosmic-light input[type="number"]:focus,
body.cosmic-light textarea:focus,
body.cosmic-light select:focus {
  background: rgba(255, 255, 255, 1) !important;
  border-color: var(--cosmic-accent) !important;
  box-shadow: 0 0 10px rgba(123, 104, 238, 0.5) !important;
  outline: none !important;
}

/* Labels */
label {
  display: block !important;
  margin-bottom: 5px !important;
  font-weight: 500 !important;
}

body.cosmic-dark label {
  color: var(--cosmic-primary) !important;
}

body.cosmic-light label {
  color: var(--cosmic-accent) !important;
}

/* Buttons */
button, 
.btn,
input[type="submit"] {
  background: linear-gradient(45deg, #00ccff, #7b68ee) !important;
  border: none !important;
  padding: 12px 25px !important;
  border-radius: 8px !important;
  font-size: 1rem !important;
  font-weight: bold !important;
  cursor: pointer !important;
  position: relative !important;
  overflow: hidden !important;
  transition: all 0.3s ease !important;
  z-index: 1 !important;
  letter-spacing: 0.5px !important;
}

body.cosmic-dark button,
body.cosmic-dark .btn,
body.cosmic-dark input[type="submit"] {
  color: #fff !important;
  box-shadow: 0 0 15px rgba(0, 204, 255, 0.5) !important;
}

body.cosmic-light button,
body.cosmic-light .btn,
body.cosmic-light input[type="submit"] {
  color: #fff !important;
  box-shadow: 0 0 15px rgba(123, 104, 238, 0.5) !important;
}

button::before,
.btn::before,
input[type="submit"]::before {
  content: "" !important;
  position: absolute !important;
  top: 0 !important;
  left: -100% !important;
  width: 100% !important;
  height: 100% !important;
  background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.3), transparent) !important;
  transition: left 0.7s ease !important;
  z-index: -1 !important;
}

button:hover,
.btn:hover,
input[type="submit"]:hover {
  transform: translateY(-3px) !important;
}

button:hover::before,
.btn:hover::before,
input[type="submit"]:hover::before {
  left: 100% !important;
}

/* Secondary button */
.btn-secondary {
  background: linear-gradient(45deg, #ff00aa, #ff6a00) !important;
}

/* Outline button */
.btn-outline {
  background: transparent !important;
  border: 2px solid !important;
}

body.cosmic-dark .btn-outline {
  border-color: var(--cosmic-primary) !important;
  color: var(--cosmic-primary) !important;
}

body.cosmic-light .btn-outline {
  border-color: var(--cosmic-accent) !important;
  color: var(--cosmic-accent) !important;
}

.btn-outline:hover {
  background: rgba(0, 0, 0, 0.1) !important;
}

/* Tables */
table {
  width: 100% !important;
  border-collapse: collapse !important;
  margin: 20px 0 !important;
  overflow: hidden !important;
  border-radius: 10px !important;
}

body.cosmic-dark table {
  background-color: rgba(0, 0, 0, 0.2) !important;
  box-shadow: 0 0 20px rgba(0, 255, 255, 0.1) !important;
}

body.cosmic-light table {
  background-color: rgba(255, 255, 255, 0.8) !important;
  box-shadow: 0 0 20px rgba(123, 104, 238, 0.1) !important;
}

th, td {
  padding: 12px 15px !important;
  text-align: left !important;
}

body.cosmic-dark th {
  background-color: rgba(0, 255, 255, 0.1) !important;
  color: var(--cosmic-primary) !important;
  border-bottom: 1px solid rgba(0, 255, 255, 0.2) !important;
}

body.cosmic-light th {
  background-color: rgba(123, 104, 238, 0.1) !important;
  color: var(--cosmic-accent) !important;
  border-bottom: 1px solid rgba(123, 104, 238, 0.2) !important;
}

body.cosmic-dark td {
  border-bottom: 1px solid rgba(255, 255, 255, 0.05) !important;
}

body.cosmic-light td {
  border-bottom: 1px solid rgba(0, 0, 0, 0.05) !important;
}

body.cosmic-dark tr:hover {
  background-color: rgba(0, 255, 255, 0.05) !important;
}

body.cosmic-light tr:hover {
  background-color: rgba(123, 104, 238, 0.05) !important;
}

/* Cards */
.card {
  border-radius: 10px !important;
  overflow: hidden !important;
  margin: 15px 0 !important;
  transition: transform 0.3s ease, box-shadow 0.3s ease !important;
}

body.cosmic-dark .card {
  background: rgba(0, 0, 0, 0.2) !important;
  border: 1px solid rgba(0, 255, 255, 0.2) !important;
  box-shadow: 0 5px 15px rgba(0, 0, 0, 0.3) !important;
}

body.cosmic-light .card {
  background: rgba(255, 255, 255, 0.8) !important;
  border: 1px solid rgba(123, 104, 238, 0.2) !important;
  box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1) !important;
}

.card:hover {
  transform: translateY(-5px) !important;
}

body.cosmic-dark .card:hover {
  box-shadow: 0 8px 25px rgba(0, 255, 255, 0.2) !important;
}

body.cosmic-light .card:hover {
  box-shadow: 0 8px 25px rgba(123, 104, 238, 0.2) !important;
}

.card-header {
  padding: 15px 20px !important;
  border-bottom: 1px solid !important;
}

body.cosmic-dark .card-header {
  border-color: rgba(0, 255, 255, 0.1) !important;
  background: rgba(0, 0, 0, 0.3) !important;
}

body.cosmic-light .card-header {
  border-color: rgba(123, 104, 238, 0.1) !important;
  background: rgba(123, 104, 238, 0.05) !important;
}

.card-body {
  padding: 20px !important;
}

.card-footer {
  padding: 15px 20px !important;
  border-top: 1px solid !important;
}

body.cosmic-dark .card-footer {
  border-color: rgba(0, 255, 255, 0.1) !important;
  background: rgba(0, 0, 0, 0.2) !important;
}

body.cosmic-light .card-footer {
  border-color: rgba(123, 104, 238, 0.1) !important;
  background: rgba(123, 104, 238, 0.03) !important;
}

/* Badges */
.badge {
  display: inline-block !important;
  padding: 5px 10px !important;
  border-radius: 20px !important;
  font-size: 0.8rem !important;
  font-weight: bold !important;
  text-transform: uppercase !important;
  letter-spacing: 0.5px !important;
}

body.cosmic-dark .badge-primary {
  background: var(--cosmic-primary) !important;
  color: #000 !important;
}

body.cosmic-light .badge-primary {
  background: var(--cosmic-accent) !important;
  color: #fff !important;
}

body.cosmic-dark .badge-secondary {
  background: var(--cosmic-secondary) !important;
  color: #fff !important;
}

body.cosmic-light .badge-secondary {
  background: #ff6a00 !important;
  color: #fff !important;
}

/* Animations */
@keyframes cosmic-rotate {
  0% {
    transform: rotate(0deg);
  }
  100% {
    transform: rotate(360deg);
  }
}

@keyframes cosmic-pulse {
  0%, 100% {
    opacity: 0.5;
  }
  50% {
    opacity: 1;
  }
}

@keyframes cosmic-float {
  0%, 100% {
    transform: translateY(0);
  }
  50% {
    transform: translateY(-10px);
  }
}

@keyframes cosmic-glow {
  0%, 100% {
    box-shadow: 0 0 10px rgba(0, 204, 255, 0.5);
  }
  50% {
    box-shadow: 0 0 20px rgba(0, 204, 255, 0.8);
  }
}

/* Responsive adjustments */
@media (max-width: 768px) {
  .signup-container,
  .reset-password-container,
  .recover-account-container,
  .withdraw-container,
  .withdraw-history-container,
  .view-links-container,
  .view-orders-container,
  .invoice-container,
  .block-container {
    padding: 20px !important;
    margin: 30px auto !important;
    width: 90% !important;
  }
  
  h1 {
    font-size: 2rem !important;
  }
  
  h2 {
    font-size: 1.8rem !important;
  }
  
  .cosmic-theme-toggle {
    top: 10px !important;
    right: 10px !important;
    width: 40px !important;
    height: 40px !important;
  }
  
  .block {
    padding: 15px !important;
  }
}

/* Announcement ticker cosmic styling */
.pn-feed,
.pn-announcement,
.pn-announcement-header,
.pn-ticker,
.pn-ticker-items,
.pn-ticker-item {
  position: relative !important;
  overflow: hidden !important;
  border-radius: 15px !important;
  backdrop-filter: blur(10px) !important;
  -webkit-backdrop-filter: blur(10px) !important;
}

.pn-announcement {
  margin: 20px 0 !important;
  box-shadow: 0 10px 30px rgba(0, 0, 0, 0.3) !important;
}

body.cosmic-dark .pn-announcement {
  background: linear-gradient(135deg, rgba(18, 18, 37, 0.8), rgba(10, 10, 30, 0.9)) !important;
  border: 1px solid rgba(0, 255, 255, 0.2) !important;
  color: var(--cosmic-dark-text) !important;
}

body.cosmic-light .pn-announcement {
  background: linear-gradient(135deg, rgba(255, 255, 255, 0.8), rgba(240, 245, 255, 0.9)) !important;
  border: 1px solid rgba(0, 102, 255, 0.2) !important;
  color: var(--cosmic-light-text) !important;
}

.pn-announcement-header {
  padding: 15px !important;
  display: flex !important;
  align-items: center !important;
}

body.cosmic-dark .pn-announcement-header {
  border-bottom: 1px solid rgba(0, 255, 255, 0.1) !important;
}

body.cosmic-light .pn-announcement-header {
  border-bottom: 1px solid rgba(0, 102, 255, 0.1) !important;
}

.pn-announcement-icon {
  width: 40px !important;
  height: 40px !important;
  border-radius: 50% !important;
  display: flex !important;
  align-items: center !important;
  justify-content: center !important;
  margin-right: 15px !important;
}

body.cosmic-dark .pn-announcement-icon {
  background: rgba(0, 255, 255, 0.1) !important;
  color: var(--cosmic-primary) !important;
}

body.cosmic-light .pn-announcement-icon {
  background: rgba(0, 102, 255, 0.1) !important;
  color: var(--cosmic-accent) !important;
}

.pn-announcement-title {
  font-weight: 600 !important;
  font-size: 1.1rem !important;
}

body.cosmic-dark .pn-announcement-title {
  color: var(--cosmic-primary) !important;
}

body.cosmic-light .pn-announcement-title {
  color: var(--cosmic-accent) !important;
}

.pn-announcement-time {
  font-size: 0.9rem !important;
}

body.cosmic-dark .pn-announcement-time {
  color: rgba(224, 224, 255, 0.7) !important;
}

body.cosmic-light .pn-announcement-time {
  color: rgba(18, 18, 37, 0.7) !important;
}

.pn-ticker {
  padding: 15px !important;
  position: relative !important;
}

.pn-ticker-item {
  padding: 10px !important;
  transition: all 0.3s ease !important;
}

body.cosmic-dark .pn-ticker-item {
  background: rgba(0, 0, 0, 0.2) !important;
}

body.cosmic-light .pn-ticker-item {
  background: rgba(255, 255, 255, 0.5) !important;
}

.pn-announcement-link {
  display: inline-flex !important;
  align-items: center !important;
  margin-top: 8px !important;
  font-size: 0.9rem !important;
  font-weight: 600 !important;
}

body.cosmic-dark .pn-announcement-link {
  color: var(--cosmic-primary) !important;
}

body.cosmic-light .pn-announcement-link {
  color: var(--cosmic-accent) !important;
}

.pn-announcement-link-icon {
  margin-left: 5px !important;
  transition: transform 0.3s ease !important;
}

.pn-announcement-link:hover .pn-announcement-link-icon {
  transform: translateX(3px) !important;
}

.pn-ticker-dots {
  display: flex !important;
  justify-content: center !important;
  margin-top: 15px !important;
  padding-bottom: 10px !important;
}

.pn-ticker-dot {
  width: 10px !important;
  height: 10px !important;
  border-radius: 50% !important;
  margin: 0 5px !important;
  cursor: pointer !important;
  transition: all 0.3s ease !important;
}

body.cosmic-dark .pn-ticker-dot {
  background: rgba(255, 255, 255, 0.3) !important;
}

body.cosmic-light .pn-ticker-dot {
  background: rgba(0, 0, 0, 0.2) !important;
}

body.cosmic-dark .pn-ticker-dot.active {
  background: var(--cosmic-primary) !important;
  box-shadow: 0 0 10px var(--cosmic-primary) !important;
}

body.cosmic-light .pn-ticker-dot.active {
  background: var(--cosmic-accent) !important;
  box-shadow: 0 0 10px var(--cosmic-accent) !important;
}
/* Marketplace centering fixes */
.marketplace-container,
.grid-container {
  width: 100% !important;
  max-width: 1200px !important;
  margin-left: auto !important;
  margin-right: auto !important;
  padding: 20px !important;
  box-sizing: border-box !important;
  display: flex !important;
  flex-direction: column !important;
  align-items: center !important;
  justify-content: center !important;
}

/* Grid layout with proper centering */
.grid-container {
  display: grid !important;
  grid-template-columns: repeat(auto-fill, minmax(300px, 1fr)) !important;
  gap: 20px !important;
  justify-items: center !important;
  align-items: stretch !important;
}

/* Ensure cards have consistent width */
.hacker-card {
  width: 100% !important;
  max-width: 350px !important;
  margin: 15px auto !important;
  display: flex !important;
  flex-direction: column !important;
  height: 100% !important;
  min-height: 300px !important;
  box-sizing: border-box !important;
}

/* Terminal section centering */
.terminal-section {
  width: 100% !important;
  max-width: 1000px !important;
  margin: 20px auto !important;
  box-sizing: border-box !important;
}

/* Search form centering */
.search-form {
  width: 100% !important;
  max-width: 600px !important;
  margin: 20px auto !important;
  display: flex !important;
  justify-content: center !important;
  align-items: center !important;
  gap: 10px !important;
}

/* Fix for search input and button */
#search-input {
  flex: 1 !important;
  max-width: 70% !important;
}

#search-button {
  min-width: 120px !important;
}

/* Fix for card content */
.card-content {
  flex: 1 !important;
  display: flex !important;
  flex-direction: column !important;
  width: 100% !important;
  justify-content: space-between !important;
}

/* Fix for card images */
.hacker-card img {
  width: 100% !important;
  height: auto !important;
  max-height: 200px !important;
  object-fit: cover !important;
  border-radius: 8px 8px 0 0 !important;
}

/* Fix for any overflow issues */
.hacker-card,
.terminal-section {
  overflow: hidden !important; /* Contain content */
}

/* Responsive adjustments */
@media (max-width: 768px) {
  .grid-container {
    grid-template-columns: 1fr !important; /* Single column on mobile */
  }
  
  .hacker-card {
    max-width: 100% !important;
  }
  
  .search-form {
    flex-direction: column !important;
    align-items: stretch !important;
  }
  
  #search-input {
    max-width: 100% !important;
    margin-bottom: 10px !important;
  }
  
  #search-button {
    width: 100% !important;
  }
}
/* Deposit Method Modals Cosmic Styling */
.modal-dialog {
  max-width: 800px !important;
  margin: 1.75rem auto !important;
}

.modal-content {
  position: relative !important;
  overflow: hidden !important;
  border-radius: 15px !important;
  box-shadow: 0 10px 30px rgba(0, 0, 0, 0.3) !important;
  transform: translateZ(0) !important;
  backdrop-filter: blur(10px) !important;
  -webkit-backdrop-filter: blur(10px) !important;
  border: none !important;
}

body.cosmic-dark .modal-content {
  background: linear-gradient(135deg, rgba(18, 18, 37, 0.9), rgba(10, 10, 30, 0.95)) !important;
  border: 1px solid rgba(0, 255, 255, 0.2) !important;
  color: var(--cosmic-dark-text) !important;
}

body.cosmic-light .modal-content {
  background: linear-gradient(135deg, rgba(255, 255, 255, 0.9), rgba(240, 245, 255, 0.95)) !important;
  border: 1px solid rgba(0, 102, 255, 0.2) !important;
  color: var(--cosmic-light-text) !important;
}

.modal-content::before {
  content: "" !important;
  position: absolute !important;
  top: -50% !important;
  left: -50% !important;
  width: 200% !important;
  height: 200% !important;
  background: conic-gradient(
    transparent, 
    rgba(0, 255, 255, 0.1), 
    transparent 30%,
    transparent 70%,
    rgba(255, 0, 255, 0.1),
    transparent
  ) !important;
  animation: cosmic-rotate 10s linear infinite !important;
  z-index: -1 !important;
}

.modal-header {
  border-bottom: none !important;
  padding: 20px 25px !important;
}

body.cosmic-dark .modal-header {
  border-bottom: 1px solid rgba(0, 255, 255, 0.1) !important;
}

body.cosmic-light .modal-header {
  border-bottom: 1px solid rgba(0, 102, 255, 0.1) !important;
}

.modal-title {
  font-weight: 600 !important;
  letter-spacing: 0.5px !important;
}

body.cosmic-dark .modal-title {
  color: var(--cosmic-primary) !important;
  text-shadow: 0 0 10px rgba(0, 204, 255, 0.5) !important;
}

body.cosmic-light .modal-title {
  color: var(--cosmic-accent) !important;
  text-shadow: 0 0 10px rgba(123, 104, 238, 0.3) !important;
}

.modal-body {
  padding: 25px !important;
}

.modal-footer {
  border-top: none !important;
  padding: 15px 25px 25px !important;
}

body.cosmic-dark .modal-footer {
  border-top: 1px solid rgba(0, 255, 255, 0.1) !important;
}

body.cosmic-light .modal-footer {
  border-top: 1px solid rgba(0, 102, 255, 0.1) !important;
}

/* Close button */
.btn-close {
  background: transparent !important;
  opacity: 1 !important;
  position: relative !important;
  width: 30px !important;
  height: 30px !important;
}

body.cosmic-dark .btn-close::before,
body.cosmic-dark .btn-close::after {
  content: '' !important;
  position: absolute !important;
  width: 2px !important;
  height: 20px !important;
  background-color: var(--cosmic-primary) !important;
  top: 5px !important;
  left: 14px !important;
}

body.cosmic-light .btn-close::before,
body.cosmic-light .btn-close::after {
  content: '' !important;
  position: absolute !important;
  width: 2px !important;
  height: 20px !important;
  background-color: var(--cosmic-accent) !important;
  top: 5px !important;
  left: 14px !important;
}

.btn-close::before {
  transform: rotate(45deg) !important;
}

.btn-close::after {
  transform: rotate(-45deg) !important;
}

.btn-close:hover {
  transform: scale(1.1) !important;
}

/* Card in modal */
.modal .card {
  border-radius: 10px !important;
  overflow: hidden !important;
  transition: transform 0.3s ease, box-shadow 0.3s ease !important;
}

body.cosmic-dark .modal .card {
  background: rgba(0, 0, 0, 0.2) !important;
  border: 1px solid rgba(0, 255, 255, 0.2) !important;
  box-shadow: 0 5px 15px rgba(0, 0, 0, 0.3) !important;
}

body.cosmic-light .modal .card {
  background: rgba(255, 255, 255, 0.8) !important;
  border: 1px solid rgba(123, 104, 238, 0.2) !important;
  box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1) !important;
}

/* Form elements in modal */
.modal input[type="number"],
.modal input[type="text"] {
  width: 100% !important;
  padding: 12px 15px !important;
  border-radius: 8px !important;
  font-size: 1rem !important;
  transition: all 0.3s ease !important;
  position: relative !important;
}

body.cosmic-dark .modal input[type="number"],
body.cosmic-dark .modal input[type="text"] {
  background: rgba(0, 0, 0, 0.2) !important;
  border: 1px solid rgba(0, 255, 255, 0.3) !important;
  color: #fff !important;
  box-shadow: inset 0 0 5px rgba(0, 255, 255, 0.2) !important;
}

body.cosmic-light .modal input[type="number"],
body.cosmic-light .modal input[type="text"] {
  background: rgba(255, 255, 255, 0.8) !important;
  border: 1px solid rgba(123, 104, 238, 0.3) !important;
  color: #000 !important;
  box-shadow: inset 0 0 5px rgba(123, 104, 238, 0.2) !important;
}

body.cosmic-dark .modal input[type="number"]:focus,
body.cosmic-dark .modal input[type="text"]:focus {
  background: rgba(0, 0, 0, 0.3) !important;
  border-color: var(--cosmic-primary) !important;
  box-shadow: 0 0 10px var(--cosmic-primary) !important;
  outline: none !important;
}

body.cosmic-light .modal input[type="number"]:focus,
body.cosmic-light .modal input[type="text"]:focus {
  background: rgba(255, 255, 255, 1) !important;
  border-color: var(--cosmic-accent) !important;
  box-shadow: 0 0 10px rgba(123, 104, 238, 0.5) !important;
  outline: none !important;
}

/* Input group */
.modal .input-group-text {
  border-radius: 0 8px 8px 0 !important;
}

body.cosmic-dark .modal .input-group-text {
  background: rgba(0, 255, 255, 0.1) !important;
  color: var(--cosmic-primary) !important;
  border: 1px solid rgba(0, 255, 255, 0.3) !important;
  border-left: none !important;
}

body.cosmic-light .modal .input-group-text {
  background: rgba(123, 104, 238, 0.1) !important;
  color: var(--cosmic-accent) !important;
  border: 1px solid rgba(123, 104, 238, 0.3) !important;
  border-left: none !important;
}

/* Alert in modal */
.modal .alert {
  border-radius: 8px !important;
  padding: 15px !important;
  margin-bottom: 20px !important;
}

body.cosmic-dark .modal .alert-info {
  background: rgba(0, 20, 50, 0.3) !important;
  border: 1px solid rgba(0, 255, 255, 0.2) !important;
  color: var(--cosmic-dark-text) !important;
}

body.cosmic-light .modal .alert-info {
  background: rgba(240, 240, 255, 0.5) !important;
  border: 1px solid rgba(0, 102, 255, 0.2) !important;
  color: var(--cosmic-light-text) !important;
}

/* Buttons in modal */
.modal .btn-primary {
  background: linear-gradient(45deg, #00ccff, #7b68ee) !important;
  border: none !important;
  padding: 12px 25px !important;
  border-radius: 8px !important;
  font-size: 1rem !important;
  font-weight: bold !important;
  cursor: pointer !important;
  position: relative !important;
  overflow: hidden !important;
  transition: all 0.3s ease !important;
  z-index: 1 !important;
  letter-spacing: 0.5px !important;
  width: 100% !important;
}

body.cosmic-dark .modal .btn-primary {
  color: #fff !important;
  box-shadow: 0 0 15px rgba(0, 204, 255, 0.5) !important;
}

body.cosmic-light .modal .btn-primary {
  color: #fff !important;
  box-shadow: 0 0 15px rgba(123, 104, 238, 0.5) !important;
}

.modal .btn-primary::before {
  content: "" !important;
  position: absolute !important;
  top: 0 !important;
  left: -100% !important;
  width: 100% !important;
  height: 100% !important;
  background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.3), transparent) !important;
  transition: left 0.7s ease !important;
  z-index: -1 !important;
}

.modal .btn-primary:hover {
  transform: translateY(-3px) !important;
}

.modal .btn-primary:hover::before {
  left: 100% !important;
}

/* Payment icons */
.payment-icons {
  display: flex !important;
  justify-content: center !important;
  gap: 10px !important;
  margin-top: 15px !important;
}

.payment-icons img {
  transition: transform 0.3s ease !important;
}

.payment-icons img:hover {
  transform: translateY(-3px) !important;
}

/* Labels */
.modal label {
  display: block !important;
  margin-bottom: 8px !important;
  font-weight: 500 !important;
}

body.cosmic-dark .modal label {
  color: var(--cosmic-primary) !important;
}

body.cosmic-light .modal label {
  color: var(--cosmic-accent) !important;
}

/* Modal backdrop */
.modal-backdrop {
  background-color: rgba(0, 0, 0, 0.7) !important;
  backdrop-filter: blur(5px) !important;
  -webkit-backdrop-filter: blur(5px) !important;
}

/* Modal animation */
.modal.fade .modal-dialog {
  transform: scale(0.9) !important;
  opacity: 0 !important;
  transition: transform 0.3s ease, opacity 0.3s ease !important;
}

.modal.show .modal-dialog {
  transform: scale(1) !important;
  opacity: 1 !important;
}

/* Fix for modal scrollbar */
.modal {
  overflow-y: auto !important;
}

/* Fix for modal on mobile */
@media (max-width: 768px) {
  .modal-dialog {
    margin: 10px !important;
    width: calc(100% - 20px) !important;
    max-width: none !important;
  }
  
  .modal-body {
    padding: 15px !important;
  }
  
  .payment-icons {
    flex-wrap: wrap !important;
  }
}
/* Stats, Blog, CTA Sections and Announcement Modal Cosmic Styling */

/* Stats Section */
.stats-section {
  padding: 80px 0 !important;
  position: relative !important;
  overflow: hidden !important;
}

body.cosmic-dark .stats-section {
  background: linear-gradient(135deg, rgba(10, 10, 26, 0.7), rgba(18, 18, 37, 0.8)) !important;
  color: var(--cosmic-dark-text) !important;
}

body.cosmic-light .stats-section {
  background: linear-gradient(135deg, rgba(240, 245, 255, 0.7), rgba(255, 255, 255, 0.8)) !important;
  color: var(--cosmic-light-text) !important;
}

.stats-header {
  text-align: center !important;
  margin-bottom: 50px !important;
}

.stats-title {
  font-size: 2.5rem !important;
  margin-bottom: 15px !important;
  position: relative !important;
  display: inline-block !important;
}

body.cosmic-dark .stats-title {
  color: var(--cosmic-primary) !important;
  text-shadow: 0 0 10px rgba(0, 204, 255, 0.5) !important;
}

body.cosmic-light .stats-title {
  color: var(--cosmic-accent) !important;
  text-shadow: 0 0 10px rgba(123, 104, 238, 0.3) !important;
}

.stats-subtitle {
  font-size: 1.2rem !important;
  opacity: 0.9 !important;
}

/* Stats Cards */
.stats-grid {
  display: grid !important;
  grid-template-columns: repeat(auto-fit, minmax(250px, 1fr)) !important;
  gap: 30px !important;
  margin-top: 30px !important;
}

.stats-card {
  border-radius: 15px !important;
  padding: 30px !important;
  text-align: center !important;
  transition: transform 0.3s ease, box-shadow 0.3s ease !important;
  position: relative !important;
  overflow: hidden !important;
}

body.cosmic-dark .stats-card {
  background: rgba(0, 0, 0, 0.2) !important;
  border: 1px solid rgba(0, 255, 255, 0.2) !important;
  box-shadow: 0 5px 15px rgba(0, 0, 0, 0.3) !important;
}

body.cosmic-light .stats-card {
  background: rgba(255, 255, 255, 0.8) !important;
  border: 1px solid rgba(123, 104, 238, 0.2) !important;
  box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1) !important;
}

.stats-card:hover {
  transform: translateY(-10px) !important;
}

body.cosmic-dark .stats-card:hover {
  box-shadow: 0 15px 30px rgba(0, 255, 255, 0.2) !important;
}

body.cosmic-light .stats-card:hover {
  box-shadow: 0 15px 30px rgba(123, 104, 238, 0.2) !important;
}

.stats-icon {
  font-size: 2.5rem !important;
  margin-bottom: 20px !important;
}

body.cosmic-dark .stats-icon {
  color: var(--cosmic-primary) !important;
  text-shadow: 0 0 15px rgba(0, 204, 255, 0.7) !important;
}

body.cosmic-light .stats-icon {
  color: var(--cosmic-accent) !important;
  text-shadow: 0 0 15px rgba(123, 104, 238, 0.7) !important;
}

.stats-value {
  font-size: 2.5rem !important;
  font-weight: 700 !important;
  margin-bottom: 10px !important;
}

body.cosmic-dark .stats-value {
  color: var(--cosmic-primary) !important;
}

body.cosmic-light .stats-value {
  color: var(--cosmic-accent) !important;
}

.stats-label {
  font-size: 1.1rem !important;
  opacity: 0.9 !important;
}

/* Blog Section */
.blog-section {
  padding: 80px 0 !important;
  position: relative !important;
  overflow: hidden !important;
}

body.cosmic-dark .blog-section {
  background: linear-gradient(135deg, rgba(18, 18, 37, 0.8), rgba(10, 10, 26, 0.7)) !important;
  color: var(--cosmic-dark-text) !important;
}

body.cosmic-light .blog-section {
  background: linear-gradient(135deg, rgba(255, 255, 255, 0.8), rgba(240, 245, 255, 0.7)) !important;
  color: var(--cosmic-light-text) !important;
}

.blog-header {
  display: flex !important;
  justify-content: space-between !important;
  align-items: center !important;
  margin-bottom: 50px !important;
  flex-wrap: wrap !important;
}

.blog-title {
  font-size: 2.5rem !important;
  margin-bottom: 15px !important;
  position: relative !important;
  display: inline-block !important;
}

body.cosmic-dark .blog-title {
  color: var(--cosmic-primary) !important;
  text-shadow: 0 0 10px rgba(0, 204, 255, 0.5) !important;
}

body.cosmic-light .blog-title {
  color: var(--cosmic-accent) !important;
  text-shadow: 0 0 10px rgba(123, 104, 238, 0.3) !important;
}

.blog-subtitle {
  font-size: 1.2rem !important;
  opacity: 0.9 !important;
}

body.cosmic-dark .btn-outline-primary {
  color: var(--cosmic-primary) !important;
  border-color: var(--cosmic-primary) !important;
  background: transparent !important;
}

body.cosmic-light .btn-outline-primary {
  color: var(--cosmic-accent) !important;
  border-color: var(--cosmic-accent) !important;
  background: transparent !important;
}

body.cosmic-dark .btn-outline-primary:hover {
  background: rgba(0, 204, 255, 0.1) !important;
  box-shadow: 0 0 15px rgba(0, 204, 255, 0.5) !important;
}

body.cosmic-light .btn-outline-primary:hover {
  background: rgba(123, 104, 238, 0.1) !important;
  box-shadow: 0 0 15px rgba(123, 104, 238, 0.5) !important;
}

/* Blog Grid */
.blog-grid {
  display: grid !important;
  grid-template-columns: repeat(auto-fill, minmax(300px, 1fr)) !important;
  gap: 30px !important;
}

.blog-card {
  border-radius: 15px !important;
  overflow: hidden !important;
  transition: transform 0.3s ease, box-shadow 0.3s ease !important;
  height: 100% !important;
  display: flex !important;
  flex-direction: column !important;
}

body.cosmic-dark .blog-card {
  background: rgba(0, 0, 0, 0.2) !important;
  border: 1px solid rgba(0, 255, 255, 0.2) !important;
  box-shadow: 0 5px 15px rgba(0, 0, 0, 0.3) !important;
}

body.cosmic-light .blog-card {
  background: rgba(255, 255, 255, 0.8) !important;
  border: 1px solid rgba(123, 104, 238, 0.2) !important;
  box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1) !important;
}

.blog-card:hover {
  transform: translateY(-10px) !important;
}

body.cosmic-dark .blog-card:hover {
  box-shadow: 0 15px 30px rgba(0, 255, 255, 0.2) !important;
}

body.cosmic-light .blog-card:hover {
  box-shadow: 0 15px 30px rgba(123, 104, 238, 0.2) !important;
}

.blog-card-image-wrapper {
  position: relative !important;
  height: 200px !important;
  overflow: hidden !important;
}

.blog-card-image {
  width: 100% !important;
  height: 100% !important;
  object-fit: cover !important;
  transition: transform 0.5s ease !important;
}

.blog-card:hover .blog-card-image {
  transform: scale(1.1) !important;
}

.blog-card-category {
  position: absolute !important;
  top: 15px !important;
  right: 15px !important;
  padding: 5px 15px !important;
  border-radius: 20px !important;
  font-size: 0.8rem !important;
  font-weight: 600 !important;
  text-transform: uppercase !important;
  letter-spacing: 1px !important;
}

body.cosmic-dark .blog-card-category {
  background: var(--cosmic-primary) !important;
  color: #000 !important;
  box-shadow: 0 0 10px rgba(0, 204, 255, 0.5) !important;
}

body.cosmic-light .blog-card-category {
  background: var(--cosmic-accent) !important;
  color: #fff !important;
  box-shadow: 0 0 10px rgba(123, 104, 238, 0.5) !important;
}

.blog-card-content {
  padding: 25px !important;
  flex: 1 !important;
  display: flex !important;
  flex-direction: column !important;
}

.blog-card-meta {
  display: flex !important;
  align-items: center !important;
  margin-bottom: 15px !important;
  flex-wrap: wrap !important;
}

.blog-card-author-image {
  width: 30px !important;
  height: 30px !important;
  border-radius: 50% !important;
  object-fit: cover !important;
  margin-right: 10px !important;
}

.blog-card-author {
  font-size: 0.9rem !important;
  font-weight: 600 !important;
  margin-right: 15px !important;
}

.blog-card-date {
  font-size: 0.85rem !important;
  opacity: 0.7 !important;
}

.blog-card-title {
  font-size: 1.3rem !important;
  margin-bottom: 15px !important;
  line-height: 1.4 !important;
}

.blog-card-title a {
  text-decoration: none !important;
  transition: color 0.3s ease !important;
}

body.cosmic-dark .blog-card-title a {
  color: var(--cosmic-primary) !important;
}

body.cosmic-light .blog-card-title a {
  color: var(--cosmic-accent) !important;
}

.blog-card-excerpt {
  font-size: 0.95rem !important;
  line-height: 1.6 !important;
  margin-bottom: 20px !important;
  flex: 1 !important;
}

.blog-card-footer {
  margin-top: auto !important;
}

.blog-card-link {
  display: inline-flex !important;
  align-items: center !important;
  font-size: 0.95rem !important;
  font-weight: 600 !important;
  text-decoration: none !important;
  transition: all 0.3s ease !important;
}

body.cosmic-dark .blog-card-link {
  color: var(--cosmic-primary) !important;
}

body.cosmic-light .blog-card-link {
  color: var(--cosmic-accent) !important;
}

.blog-card-link-icon {
  margin-left: 8px !important;
  transition: transform 0.3s ease !important;
}

.blog-card-link:hover .blog-card-link-icon {
  transform: translateX(5px) !important;
}

/* CTA Section */
.cta-section {
  padding: 100px 0 !important;
  position: relative !important;
  overflow: hidden !important;
}

body.cosmic-dark .cta-section {
  background: linear-gradient(135deg, rgba(0, 20, 50, 0.8), rgba(50, 0, 50, 0.8)) !important;
  color: var(--cosmic-dark-text) !important;
}

body.cosmic-light .cta-section {
  background: linear-gradient(135deg, rgba(100, 150, 255, 0.8), rgba(150, 100, 255, 0.8)) !important;
  color: #fff !important;
}

.cta-section::before {
  content: "" !important;
  position: absolute !important;
  top: 0 !important;
  left: 0 !important;
  width: 100% !important;
  height: 100% !important;
  background-size: cover !important;
  background-position: center !important;
  opacity: 0.1 !important;
  z-index: -1 !important;
}

.cta-content {
  text-align: center !important;
  padding: 50px !important;
  border-radius: 20px !important;
  position: relative !important;
  overflow: hidden !important;
}

body.cosmic-dark .cta-content {
  background: rgba(0, 0, 0, 0.3) !important;
  border: 1px solid rgba(0, 255, 255, 0.2) !important;
  box-shadow: 0 10px 30px rgba(0, 0, 0, 0.3) !important;
}

body.cosmic-light .cta-content {
  background: rgba(255, 255, 255, 0.2) !important;
  border: 1px solid rgba(255, 255, 255, 0.3) !important;
  box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1) !important;
}

.cta-content::before {
  content: "" !important;
  position: absolute !important;
  top: -50% !important;
  left: -50% !important;
  width: 200% !important;
  height: 200% !important;
  background: conic-gradient(
    transparent, 
    rgba(0, 255, 255, 0.1), 
    transparent 30%,
    transparent 70%,
    rgba(255, 0, 255, 0.1),
    transparent
  ) !important;
  animation: cosmic-rotate 10s linear infinite !important;
  z-index: -1 !important;
}

.cta-badge {
  display: inline-block !important;
  padding: 8px 20px !important;
  border-radius: 30px !important;
  font-size: 0.9rem !important;
  font-weight: 600 !important;
  text-transform: uppercase !important;
  letter-spacing: 1px !important;
  margin-bottom: 25px !important;
}

body.cosmic-dark .cta-badge {
  background: var(--cosmic-primary) !important;
  color: #000 !important;
  box-shadow: 0 0 15px rgba(0, 204, 255, 0.5) !important;
}

body.cosmic-light .cta-badge {
  background: #fff !important;
  color: var(--cosmic-accent) !important;
  box-shadow: 0 0 15px rgba(255, 255, 255, 0.5) !important;
}

.cta-title {
  font-size: 2.8rem !important;
  margin-bottom: 25px !important;
  color: #fff !important;
  text-shadow: 0 0 15px rgba(0, 0, 0, 0.3) !important;
}

.cta-description {
  font-size: 1.2rem !important;
  max-width: 800px !important;
  margin: 0 auto 40px !important;
  opacity: 0.9 !important;
}

.cta-buttons {
  display: flex !important;
  justify-content: center !important;
  gap: 20px !important;
  flex-wrap: wrap !important;
}

.btn-light {
  background: #fff !important;
  color: var(--cosmic-accent) !important;
  border: none !important;
  padding: 12px 30px !important;
  font-weight: 600 !important;
  transition: all 0.3s ease !important;
}

.btn-light:hover {
  transform: translateY(-5px) !important;
  box-shadow: 0 10px 25px rgba(0, 0, 0, 0.2) !important;
}

.btn-outline-light {
  background: transparent !important;
  color: #fff !important;
  border: 2px solid #fff !important;
  padding: 12px 30px !important;
  font-weight: 600 !important;
  transition: all 0.3s ease !important;
}

.btn-outline-light:hover {
  background: rgba(255, 255, 255, 0.1) !important;
  transform: translateY(-5px) !important;
}

/* Announcement Modal */
.modal-overlay {
  position: fixed !important;
  top: 0 !important;
  left: 0 !important;
  width: 100% !important;
  height: 100% !important;
  background: rgba(0, 0, 0, 0.7) !important;
  backdrop-filter: blur(5px) !important;
  -webkit-backdrop-filter: blur(5px) !important;
  display: flex !important;
  justify-content: center !important;
  align-items: center !important;
  z-index: 9999 !important;
}

.modal {
  width: 90% !important;
  max-width: 600px !important;
  border-radius: 15px !important;
  overflow: hidden !important;
  position: relative !important;
  animation: modal-zoom 0.3s ease-out !important;
}

@keyframes modal-zoom {
  from {
    transform: scale(0.8);
    opacity: 0;
  }
  to {
    transform: scale(1);
    opacity: 1;
  }
}

body.cosmic-dark .modal {
  background: linear-gradient(135deg, rgba(18, 18, 37, 0.9), rgba(10, 10, 26, 0.95)) !important;
  border: 1px solid rgba(0, 255, 255, 0.2) !important;
  color: var(--cosmic-dark-text) !important;
  box-shadow: 0 15px 40px rgba(0, 0, 0, 0.5) !important;
}

body.cosmic-light .modal {
  background: linear-gradient(135deg, rgba(255, 255, 255, 0.9), rgba(240, 245, 255, 0.95)) !important;
  border: 1px solid rgba(123, 104, 238, 0.2) !important;
  color: var(--cosmic-light-text) !important;
  box-shadow: 0 15px 40px rgba(0, 0, 0, 0.2) !important;
}

.modal::before {
  content: "" !important;
  position: absolute !important;
  top: -50% !important;
  left: -50% !important;
  width: 200% !important;
  height: 200% !important;
  background: conic-gradient(
    transparent, 
    rgba(0, 255, 255, 0.1), 
    transparent 30%,
    transparent 70%,
    rgba(255, 0, 255, 0.1),
    transparent
  ) !important;
  animation: cosmic-rotate 10s linear infinite !important;
  z-index: -1 !important;
}

.modal-header {
  display: flex !important;
  justify-content: space-between !important;
  align-items: center !important;
  padding: 20px 25px !important;
}

body.cosmic-dark .modal-header {
  border-bottom: 1px solid rgba(0, 255, 255, 0.1) !important;
}

body.cosmic-light .modal-header {
  border-bottom: 1px solid rgba(123, 104, 238, 0.1) !important;
}

.modal-title {
  font-size: 1.5rem !important;
  font-weight: 600 !important;
}

body.cosmic-dark .modal-title {
  color: var(--cosmic-primary) !important;
  text-shadow: 0 0 10px rgba(0, 204, 255, 0.5) !important;
}

body.cosmic-light .modal-title {
  color: var(--cosmic-accent) !important;
  text-shadow: 0 0 10px rgba(123, 104, 238, 0.3) !important;
}

.modal-close {
  background: transparent !important;
  border: none !important;
  font-size: 1.5rem !important;
  cursor: pointer !important;
  width: 40px !important;
  height: 40px !important;
  display: flex !important;
  align-items: center !important;
  justify-content: center !important;
  border-radius: 50% !important;
  transition: all 0.3s ease !important;
}

body.cosmic-dark .modal-close {
  color: var(--cosmic-primary) !important;
}

body.cosmic-light .modal-close {
  color: var(--cosmic-accent) !important;
}

.modal-close:hover {
  transform: rotate(90deg) !important;
}

body.cosmic-dark .modal-close:hover {
  background: rgba(0, 255, 255, 0.1) !important;
}

body.cosmic-light .modal-close:hover {
  background: rgba(123, 104, 238, 0.1) !important;
}

.modal-body {
  padding: 25px !important;
  max-height: 70vh !important;
  overflow-y: auto !important;
}

.modal-image {
  width: 100% !important;
  max-height: 300px !important;
  object-fit: cover !important;
  border-radius: 10px !important;
  margin-bottom: 20px !important;
}

body.cosmic-dark .modal-image {
  box-shadow: 0 5px 15px rgba(0, 0, 0, 0.3) !important;
}

body.cosmic-light .modal-image {
  box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1) !important;
}

.modal-content {
  line-height: 1.6 !important;
  font-size: 1rem !important;
}

.modal-footer {
  display: flex !important;
  justify-content: flex-end !important;
  gap: 15px !important;
  padding: 20px 25px !important;
}

body.cosmic-dark .modal-footer {
  border-top: 1px solid rgba(0, 255, 255, 0.1) !important;
}

body.cosmic-light .modal-footer {
  border-top: 1px solid rgba(123, 104, 238, 0.1) !important;
}

.btn-secondary {
  background: transparent !important;
  padding: 10px 20px !important;
  border-radius: 8px !important;
  font-weight: 600 !important;
  transition: all 0.3s ease !important;
}

body.cosmic-dark .btn-secondary {
  color: var(--cosmic-dark-text) !important;
  border: 1px solid rgba(255, 255, 255, 0.2) !important;
}

body.cosmic-light .btn-secondary {
  color: var(--cosmic-light-text) !important;
  border: 1px solid rgba(0, 0, 0, 0.2) !important;
}

body.cosmic-dark .btn-secondary:hover {
  background: rgba(255, 255, 255, 0.1) !important;
}

body.cosmic-light .btn-secondary:hover {
  background: rgba(0, 0, 0, 0.05) !important;
}

.btn-primary {
  background: linear-gradient(45deg, #00ccff, #7b68ee) !important;
  border: none !important;
  padding: 10px 20px !important;
  border-radius: 8px !important;
  font-weight: 600 !important;
  position: relative !important;
  overflow: hidden !important;
  transition: all 0.3s ease !important;
  z-index: 1 !important;
}

body.cosmic-dark .btn-primary {
  color: #fff !important;
  box-shadow: 0 0 15px rgba(0, 204, 255, 0.5) !important;
}

body.cosmic-light .btn-primary {
  color: #fff !important;
  box-shadow: 0 0 15px rgba(123, 104, 238, 0.5) !important;
}

.btn-primary::before {
  content: "" !important;
  position: absolute !important;
  top: 0 !important;
  left: -100% !important;
  width: 100% !important;
  height: 100% !important;
  background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.3), transparent) !important;
  transition: left 0.7s ease !important;
  z-index: -1 !important;
}

.btn-primary:hover {
  transform: translateY(-3px) !important;
}

.btn-primary:hover::before {
  left: 100% !important;
}

/* Alert styling */
.alert {
  padding: 15px 20px !important;
  border-radius: 10px !important;
  margin-bottom: 20px !important;
  position: relative !important;
}

body.cosmic-dark .alert-info {
  background: rgba(0, 20, 50, 0.3) !important;
  border: 1px solid rgba(0, 255, 255, 0.2) !important;
  color: var(--cosmic-dark-text) !important;
}

body.cosmic-light .alert-info {
  background: rgba(240, 240, 255, 0.5) !important;
  border: 1px solid rgba(0, 102, 255, 0.2) !important;
  color: var(--cosmic-light-text) !important;
}

body.cosmic-dark .alert-danger {
  background: rgba(50, 0, 0, 0.3) !important;
  border: 1px solid rgba(255, 0, 0, 0.2) !important;
  color: #ffe0e0 !important;
}

body.cosmic-light .alert-danger {
  background: rgba(255, 240, 240, 0.5) !important;
  border: 1px solid rgba(255, 0, 0, 0.2) !important;
  color: #660000 !important;
}

/* Animation classes */
.fade-in {
  animation: fade-in 1s ease forwards !important;
}

.slide-up {
  animation: slide-up 1s ease forwards !important;
}

.slide-down {
  animation: slide-down 1s ease forwards !important;
}

.zoom-in {
  animation: zoom-in 1s ease forwards !important;
}

@keyframes fade-in {
  from {
    opacity: 0;
  }
  to {
    opacity: 1;
  }
}

@keyframes slide-up {
  from {
    opacity: 0;
    transform: translateY(50px);
  }
  to {
    opacity: 1;
    transform: translateY(0);
  }
}

@keyframes slide-down {
  from {
    opacity: 0;
    transform: translateY(-50px);
  }
  to {
    opacity: 1;
    transform: translateY(0);
  }
}

@keyframes zoom-in {
  from {
    opacity: 0;
    transform: scale(0.8);
  }
  to {
    opacity: 1;
    transform: scale(1);
  }
}

/* Responsive adjustments */
@media (max-width: 768px) {
  .stats-title,
  .blog-title,
  .cta-title {
    font-size: 2rem !important;
  }
  
  .stats-subtitle,
  .blog-subtitle,
  .cta-description {
    font-size: 1rem !important;
  }
  
  .blog-header {
    flex-direction: column !important;
    align-items: flex-start !important;
    gap: 20px !important;
  }
  
  .blog-grid {
    grid-template-columns: 1fr !important;
  }
  
  .cta-content {
    padding: 30px 20px !important;
  }
  
  .cta-buttons {
    flex-direction: column !important;
    gap: 15px !important;
  }
  
  .modal {
    width: 95% !important;
    max-height: 90vh !important;
  }
  
  .modal-body {
    max-height: 60vh !important;
  }
}

/* Fix for any conflicts with Bootstrap */
.modal-dialog {
  margin: 1.75rem auto !important;
}

.modal-content {
  background-clip: padding-box !important;
}

.modal-header .btn-close {
  padding: 0.5rem !important;
  margin: -0.5rem -0.5rem -0.5rem auto !important;
}

.row {
  display: flex !important;
  flex-wrap: wrap !important;
  margin-right: -15px !important;
  margin-left: -15px !important;
}

.col-12, .col-md-5, .col-md-7, .col-lg-10 {
  position: relative !important;
  width: 100% !important;
  padding-right: 15px !important;
  padding-left: 15px !important;
}

.col-12 {
  flex: 0 0 100% !important;
  max-width: 100% !important;
}

@media (min-width: 768px) {
  .col-md-5 {
    flex: 0 0 41.666667% !important;
    max-width: 41.666667% !important;
  }
  
  .col-md-7 {
    flex: 0 0 58.333333% !important;
    max-width: 58.333333% !important;
  }
}

@media (min-width: 992px) {
  .col-lg-10 {
    flex: 0 0 83.333333% !important;
    max-width: 83.333333% !important;
  }
}

.justify-content-center {
  justify-content: center !important;
}

.text-center {
  text-align: center !important;
}

.mb-3 {
  margin-bottom: 1rem !important;
}

.mb-4 {
  margin-bottom: 1.5rem !important;
}

.ms-2 {
  margin-left: 0.5rem !important;
}

.me-2 {
  margin-right: 0.5rem !important;
}

.mt-3 {
  margin-top: 1rem !important;
}

.form-label {
  margin-bottom: 0.5rem !important;
  display: inline-block !important;
}

.form-control {
  display: block !important;
  width: 100% !important;
  padding: 0.375rem 0.75rem !important;
  font-size: 1rem !important;
  font-weight: 400 !important;
  line-height: 1.5 !important;
  background-clip: padding-box !important;
  border-radius: 0.25rem !important;
  transition: border-color 0.15s ease-in-out, box-shadow 0.15s ease-in-out !important;
}

.input-group {
  position: relative !important;
  display: flex !important;
  flex-wrap: wrap !important;
  align-items: stretch !important;
  width: 100% !important;
}

.input-group-text {
  display: flex !important;
  align-items: center !important;
  padding: 0.375rem 0.75rem !important;
  font-size: 1rem !important;
  font-weight: 400 !important;
  line-height: 1.5 !important;
  text-align: center !important;
  white-space: nowrap !important;
  border-radius: 0 0.25rem 0.25rem 0 !important;
}

.d-grid {
  display: grid !important;
}

.btn-lg {
  padding: 0.5rem 1rem !important;
  font-size: 1.25rem !important;
  border-radius: 0.3rem !important;
}

.shadow-lg {
  box-shadow: 0 1rem 3rem rgba(0, 0, 0, 0.175) !important;
}

.img-fluid {
  max-width: 100% !important;
  height: auto !important;
}

.payment-icons {
  display: flex !important;
  justify-content: center !important;
  gap: 10px !important;
  margin-top: 15px !important;
}



</style>

<script>
// Create and append theme toggle button
document.addEventListener('DOMContentLoaded', function() {
  // Add cosmic classes to body - always start with dark mode
  document.body.classList.add('cosmic-dark');
  
  // Create particles container
  const particlesContainer = document.createElement('div');
  particlesContainer.className = 'cosmic-particles';
  particlesContainer.id = 'cosmic-particles';
  document.body.appendChild(particlesContainer);
  
  // Create theme toggle button
  const themeToggle = document.createElement('button');
  themeToggle.className = 'cosmic-theme-toggle';
  themeToggle.innerHTML = '<i class="fas fa-moon"></i>';
  themeToggle.title = 'Toggle Light/Dark Mode';
  
  // Check if Font Awesome is loaded, if not, load it
  if (!document.querySelector('link[href*="font-awesome"]')) {
    const fontAwesome = document.createElement('link');
    fontAwesome.rel = 'stylesheet';
    fontAwesome.href = 'https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css';
    document.head.appendChild(fontAwesome);
  }
  
  document.body.appendChild(themeToggle);
  
  // Theme toggle functionality
  themeToggle.addEventListener('click', function() {
    if (document.body.classList.contains('cosmic-dark')) {
      document.body.classList.remove('cosmic-dark');
      document.body.classList.add('cosmic-light');
      this.innerHTML = '<i class="fas fa-sun"></i>';
      localStorage.setItem('cosmic-theme', 'light');
    } else {
      document.body.classList.remove('cosmic-light');
      document.body.classList.add('cosmic-dark');
      this.innerHTML = '<i class="fas fa-moon"></i>';
      localStorage.setItem('cosmic-theme', 'dark');
    }
  });
  
  // Check for saved theme preference only
  const savedTheme = localStorage.getItem('cosmic-theme');
  if (savedTheme === 'light') {
    document.body.classList.remove('cosmic-dark');
    document.body.classList.add('cosmic-light');
    themeToggle.innerHTML = '<i class="fas fa-sun"></i>';
  }
  // No system preference detection - always default to dark mode
  
  // Create and animate particles
  createParticles();
  
  // Add hover effects to all buttons
  addButtonEffects();
  
  // Add floating animation to containers
  addFloatingEffect();
  
  // Process any session messages
  processSessionMessages();
  
  // Add block styling
  enhanceBlocks();
  
  // Initialize announcement ticker
  initAnnouncementTicker();
});

// Initialize announcement ticker
function initAnnouncementTicker() {
  const tickerItems = document.querySelectorAll('.pn-ticker-item');
  const tickerDots = document.querySelectorAll('.pn-ticker-dot');
  
  if (tickerItems.length === 0) return;
  
  // Hide all items except the first one
  tickerItems.forEach((item, index) => {
    if (index !== 0) {
      item.style.display = 'none';
    }
  });
  
  // Add click event to dots
  tickerDots.forEach(dot => {
    dot.addEventListener('click', function() {
      const index = this.getAttribute('data-index');
      
      // Hide all items
      tickerItems.forEach(item => {
        item.style.display = 'none';
      });
      
      // Show selected item
      const selectedItem = document.querySelector(`.pn-ticker-item[data-index="${index}"]`);
      if (selectedItem) {
        selectedItem.style.display = 'block';
      }
      
      // Update active dot
      tickerDots.forEach(d => {
        d.classList.remove('active');
      });
      this.classList.add('active');
    });
  });
  
  // Auto rotate announcements
  let currentIndex = 1;
  setInterval(() => {
    const nextIndex = currentIndex % tickerItems.length + 1;
    const nextDot = document.querySelector(`.pn-ticker-dot[data-index="${nextIndex}"]`);
    if (nextDot) {
      nextDot.click();
      currentIndex = nextIndex;
    }
  }, 5000);
}


// Create cosmic particles
function createParticles() {
  const particlesContainer = document.getElementById('cosmic-particles');
  const particleCount = 50;
  
  for (let i = 0; i < particleCount; i++) {
    const particle = document.createElement('div');
    particle.className = 'cosmic-particle';
    
    // Random particle styling
    const size = Math.random() * 5 + 1;
    const isDark = document.body.classList.contains('cosmic-dark');
    
    particle.style.cssText = `
      position: absolute;
      width: ${size}px;
      height: ${size}px;
      background-color: ${isDark ? 
        `rgba(${Math.floor(Math.random() * 100 + 155)}, ${Math.floor(Math.random() * 100 + 155)}, 255, ${Math.random() * 0.5 + 0.2})` : 
        `rgba(${Math.floor(Math.random() * 50 + 100)}, ${Math.floor(Math.random() * 50 + 50)}, ${Math.floor(Math.random() * 100 + 155)}, ${Math.random() * 0.5 + 0.2})`};
      border-radius: 50%;
      top: ${Math.random() * 100}vh;
      left: ${Math.random() * 100}vw;
      box-shadow: 0 0 ${size * 2}px ${isDark ? 'rgba(0, 255, 255, 0.8)' : 'rgba(123, 104, 238, 0.8)'};
      animation: cosmic-float ${Math.random() * 10 + 10}s infinite ease-in-out, 
                 cosmic-pulse ${Math.random() * 5 + 5}s infinite ease-in-out;
      animation-delay: ${Math.random() * 5}s;
      z-index: -1;
      pointer-events: none;
    `;
    
    particlesContainer.appendChild(particle);
  }
  
  // Update particles when theme changes
  document.querySelector('.cosmic-theme-toggle').addEventListener('click', function() {
    particlesContainer.innerHTML = '';
    setTimeout(createParticles, 100);
  });
}

// Add hover effects to buttons
function addButtonEffects() {
  const buttons = document.querySelectorAll('button, .btn, input[type="submit"]');
  
  buttons.forEach(button => {
    // Skip the theme toggle button
    if (button.classList.contains('cosmic-theme-toggle')) return;
    
    button.addEventListener('mouseover', function() {
      const isDark = document.body.classList.contains('cosmic-dark');
      this.style.boxShadow = isDark ? 
        '0 0 20px rgba(0, 255, 255, 0.8)' : 
        '0 0 20px rgba(123, 104, 238, 0.8)';
    });
    
    button.addEventListener('mouseout', function() {
      const isDark = document.body.classList.contains('cosmic-dark');
      this.style.boxShadow = isDark ? 
        '0 0 15px rgba(0, 204, 255, 0.5)' : 
        '0 0 15px rgba(123, 104, 238, 0.5)';
    });
  });
}

// Add floating animation to containers
function addFloatingEffect() {
  const containers = document.querySelectorAll('.signup-container, .reset-password-container, .recover-account-container, .withdraw-container, .withdraw-history-container, .view-links-container, .view-orders-container, .view-services-container .service-card, .invoice-container, .block-container');
  
  containers.forEach(container => {
    container.style.animation = `cosmic-float ${Math.random() * 2 + 8}s infinite ease-in-out`;
    container.style.animationDelay = `${Math.random() * 2}s`;
  });
}

// Process session messages
function processSessionMessages() {
  // Check for PHP session messages in hidden elements
  const sessionMessages = document.querySelectorAll('.session-message');
  
  sessionMessages.forEach(message => {
    const type = message.dataset.type || 'info';
    const text = message.textContent;
    
    if (text && text.trim() !== '') {
      showNotification(text, type);
      // Hide the original message
      message.style.display = 'none';
    }
  });
}

// Show notification
function showNotification(message, type = 'info') {
  const notification = document.createElement('div');
  notification.className = `session-notification ${type}`;
  notification.innerHTML = message;
  
  document.body.appendChild(notification);
  
  // Remove notification after animation completes
  setTimeout(() => {
    notification.remove();
  }, 5500);
}

// Enhance blocks with icons and styling
function enhanceBlocks() {
  const blocks = document.querySelectorAll('.block');
  
  blocks.forEach(block => {
    const title = block.querySelector('.block-title');
    if (title) {
      // Add icon based on block type
      const blockType = block.dataset.type || '';
      let icon = 'fa-info-circle';
      
      switch(blockType.toLowerCase()) {
        case 'info':
          icon = 'fa-info-circle';
          break;
        case 'success':
          icon = 'fa-check-circle';
          break;
        case 'warning':
          icon = 'fa-exclamation-triangle';
          break;
        case 'error':
          icon = 'fa-times-circle';
          break;
        case 'user':
          icon = 'fa-user';
          break;
        case 'settings':
          icon = 'fa-cog';
          break;
        case 'stats':
          icon = 'fa-chart-bar';
          break;
      }
      
      // Add icon if not already present
      if (!title.querySelector('i')) {
        title.innerHTML = `<i class="fas ${icon}"></i> ${title.innerHTML}`;
      }
    }
  });
}

// Add text typing effect to headings
document.addEventListener('DOMContentLoaded', function() {
  const headings = document.querySelectorAll('h1, h2, h3');
  
  headings.forEach(heading => {
    const text = heading.textContent;
    heading.textContent = '';
    
    for (let i = 0; i < text.length; i++) {
      const span = document.createElement('span');
      span.textContent = text[i];
      span.style.opacity = '0';
      span.style.animation = `cosmic-fade-in 0.1s forwards`;
      span.style.animationDelay = `${i * 0.05}s`;
      heading.appendChild(span);
    }
  });
});

// Add cosmic fade-in animation
const style = document.createElement('style');
style.textContent = `
  @keyframes cosmic-fade-in {
    0% { opacity: 0; transform: translateY(10px); }
    100% { opacity: 1; transform: translateY(0); }
  }
`;
document.head.appendChild(style);
</script>

