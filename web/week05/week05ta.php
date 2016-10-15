<?php
    // default Heroku Postgres configuration URL
    $dbUrl = getenv('DATABASE_URL');
    if (empty($dbUrl)) {
     // example localhost configuration URL with postgres username and a database called cs313db
        require('../../cs313/model/localDB.php');
    }
    $dbopts = parse_url($dbUrl);
    $dbHost = $dbopts["host"]; 
     $dbPort = $dbopts["port"]; 
     $dbUser = $dbopts["user"]; 
     $dbPassword = $dbopts["pass"];
     $dbName = ltrim($dbopts["path"],'/');
    try {
     $db = new PDO("pgsql:host=$dbHost;port=$dbPort;dbname=$dbName", $dbUser, $dbPassword);
    }
    catch (PDOException $ex) {
     print "<p>error: $ex->getMessage() </p>\n\n";
     die();
    }
?>

<html>
    <body>
        <br>
        <hr>
        <h2>SCRIPTURE RESOURCES</h2>
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="POST">
            <select name="books">
                <option value="all">Search All Books</option>
                <?php
                $query = $db->query('SELECT * FROM scriptures')->fetchAll();
                
                if($_SERVER["REQUEST_METHOD"] == "POST"){
                    $books = $_POST['books'];
                    if($books != 'all'){
                        $query = $db->query("SELECT * FROM scriptures WHERE book='$books'")->fetchAll();
                    }
                }
 
                foreach($db->query('SELECT DISTINCT book FROM scriptures')->fetchAll() as $books){
                    if($_SERVER["REQUEST_METHOD"] == "POST"){
                        if($_POST["books"] == $books["book"]){ 
                            $selected = "selected='selected'";
                        }
                        else{
                            $selected = "";
                        }
                    }
                    echo '<option value="' . $books['book'] . '"' . $selected . '>' . $books['book'] . '</option>';
                }
                ?>
                <input type="submit" value="Search"/>
            </select>
        </form>
        <?php
            foreach($query as $row){
                    echo '<b>' . $row['book'] . ' ' . $row['chapter'] . ':' . $row['verse'] . '</b>';
                    echo ' - "' . $row['content'] . '"';
                    echo '<br/><br/>';
            }
        ?>
        <hr>	
    </body>
</html>