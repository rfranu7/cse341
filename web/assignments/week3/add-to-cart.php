<?php
session_start();

$shoesCode = array(
    "Nike SB Dunk Low - Street Hawker" => "SH", 
    "Nike Zoom Freak 2 - Letter Bro" =>  "LB", 
    "Nike Air Max 90 - Duck Camo" =>  "DC", 
    "Nike Dunk High - Pure Platinum" =>  "PP", 
    "Kobe 6 Protro - Green Apple" =>  "GA", 
    "Sean Cliver x NikeSB Dunk Low - Holiday Special" =>  "HS"
);

$shoesImg = array(
    "Nike SB Dunk Low - Street Hawker" => "sb-dunk-low-street-hawker.jpg", 
    "Nike Zoom Freak 2 - Letter Bro" =>  "zoom-freak-2-letter-bro.jpg", 
    "Nike Air Max 90 - Duck Camo" =>  "air-max-90-duck-camo.jpg", 
    "Nike Dunk High - Pure Platinum" =>  "dunk-high-pure-platinum.jpg", 
    "Kobe 6 Protro - Green Apple" =>  "kobe-6-protro-green-apple.jpg", 
    "Sean Cliver x NikeSB Dunk Low - Holiday Special" =>  "sb-dunk-low-holiday-special.jpg"
);


$itemName = htmlspecialchars($_POST['itemName']);
$itemQuantity = isset($_POST['itemQuantity']) ? filter_input(INPUT_POST, $_POST['itemQuantity'], FILTER_SANITIZE_STRING) : 1;
$itemPrice = 1000;

if(array_key_exists($itemName, $shoesCode)) {
    $itemCode = $shoesCode[$itemName];
}

if(array_key_exists($itemName, $shoesImg)) {
    $itemImg = $shoesImg[$itemName];
}

// Perform checking

if(isset($_SESSION['cart'])){
    if(array_key_exists($itemCode, $_SESSION['cart'])) {
        $_SESSION['cart'][$itemCode]['itemQuantity'] += $itemQuantity;
        $_SESSION['cart'][$itemCode]['itemPrice'] += $itemPrice;
    } else {
        $itemOrder = array("itemName" => $itemName, "itemQuantity" => $itemQuantity, "itemPrice" => $itemPrice, "itemImg" => $itemImg);
        $_SESSION['cart'][$itemCode] = $itemOrder;
    }
} else {
    $itemOrder = array($itemCode => array("itemName" => $itemName, "itemQuantity" => $itemQuantity, "itemPrice" => $itemPrice, "itemImg" => $itemImg));
    $_SESSION['cart'] =  $itemOrder;
}

print_r($_SESSION['cart']);
header('Location: browse.php');


?>