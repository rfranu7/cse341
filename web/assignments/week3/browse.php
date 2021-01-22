<?php
if(!isset($_SESSION)) { 
    session_start(); 
}

if(isset($_SESSION['cart'])) {
    $cartCount = 0;
    foreach($_SESSION['cart'] as $item) {
        $cartCount += $item['itemQuantity'];
    }
}

$shoes = array(
            "Nike SB Dunk Low - Street Hawker" => "sb-dunk-low-street-hawker.jpg", 
            "Nike Zoom Freak 2 - Letter Bro" =>  "zoom-freak-2-letter-bro.jpg", 
            "Nike Air Max 90 - Duck Camo" =>  "air-max-90-duck-camo.jpg", 
            "Nike Dunk High - Pure Platinum" =>  "dunk-high-pure-platinum.jpg", 
            "Kobe 6 Protro - Green Apple" =>  "kobe-6-protro-green-apple.jpg", 
            "Sean Cliver x NikeSB Dunk Low - Holiday Special" =>  "sb-dunk-low-holiday-special.jpg"
        );

?><!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ONLINE STORE - Browse Items</title>
    <link rel="stylesheet" href="assets/css/style.css">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">

</head>
<body>

    <header><?php include 'header.php'; ?></header>

    <main>
        <div class="browse">

            <?php 
            foreach($shoes as $key => $value) {
                echo '<div class="item">
                        <div class="itemImgHolder">
                            <img src="assets/img/'.$value.'" alt="'.$key.'" title="'.$key.'">
                        </div>
                        <div class="itemDetails">
                            <h3>'.$key.'</h3>
                            <button class="btn">Buy Now</button>
                            <form class="addToCartForm" action="?action=add-to-cart" method="post">
                                <input type="hidden" name="itemName" value="'.$key.'">
                                <button class="btn">Add to Cart</button>
                            </form>
                        </div>
                      </div>';
            }
            ?>
            
        </div>
    </main>
    
    <footer><?php include 'footer.php'; ?></footer>
    
</body>
</html>