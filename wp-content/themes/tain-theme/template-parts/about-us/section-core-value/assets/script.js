function animateCounter(id, targetNumber, durationInSeconds) {
    const counterElement = document.getElementById(id);
    const duration = durationInSeconds * 1000; // Convert seconds to milliseconds
    const increment = targetNumber / (duration / 16); // Approx. 60 frames per second
    let currentNumber = 0;

    const updateCounter = () => {
        currentNumber += increment;
        if (currentNumber < targetNumber) {
          counterElement.textContent = Math.ceil(currentNumber);
          requestAnimationFrame(updateCounter);
        } else {
          counterElement.textContent = targetNumber; // Ensure it ends cleanly
        }
    };

    updateCounter();
}

// Call the function
animateCounter('counter_1', 15000, 3); // Example: count to 15000 in 3 seconds
animateCounter('counter_2', 60, 3);
animateCounter('counter_3', 30, 3);