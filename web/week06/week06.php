<?php
require('dbconnectionta.php');
    $name = $description = $quantity = $price = "";
    
    if (isset($_POST) && !empty($_POST)){
        $set = $_POST;
        debug_to_console($_POST);
        if($_POST['form'] == 'form1'){
                $name = $_POST["name"];
                $description = $_POST["description"];
                $quantity = $_POST["quantity"];
                $price = $_POST["price"];
                $category = $_POST["category"];
                if ($category == "Furniture"){
                    $category = 1;
                } else if ($category == "Home Accessories"){
                    $category = 2;
                } else if ($category == "Kitchen"){
                    $category = 3;
                } else if ($category == "Computer Accessories"){
                    $category = 4;
                } else if ($category == "Clothing Male"){
                    $category = 5;
                } else if ($category == "Clothing Female"){
                    $category = 6;
                } else if ($category == "Food"){
                    $category = 7;
                }
                $db->exec("INSERT INTO item (name, description, quantity, price, category_id) VALUES ('$name', '$description', '$quantity', '$price', '$category')");
        
                $sid = $db->lastInsertId('item_id_seq');
                $name = $description = $quantity = $price = "";
        } else {
            if ( is_array( $_POST ) ){
                $output1 = $_POST;
                debug_to_console(count ($output1));
                if (count($output1) == 5){
                    $count = 0;
                    foreach($output1 as $ele){
                        $result[$count] = $ele;
                        $count = $count + 1;
                    }
                    $name = $result[0];
                    $description = $result[1];
                    $quantity = $result[2];
                    $price = $result[3];
                    $tid = $result[4];
                    debug_to_console( $name );
                    debug_to_console( $description );
                    debug_to_console( $quantity );
                    debug_to_console( $price );
                    $sqlString = "UPDATE item
                               SET name='" . $name . "', description='" . $description . "', quantity='" . $quantity . "', price='" . $price . "'
                               WHERE id='" . $tid . "';";
                    $db->exec($sqlString);
                    
                }
            }
        }
    }

function debug_to_console( $data ) {

    if ( is_array( $data ) ){
        $output = "<script>console.log( 'Debug Objects: Array: " . implode( ',', $data) . "' );</script>";
    }
    else {
        $output = "<script>console.log( 'Debug Objects: Data: " . $data . "' );</script>";
    }
    echo $output;
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
                var row = "row" + num.toString();
                var all = document.getElementsByClassName(row);
                for (i=0;i<all.length;i++){
                    if (all[i].style.display == "none"){
                        all[i].style.display = "";
                    } else {
                        all[i].style.display = "none";
                    }
                }
            }
            
            function editDatabase(length, rowID){
                console.log(length);
                console.log(rowID);
                var rows = document.getElementsByClassName("row" + rowID);
                var childEl;
                for (i=0;i<rows.length;i++){
                    if (rows[i].getAttribute("name")==length.toString()){
                        childEl = rows[i].childNodes;
                        for(j=0;j<=childEl.length-1;j++){
                            if (j != childEl.length-1){
                                if (j == 3){
                                    childEl[j].childNodes[1].className="save";
                                    childEl[j].childNodes[2].className="edit";
                                } else {
                                    childEl[j].firstElementChild.className="save";
                                    childEl[j].childNodes[1].className="edit";
                                }
                            } else {
                                childEl[j].childNodes[2].className="save";
                                childEl[j].firstElementChild.className="edit";
                            }
                        }
                    }
                }
            }
            
            function editCell(length, rowID){
                console.log(length);
                console.log(rowID);
                var rows = document.getElementsByClassName("row" + rowID);
                var childEl;
                for (i=0;i<rows.length;i++){
                    if (rows[i].getAttribute("name")==length.toString()){
                        childEl = rows[i].childNodes;
                        for(j=0;j<=childEl.length-1;j++){
                            if (j != childEl.length-1){
                                if (j == 3){
                                    childEl[j].childNodes[1].className="edit";
                                    childEl[j].childNodes[2].className="save";
                                } else {
                                    childEl[j].firstElementChild.className="edit";
                                    childEl[j].childNodes[1].className="save";
                                }
                            } else {
                                childEl[j].childNodes[2].className="edit";
                                childEl[j].firstElementChild.className="save";
                            }
                        }
                    }
                }
            }
    </script>
    </head>
<body onload="hide()">
    
    <div class="table-title"><h3>Inventory</h3></div>
    
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
        $rowID = 1;
        echo '<tr>';
        echo '<th colspan="5" ' . 'class="cat"' . ' onclick="toggleCat(' . $length . ')">' . $cat['name'] . '</th>';
        echo '</tr>';
        $query = $db->query("SELECT * FROM item")->fetchAll();
        foreach($query as $row){
            if ($row['price'] >= $low && $row['price'] <= $high && $row['category_id'] == $length){
                $name = $row['name'];
                $description = $row['description'];
                $quantity = $row['quantity'];
                $price = $row['price'];
                $tid = $row['id'];
                echo '<form action="" method="post" id="addForm2">';
                echo '<tr class="row' . $length . '" name="' . $rowID . '">';
                echo '<td>' . 
                    '<input type="text" class="save"' . 'name="name' . $length . $rowID . '"' . ' value="' . 
                    $name . 
                    '">' . 
                    '<span class="edit">' . 
                    $name . 
                    '</span>' . 
                    '</td>';
                echo '<td>' . 
                    '<input type="text" class="save"' . 'name="descpription' . $length . $rowID . '"' . ' value="' . 
                    $description . 
                    '">' . 
                    '<span class="edit">' . 
                    $description . 
                    '</span>' . 
                    '</td>';
                echo '<td>' . 
                    '<input type="text" class="save"' . 'name="quantity' . $length . $rowID . '"' . ' value="' . 
                    $quantity . 
                    '">' . 
                    '<span class="edit">' . 
                    $quantity . 
                    '</span>' . 
                    '</td>';
                echo '<td>$' . 
                    '<input type="text" class="save"' . 'name="price' . $length . $rowID . '"' . ' value="' . 
                    $price . 
                    '">' . 
                    '<span class="edit">' . 
                    $price . 
                    '</span>' . 
                    '</td>';
                echo '<td>' . 
                    '<input type="button"' . 
                    'class="edit"' . 
                    ' onclick="editCell(' . 
                    $rowID . 
                    ', ' .  
                    $length . 
                    ')"' . 
                    ' value="Edit">';
                echo '<input type="hidden" name="form2" value="'. $tid . '">';
                echo '<input type="submit"' . 
                    'class="save"' . 
                    ' onclick="editDatabase(' . 
                    $rowID . 
                    ', ' .  
                    $length . 
                    ')"' . 
                    ' value="Save" />' . 
                    '</td>';
                echo '</tr>';
                $rowID = $rowID + 1;
                echo '</form>';
            }
        }
        $length = $length + 1;
    }
        ?>
    <?php
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