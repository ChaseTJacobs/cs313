<html>
<body>
    
    <h1>Items</h1>

<?php

// default Heroku Postgres configuration URL
$dbUrl = getenv('DATABASE_URL');

if (empty($dbUrl)) {
 // example localhost configuration URL with postgres username and a database called cs313db
 $dbUrl = "postgres://postgres:password@localhost:5432/cs313db";
}

$dbopts = parse_url($dbUrl);

print "<p>$dbUrl</p>\n\n";

$dbHost = $dbopts["host"]; 
$dbPort = $dbopts["port"]; 
$dbUser = $dbopts["user"]; 
$dbPassword = $dbopts["pass"];
$dbName = ltrim($dbopts["path"],'/');

    print "<table>
            <tr>
                <th class='tableHeader'>Name</th>
                <th class='tableHeader'>Description</th>
                <th class='tableHeader'>Quantity</th>
                <th class='tableHeader'>Price</th>
            </tr>";
try {
 $db = new PDO("pgsql:host=$dbHost;port=$dbPort;dbname=$dbName", $dbUser, $dbPassword);
    
foreach($db->query('SELECT * FROM item') as $row){
        echo '<tr>';
        echo '<td>' . $row['name'] . '/td>';
        echo '<td>' . $row['description'] . '</td>';
        echo '<td>' . $row['quantity'] . '</td>';
        echo '<td>$' . $row['price'] . '</td>';
        echo '</tr>';
    }
}
catch (PDOException $ex) {
 print "<p>error: $ex->getMessage() </p>\n\n";
 die();
}
    print "</table>"

?>

</body>
</html>