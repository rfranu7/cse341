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

    <header><?php include 'header.php'; ?></header>

    <main class="col-2">
        
        <div class="cart">
            <?php 
            if(isset($_SESSION['message'])) {
                echo "<p class='".$_SESSION['msgStatus']."'>".$_SESSION['message']."</p>";
                unset($_SESSION['message']);
                unset($_SESSION['msgStatus']);
            }


            $total = 0;
            if(isset($_SESSION['cart'])){
                foreach($_SESSION['cart'] as $item) {
                    $total += $item['itemPrice'];

                    echo '<div class="itemDetailPlaceHolder">
                            <form>
                                <input type="checkbox" name="delete[]" class="checkItems" data-name="'.$item['itemName'].'" data-price="'.$item['itemPrice'].'" data-quantity="'.$item['itemQuantity'].'">
                            </form>
                            <div class="itemImgHolder">
                                <img src="assets/img/'.$item['itemImg'].'" alt="'.$item['itemName'].'" title="'.$item['itemName'].'">
                            </div>
                            <h3>'.$item['itemName'].'</h3>
                            <h3 class="itemPrice">'.$item['itemPrice'].'</h3>
                            <div class="quantityEdit">
                                <button class="btn btn-primary minus-btn">-</button>
                                <input type="number" class="quantityInput" name="quantity" value="'.$item['itemQuantity'].'">
                                <button class="btn btn-primary add-btn">+</button>
                            </div>
                          </div>';
                }
            } else {
                echo '<div class="itemDetailPlaceHolder no-view"><p class="all-col">No items to view</p>'.
                    '<p class="btn-anchor all-col"><a class="btn btn-primary" href="?action=browse">Browse Now</a></p    ></div>';
            }
            ?>
            
        </div>

        <div class="total">
            <div class="summary">
                <h4>Order Summary</h4>
                <p>Subtotal <span id="amount"></span></p>
                <p>Order Summary</p>
                <div id="orderSum"></div>
                <form id="checkoutForm" action="?action=proceed-to-checkout" method="post">
                    <input type="hidden" name="total" id="totalForm">
                    <input id="checkoutBtn" type="submit" class="btn btn-action <?php if(!isset($_SESSION['cart'])) { echo "btn-disabled"; } ?>" value="Checkout" <?php if(!isset($_SESSION['cart'])) { echo "disabled"; } ?>>
                </form>
            </div>
        </div>
    </main>
    
    <footer><?php include 'footer.php'; ?></footer>

    <!-- The Modal -->
    <div id="removeModal" class="modal">

        <!-- Modal content -->
        <div class="modal-content">
            <div class="modal-header">
                <span class="close">&times;</span>
            </div>
            <div class="modal-body">
                <p>Are you sure you want to remove <span id="itemName"></span> from your cart? </p>
            </div>
            <div class="modal-footer">
                <form id="removeItemForm" action="?action=remove-item" method="post">
                    <input type="hidden" name="itemName" id="itemNameRemove">
                    <input type="hidden" name="itemQuantity" id="itemQuantityRemove">
                    <input type="hidden" name="itemPrice" id="itemPriceRemove">
                    <button class="btn btn-error">Remove Item</button>
                </form>
                <button id="cancel-btn" class="btn btn-primary">Cancel</button>
            </div>
        </div>

    </div>

    <script src="assets/js/modal.js"></script>
    <script src="assets/js/cart.js"></script>
    
</body>
</html>