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

$sql = "SELECT * FROM public.scriptures";
if(isset($_POST['book'])) {
    $sql .= " WHERE book = $_POST[book]";
}

echo $sql;


$statement = $db->query($sql);
$results = $statement->fetchAll(PDO::FETCH_ASSOC);

// print_r($results);
echo '<h1>Scripture Resources</h1>';
echo '<form method="POST" action="./">';
echo '<input type="text" name="book" id="book">';
echo '<input type="submit" value="SEARCH"></form>';
foreach($results as $row){
    echo '<div class="scripture-block" style="margin-bottom: 1rem;"><strong class="book">'.$row['book'].' </strong>';
    echo '<strong class="chapter">'.$row['chapter'].':</strong>';
    echo '<strong class="verse">'.$row['verse'].'</strong>';   
    echo '<span class="content"> - "'.$row['content'].'"</span></div>'; 
}

?>