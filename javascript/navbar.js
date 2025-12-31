function displayContent(elementId) {
    // Get elements by ids
    const productsDropdown = document.getElementById("products-dropdown");
    const profileDropdown = document.getElementById("profile-dropdown");
    const cartDropdown = document.getElementById("cart-dropdown");
    const videosDropdown = document.getElementById("videos-dropdown");
    const wikiDropdown = document.getElementById("wiki-dropdown");

    // Dropdown array
    const dropdowns = [productsDropdown, profileDropdown, cartDropdown, videosDropdown, wikiDropdown];
    
    // Loop through each dropdown
    dropdowns.forEach(dropdown => {
        if (!dropdown) return; // skip if the element doesnt exist

        // If the id matches the one passed in the function
        if (dropdown.id === elementId) {
        // Check if the current dropdown is being displayed
        // Toggle clicked dropdown
        const isVisible = window.getComputedStyle(dropdown).display === "flex";
        dropdown.style.display = isVisible ? "none" : "flex";
        } else {
        // Hide all other dropdowns
        dropdown.style.display = "none";
        }
    });
    }

// Function to close the dropdown
function closeDropdown() {
    const productsDropdown = document.getElementById("products-dropdown");
    const profileDropdown = document.getElementById("profile-dropdown");
    const cartDropdown = document.getElementById("cart-dropdown");
    const videosDropdown = document.getElementById("videos-dropdown");
    const wikiDropdown = document.getElementById("wiki-dropdown");

    // Hide all dropdowns if they exists
    if (productsDropdown) productsDropdown.style.display = "none";
    if (profileDropdown) profileDropdown.style.display = "none";
    if (cartDropdown) cartDropdown.style.display = "none";
    if (videosDropdown) videosDropdown.style.display = "none";
    if (wikiDropdown) wikiDropdown.style.display = "none";
}

