<html>
    <head>
        <link type="text/css" rel="stylesheet" href="../css/main.css" />
    </head>
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
}
catch (PDOException $ex) {
 print "<p>error: $ex->getMessage() </p>\n\n";
 die();
}

?>
    
    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="POST">
        <select name="price">
            <option value="all">All prices</option>
            <option value="0">$0 to $10</option>
            <option value="11">$11 to $50</option>
            <option value="51">$51 to $100</option>
            <option value="101">$101 to $200</option>
            <option value="201">$201 to $300</option>
            <option value="301">$301 and above</option>
            <?php
            $query = $db->query('SELECT * FROM item')->fetchAll();
            
            if ($_SERVER["REQUEST_METHOD"] == "POST"){
                $prices = $_POST['price'];
                if($prices != 'all'){
                    // = $db->query("SELECT * FROM item WHERE price='$prices'")->fetchAll();
                    if ($prices == "0"){
                        $low = 0;
                        $high = 10;
                    } else if ($prices == "11"){
                        $low = 11;
                        $high = 50;
                    } else if ($prices == "51"){
                        $low = 51;
                        $high = 100;
                    } else if ($prices == "101"){
                        $low = 101;
                        $high = 200;
                    } else if ($prices == "201"){
                        $low = 201;
                        $high = 300;
                    } else if ($prices == "201"){
                        $low = 301;
                        $high = 99999999;
                    }
                }
            }
            /*
            foreach($db->query('SELECT DISTINCT price FROM item')->fetchAll() as $prices){
                if($_SERVER["REQUEST_METHOD"] == "POST"){
                    if($_POST["price"] == $prices["price"]){
                        $selected = "selected='selected'";
                    }
                    else{
                        $selected = "";
                    }
                }
            }
            */
            ?>
            <input type="submit" value="Search"/>
        </select>
    
    </form>
    <?php
        foreach($query as $row){
            if ($row['price'] > $low && $row['price'] < $high){
                echo '<tr>';
                echo '<td>' . $row['name'] . '</td>';
                echo '<td>' . $row['description'] . '</td>';
                echo '<td>' . $row['quantity'] . '</td>';
                echo '<td>$' . $row['price'] . '</td>';
                echo '</tr>';
            }
        }
        echo '</table>';
    ?>

</body>
</html>