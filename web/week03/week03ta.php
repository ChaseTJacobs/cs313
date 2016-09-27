<html>
<body>

Name: <?php echo $_POST["name"]; ?><br>
Email: <?php echo $_POST["email"]; ?><br>
Your Major: <a href ="<?php echo $_POST["major"]; ?>"><?php echo $_POST["major"]; ?></a><br>
Places you have been: <br>
    <?php 
        if(!empty($_POST['checkbox'])) {
            foreach($_POST['checkbox'] as $check) {
                echo $check . "<br>";
            }
        }
    ?><br>
    <?php echo $_POST["comments"]; ?>

</body>
</html