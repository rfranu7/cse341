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

?><!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ONLINE STORE - Cart</title>
    <link rel="stylesheet" href="assets/css/style.css">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
</head>
<body>

    <header>
        <?php include 'header.php'; ?>
    </header>

    <main class="col-2">
        <div class="cart">
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
                            <div class="quantityEdit">
                                <button class="btn">-</button>
                                <input type="number" name="quantity" value="'.$item['itemQuantity'].'">
                                <button class="btn">+</button>
                            </div>
                          </div>';
                }
            }
            ?>
            
        </div>

        <div class="total">
            <div class="summary">
                <h4>Order Summary</h4>
                <p>Subtotal <span></span></p>
                <p>Order Summary</p>
                <form action="proceed-to-checkout.php" method="post">
                    <input type="hidden" name="total">
                    <input type="submit" class="btn" value="Checkout">
                </form>
            </div>
        </div>
    </main>
    
    <footer></footer>
    
</body>
</html>