<html>
<body>
    
    <h1>Items</h1>

<?php

// default Heroku Postgres configuration URL
$dbUrl = getenv('DATABASE_URL');

if (empty($dbUrl)) {
 // example localhost configuration URL with postgres username and a database called cs313db
 $dbUrl = "postgres://wqxoukiphvzwqs:8dHXxJLyFrSucrLACSP3rx9bwk@ec2-107-22-235-119.compute-1.amazonaws.com:5432/dpsuuhcpqefm4";
}

$dbopts = parse_url($dbUrl);

print "<p>$dbUrl</p>\n\n";

$dbHost = $dbopts["host"]; 
$dbPort = $dbopts["port"]; 
$dbUser = $dbopts["user"]; 
$dbPassword = $dbopts["pass"];
$dbName = ltrim($dbopts["path"],'/');

try {
 $db = new PDO("pgsql:host=$dbHost;port=$dbPort;dbname=$dbName", $dbUser, $dbPassword);
    
    foreach($db->query('SELECT now()') as $row){
        print "<p>$row[0]</p>\n\n";
    }
}
catch (PDOException $ex) {
 print "<p>error: $ex->getMessage() </p>\n\n";
 die();
}

foreach ($db->query('SELECT now()') as $row)
{
 print "<p>$row[0]</p>\n\n";
}

?>

</body>
</html>