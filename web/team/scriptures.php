<?php 

try
{
  $dbUrl = getenv('DATABASE_URL');

  $dbOpts = parse_url($dbUrl);

  $dbHost = $dbOpts["host"];
  $dbPort = $dbOpts["port"];
  $dbUser = $dbOpts["user"];
  $dbPassword = $dbOpts["pass"];
  $dbName = ltrim($dbOpts["path"],'/');

  $db = new PDO("pgsql:host=$dbHost;port=$dbPort;dbname=$dbName", $dbUser, $dbPassword);

  $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
}
catch (PDOException $ex)
{
  echo 'Error!: ' . $ex->getMessage();
  die();
}

$sql = "SELECT *
        FROM public.scriptures";

$statement = $db->query($sql);
$results = $statement->fetchAll(PDO::FETCH_ASSOC);

// print_r($results);
foreach($results as $row){
    echo '<div class="scripture-block"><span class="book">'.$row['book'].' </span>';
    echo '<span class="chapter">'.$row['chapter'].':</span>';
    echo '<span class="verse">'.$row['verse'].'</span>';   
    echo '<span class="content"> - "'.$row['content'].'"</span></div>';    
}




?>