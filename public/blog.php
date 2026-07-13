<?php require_once 'preload.php';?>
<?php require_once (dirname(__FILE__)).'/incs/header.php';?>
<?php 
// Increased limit from 10 to 1000 to show more posts
$articles = $query->normal("SELECT * FROM articles WHERE status='1' ORDER BY id DESC LIMIT 1000");
echo "<!-- Debug: Found {$articles->num_rows} articles with status=1 -->";

do_winfo('BLOG'); 
?>
<style>
/* Elegant Modern Blog Styling */
:root {
  --primary-color: #6366f1;
  --primary-dark: #4f46e5;
  --primary-light: #818cf8;
  --accent-color: #f43f5e;
  --dark-color: #1e293b;
  --light-color: #f8fafc;
  --gray-color: #94a3b8;
  --gray-light: #e2e8f0;
  --card-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.08), 0 4px 6px -2px rgba(0, 0, 0, 0.03);
  --card-shadow-hover: 0 20px 25px -5px rgba(0, 0, 0, 0.1), 0 10px 10px -5px rgba(0, 0, 0, 0.04);
  --transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
  --content-width: 1200px;
  --border-radius: 12px;
}

body {
  background-color: #f9fafb;
}

/* Blog Header Section */
.blog-hero {
  position: relative;
  background: linear-gradient(135deg, var(--primary-dark), var(--primary-light));
  padding: 6rem 0;
  color: var(--light-color);
  overflow: hidden;
}

.blog-hero::before {
  content: '';
  position: absolute;
  top: 0;
  left: 0;
  width: 100%;
  height: 100%;
  background-image: url('../img/pattern.svg');
  opacity: 0.1;
  z-index: 0;
}

.blog-hero::after {
  content: '';
  position: absolute;
  bottom: -2px;
  left: 0;
  width: 100%;
  height: 60px;
  background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 1440 320'%3E%3Cpath fill='%23f9fafb' fill-opacity='1' d='M0,128L60,154.7C120,181,240,235,360,250.7C480,267,600,245,720,213.3C840,181,960,139,1080,133.3C1200,128,1320,160,1380,176L1440,192L1440,320L1380,320C1320,320,1200,320,1080,320C960,320,840,320,720,320C600,320,480,320,360,320C240,320,120,320,60,320L0,320Z'%3E%3C/path%3E%3C/svg%3E");
  background-size: cover;
  background-repeat: no-repeat;
  z-index: 1;
}

.blog-hero-content {
  position: relative;
  z-index: 2;
  text-align: center;
}

.blog-hero h1 {
  font-size: 3.5rem;
  font-weight: 800;
  margin-bottom: 1rem;
  color: white;
  text-shadow: 0 2px 4px rgba(0,0,0,0.1);
  letter-spacing: -0.5px;
}

.blog-hero p {
  font-size: 1.25rem;
  max-width: 600px;
  margin: 0 auto;
  color: rgba(255, 255, 255, 0.9);
}

/* Search Section */
.search-container {
  max-width: 700px;
  margin: -2.5rem auto 3rem;
  position: relative;
  z-index: 10;
  padding: 0 20px;
}

.search-form {
  display: flex;
  background: white;
  border-radius: var(--border-radius);
  box-shadow: var(--card-shadow);
  overflow: hidden;
  border: 1px solid var(--gray-light);
  transition: var(--transition);
}

.search-form:focus-within {
  box-shadow: 0 0 0 3px rgba(99, 102, 241, 0.3);
  border-color: var(--primary-light);
}

.search-form input {
  flex: 1;
  padding: 1.25rem 1.5rem;
  border: none;
  font-size: 1.1rem;
  background: transparent;
  color: var(--dark-color);
}

.search-form input:focus {
  outline: none;
}

.search-form button {
  background: var(--primary-color);
  color: white;
  font-weight: 600;
  border: none;
  padding: 0 1.75rem;
  cursor: pointer;
  transition: var(--transition);
  display: flex;
  align-items: center;
}

.search-form button:hover {
  background: var(--primary-dark);
}

.search-form button span {
  margin-left: 8px;
}

