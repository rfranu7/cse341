<nav>
    <a class="imageHolder" href=".">
        <img src="assets/img/b-logo.png" alt="STORE NAME">
    </a>
    <!-- <button>Search</button> -->
    <a class="cart" href="./?action=cart">
        <span class="material-icons shopping-cart">shopping_cart</span>
        <?php if(isset($cartCount) && $cartCount > 0) { echo '<span class="cart-num">'.$cartCount.'</span>';} ?>
    </a>
</nav>
<img src="assets/img/banner.jpg" alt="STORE BANNER">