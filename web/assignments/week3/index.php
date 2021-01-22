<?php 
    // Main Controller

    // Create or access session
    session_start();

    $action = filter_input(INPUT_POST, 'action');
    if ($action == NULL){
        $action = filter_input(INPUT_GET, 'action');
    }
    
    include "countries.php";

    // DEFINE ARRAYS
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

    switch ($action){
        case "add-to-cart":
            
            $itemName = filter_input(INPUT_POST, 'itemName', FILTER_SANITIZE_STRING);
            $itemQuantity = 1;
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
                $_SESSION['cart'] = $itemOrder;
            }
            
            // SEND BACK TO BROWSE PAGE
            header('Location: .');
        break;

        case "cart":
            include $_SERVER['DOCUMENT_ROOT'] . '/assignments/week3/cart.php';
        break;

        case "proceed-to-checkout":
            // FILTER DATA FROM CART
            $total = filter_input(INPUT_POST, 'total', FILTER_SANITIZE_NUMBER_FLOAT);
            $orderName = filter_input(INPUT_POST, 'orderName', FILTER_DEFAULT, FILTER_FORCE_ARRAY);
            $orderQuantity = filter_input(INPUT_POST, 'orderQuantity', FILTER_DEFAULT, FILTER_FORCE_ARRAY);

            // CHECK IF EMPTY
            if(empty($total) || empty($orderName) || empty($orderQuantity)) {
                $_SESSION['message'] = "Please select items from your cart before checking out";
                header('Location: ./?action=cart');
                exit;
            }

            // SET PROCESSED VARIABLES TO SESSION
            $_SESSION['checkout'] = array("total" => $total, "orderName" => $orderName, "orderQuantity" => $orderQuantity);

            // SEND TO CHECKOUT PAGE
            header('Location: ./?action=checkout');
        break;
        
        case "checkout":
            // REDIRECT TO CART IF ITEMS ARE EMPTY
            if(!isset($_SESSION['checkout'])){
                $_SESSION['message'] = "Please select items from your cart before checking out";
                header('Location: ./?action=cart');
                exit;
            }
            include $_SERVER['DOCUMENT_ROOT'] . '/assignments/week3/checkout.php';
        break;

        case "return-cart":
            unset($_SESSION['checkout']);
            header('Location: ./?action=cart');
        break;

        case "confirm":
            // REDIRECT TO CART IF ITEMS ARE EMPTY
            // if(!isset($_SESSION['checkout'])){
            //     $_SESSION['message'] = "Please select items from your cart before checking out";
            //     header('Location: ./?action=cart');
            //     exit;
            // }

            // FILTER FORM INPUTS
            $firstName = filter_input(INPUT_POST, 'firstName', FILTER_SANITIZE_STRING);
            $lastName = filter_input(INPUT_POST, 'lastName', FILTER_SANITIZE_STRING);
            $emailAddress = filter_input(INPUT_POST, 'emailAddress', FILTER_SANITIZE_EMAIL);
            $mobileNumber = filter_input(INPUT_POST, 'mobileNumber', FILTER_SANITIZE_NUMBER_INT);
            $streetAddress = filter_input(INPUT_POST, 'streetAddress', FILTER_SANITIZE_STRING);
            $city = filter_input(INPUT_POST, 'city', FILTER_SANITIZE_STRING);
            $province = filter_input(INPUT_POST, 'province', FILTER_SANITIZE_STRING);
            $countryCode = filter_input(INPUT_POST, 'country', FILTER_SANITIZE_STRING);
            $zipCode = filter_input(INPUT_POST, 'zipCode', FILTER_SANITIZE_NUMBER_INT);

            $country = $countries[$countryCode];

            // IF ONE OF THE FIELD IS EMPTY REDIRECT TO CHECKOUT PAGE WITH ERROR MESSAGE
            if(empty($firstName) || empty($lastName) || empty($emailAddress) || empty($mobileNumber) || 
            empty($streetAddress) || empty($city) || empty($province) || empty($country) || empty($zipCode)) {
                $_SESSION['message'] = "Please fill out all required fields.";
                header('Location: ./?action=checkout');
                exit;
            }

            // SET ITEM DETAILS
            $checkoutItemImg = array();
            $checkoutItemPrice = array();
            
            for($i=0; $i<count($_SESSION['checkout']['orderName']); $i++) {
                if(array_key_exists($_SESSION['checkout']['orderName'][$i], $shoesImg)) {
                    $itemImg = $shoesImg[$_SESSION['checkout']['orderName'][$i]];
                    $checkoutItemImg[] = $itemImg;
                }

                $itemPrice = $_SESSION['checkout']['orderQuantity'][$i]*1000;
                $checkoutItemPrice[] = $itemPrice;
            }

            unset($_SESSION['cart']);

            include $_SERVER['DOCUMENT_ROOT'] . '/assignments/week3/confirm.php';
        break;

        default:        
            include $_SERVER['DOCUMENT_ROOT'] . '/assignments/week3/browse.php';
        break;
    }


?>