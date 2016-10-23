<?php
require('dbconnectionta.php');
    //$name = $description = $quantity = $price = "";
    
    if (isset($_POST) && !empty($_POST)){
        if($_POST['form'] == 'form1') {
                echo "THE STUFF IS: " . $name . $description . $quantity . $price;
                $db->exec("INSERT INTO item (name, description, quantity, price) VALUES ('$name', '$description', '$quantity', '$price')");
        
                $sid = $db->lastInsertId('item_id_seq');
                $name = $description = $quantity = $price = "";
        }
    }
?>

<html>
    <head>
        <link type="text/css" rel="stylesheet" href="../css/main.css" />
        <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.6.2/jquery.min.js"></script>
        <script type="text/javascript">
            $(document).ready(function(){
                $("#addForm").submit(function(e) {
                    $.ajax({
                        type: "POST",
                        url: "week06.php",
                        data: $(this).serialize()
                    }).done(function(data) {
                        $("#results").html(data); 
                    });
                    e.preventDefault();
                });
            });
        </script>
    </head>
<body>
    
    <h1>Items</h1>
    
    <script>    
        function show(){
            document.getElementById("results").style.display = "inline";
        }
        function hide(){
            document.getElementById("results").style.display = "none";
        }
    </script>
    <input type="button" onclick="show()">Add Element<br>
    <span id="results">
        <form action="" method="post" id="addForm">
            <table>
                <tr>
                    <th>Name</th>
                    <th>Description</th>
                    <th>Quantity</th>
                    <th>Price</th>
                </tr>
                <tr>
                    <td><input type="text" name="name" value="<?= $name;?>"></td>
                    <td><input type="text" name="description" value="<?= $description;?>"></td>
                    <td><input type="text" name="quantity" value="<?= $quantity;?>"></td>
                    <td><input type="text" name="price" value="<?= $price;?>"></td>
                </tr>
            </table>
            <input type="hidden" name="form" value="form1" />
            <input type="submit" onclick="hide()" value="Submit">
        </form>
    </span>

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
                    } else if ($prices == "301"){
                        $low = 301;
                        $high = 99999999;
                    }
                } else {
                    $low = 0;
                    $high = 999999999;
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
            if ($row['price'] >= $low && $row['price'] <= $high){
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