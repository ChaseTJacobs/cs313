<html>
<body>

Name: <?php echo $_POST["name"]; ?><br>
Email: <?php echo $_POST["email"]; ?><br>
Major: <?php echo $_POST["major"]; ?><br>
Places you have been: <br>
    <?php 
        if(!empty($POST['checkbox'])) {
            foreach($POST['checkbox'] as $check) {
                echo $check;
            }
        }
    ?><br>
    <?php echo $_POST["comments"]; ?>

</body>
</html