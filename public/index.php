<?php require_once 'preload.php';?>

<?php


 $articles = $query->limit('articles','*','id','desc','0,9','i',1,'status=?');
 $announcements = $query->limit('announcements','*','id','desc','0,9','i',1,'status=?');
?>
<?php require_once (dirname(__FILE__)).'/incs/header.php';?>

<!-- Custom CSS for enhanced design -->
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

<!-- Title -->
<title><?php echo do_config(11);?> <?php echo do_config(8);?> <?php echo do_config(1);?> </title>

    

  <!-- Hero Section -->
  <section class="hero-section">
    <div class="container">
      <div class="row align-items-center">
        <div class="col-lg-6 hero-content">
          <h1 class="display-3 fw-bold hero-title slide-left">
          <?php echo do_config(24)?> <?php echo do_config(1)?>
          </h1>
          
          <p class="lead hero-subtitle slide-left" style="animation-delay: 0.2s">
            <?php echo do_config(10)?>
          </p>
          
          <div class="hero-buttons slide-left" style="animation-delay: 0.4s">
            <?php if(!logged){ ?>
              <a href="<?php echo do_config(14);?>signin" class="btn btn-primary btn-lg shadow-lg">
                Begin Your Journey <i class="fa fa-rocket ms-2"></i>
              </a>
              <a href="#features" class="btn btn-outline-primary btn-lg">
                Explore Features
              </a>
            <?php }else{ ?>
              <?php $role = isset($member->role) ? $member->role : null; ?>
              <?php if($role === 'admin'){ ?>
                <a href="<?php echo do_config(14);?>admin/dashboard" class="btn btn-primary btn-lg shadow-lg">
                  Admin Portal <i class="fa fa-user-shield ms-2"></i>
                </a>
              <?php } ?>
              <a href="<?php echo do_config(14);?>user/dashboard" class="btn btn-outline-primary btn-lg">
                My Dashboard <i class="fa fa-tachometer-alt ms-2"></i>
              </a>
            <?php } ?>
          </div>
        </div>
        <div class="col-lg-6 d-none d-lg-block">
          <div class="hero-image-container slide-right">
            <div class="hero-shape-1"></div>
            <div class="hero-shape-2"></div>
          </div>
        </div>
      </div>
    </div>
  </section>

  <!-- Stats Section -->
  <section class="">
    <div class="">
      <div class="stats-header fade-in">
        <h2 class="stats-title">Our Thriving Community</h2>
        <p class="stats-subtitle">Join thousands of satisfied members and experience the difference</p>
      </div>
      
      <?php
        $market_response = viewmarket();
        $market = $market_response ?: ($_SESSION['user']['market'] ?? '');
        
        if (empty($market)) {
          $market = "<div class='alert alert-danger'>Market data could not be loaded. Please try again later.</div>";
        }
        
        echo $market;
      ?>
    </div>
  </section>

  <!-- Blog Section -->
  <section class="blog-section" id="blog">
    <div class="container">
      <div class="blog-header">
        <div class="blog-title-wrapper fade-in">
          <h2 class="blog-title">Fresh Insights & Knowledge</h2>
          <p class="blog-subtitle">Explore our latest articles and stay ahead of the curve</p>
        </div>
        <a href="<?php echo do_config(14);?>blog" class="btn btn-outline-primary fade-in">
          Browse All Articles <i class="fa fa-arrow-right ms-2"></i>
        </a>
      </div>
      
      <?php if($articles->num_rows == 0){ ?>
        <div class="alert alert-info text-center fade-in">
          <i class="fa fa-info-circle me-2"></i> We're working on creating valuable content for you. Check back soon!
        </div>
      <?php } else { ?>
        <div class="blog-grid">
          <?php
          // Reset the pointer to the beginning of the result set
          $articles->data_seek(0);
          $delay = 0;
          while($res=$articles->fetch_assoc()){
            $delay += 0.1;
          ?>
            <div class="blog-card slide-up" style="animation-delay: <?php echo $delay; ?>s">
              <div class="blog-card-image-wrapper">
                <img src="<?php echo $res['preview'];?>" alt="<?php echo htmlspecialchars($res['title']);?>" class="blog-card-image" onerror="this.style.display='none';">
                <span class="blog-card-category">Featured</span>
              </div>
              <div class="blog-card-content">
                <div class="blog-card-meta">
                  <img src="<?php echo do_user($res['user_id'],'avatar');?>" alt="<?php echo do_user($res['user_id'],'username');?>" class="blog-card-author-image" onerror="this.style.display='none';">
                  <span class="blog-card-author"><?php echo do_user($res['user_id'],'username');?></span>
                  <span class="blog-card-date"><i class="fa fa-calendar-alt"></i> <?php echo get_time_ago(strtotime($res['created']));?></span>
                </div>
                <h3 class="blog-card-title">
                  <a href="<?php echo do_config(14);?>article/<?php echo $res['link'];?>/">
                    <?php echo htmlspecialchars($res['title']);?>
                  </a>
                </h3>
                <p class="blog-card-excerpt"><?php echo substr(strip_tags($res['content']), 0, 100);?>...</p>
                <div class="blog-card-footer">
                  <a href="<?php echo do_config(14);?>article/<?php echo $res['link'];?>/" class="blog-card-link">
                    Read Full Article <i class="fa fa-arrow-right blog-card-link-icon"></i>
                  </a>
                </div>
              </div>
            </div>
          <?php } ?>
        </div>
      <?php } ?>
    </div>
  </section>

  <!-- CTA Section -->
  <section class="cta-section">
    <div class="container">
      <div class="row justify-content-center">
        <div class="col-lg-10">
          <div class="cta-content">
            <span class="cta-badge slide-down">
              Start Your Journey Today
            </span>
            <h2 class="cta-title fade-in">
              Transform Your Experience with <?php echo do_config(1)?>
            </h2>
            <p class="cta-description slide-up">
              Join thousands of satisfied admin who have already discovered the power of our platform. It's time for you to experience the difference.
            </p>
            <div class="cta-buttons zoom-in">
              <?php if(!logged){ ?>
                <a href="<?php echo do_config(14);?>signup" class="btn btn-light btn-lg shadow-lg">
                  Create Your Account <i class="fa fa-user-plus ms-2"></i>
                </a>
                <a href="<?php echo do_config(14);?>signin" class="btn btn-outline-light btn-lg">
                  Sign In <i class="fa fa-sign-in-alt ms-2"></i>
                </a>
              <?php } else { ?>
                <a href="<?php echo do_config(14);?>user/dashboard" class="btn btn-light btn-lg shadow-lg">
                  Go to My Dashboard <i class="fa fa-tachometer-alt ms-2"></i>
                </a>
              <?php } ?>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
