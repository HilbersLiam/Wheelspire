const body = document.body;
const themeSelector = document.getElementById('theme-selector');

// Load saved theme if it exists
const savedTheme = localStorage.getItem('theme');
if (savedTheme) {
    body.className = savedTheme;
    themeSelector.value = savedTheme;
}

themeSelector.addEventListener('change', (e) => {
    const selectedTheme = e.target.value;
    // Apply selected theme
    body.className = selectedTheme;
    // Save preference
    localStorage.setItem('theme', selectedTheme); 
});