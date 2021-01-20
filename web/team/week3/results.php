<?php

$name = htmlspecialchars($_POST['name']);
$email = htmlspecialchars($_POST['email']);
$major = htmlspecialchars($_POST['major']);
$comments = htmlspecialchars($_POST['comments']);
$continents = $_POST['continent'];
$continentsName = array("na" => "North America", "sa" => "South America", "eu" => "Europe", "as" => "Asia", "au" => "Australia", "af" => "Africa", "an" => "Antartica");

?><!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Result</title>
</head>
<body>

<?php 

    echo '<p>Name: '.$name.'</p>';
    echo '<p>Email Address: <a href="mailto:'.$email.'">'.$email.'</a></p>';
    echo '<p>Major: '.$major.'</p>';
    echo '<p>Name: '.$comments.'</p>';
    echo '<p>Visited Continents:</p>';

    foreach($continents as $con) {
        $continent = htmlspecialchars($con);
        echo '<ul>';
        if(array_key_exists($continent, $continentsName)) {
            echo '<li>'.$continentsName[$continent].'</li>';
        }
        echo '</ul>';
    }
?>
    
</body>
</html>