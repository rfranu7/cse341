const placeholder = document.querySelector(".first-row");
const btn = document.querySelector(".btn");
const img = document.getElementById("portrait-img");
img.addEventListener("click", (e) => {
    if(e.target.dataset.src == "alternate"){
        img.setAttribute("src", "assets/images/randeep-portrait-alternate.png");
        placeholder.style.backgroundColor = "#6b40ce";
        btn.style.backgroundColor = "#4ccde5";
        img.dataset.src = "normal";
    } else {
        img.setAttribute("src", "assets/images/randeep-portrait.png");
        placeholder.style.backgroundColor = "#4ccde5";
        btn.style.backgroundColor = "#6b40ce";
        img.dataset.src = "alternate";
    }
});