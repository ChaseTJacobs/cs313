<?php 
    
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