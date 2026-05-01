// ========== MODE CLAIR / SOMBRE ==========
const themeToggle = document.getElementById('themeToggle');
const savedTheme = localStorage.getItem('theme');

if (savedTheme) {
    document.documentElement.setAttribute('data-theme', savedTheme);
    if (themeToggle) {
        themeToggle.innerHTML = savedTheme === 'light' ? '<i class="fas fa-moon"></i>' : '<i class="fas fa-sun"></i>';
    }
}

if (themeToggle) {
    themeToggle.addEventListener('click', () => {
        const currentTheme = document.documentElement.getAttribute('data-theme');
        const newTheme = currentTheme === 'light' ? 'dark' : 'light';
        
        document.documentElement.setAttribute('data-theme', newTheme);
        localStorage.setItem('theme', newTheme);
        
        themeToggle.innerHTML = newTheme === 'light' ? '<i class="fas fa-moon"></i>' : '<i class="fas fa-sun"></i>';
    });
}

// ========== FADE-IN AU SCROLL ==========
const fadeElements = document.querySelectorAll('.fade-in');

const observer = new IntersectionObserver((entries) => {
    entries.forEach(entry => {
        if (entry.isIntersecting) {
            entry.target.classList.add('visible');
        }
    });
}, { threshold: 0.1 });

fadeElements.forEach(el => observer.observe(el));

// ========== ANIMATION DES BARRES DE COMPÉTENCES ==========
const skillBars = document.querySelectorAll('.skill-bar-item');

const skillsObserver = new IntersectionObserver((entries) => {
    entries.forEach(entry => {
        if (entry.isIntersecting) {
            const progress = entry.target.querySelector('.progress');
            if (progress) {
                const width = progress.getAttribute('data-width') || progress.style.width;
                if (width) {
                    progress.style.width = width;
                }
            }
        }
    });
}, { threshold: 0.5 });

skillBars.forEach(bar => skillsObserver.observe(bar));

// ========== INITIALISATION DES BARRES (si data-width) ==========
document.querySelectorAll('.progress').forEach(progress => {
    const width = progress.getAttribute('data-width');
    if (width) {
        progress.style.width = '0%';
        progress.setAttribute('data-width', width);
    }
});// ========== MODE CLAIR / SOMBRE ==========
const themeToggle = document.getElementById('themeToggle');
const savedTheme = localStorage.getItem('theme');

if (savedTheme) {
    document.documentElement.setAttribute('data-theme', savedTheme);
    if (themeToggle) {
        themeToggle.innerHTML = savedTheme === 'light' ? '<i class="fas fa-moon"></i>' : '<i class="fas fa-sun"></i>';
    }
}

if (themeToggle) {
    themeToggle.addEventListener('click', () => {
        const currentTheme = document.documentElement.getAttribute('data-theme');
        const newTheme = currentTheme === 'light' ? 'dark' : 'light';
        
        document.documentElement.setAttribute('data-theme', newTheme);
        localStorage.setItem('theme', newTheme);
        
        themeToggle.innerHTML = newTheme === 'light' ? '<i class="fas fa-moon"></i>' : '<i class="fas fa-sun"></i>';
    });
}

// ========== FADE-IN AU SCROLL ==========
const fadeElements = document.querySelectorAll('.fade-in');

const observer = new IntersectionObserver((entries) => {
    entries.forEach(entry => {
        if (entry.isIntersecting) {
            entry.target.classList.add('visible');
        }
    });
}, { threshold: 0.1 });

fadeElements.forEach(el => observer.observe(el));

// ========== ANIMATION DES BARRES DE COMPÉTENCES ==========
const skillBars = document.querySelectorAll('.skill-bar-item');

const skillsObserver = new IntersectionObserver((entries) => {
    entries.forEach(entry => {
        if (entry.isIntersecting) {
            const progress = entry.target.querySelector('.progress');
            if (progress) {
                const width = progress.getAttribute('data-width') || progress.style.width;
                if (width) {
                    progress.style.width = width;
                }
            }
        }
    });
}, { threshold: 0.5 });

skillBars.forEach(bar => skillsObserver.observe(bar));

// ========== INITIALISATION DES BARRES (si data-width) ==========
document.querySelectorAll('.progress').forEach(progress => {
    const width = progress.getAttribute('data-width');
    if (width) {
        progress.style.width = '0%';
        progress.setAttribute('data-width', width);
    }
});