/* Suggestions */
.search-suggestions {
  background: white;
  margin-top: 0.5rem;
  border-radius: var(--border-radius);
  box-shadow: var(--card-shadow);
  padding: 0.5rem 0;
  display: none;
  max-height: 200px;
  overflow-y: auto;
}

.suggestion-item {
  padding: 0.75rem 1.5rem;
  cursor: pointer;
  transition: var(--transition);
}

.suggestion-item:hover {
  background: var(--gray-light);
}

.suggestion-item mark {
  background-color: rgba(99, 102, 241, 0.2);
  color: var(--primary-dark);
  padding: 0 2px;
  border-radius: 3px;
}

/* Articles Container */
.articles-section {
  padding: 1rem 0 4rem;
}

.articles-container {
  max-width: var(--content-width);
  margin: 0 auto;
  padding: 0 20px;
}

/* No Articles Message */
.no-articles {
  background: #fff3cd;
  color: #856404;
  padding: 1.25rem;
  border-radius: var(--border-radius);
  text-align: center;
  margin: 2rem 0;
  border: 1px solid rgba(133, 100, 4, 0.1);
}

/* No Search Results */
.no-search-results {
  background: #f8f9fa;
  color: #495057;
  padding: 1.25rem;
  border-radius: var(--border-radius);
  text-align: center;
  margin: 2rem 0;
  display: none;
  border: 1px solid rgba(73, 80, 87, 0.1);
}

.no-search-results i, .no-articles i {
  margin-right: 8px;
}

.search-did-you-mean {
  display: block;
  margin-top: 0.5rem;
  font-size: 0.95rem;
}

.search-did-you-mean a {
  color: var(--primary-color);
  text-decoration: underline;
  cursor: pointer;
}

/* Article Cards - Using JS for layout */
.articles-grid {
  display: flex;
  flex-wrap: wrap;
  margin: 0 -15px;
}

.article-card-wrapper {
  padding: 0 15px;
  margin-bottom: 30px;
  width: 33.333%;
  transition: var(--transition);
}

.article-card {
  display: flex;
  flex-direction: column;
  background: white;
  border-radius: var(--border-radius);
  overflow: hidden;
  box-shadow: var(--card-shadow);
  transition: var(--transition);
  height: 100%;
  border: 1px solid var(--gray-light);
}

.article-card:hover {
  transform: translateY(-5px);
  box-shadow: var(--card-shadow-hover);
}

.article-image {
  position: relative;
  height: 200px;
  overflow: hidden;
}

.article-image img {
  width: 100%;
  height: 100%;
  object-fit: cover;
  transition: var(--transition);
}

.article-card:hover .article-image img {
  transform: scale(1.05);
}

.article-content {
  padding: 1.5rem;
  flex: 1;
  display: flex;
  flex-direction: column;
}

.article-title {
  font-size: 1.1rem;
  font-weight: 600;
  margin-bottom: 0.75rem;
  color: var(--dark-color);
  line-height: 1.4;
  transition: var(--transition);
}

.article-card:hover .article-title {
  color: var(--primary-color);
}

.article-meta {
  margin-top: auto;
  padding-top: 1rem;
  border-top: 1px solid var(--gray-light);
  display: flex;
  align-items: center;
}

.article-date {
  display: flex;
  align-items: center;
  margin-left: auto;
  font-size: 0.8rem;
  color: var(--gray-color);
}

.article-date i {
  margin-right: 4px;
}

/* AdSense Container Styles */
.ad-container {
  width: 100%;
  margin: 2rem auto;
  text-align: center;
  overflow: hidden;
  clear: both;
}

.ad-container-header {
  margin-top: -1rem;
  margin-bottom: 2rem;
}

.ad-container-footer {
  margin-top: 2rem;
  margin-bottom: 0;
}

.ad-container-between {
  width: 100%;
  margin: 1rem 0 2rem;
}

/* Animation Classes */
.fade-in {
  animation: fadeIn 0.8s ease forwards;
}

.slide-up {
  animation: slideUp 0.6s ease forwards;
}

@keyframes fadeIn {
  from { opacity: 0; }
  to { opacity: 1; }
}

@keyframes slideUp {
  from { 
    opacity: 0;
    transform: translateY(20px);
  }
  to { 
    opacity: 1;
    transform: translateY(0);
  }
}

