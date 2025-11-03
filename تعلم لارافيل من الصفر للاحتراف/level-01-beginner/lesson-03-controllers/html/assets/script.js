/**
 * Laravel Learning - Lesson 01 Intro
 * Main JavaScript File
 * Version: 1.0
 */

// ========================================
// Wait for DOM to be ready
// ========================================
document.addEventListener('DOMContentLoaded', function() {

  // Initialize all features
  initScrollTop();
  initSmoothScroll();
  initCodeCopy();
  initTableOfContents();
  initSearchHighlight();
  initThemeToggle();
  initPrintButton();
  initProgressBar();
  initExternalLinks();
  initLazyLoadImages();

  console.log('✅ Laravel Learning JS Loaded');
});

// ========================================
// Scroll to Top Button
// ========================================
function initScrollTop() {
  const scrollBtn = document.getElementById('scrollTop');

  if (!scrollBtn) {
    // Create scroll button if doesn't exist
    const btn = document.createElement('div');
    btn.id = 'scrollTop';
    btn.innerHTML = '↑';
    btn.title = 'العودة للأعلى';
    document.body.appendChild(btn);
  }

  const scrollButton = document.getElementById('scrollTop');

  // Show/hide button based on scroll position
  window.addEventListener('scroll', function() {
    if (window.pageYOffset > 300) {
      scrollButton.classList.add('show');
    } else {
      scrollButton.classList.remove('show');
    }
  });

  // Scroll to top on click
  scrollButton.addEventListener('click', function() {
    window.scrollTo({
      top: 0,
      behavior: 'smooth'
    });
  });
}

// ========================================
// Smooth Scroll for Anchor Links
// ========================================
function initSmoothScroll() {
  document.querySelectorAll('a[href^="#"]').forEach(anchor => {
    anchor.addEventListener('click', function (e) {
      const href = this.getAttribute('href');

      // Skip if href is just "#"
      if (href === '#') return;

      e.preventDefault();
      const target = document.querySelector(href);

      if (target) {
        target.scrollIntoView({
          behavior: 'smooth',
          block: 'start'
        });

        // Update URL without jumping
        history.pushState(null, null, href);
      }
    });
  });
}

// ========================================
// Copy Code to Clipboard
// ========================================
function initCodeCopy() {
  // Add copy button to all code blocks
  document.querySelectorAll('pre').forEach(function(pre) {
    const button = document.createElement('button');
    button.className = 'copy-code-btn';
    button.textContent = 'نسخ';
    button.title = 'نسخ الكود';

    // Style the button
    Object.assign(button.style, {
      position: 'absolute',
      top: '10px',
      left: '10px',
      padding: '5px 12px',
      background: '#4299e1',
      color: 'white',
      border: 'none',
      borderRadius: '4px',
      cursor: 'pointer',
      fontSize: '0.85rem',
      fontWeight: '600',
      transition: 'all 0.3s',
      zIndex: '10'
    });

    // Make pre position relative
    pre.style.position = 'relative';

    // Insert button
    pre.appendChild(button);

    // Copy functionality
    button.addEventListener('click', function() {
      const code = pre.querySelector('code');
      const text = code ? code.textContent : pre.textContent;

      navigator.clipboard.writeText(text).then(function() {
        button.textContent = '✓ تم النسخ';
        button.style.background = '#48bb78';

        setTimeout(function() {
          button.textContent = 'نسخ';
          button.style.background = '#4299e1';
        }, 2000);
      }).catch(function(err) {
        console.error('فشل النسخ:', err);
        button.textContent = '✗ فشل';
        button.style.background = '#f56565';

        setTimeout(function() {
          button.textContent = 'نسخ';
          button.style.background = '#4299e1';
        }, 2000);
      });
    });
  });
}

// ========================================
// Auto-generate Table of Contents
// ========================================
function initTableOfContents() {
  const content = document.querySelector('.content');
  if (!content) return;

  const headings = content.querySelectorAll('h2, h3, h4');
  if (headings.length === 0) return;

  // Create TOC container
  const toc = document.createElement('div');
  toc.className = 'table-of-contents card';
  toc.innerHTML = '<div class="card-header">📑 المحتويات</div><ul class="toc-list"></ul>';

  const tocList = toc.querySelector('.toc-list');

  // Generate TOC items
  headings.forEach(function(heading, index) {
    // Add ID to heading if doesn't exist
    if (!heading.id) {
      heading.id = 'heading-' + index;
    }

    const li = document.createElement('li');
    li.className = heading.tagName.toLowerCase(); // h2, h3, or h4

    const a = document.createElement('a');
    a.href = '#' + heading.id;
    a.textContent = heading.textContent;

    li.appendChild(a);
    tocList.appendChild(li);
  });

  // Insert TOC after first h1 or at beginning
  const firstH1 = content.querySelector('h1');
  if (firstH1 && firstH1.nextElementSibling) {
    firstH1.nextElementSibling.before(toc);
  } else {
    content.insertBefore(toc, content.firstChild);
  }
}

// ========================================
// Search and Highlight Text
// ========================================
function initSearchHighlight() {
  // Get search term from URL
  const urlParams = new URLSearchParams(window.location.search);
  const searchTerm = urlParams.get('search');

  if (searchTerm) {
    highlightText(searchTerm);
  }

  // Add search functionality (optional)
  // You can add a search box later
}

