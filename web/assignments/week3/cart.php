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
                echo "<p class='error'>".$_SESSION['message']."</p>";
                unset($_SESSION['message']);
            }


            $total = 0;
            if(isset($_SESSION['cart'])){
                foreach($_SESSION['cart'] as $item) {
                    $total += $item['itemPrice'];

                    echo '<div class="itemDetailPlaceHolder">
                            <input type="checkbox" name="delete[]" class="checkItems" data-name="'.$item['itemName'].'" data-price="'.$item['itemPrice'].'" data-quantity="'.$item['itemQuantity'].'">
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
            } else {
                echo '<div class="itemDetailPlaceHolder"><p class="all-col">No items to view</p>'.
                    '<a class="btn btnAnchor all-col" href="?action=browse">Browse Now</a></div>';
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
                    <input type="submit" class="btn" value="Checkout">
                </form>
            </div>
        </div>
    </main>
    
    <footer><?php include 'footer.php'; ?></footer>

    <script>
    
        const checkItems = document.querySelectorAll(".checkItems");
        checkItems.forEach(element => {
            element.addEventListener("change", (e) => {
                const amount = document.getElementById("amount");
                const totalAmount = document.getElementById("totalForm");
                const orderSum = document.getElementById("orderSum");
                const checkoutForm = document.getElementById("checkoutForm");

                if(e.target.checked) {
                    // ADD AMOUNT TO CART
                    amount.textContent = amount.textContent == "" ? 0 + parseFloat(e.target.dataset.price) : parseFloat(amount.textContent) + parseFloat(e.target.dataset.price);
                    totalAmount.value = totalAmount.value == "" ? 0 + parseFloat(e.target.dataset.price) : parseFloat(totalAmount.value) + parseFloat(e.target.dataset.price)

                    // ADD ITEM TO ORDER SUMMARY
                    if(orderSum.innerHTML == "") {
                        orderSum.innerHTML = "<ul id='orderSumList'><li data-name='"+e.target.dataset.name+"'>"+e.target.dataset.quantity+" "+e.target.dataset.name+"</li></ul>";
                        
                        const orderQuantity = document.createElement("input");
                        orderQuantity.setAttribute("type", "hidden");
                        orderQuantity.setAttribute("name", "orderQuantity[]");
                        orderQuantity.dataset.name = e.target.dataset.name;
                        orderQuantity.setAttribute("value", e.target.dataset.quantity);
                        
                        const orderName = document.createElement("input");
                        orderName.setAttribute("type", "hidden");
                        orderName.setAttribute("name", "orderName[]");
                        orderName.dataset.name = e.target.dataset.name;
                        orderName.setAttribute("value", e.target.dataset.name);

                        checkoutForm.appendChild(orderQuantity);
                        checkoutForm.appendChild(orderName);
                    } else {
                        const orderList = document.getElementById("orderSumList");
                        const li = document.createElement("li");
                        li.dataset.name = e.target.dataset.name;
                        li.textContent = e.target.dataset.quantity+" "+e.target.dataset.name;
                        orderList.appendChild(li);

                        const orderQuantity = document.createElement("input");
                        orderQuantity.setAttribute("type", "hidden");
                        orderQuantity.setAttribute("name", "orderQuantity[]");
                        orderQuantity.dataset.name = e.target.dataset.name;
                        orderQuantity.setAttribute("value", e.target.dataset.quantity);
                        
                        const orderName = document.createElement("input");
                        orderName.setAttribute("type", "hidden");
                        orderName.setAttribute("name", "orderName[]");
                        orderName.dataset.name = e.target.dataset.name;
                        orderName.setAttribute("value", e.target.dataset.name);

                        checkoutForm.appendChild(orderQuantity);
                        checkoutForm.appendChild(orderName);
                    }

                } else if(!e.target.checked) {
                    // REMOVE AMOUNT TO CART
                    amount.textContent = amount.textContent == "" ? 0 - parseFloat(e.target.dataset.price) : parseFloat(amount.textContent) - parseFloat(e.target.dataset.price);
                    totalAmount.value = totalAmount.value == "" ? 0 - parseFloat(e.target.dataset.price) : parseFloat(totalAmount.value) - parseFloat(e.target.dataset.price)

                    // REMOVE ITEM TO ORDER SUMMARY
                    if(!orderSum.innerHTML == "") {
                        const orderList = document.getElementById("orderSumList");
                        const childs = orderList.childNodes;

                        const checkoutForm = document.getElementById("checkoutForm");
                        const InputName = document.querySelectorAll("input[name='orderName[]']");
                        const InputQuantity = document.querySelectorAll("input[name='orderQuantity[]']");
                        console.log(InputName);

                        for(var i=0; i<childs.length; i++) {
                            if(childs[i].dataset.name == e.target.dataset.name) {
                                orderList.removeChild(childs[i]);
                                checkoutForm.removeChild(InputName[i]);
                                checkoutForm.removeChild(InputQuantity[i]);
                            } else {
                                continue;
                            }
                        }
                    }

                }
            });
        });

    </script>
    
</body>
</html>