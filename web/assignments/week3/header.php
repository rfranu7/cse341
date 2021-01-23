<nav>
    <a class="imageHolder" href=".">
        <img src="assets/img/b-logo.png" alt="STORE NAME">
    </a>
    <a class="cart-header" href="./?action=cart">
        <span class="material-icons shopping-cart">shopping_cart</span>
        <?php if(isset($cartCount) && $cartCount > 0) { echo '<span class="cart-num">'.$cartCount.'</span>';} ?>
    </a>
</nav>
<img id="storeHero" src="assets/img/hero.jpg" alt="STORE HERO">

<script>
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

    window.addEventListener("resize", (e) => {

        console.log(e);

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
        console.log("window resized");
    })
</script>