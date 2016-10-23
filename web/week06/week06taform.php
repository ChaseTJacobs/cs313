<?php
require('db_connectionta.php');
    $book = $chapter = $verse = $content = $topic = $newTopic = "";
    $bookErr = $chapterErr = $verseErr = $contentErr = $topicErr = "";
    
    if (isset($_POST) && !empty($_POST)){
        if($_POST['form'] == 'form1') {
            if(empty($_POST["book"])){
                $bookErr = "Book is required";
            }
            else{
                $book = $_POST["book"];
            }
            if(empty($_POST["chapter"])){
                $chapterErr = "Chapter is required";
            }
            else{
                $chapter = $_POST["chapter"];
            }
            if(empty($_POST["verse"])){
                $verseErr = "Verse is required";
            }
            else{
                $verse = $_POST["verse"];
            }
            if(empty($_POST["content"])){
                $contentErr = "Content is required";
            }
            else{
                $content = $_POST["content"];
            }
            if(!empty($_POST['topics'])){
                $topics = $_POST["topics"];
                        if(in_array("0", $topics)){
                            if($_POST["Other"] != ""){
                                $newTopic = $_POST["Other"];
                            }
                            else{
                                $topicErr = "Please provide a topic next to the selected checkbox";
                            }
                        }
            }
            else{
                $topicErr = "Please select a topic";
            }
            if($bookErr == "" && $chapterErr == "" && $verseErr == "" && $contentErr == "" && $topicErr == ""){
                
                $db->exec("INSERT INTO scriptures (book, chapter, verse, content) VALUES ('$book', '$chapter', '$verse', '$content')");
                $sid = $db->lastInsertId('scriptures_id_seq');
                if($newTopic != ""){
                    $db->exec("INSERT INTO topics (name) VALUES ('$newTopic')");
                    $topicId = $db->lastInsertId('topics_id_seq');
                    $db->exec("INSERT INTO topicconnections (sid, tid) VALUES ('$sid', '$topicId')");
                }
                for($i = 0; $i < count($topics); $i++){
                    $db->exec("INSERT INTO topicconnections (sid, tid) VALUES ('$sid', '" . $topics["$i"] . "')");
                }
                $book = $chapter = $verse = $content = $topic = $newTopic = "";
                $bookErr = $chapterErr = $verseErr = $contentErr = $topicErr = "";
            }
        }
    }
?>
<html>
    <head>
        <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.6.2/jquery.min.js"></script>
        <script type="text/javascript">
            $(document).ready(function(){
                $("#addForm").submit(function(e) {
                    $.ajax({
                        type: "POST",
                        url: "week6_form.php",
                        data: $(this).serialize()
                    }).done(function(data) {
                        $("#results").html(data); 
                    });
                    e.preventDefault();
                });
            });
        </script>
        <style>
            #addForm {
                float: left;
                padding-top: 30px;
                margin-left: 40px;
                position: fixed;
                height: 92vh;
                overflow-y: auto;
                padding-right: 40px;
            }
            #scriptures{
                float: right;
                width: 65%;
            }
        </style>
    </head>
<body>
     <div id="results">
     <form action="" method="post" id="addForm">
         <b>Book: </b><span><?= $bookErr;?></span><br>
          <input type="text" name="book" value="<?=$book?>"><br><br>
          <b>Chapter: </b><span><?= $chapterErr;?></span><br>
          <input type="text" name="chapter" value="<?=$chapter?>"><br><br>
          <b>Verse: </b><span><?= $verseErr;?></span><br>
          <input type="text" name="verse" value="<?=$verse?>"><br><br>
          <b>Content: </b><span><?= $contentErr;?></span><br>
          <textarea cols="30" rows="4" name="content"><?=$content?></textarea>
          <br><br>       
          <b>Topics: </b><span><?= $topicErr;?></span><br>
          <?php 
          foreach($db->query('SELECT * FROM Topics')->fetchAll() as $topic){
            echo "<input type='checkbox' name='topics[]' value='" . $topic['id'] . "'>" . $topic['name'] . "<br>";
          }
          ?>
          <input type="checkbox" name="topics[]" value="0"><input type="text" name="Other" onfocus="$(this).prev(':checkbox').prop('checked', 'checked');" /><br>
          <br><br>
          <input type="hidden" name="form" value="form1" />
          
          <input type="submit" value="Submit">
          <br><br>
     </form>
         <div id="scriptures">
            <?php include('week06ta.php');?>
         </div>
     </div>
</body>
</html>