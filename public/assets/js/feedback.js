let feedbackStars = document.querySelectorAll(".feedback-stars li");
let stars = document.getElementById("stars");

for (let i = 0; i < feedbackStars.length; i++) {
    feedbackStars[i].addEventListener("click", (e) => {
        const clickedStarIndex = Array.from(feedbackStars).indexOf(e.currentTarget);
        
        // Add "active" class to clicked star and preceding stars
        for (let a = 0; a <= clickedStarIndex; a++) {
            feedbackStars[a].classList.add("active");
        }

        // Remove "active" class from stars after the clicked one
        for (let a = clickedStarIndex + 1; a < feedbackStars.length; a++) {
            feedbackStars[a].classList.remove("active");
        }

        // Update the value of the stars input
        stars.value = clickedStarIndex + 1; // Assuming 1-based index
    });
}
