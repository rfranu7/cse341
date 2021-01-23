// FIGURE OUT SIZE ON RELOAD
const hero = document.getElementById("storeHero");
if(screen.width <= 450) {
    hero.setAttribute("src", "assets/img/hero-0.jpg")
} else if(screen.width <= 640) {
    hero.setAttribute("src", "assets/img/hero-25.jpg")
} else if(screen.width <= 768) {
    hero.setAttribute("src", "assets/img/hero-50.jpg")
} else if(screen.width <= 1024) {
    hero.setAttribute("src", "assets/img/hero-75.jpg")
} else {
    hero.setAttribute("src", "assets/img/hero.jpg")
}

// FIX SIZE ON PAGE RESIZE (MAINLY FOR MOBILE PORTRAIT TO LANDSCAPE)
window.addEventListener("resize", (e) => {
    if(e.target.outerWidth <= 450) {
        hero.setAttribute("src", "assets/img/hero-0.jpg")
    } else if(e.target.outerWidth <= 640) {
        hero.setAttribute("src", "assets/img/hero-25.jpg")
    } else if(e.target.outerWidth <= 768) {
        hero.setAttribute("src", "assets/img/hero-50.jpg")
    } else if(e.target.outerWidth <= 1024) {
        hero.setAttribute("src", "assets/img/hero-75.jpg")
    } else {
        hero.setAttribute("src", "assets/img/hero.jpg")
    }
});