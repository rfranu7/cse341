<nav>
    <a class="imageHolder" href="browse.php">
        <img src="assets/img/b-logo.png" alt="STORE NAME">
    </a>
    <!-- <button>Search</button> -->
    <a class="cart" href="cart.php">
        <span class="material-icons shopping-cart">shopping_cart</span>
        <span class="cart-num"><?php if(isset($cartCount) && $cartCount > 0) { echo $cartCount;} ?></span>
    </a>
</nav>
<img src="assets/img/banner.jpg" alt="STORE BANNER">