/* Responsive Adjustments */
@media (max-width: 992px) {
  :root {
    --content-width: 95%;
  }
  
  .article-card-wrapper {
    width: 50%;
  }
  
  .blog-hero h1 {
    font-size: 3rem;
  }
}

@media (max-width: 768px) {
  .blog-hero h1 {
    font-size: 2.5rem;
  }
  
  .blog-hero p {
    font-size: 1rem;
  }
  
  .search-form {
    flex-direction: column;
  }
  
  .search-form input,
  .search-form button {
    width: 100%;
    padding: 1rem;
  }
  
  .search-form button {
    display: flex;
    justify-content: center;
  }
}

@media (max-width: 576px) {
  .article-card-wrapper {
    width: 100%;
  }
  
  .blog-hero {
    padding: 4rem 0 5rem;
  }
  
  .blog-hero h1 {
    font-size: 2rem;
  }
  
  .search-container {
    margin: -2rem auto 2rem;
  }
}
</style>
<!-- Title -->
<title><?php echo SITE_TITLE.' '.do_config(8).' '.do_config(1); ?> </title>

<!-- Hero Section -->
<section class="blog-hero">
    <div class="container">
        <div class="blog-hero-content">
            <h1><?php echo SITE_TITLE; ?></h1>
            <p>SEARCH FOR YOUR NEEDED SERVICE</p>
        </div>
    </div>
</section>

<!-- Search Section -->
<div class="search-container">
    <form class="search-form" onsubmit="return false;">
        <input type="text" id="searchInput" placeholder="Search for articles..." aria-label="Search" oninput="handleSearch()">
        <button type="button" onclick="performSearch()">
            <i class="fa fa-search"></i><span>SEARCH</span>
        </button>
    </form>
    <div id="searchSuggestions" class="search-suggestions"></div>
</div>

<!-- AdSense Header Container -->
<div class="container">
    <div class="ad-container ad-container-header">
        <!-- AdSense code can be inserted here -->
    </div>
</div>

<!-- Articles Section -->
<section class="articles-section">
    <div class="articles-container">
        
        <?php if($articles->num_rows == 0){ ?>
        <div class="no-articles">
            <i class="fa fa-exclamation-triangle"></i> <?php echo _NO_RECORDS_WERE_FOUND;?>
        </div>
        <?php } else { ?>
        
        <div class="articles-grid" id="articlesContainer">
            <?php 
            // Reset the result pointer just in case
            if ($articles->num_rows > 0) {
                $articles->data_seek(0);
            }
            
            $counter = 0;
            while($res = $articles->fetch_assoc()) {
                $counter++;
                echo "<!-- Processing article #{$counter}: ID={$res['id']}, Title={$res['title']} -->";
                
                                // Store the content for search indexing - limit to first 200 chars
                $content_snippet = substr(strip_tags($res['content']), 0, 200);
            ?>
            <div class="article-card-wrapper" 
                 data-title="<?php echo strtolower(htmlspecialchars($res['title'])); ?>"
                 data-content="<?php echo strtolower(htmlspecialchars($content_snippet)); ?>">
                <article class="article-card">
                    <a href="<?php echo do_config(14);?>article/<?php echo $res['link'];?>/" class="article-image">
                        <img src="<?php echo $res['preview'];?>" alt="<?php echo $res['title'];?>" class="lazy-image" onerror="this.style.display='none';" <?php echo do_config(1)?>>
                    </a>
                    <div class="article-content">
                        <a href="<?php echo do_config(14);?>article/<?php echo $res['link'];?>/">
                            <h3 class="article-title"><?php echo $res['title'];?></h3>
                        </a>
                        <div class="article-meta">
                            <span class="article-date">
                                <i class="fa fa-clock-o"></i>
                                <time datetime="<?php echo date('Y-m-d', strtotime($res['created']));?>"><?php echo get_time_ago(strtotime($res['created']));?></time>
                            </span>
                        </div>
                    </div>
                </article>
            </div>
            
            <?php 
                // Add an AdSense slot after every 6 articles
                if ($counter > 1 && $counter % 6 === 0) {
                    echo '<div class="ad-container ad-container-between"><!-- AdSense code can be inserted here --></div>';
                }
                echo "<!-- Finished article #{$counter} -->"; 
            ?>
            <?php } ?>
            <?php echo "<!-- Total articles processed: {$counter} -->"; ?>
            
            <!-- No search results message -->
            <div class="no-search-results" id="noSearchResults">
                <i class="fa fa-search"></i> No articles match your search criteria.
                <span class="search-did-you-mean" id="didYouMean"></span>
            </div>
        </div>
        <?php } ?>
    </div>
