<?php
require('db_connectionta.php');
?>

<style>
    table{
        width: 90%;
        border-collapse: collapse;
    }
    td:first-child {
        padding-right: 50px;
    }
    tr>td+td {
        text-align: center;
    }
    th {
        padding: 5px 15px!important;
    }
    td, th {
        border: 1px solid black;
        padding: 15px;
    }
</style>
<html>
    <body>
        <hr>
        <h2>SCRIPTURE RESOURCES</h2>
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="POST">
            <select name="books">
                <option value="all">Search All Books</option>
                <?php
                $query = $db->query('SELECT * FROM scriptures ORDER BY id DESC')->fetchAll();
                
                if($_SERVER["REQUEST_METHOD"] == "POST" && $_POST['form'] == 'form2'){
                    $books = $_POST['books'];
                    if($books != 'all'){
                        $query = $db->query("SELECT * FROM scriptures WHERE book='$books'")->fetchAll();
                    }
                }
 
                foreach($db->query('SELECT DISTINCT book FROM scriptures')->fetchAll() as $books){
                    if($_SERVER["REQUEST_METHOD"] == "POST" && $_POST['form'] == 'form2'){
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
                <input type="hidden" name="form" value="form2" />
                <input type="submit" value="Search"/>
            </select>
        </form>
        <table>
            <thead>
                <tr>
                    <th>Scripture</th>
                    <th>Topics</th>
                </tr>
            </thead>
        <?php
            foreach($query as $row){
                    echo '<tr>';
                    echo '<td><b>' . $row['book'] . ' ' . $row['chapter'] . ':' . $row['verse'] . '</b>';
                    echo ' - "' . $row['content'] . '"</td><td>';
                    foreach($db->query("SELECT * FROM topics t JOIN topicconnections tc ON t.id = tc.tid WHERE sid='" . $row['id'] . "'") as $topic){
                        echo $topic['name'] . "<br>";
                    }
                    echo '</td></tr>';
            }
        ?>
        </table>
        <br>
        <hr>
        <br><br>
    </body>
</html>