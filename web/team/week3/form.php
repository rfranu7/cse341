<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PHP Form Survey</title>
    <style>

        input, textarea {
            margin-bottom: .5rem;
        }
        
        input[type=text], textarea {
            display: block;
        }

        .radioInput {
            display: block;
        }
    
    </style>
</head>
<body>

<?php
    $majors = array("CS" => "Computer Science", "WDD" => "Web Design and Development", "CIT" => "Computer Information Technology", "CE" => "Computer Engineering");
    $continents = array("na" => "North America", "sa" => "South America", "eu" => "Europe", "as" => "Asia", "au" => "Australia", "af" => "Africa", "an" => "Antartica");

    echo '<form action="results.php" method="post">';
    echo    '<label for="name">Name</label>
             <input type="text" name="name" id="name">';
    
    echo    '<label for="email">Email Address</label>
             <input type="text" name="email" id="email">';
        
    echo    '<label>Major</label>';
    foreach($majors as $key => $value) {
        echo '<div class="radioInput">
                <input type="radio" name="major" id="'.$key.'" value="'.$value.'">
                <label for="'.$key.'">'.$value.'</label>
              </div>';
    }
        
    echo    '<label for="comments">Comments</label>
            <textarea name="comments" id="comments" cols="30" rows="10"></textarea>';
        
    echo    '<label for="comments">Visited Continents</label>';
    foreach($continents as $key => $value) {
        echo '<div class="radioInput">
                <input type="checkbox" name="continent[]" id="'.$key.'" value="'.$key.'">
                <label for="'.$key.'">'.$value.'</label>
              </div>';
    }

    echo    '<input type="submit" value="SEND">
         </form>';
    ?>
    
</body>
</html>