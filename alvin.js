// Function to redirect based on screen size
function redirectBasedOnScreenSize() {
    // Get the current window width
    const windowWidth = window.innerWidth;

    // Define the screen width threshold for switching to the mobile version
    const mobileScreenWidthThreshold = 768; // Adjust this value as needed

    // Check if the window width is less than the threshold
    if (windowWidth < mobileScreenWidthThreshold) {
        // Redirect to mobile.php for smaller screens
        window.location.href = 'mobile.php';
    } else {
        // Redirect to userdashboard.php for larger screens
        window.location.href = 'userdashboard.php';
    }
}

// Call the function when the page loads
window.addEventListener('load', redirectBasedOnScreenSize);




/*

