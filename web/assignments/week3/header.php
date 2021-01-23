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

<script src="assets/js/hero-resize.js"></script>