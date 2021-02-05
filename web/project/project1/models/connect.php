<?php

function dbConnect() {
    try {
        $dbUrl = getenv('DATABASE_URL');
    
        if (!isset($dbUrl) || empty($dbUrl)) {
            $dbUrl = getenv('database_url', true);
        }
    
        $dbOpts = parse_url($dbUrl);
    
        $dbHost = $dbOpts["host"];
        $dbPort = $dbOpts["port"];
        $dbUser = $dbOpts["user"];
        $dbPassword = $dbOpts["pass"];
        $dbName = ltrim($dbOpts["path"],'/');
    
        $db = new PDO("pgsql:host=$dbHost;port=$dbPort;dbname=$dbName", $dbUser, $dbPassword);
    
        $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        return $db;
    }
    catch (PDOException $ex) {
        echo 'Error!: ' . $ex->getMessage();
        die();
    }
}

?>