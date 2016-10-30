<?php
require('dbconnectionta.php');
    $name = $description = $quantity = $price = "";
    
    if (isset($_POST) && !empty($_POST)){
        if($_POST['form'] == 'form1'){
                $name = $_POST["name"];
                $description = $_POST["description"];
                $quantity = $_POST["quantity"];
                $price = $_POST["price"];
                $category = $_POST["category"];
                if ($category == "Furniture"){
                    $category = 1;
                } else if (category == "Home Accessories"){
                    $category = 2;
                } else if (category == "Kitchen"){
                    $category = 3;
                } else if (category == "Computer Accessories"){
                    $category = 4;
                } else if (category == "Clothing Male"){
                    $category = 5;
                } else if (category == "Clothing Female"){
                    $category = 6;
                } else if (category == "Food"){
                    $category = 7;
                }
                $db->exec("INSERT INTO item (name, description, quantity, price, category_id) VALUES ('$name', '$description', '$quantity', '$price', '$category')");
        
                $sid = $db->lastInsertId('item_id_seq');
                $name = $description = $quantity = $price = "";
        }
    }
?>

<html>
    <head>
        <link type="text/css" rel="stylesheet" href="week06.css" />
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
        <script>    
            function show(){
                document.getElementById("results").style.display = "inline";
            }
            function hide(){
                document.getElementById("results").style.display = "none";
            }
            
            function toggleCat(num){
                console.log(num);
                
                var row = "row" + num.toString();
                var all = document.getElementsByClassName(row);
                console.log(row);
                for (i=0;i<all.length;i++){
                    if (all[i].style.display == "none"){
                        all[i].style.display = "";
                        console.log("Set to show");
                    } else {
                        all[i].style.display = "none";
                        console.log("Set to hide");
                    }
                }
            }
            
            function editDatabase(id){
                
            }
            
            function editCell(){
                
            }
    </script>
    </head>
<body onload="hide()">
    
    <div class="table-title"><h3>Inventory</h3></div>

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

    print "<table class='table-fill'>
            <tr>
                <th class='text-left'>Name</th>
                <th class='text-left'>Description</th>
                <th class='text-left'>Quantity</th>
                <th class='text-left'>Price</th>
                <th class='text-left'>Action</th>
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
        <div class="select-style">
        <select name="price">
            <option value="all">All prices</option>
            <option value="0">$0 to $10</option>
            <option value="11">$11 to $50</option>
            <option value="51">$51 to $100</option>
            <option value="101">$101 to $200</option>
            <option value="201">$201 to $300</option>
            <option value="301">$301 and above</option>
            <?php
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
            ?>
        </select>
            </div>
    <input class="submit" type="submit" value="Search"/>
    </form>
    <?php
    /*
    function selectByCategory ($some_id){

        SELECT * FROM item
            INNER JOIN category
            ON item.category_id=category.id
            WHERE category.id = '$some_id';
    } */
    $result = $db->query('SELECT * FROM category');
    $length = 1;
    foreach($result as $cat){
        echo '<tr>';
        echo '<th colspan="4" ' . 'class="cat"' . ' onclick="toggleCat(' . $length . ')">' . $cat['name'] . '</th>';
        echo '</tr>';
        $query = $db->query("SELECT * FROM item")->fetchAll();
        foreach($query as $row){
            if ($row['price'] >= $low && $row['price'] <= $high && $row['category_id'] == $length){
                echo '<tr class="row' . $length . '">';
                echo '<td>' . $row['name'] . '</td>';
                echo '<td>' . $row['description'] . '</td>';
                echo '<td>' . $row['quantity'] . '</td>';
                echo '<td>$' . $row['price'] . '</td>';
                echo '<td>' . '<input type="button"' . 'class="edit"' . ' onclick="editCell()"' . ' value="Edit">';
                echo '<input type="button"' . 'class="save"' . ' onclick="editDatabase()"' . ' value="Save">' . '</td>';
                echo '</tr>';
            }
        }
        $length = $length + 1;
    }
        echo '</table>';
    ?>
    <br>
    <input type="button" onclick="show()" value="Add Element">
    <span id="results">
        <form action="" method="post" id="addForm">
            <table>
                <tr>
                    <th>Name</th>
                    <th>Description</th>
                    <th>Quantity</th>
                    <th>Price</th>
                    <th>Category</th>
                </tr>
                <tr>
                    <td><input type="text" name="name" value="<?= $name;?>"></td>
                    <td><input type="text" name="description" value="<?= $description;?>"></td>
                    <td><input type="text" name="quantity" value="<?= $quantity;?>"></td>
                    <td><input type="text" name="price" value="<?= $price;?>"></td>
                    <td><input type="text" name="category" value="<?= $category;?>"></td>
                </tr>
            </table>
            <input type="hidden" name="form" value="form1" />
            <input type="submit" onclick="hide()" value="Submit">
        </form>
    </span>

</body>
</html>