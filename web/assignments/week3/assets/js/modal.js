// GET MODAL ITEMS
const modal = document.getElementById("myModal");
const span = document.getElementsByClassName("close")[0];
const cancelBtn = document.getElementById("cancel-btn");

// CLOSE MODAL ON X OR CANCEL BUTTON
span.addEventListener("click", (e) => {
    modal.style.display = "none";
});

cancelBtn.addEventListener("click", (e) => {
    modal.style.display = "none";
});

// CLOSE MODAL IF THE OUTSIDE WINDOW IS CLICKED
window.addEventListener('click', (e) => {
    if (e.target == modal) {
        modal.style.display = "none";
    }
});