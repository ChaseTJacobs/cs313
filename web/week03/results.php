<?php
    include 'save.php';
    $answer1 = $_POST["year"];
    echo "The year is " . $answer1 . " and " . $viewed;
/*
    if($_POST["year"] == "Freshman"){
        
    } elseif ($_POST["year"] == "Sophomore"){
        
    } elseif ($_POST["year"] == "Junior"){
        
    } elseif ($_POST["year"] == "Senior"){
        
    }

    if($_POST["major"] == "CS"){
        
    } elseif ($_POST["major"] == "WDD"){
        
    } elseif ($_POST["major"] == "CIT"){
        
    } elseif ($_POST["major"] == "SE"){
        
    } elseif ($_POST["major"] == "CE"){
        
    } elseif ($_POST["major"] == "Other"){
        
    }

    if($_POST["language"] == "Cplus"){
        
    } elseif ($_POST["language"] == "Java"){
        
    } elseif ($_POST["language"] == "Javascript"){
        
    } elseif ($_POST["language"] == "Python"){
        
    } elseif ($_POST["language"] == "C"){
        
    } elseif ($_POST["language"] == "Csharp"){
        
    } elseif ($_POST["language"] == "SQL"){
        
    } elseif ($_POST["language"] == "PHP"){
        
    } elseif ($_POST["language"] == "Ruby"){
        
    } elseif ($_POST["language"] == "Perl"){
        
    } elseif ($_POST["language"] == "Other"){
        
    }

    if ($_POST["prof"] == "yes"){
        
    } elseif ($_POST["prof"] == "no"){
        
    }
    */
?>

<!DOCTYPE html>
<html>
<body>
    <table>
        <tr>
            <th>
                Questions
            </th>
            <th>
                Voting Results
            </th>
        </tr>
        <tr>
            <td>
                Q: What year are you in school?
                <?php 
                    echo $_POST["year"];
                ?>
            </td>
            <td>
            
            </td>
        </tr>
        <tr>
            <td>
                Q: What is your major?
            </td>
            <td>
                <?php 
                    echo $_POST["major"];
                ?>
            </td>
        </tr>
        <tr>
            <td>
                Q: What is your favorite language to program in?
            </td>
            <td>
                <?php 
                    echo $_POST["language"];
                ?>
            </td>
        </tr>
        <tr>
            <td>
                Q: Have you ever had a proffesional level programming job/internship?
            </td>
            <td>
                <?php 
                    echo $_POST["prof"];
                ?>
            </td>
        </tr>
    
    </table>
</body>
</html>