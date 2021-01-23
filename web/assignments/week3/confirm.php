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

    <header><?php include 'header.php'; ?></header>

    <main>
        <div class="welcome">
            <h1>THANK YOU FOR YOUR ORDER</h1>
            <p>We are currently processing your order and will email you with the confirmation shortly.</p>
        </div>

        <div class="confirm">
            <h3>Order number: <?php echo mt_rand(100000, 999999); ?></h3>
            <div class="delDetails">
                <h3>Delivery Details</h3>
                <p><strong>Delivery for</strong></p>
                <p><?php echo $firstName.' '.$lastName; ?></p>
                <p>Phone number: <?php echo $mobileNumber; ?></p>
                
                <p><strong>Address</strong></p>
                <p><?php echo $streetAddress.', '.$city.', '.$province.', '.$countryCode.' '.$zipCode; ?></p>
                
                <p><strong>Delivery Method</strong></p>
                <p>Standard Shipping - item will be delivered on or before <?php echo date('F d, Y', strtotime('+3 days')); ?>.</p>
            </div>
            <h3>Order Summary</h3>
            <?php 
            $total = 0;
            if(isset($_SESSION['checkout'])){
                for($i=0; $i<count($_SESSION['checkout']['orderName']); $i++) {
                    echo '<div class="itemDetailPlaceHolderConfirm">
                            <div class="imgHolder">
                                <img src="assets/img/'.$checkoutItemImg[$i].'" alt="'.$_SESSION['checkout']['orderName'][$i].'" title="'.$_SESSION['checkout']['orderName'][$i].'">
                            </div>
                            <h3>'.$_SESSION['checkout']['orderName'][$i].'</h3>
                            <h3>'.$checkoutItemPrice[$i].'</h3>
                            <h3>'.$_SESSION['checkout']['orderQuantity'][$i].'</h3>
                          </div>';
                }
            }
            ?>
            <div class="amountSummary">
                <div class="amountItems">
                    <p>Subtotal</p>
                    <p> <?php if(isset($_SESSION['checkout']['orderName'])) { echo $_SESSION['checkout']['total']; } ?></p>
                </div>
                <div class="amountItems">
                    <h3 class="totalAmount">Tax</h3>
                    <h3> <?php if(isset($_SESSION['checkout']['orderName'])) { echo ($_SESSION['checkout']['total']*.20); } ?></h3>
                </div>
                <div class="amountItems">
                    <h3 class="totalAmount">Total</h3>
                    <h3> <?php if(isset($_SESSION['checkout']['orderName'])) { echo ($_SESSION['checkout']['total']*1.20); } ?></h3>
                </div>
            </div>         
        </div>
    </main>

    <?php unset($_SESSION['checkout']); ?>
    
    <footer><?php include 'footer.php'; ?></footer>
    
</body>
</html>