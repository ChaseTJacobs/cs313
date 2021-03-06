<?php
    // default Heroku Postgres configuration URL
    $dbUrl = getenv('DATABASE_URL');
    
    $dbopts = parse_url($dbUrl);
    $dbHost = $dbopts["host"]; 
     $dbPort = $dbopts["port"]; 
     $dbUser = $dbopts["user"]; 
     $dbPassword = $dbopts["pass"];
     $dbName = ltrim($dbopts["path"],'/');
    try {
     $db = new PDO("pgsql:host=$dbHost;port=$dbPort;dbname=$dbName", $dbUser, $dbPassword);
        $output = "<script>console.log( 'This ran and worked' );</script>";
    }
    catch (PDOException $ex) {
     print "<p>error: $ex->getMessage() </p>\n\n";
     die();
    }
?>