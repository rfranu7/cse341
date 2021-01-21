<?php
include "countries.php";

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
    <title>ONLINE STORE - Checkout Items</title>
    <link rel="stylesheet" href="assets/css/style.css">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">

</head>
<body>

    <header>
        <?php include 'header.php'; ?>
    </header>

    <main class="col-2">
        <div class="checkout">
            <form action="checkout-items.php" method="post">

                <label for="firstName"><span class="req">*</span> First Name</label>
                <input type="text" name="firstName" id="firstName" class="formInputs" required>
                
                <label for="lastName"><span class="req">*</span> Last Name</label>
                <input type="text" name="lastName" id="lastName" class="formInputs" required>
                
                <label for="emailAddress"><span class="req">*</span> Email Address</label>
                <input type="email" name="emailAddress" id="emailAddress" class="formInputs" required>
                
                <label for="mobileNumber"><span class="req">*</span> Mobile Number</label>
                <input type="tel" name="mobileNumber" id="mobileNumber" class="formInputs" required>
                
                <label for="streetAddress"><span class="req">*</span> Street Address</label>
                <input type="text" name="streetAddress" id="streetAddress" class="formInputs" required>
                
                <label for="city"><span class="req">*</span> City</label>
                <input type="text" name="city" id="city" class="formInputs" required>
                
                <label for="province"><span class="req">*</span> Province</label>
                <input type="text" name="province" id="province" class="formInputs" required>
                
                <label for="country"><span class="req">*</span> Country</label>
                <select name="country" id="country" class="formInputs" required>
                    <option value="" selected disabled>Select a country</option>
                    <?php foreach($countries as $key => $value) {
                        echo '<option value="'.$key.'" title="'.htmlspecialchars($value).'">'.htmlspecialchars($value).'</option>';
                    }
                    
                    ?>
                </select>
                
                <label for="zipCode"><span class="req">*</span> Zip Code</label>
                <input type="text" name="zipCode" id="zipCode" class="formInputs"  required>

                <a class="btn" href="cart.php">Return to Cart</a>
                <input type="submit" class="btn" value="Buy Now">

            </form>
        </div>

        <div class="total">
            <div class="summary">   
                <h4>Order Summary</h4>
                <p>Subtotal <span></span></p>
                <p>Order Summary</p>
            </div>
        </div>
    </main>
    
    <footer></footer>
    
</body>
</html>