</section>

<!-- AdSense Footer Container -->
<div class="container">
    <div class="ad-container ad-container-footer">
        <?php echo do_config(15); ?>
    </div>
</div>

<!-- Enhanced Search Script with Spelling Suggestions -->
<script>
// Store all article data for searching
const articles = [];

// Initialize layout and search functionality
document.addEventListener('DOMContentLoaded', function() {
    // Collect all article data for search index
    document.querySelectorAll('.article-card-wrapper').forEach(card => {
        articles.push({
            element: card,
            title: card.getAttribute('data-title') || '',
            content: card.getAttribute('data-content') || ''
        });
    });
    
    // Initialize 3-column layout
    arrangeArticlesInGrid();
    
    // Focus on search input
    setTimeout(() => {
        document.getElementById('searchInput').focus();
    }, 500);
    
    // Listen for window resize to rearrange grid
    window.addEventListener('resize', arrangeArticlesInGrid);
});

// Handle input in search box
function handleSearch() {
    const searchInput = document.getElementById('searchInput');
    const searchTerm = searchInput.value.toLowerCase().trim();
    
    // Show search suggestions if there are at least 2 characters
    if (searchTerm.length >= 2) {
        showSearchSuggestions(searchTerm);
    } else {
        hideSearchSuggestions();
    }
}

// Show search suggestions based on input
function showSearchSuggestions(searchTerm) {
    const suggestionsContainer = document.getElementById('searchSuggestions');
    
    // Get matching articles
    const matches = findMatches(searchTerm, 5);
    
    if (matches.length > 0) {
        suggestionsContainer.innerHTML = '';
        
        matches.forEach(match => {
            const div = document.createElement('div');
            div.className = 'suggestion-item';
            
            // Highlight the matching part
            const title = match.title.replace(
                new RegExp(searchTerm, 'gi'), 
                match => `<mark>${match}</mark>`
            );
            
            div.innerHTML = title;
            div.addEventListener('click', () => {
                document.getElementById('searchInput').value = match.title;
                hideSearchSuggestions();
                performSearch();
            });
            
            suggestionsContainer.appendChild(div);
        });
        
        suggestionsContainer.style.display = 'block';
    } else {
        hideSearchSuggestions();
    }
}

// Hide search suggestions
function hideSearchSuggestions() {
    const suggestionsContainer = document.getElementById('searchSuggestions');
    suggestionsContainer.style.display = 'none';
}

// Find matches for search suggestions
function findMatches(searchTerm, limit = 5) {
    const matches = [];
    
    for (const article of articles) {
        if (article.title.includes(searchTerm) || article.content.includes(searchTerm)) {
            matches.push({
                element: article.element,
                title: article.title
            });
            
            if (matches.length >= limit) break;
        }
    }
    
    return matches;
}

