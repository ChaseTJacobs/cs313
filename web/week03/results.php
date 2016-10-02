<?php
    include 'save.php';
    session_start();

    /*if ($_SESSION["year"] == ""){
        $_SESSION["year"] = $_POST["year"];
    } else {
        
    }
    $_SESSION["major"] = $_POST["major"]; 
    $_SESSION["language"] = $_POST["language"];
    $_SESSION["prof"] = $_POST["prof"];
    */
    if($_POST["year"] == "Freshman"){
        $Freshman = $Freshman + 1;
    } elseif ($_POST["year"] == "Sophomore"){
        $Sophomore = $Sophomore + 1;
    } elseif ($_POST["year"] == "Junior"){
        $Junior = $Junior + 1;
    } elseif ($_POST["year"] == "Senior"){
        $Senior + $Senior + 1;
    }

    if($_POST["major"] == "CS"){
        $CS = $CS + 1;
    } elseif ($_POST["major"] == "WDD"){
        $WDD = $WDD + 1;
    } elseif ($_POST["major"] == "CIT"){
        $CIT = $CIT + 1;
    } elseif ($_POST["major"] == "SE"){
        $SE = $SE + 1;
    } elseif ($_POST["major"] == "CE"){
        $CE = $CE + 1;
    } elseif ($_POST["major"] == "Other"){
        $Othermajor = $Othermajor + 1;
    }

    if($_POST["language"] == "Cplus"){
        $Cplusplus = $Cplusplus + 1;
    } elseif ($_POST["language"] == "Java"){
        $Java = $Java + 1;
    } elseif ($_POST["language"] == "Javascript"){
        $Javascript = $Javascript + 1;
    } elseif ($_POST["language"] == "Python"){
        $Python = $Python + 1;
    } elseif ($_POST["language"] == "C"){
        $C = $C + 1;
    } elseif ($_POST["language"] == "Csharp"){
        $Csharp = $Csharp + 1;
    } elseif ($_POST["language"] == "SQL"){
        $SQL = $SQL + 1;
    } elseif ($_POST["language"] == "PHP"){
        $PHP = $PHP + 1;
    } elseif ($_POST["language"] == "Ruby"){
        $Ruby = $Ruby + 1;
    } elseif ($_POST["language"] == "Perl"){
        $Perl = $Perl + 1;
    } elseif ($_POST["language"] == "Other"){
        $Otherlanguage = $Otherlanguage + 1;
    }

    if ($_POST["prof"] == "yes"){
        $Yes = $Yes + 1;
    } elseif ($_POST["prof"] == "no"){
        $No = $No + 1;
    }
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