function highlightText(term) {
  const content = document.querySelector('.content');
  if (!content) return;

  const regex = new RegExp(term, 'gi');

  function highlightNode(node) {
    if (node.nodeType === 3) { // Text node
      const text = node.nodeValue;
      if (regex.test(text)) {
        const span = document.createElement('span');
        span.innerHTML = text.replace(regex, '<mark style="background: #fef08a; padding: 2px 4px; border-radius: 2px;">$&</mark>');
        node.parentNode.replaceChild(span, node);
      }
    } else if (node.nodeType === 1 && node.tagName !== 'SCRIPT' && node.tagName !== 'STYLE') {
      Array.from(node.childNodes).forEach(highlightNode);
    }
  }

  highlightNode(content);
}

// ========================================
// Theme Toggle (Light/Dark Mode)
// ========================================
function initThemeToggle() {
  // Check if user has a saved preference
  const savedTheme = localStorage.getItem('theme');
  if (savedTheme) {
    document.body.classList.add(savedTheme);
  }

  // Create theme toggle button (optional)
  // You can add this if needed
}

function toggleTheme() {
  document.body.classList.toggle('dark-mode');

  const theme = document.body.classList.contains('dark-mode') ? 'dark-mode' : '';
  localStorage.setItem('theme', theme);
}

// ========================================
// Print Button
// ========================================
function initPrintButton() {
  // Add print button if it doesn't exist
  const printBtn = document.querySelector('.print-btn');

  if (printBtn) {
    printBtn.addEventListener('click', function() {
      window.print();
    });
  }
}

// ========================================
// Progress Bar
// ========================================
function initProgressBar() {
  // Create progress bar
  const progressBar = document.createElement('div');
  progressBar.id = 'readingProgress';

  Object.assign(progressBar.style, {
    position: 'fixed',
    top: '0',
    left: '0',
    width: '0%',
    height: '4px',
    background: 'linear-gradient(90deg, #ff2d20, #c81e0f)',
    zIndex: '9999',
    transition: 'width 0.2s'
  });

  document.body.prepend(progressBar);

  // Update progress on scroll
  window.addEventListener('scroll', function() {
    const winScroll = document.documentElement.scrollTop;
    const height = document.documentElement.scrollHeight - document.documentElement.clientHeight;
    const scrolled = (winScroll / height) * 100;

    progressBar.style.width = scrolled + '%';
  });
}

// ========================================
// Keyboard Shortcuts
// ========================================
document.addEventListener('keydown', function(e) {
  // Ctrl/Cmd + K: Focus search (if search box exists)
  if ((e.ctrlKey || e.metaKey) && e.key === 'k') {
    e.preventDefault();
    const searchBox = document.querySelector('.search-input');
    if (searchBox) {
      searchBox.focus();
    }
  }

  // Ctrl/Cmd + P: Print
  if ((e.ctrlKey || e.metaKey) && e.key === 'p') {
    e.preventDefault();
    window.print();
  }

  // Home: Scroll to top
  if (e.key === 'Home' && !e.shiftKey) {
    e.preventDefault();
    window.scrollTo({ top: 0, behavior: 'smooth' });
  }

  // End: Scroll to bottom
  if (e.key === 'End' && !e.shiftKey) {
    e.preventDefault();
    window.scrollTo({ top: document.body.scrollHeight, behavior: 'smooth' });
  }
});

// ========================================
// External Links - Open in New Tab
// ========================================
function initExternalLinks() {
  document.querySelectorAll('a[href^="http"]').forEach(function(link) {
    if (!link.hostname.includes(window.location.hostname)) {
      link.target = '_blank';
      link.rel = 'noopener noreferrer';

      // Add external icon
      if (!link.querySelector('.external-icon')) {
        const icon = document.createElement('span');
        icon.className = 'external-icon';
        icon.innerHTML = ' ↗';
        icon.style.fontSize = '0.8em';
        link.appendChild(icon);
      }
    }
  });
}

// ========================================
// Lazy Load Images (if needed)
// ========================================
function initLazyLoadImages() {
  if ('IntersectionObserver' in window) {
    const imageObserver = new IntersectionObserver(function(entries, observer) {
      entries.forEach(function(entry) {
        if (entry.isIntersecting) {
          const img = entry.target;
          if (img.dataset.src) {
            img.src = img.dataset.src;
            img.removeAttribute('data-src');
            imageObserver.unobserve(img);
          }
        }
      });
    });

    document.querySelectorAll('img[data-src]').forEach(function(img) {
      imageObserver.observe(img);
    });
  }
}

// ========================================
// Console Welcome Message
// ========================================
console.log('%c🚀 Laravel Learning Platform', 'font-size: 20px; color: #ff2d20; font-weight: bold;');
console.log('%cLesson 01: مقدمة إلى Laravel', 'font-size: 14px; color: #2d3748;');
console.log('%cمرحباً بك! نتمنى لك تعلماً ممتعاً 📚', 'font-size: 12px; color: #4a5568;');

// ========================================
// Performance Monitoring (Optional)
// ========================================
window.addEventListener('load', function() {
  if ('performance' in window) {
    const perfData = window.performance.timing;
    const pageLoadTime = perfData.loadEventEnd - perfData.navigationStart;
    console.log('⏱️ Page Load Time: ' + (pageLoadTime / 1000).toFixed(2) + 's');
  }
});
