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

$sql = "SELECT * FROM public.scriptures WHERE id = $_GET[id]";

// echo $sql;

$statement = $db->query($sql);
$row = $statement->fetch(PDO::FETCH_ASSOC);

echo '<div class="scripture-block" style="margin-bottom: 1rem;"><strong class="book">'.$row['book'].' </strong>';
echo '<strong class="chapter">'.$row['chapter'].':</strong>';
echo '<strong class="verse">'.$row['verse'].'</strong>';
echo '<span class="content"> - "'.$row['content'].'"</span></div>';

?>