// Perform the actual search
function performSearch() {
    hideSearchSuggestions();
    
    const searchInput = document.getElementById('searchInput');
    const searchTerm = searchInput.value.toLowerCase().trim();
    const noResultsMessage = document.getElementById('noSearchResults');
    const didYouMean = document.getElementById('didYouMean');
    const adContainers = document.querySelectorAll('.ad-container-between');
    
    let resultsFound = false;
    let visibleCount = 0;
    
    // Hide all ad containers initially
    adContainers.forEach(container => {
        container.style.display = 'none';
    });
    
    // Reset did-you-mean element
    didYouMean.innerHTML = '';
    
    // If search is empty, show all articles
    if (searchTerm === '') {
        articles.forEach(article => {
            article.element.style.display = '';
        });
        noResultsMessage.style.display = 'none';
        arrangeArticlesInGrid();
        return;
    }
    
    // Filter articles based on search term
    articles.forEach(article => {
        if (article.title.includes(searchTerm) || article.content.includes(searchTerm)) {
            article.element.style.display = '';
            resultsFound = true;
            visibleCount++;
            
            // Show ad container after every 6 visible articles
            if (visibleCount % 6 === 0) {
                const adIndex = Math.floor(visibleCount / 6) - 1;
                if (adIndex < adContainers.length) {
                    adContainers[adIndex].style.display = 'block';
                }
            }
        } else {
            article.element.style.display = 'none';
        }
    });
    
    // If no results, show spelling suggestions
    if (!resultsFound) {
        noResultsMessage.style.display = 'block';
        
        // Generate spelling suggestions
        const suggestions = generateSpellingSuggestions(searchTerm);
        if (suggestions.length > 0) {
            didYouMean.innerHTML = 'Did you mean: ' + suggestions.map(term => 
                `<a onclick="applySuggestion('${term}')">${term}</a>`
            ).join(', ') + '?';
        }
    } else {
        noResultsMessage.style.display = 'none';
    }
    
    // Rearrange visible articles
    arrangeArticlesInGrid();
}

// Apply a spelling suggestion
function applySuggestion(term) {
    const searchInput = document.getElementById('searchInput');
    searchInput.value = term;
    performSearch();
}

// Simple spelling suggestion generator
function generateSpellingSuggestions(searchTerm) {
    // Get all words from all articles
    const allWords = new Set();
    articles.forEach(article => {
        const words = (article.title + ' ' + article.content).split(/\s+/);
        words.forEach(word => {
            if (word.length > 2) {
                allWords.add(word.toLowerCase());
            }
        });
    });
    
    // Find similar words (simple Levenshtein distance)
    const suggestions = [];
    allWords.forEach(word => {
        if (levenshteinDistance(word, searchTerm) <= 2 && word !== searchTerm) {
            suggestions.push(word);
        }
    });
    
    return suggestions.slice(0, 3); // Return top 3 suggestions
}

// Calculate Levenshtein distance between two strings
function levenshteinDistance(a, b) {
    if (a.length === 0) return b.length;
    if (b.length === 0) return a.length;
    
    const matrix = [];
    
    // Initialize matrix
    for (let i = 0; i <= b.length; i++) {
        matrix[i] = [i];
    }
    
    for (let j = 0; j <= a.length; j++) {
        matrix[0][j] = j;
    }
    
    // Fill in the matrix
    for (let i = 1; i <= b.length; i++) {
        for (let j = 1; j <= a.length; j++) {
            if (b.charAt(i-1) === a.charAt(j-1)) {
                matrix[i][j] = matrix[i-1][j-1];
            } else {
                matrix[i][j] = Math.min(
                    matrix[i-1][j-1] + 1, // substitution
                    matrix[i][j-1] + 1,   // insertion
                    matrix[i-1][j] + 1    // deletion
                );
            }
        }
    }
    
    return matrix[b.length][a.length];
}

// Arrange articles in a 3-column grid using JavaScript
function arrangeArticlesInGrid() {
    // Only perform this on visible articles
    const visibleArticles = Array.from(document.querySelectorAll('.article-card-wrapper'))
        .filter(card => card.style.display !== 'none');
    
    // Determine number of columns based on screen width
    let columns = 3;
    if (window.innerWidth <= 992 && window.innerWidth > 576) {
        columns = 2;
    } else if (window.innerWidth <= 576) {
        columns = 1;
    }
    
    // Reset all heights
    visibleArticles.forEach(card => {
        card.style.height = 'auto';
    });
    
    // Group articles into rows
    for (let i = 0; i < visibleArticles.length; i += columns) {
        const row = visibleArticles.slice(i, i + columns);
        
        // Skip if not a full row (except for the last one)
        if (row.length < columns && i + columns < visibleArticles.length) continue;
        
        // Find the tallest card in this row
        let maxHeight = 0;
        row.forEach(card => {
            const height = card.offsetHeight;
            maxHeight = Math.max(maxHeight, height);
        });
        
        // Set all cards in this row to the same height
        row.forEach(card => {
            card.style.height = maxHeight + 'px';
        });
    }
}
</script>

<?php require_once 'ajax.js.php';?>
<?php require_once (dirname(__FILE__)).'/incs/footer.php';?>
