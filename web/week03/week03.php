<?php 
session_start();
?>

<html>
<body>
    
    <?php include 'save.php';?>
    <table>
        <form action="results.php" method="post">
        <tr>
            <td>
                Q: What year are you in school?
                <input type="radio" name="year" value="Freshman">Freshman<br>
                <input type="radio" name="year" value="Sophomore">Sophomore<br>
                <input type="radio" name="year" value="Junior">Junior<br>
                <input type="radio" name="year" value="Senior">Senior
            </td>
            <td>
                Q: What is your major?
                <input type="radio" name="major" value="CS">CS<br>
                <input type="radio" name="major" value="WDD">WDD<br>
                <input type="radio" name="major" value="CIT">CIT<br>
                <input type="radio" name="major" value="SE">SE<br>
                <input type="radio" name="major" value="CE">CE<br>
                <input type="radio" name="major" value="Other">Other
            </td>
        </tr>
        <tr>
            <td>
                Q: What is your favorite language to program in?
                <input type="radio" name="language" value="Cplus">C++<br>
                <input type="radio" name="language" value="Java">Java<br>
                <input type="radio" name="language" value="Javascript">Javascript<br>
                <input type="radio" name="language" value="Python">Python<br>
                <input type="radio" name="language" value="C">C<br>
                <input type="radio" name="language" value="Csharp">C#<br>
                <input type="radio" name="language" value="SQL">SQL<br>
                <input type="radio" name="language" value="PHP">PHP<br>
                <input type="radio" name="language" value="Ruby">Ruby<br>
                <input type="radio" name="language" value="Perl">Perl<br>
                <input type="radio" name="language" value="Other">Other
            </td>
            <td>
                Q: Have you ever had a proffesional level programming job/internship?
                <input type="radio" name="prof" value="yes">Yes<br>
                <input type="radio" name="prof" value="no">No
            </td>
        </tr>
        <tr>
            <td>
                <button type="button">See Results</button>
            </td>
            <td>
                <input type="submit">Vote!
            </td>
        </tr>
            </form>
    </table>

</body>
</html>


Yes
No