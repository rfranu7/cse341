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
    <title>ONLINE STORE - Thank you for purchasing!</title>
    <link rel="stylesheet" href="assets/css/style.css">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">

</head>
<body>

    <header>
        <?php include 'header.php'; ?>
    </header>

    <main class="col-2">
        <div class="welcome">
            <h1>THANK YOU FOR YOUR ORDER</h1>
            <p>SOME MESSAAGE HERE</p>
        </div>

        <div class="confirm">
            <h2>Order number</h2>
            <h2>Order date</h2>
            <h2>Delivery Details</h2>
            <h2>Order Summary</h2>
            <?php 
            $total = 0;
            if(isset($_SESSION['cart'])){
                foreach($_SESSION['cart'] as $item) {
                    $total += $item['itemPrice'];

                    echo '<div class="itemDetailPlaceHolder">
                            <input type="checkbox" name="delete[]">
                            <img src="assets/img/'.$item['itemImg'].'" alt="'.$item['itemName'].'" title="'.$item['itemName'].'">
                            <h3>'.$item['itemName'].'</h3>
                            <h3>'.$item['itemPrice'].'</h3>
                            <h3>'.$item['itemQuantity'].'</h3>
                          </div>';
                }
            }
            ?>         
        </div>

        <div class="total">
            <p>Subtotal <span></span></p>
            <p>Order Summary</p>
        </div>
    </main>
    
    <footer></footer>
    
</body>
</html>