</div>



<!-- Custom JavaScript for enhanced functionality -->
<script>
document.addEventListener('DOMContentLoaded', function() {
  // Announcement Ticker Functionality
  const tickerItems = document.querySelectorAll('.ticker-item');
  const tickerDots = document.querySelectorAll('.ticker-dot');
  let currentSlide = 0;
  let slideInterval;
  
  function showSlide(index) {
    // Update current slide index
    currentSlide = index;
    
    // Update ticker items
    tickerItems.forEach((item, i) => {
      if (i === currentSlide) {
        item.style.display = 'block';
      } else {
        item.style.display = 'none';
      }
    });
    
    // Update ticker dots
    tickerDots.forEach((dot, i) => {
      if (i === currentSlide) {
        dot.classList.add('active');
      } else {
        dot.classList.remove('active');
      }
    });
  }
  
  function nextSlide() {
    let nextIndex = currentSlide + 1;
    if (nextIndex >= tickerItems.length) {
      nextIndex = 0;
    }
    showSlide(nextIndex);
  }
  
  // Initialize ticker
  if (tickerItems.length > 0) {
    // Show first slide
    showSlide(0);
    
    // Start auto-rotation
    slideInterval = setInterval(nextSlide, 5000);
    
    // Add click event to dots
    tickerDots.forEach((dot, index) => {
      dot.addEventListener('click', () => {
        showSlide(index);
        clearInterval(slideInterval);
        slideInterval = setInterval(nextSlide, 5000);
      });
    });
    
    // Pause rotation on hover
    const ticker = document.getElementById('announcementTicker');
    if (ticker) {
      ticker.addEventListener('mouseenter', () => {
        clearInterval(slideInterval);
      });
      
      ticker.addEventListener('mouseleave', () => {
        clearInterval(slideInterval);
        slideInterval = setInterval(nextSlide, 5000);
      });
    }
  }
  
  // Smooth scrolling for anchor links
  document.querySelectorAll('a[href^="#"]').forEach(anchor => {
    anchor.addEventListener('click', function(e) {
      e.preventDefault();
      
      const targetId = this.getAttribute('href');
      if (targetId === '#') return;
      
      const targetElement = document.querySelector(targetId);
      if (targetElement) {
        window.scrollTo({
          top: targetElement.offsetTop - 80,
          behavior: 'smooth'
        });
      }
    });
  });
  
  // Animate elements when they come into view
  const animateOnScroll = function() {
    const elements = document.querySelectorAll('.fade-in:not(.animated), .slide-up:not(.animated), .slide-down:not(.animated), .slide-left:not(.animated), .slide-right:not(.animated), .zoom-in:not(.animated)');
    
    elements.forEach(element => {
      const elementPosition = element.getBoundingClientRect().top;
      const windowHeight = window.innerHeight;
      
      if (elementPosition < windowHeight - 50) {
        element.classList.add('animated');
      }
    });
  };
  
  // Run animation on load
  animateOnScroll();
  
  // Run animation on scroll
  window.addEventListener('scroll', animateOnScroll);
  
  // Counter animation for stats
  const statsNumbers = document.querySelectorAll('.stats-number');
  
  const animateCounter = function(element) {
    const targetValue = parseInt(element.getAttribute('data-value').replace(/,/g, ''));
    const duration = 2000; // 2 seconds
    const startTime = Date.now();
    const startValue = 0;
    
    const updateCounter = function() {
      const currentTime = Date.now();
      const elapsedTime = currentTime - startTime;
      
      if (elapsedTime < duration) {
        const progress = elapsedTime / duration;
        const currentValue = Math.floor(startValue + progress * (targetValue - startValue));
        element.textContent = currentValue.toLocaleString();
        requestAnimationFrame(updateCounter);
      } else {
        element.textContent = targetValue.toLocaleString();
      }
    };
    
    updateCounter();
  };
  
  const observerOptions = {
    root: null,
    rootMargin: '0px',
    threshold: 0.1
  };
  
  const statsObserver = new IntersectionObserver((entries) => {
    entries.forEach(entry => {
      if (entry.isIntersecting) {
        const statsNumber = entry.target;
        animateCounter(statsNumber);
        statsObserver.unobserve(statsNumber);
      }
    });
  }, observerOptions);
  
  statsNumbers.forEach(number => {
    statsObserver.observe(number);
  });
});

// Function to close announcement modal
function Closeannounce() {
  document.getElementById('rev_popup').style.display = 'none';
  
  // Set cookie to remember the modal was closed
  const date = new Date();
  date.setTime(date.getTime() + (24 * 60 * 60 * 1000)); // 1 day
  document.cookie = "closed=true; expires=" + date.toUTCString() + "; path=/";
}
</script>

<?php require_once 'ajax.js.php';?>
<?php require_once (dirname(__FILE__)).'/incs/footer.php';?>


