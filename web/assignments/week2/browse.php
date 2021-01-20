<?php

$shoes = array(
            "Nike SB Dunk Low “Street Hawker”" => "“Street Hawker” Dunk Low.jpg", 
            "Nike SB Dunk Low “Elephant”" =>  "Dunk Low “Elephant”.jpg", 
            "Nike Air Max 90 “Duck Camo”" =>  "Nike Air Max 90 “Duck Camo”.jpg", 
            "Nike Dunk High “Pure Platinum”" =>  "Nike Dunk High “Pure Platinum”.jpg", 
            "OBJ x Nike Air Max 720 “Young King of the Drip”" =>  "OBJ x Nike Air Max 720 “Young King of the Drip”.jpg", 
            "Sean Cliver x NikeSB “Holiday Special” Dunk Low" =>  "Sean Cliver x NikeSB “Holiday Special” Dunk Low.jpg"
        );

?><!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ONLINE STORE - Browse Items</title>

    <style>
        header nav {
            display: grid;
            grid-template-columns: 1fr 80px 80px;
            grid-column-gap: .5rem;
        }

        .browse {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            gap: 1rem;
        }

        img {
            max-width: 100%;
        }
    </style>

</head>
<body>

    <header>
        <nav>
            <img src="logo.png" alt="STORE NAME">
            <button>Search</button>
            <button>Cart</button>
        </nav>
        <img src="banner.png" alt="STORE BANNER">
    </header>

    <main>
        <div class="welcome">
            <h1>WELCOME</h1>
            <p>SOME MESSAAGE HERE</p>
        </div>

        <div class="browse">

            <?php 
            foreach($shoes as $key => $value) {
                echo '<div class="item">
                        <img src="assets/img/'.$value.'" alt="'.$key.'" title="'.$key.'">
                        <div class="itemDetails">
                            <h3>'.$key.'</h3>
                            <button>Buy Now</button>
                            <button>Add to Cart</button>
                        </div>
                      </div>';
            }
            ?>
            
        </div>
    </main>
    
    <footer></footer>
    
</body>
</html>