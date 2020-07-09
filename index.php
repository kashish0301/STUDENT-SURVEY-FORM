<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css\styles.css">
    <title><strong> STUDENT SURVEY FORM</strong></title>
</head>

<body>





    <h1 style="color: ivory;background-color:rgba(0, 0, 0, 0.5);">STUDENT SURVEY FORM</h1>
    <div class="top-container" style="margin-left: 300px; margin-right: 300px;">
        <form id="form1" method="POST" action="index.php">
            <table>
                <tr>
                    <td style="text-align: right;"><label id="name">*Name:</label></td>
                    <td> <input type="text" id="name" name="fname" placeholder="Enter your name" required></td>
                </tr>
                <br>
                <tr>
                    <td style="text-align: right;"><label id="email">*Email:</label></td>
                    <td><input type="email" id="email" name="email" placeholder="Enter your email" required></td>
                </tr>
                <br>
                <tr>
                    <td style="text-align: right;"><label id="age">*Age:</label></td>
                    <td><input type="number" id="age" name="age" placeholder="Enter your age" required></td>
                </tr>
                <br>
                <tr>
                    <div class="d">
                        <td style="text-align: right;"><label id="gender-label">What is your Gender?</label></td>
                        <td>
                            <div class="divz">
                                <input type="radio" name="gender" id="male"><label>Male</label><br>
                                <input type="radio" name="gender" id="female"><label>Female</label><br>
                                <input type="radio" name="gender" id="Other"><label>Other</label>
                            </div>
                        </td>
                    </div>
                </tr>
                <tr>
                    <td style="text-align: right;"> <label id="dob-label">D.O.B</label></td>
                    <td> <input type="date" id="date" name="dob"></td>
                </tr>
                <br>
                <tr>
                    <td style="text-align: right;"><label id="role-label">Which option best describes your current role?:</label></td>
                    <td> <select name="frole" id="role">
                            <option value="Student">Student</option>
                            <option value="Teacher">Teacher</option>
                            <option value="trainee">Trainee</option>
                            <option value="intern">Intern</option>
                        </select></td>
                </tr>
                <br>
                <tr>
                    <div class="d">
                        <td style="text-align: right;"><label id="option1" class="op-label">How likely is it that you would recommend a friend?</label></td>
                        <td>
                            <div id="div1" class="divz">
                                <input type="radio" name="tell" id="f1"><label>Definitly</label><br>
                                <input type="radio" name="tell" id="f2"><label>Maybe</label><br>
                                <input type="radio" name="tell" id="f3"><label>Not sure</label>
                            </div>
                        </td>
                    </div>
                </tr>
                <tr>
                    <div class="d">
                        <td style="text-align: right;"> <label id="option2" class="op-label">Things that should be improved in the future</label></td>
                        <td>
                            <div id="future-div" class="divz">
                                <input type="radio" name="future" id="a1"><label>Front-end projects</label><br>
                                <input type="radio" name="future" id="a2"><label>Back-end Projects</label><br>
                                <input type="radio" name="future" id="a3"><label>Data Visualisation</label>
                            </div>
                        </td>
                    </div>
                </tr>
            </table>
            <input name="submit" type="submit" id="butid" placeholder="SUBMIT">
        </form>
    </div>

    <?php
    function filterName($field)
    {
        // Sanitize user name
        $field = filter_var(trim($field), FILTER_SANITIZE_STRING);

        // Validate user name
        if (filter_var($field, FILTER_VALIDATE_REGEXP, array("options" => array("regexp" => "/^[a-zA-Z\s]+$/")))) {
            return $field;
        } else {
            return FALSE;
        }
    }    
    //connect to php connection file and then to server(phpmyadmin)
    include('connect.php');
    
 if(isset($_POST['submit'])) {
   // $fname = $_POST['fname'];
        // Validate user name
        if (empty($_POST["fname"])) {
            $nameErr = "Please enter your name.";
            echo $nameErr;
        } else {
            $fname = filterName($_POST["fname"]);
            if ($fname == FALSE) {
                $nameErr = "Please enter a valid name.";
                echo $nameErr;
            }
        }
    $email = $_POST['email'];
    $age = $_POST['age'];
    $gender = $_POST['gender'];
    $dob = $_POST['dob'];
    $frole = $_POST['frole'];
    $tell = $_POST['tell'];
    $future = $_POST['future'];
 
    mysqli_query($connect, "INSERT into `student_survey` ( `fname`, `email`, `age`,`gender`,`dob`, `frole`, `tell`, `future`)VALUES('$fname','$email','$age','$gender','$dob','$frole','$tell','$future')");
    

   if (mysqli_affected_rows($connect) > 0) {

        echo '<p style="background-color:orange;text-align:center;font-size:200%;" >Successful !!!!!!</p>';

        echo '<p style="background-color:orange;text-align:center;font-size:200%;" ><a href="index.php">GO BACK</a></p>';
    } 
    else {
        echo 'Student NOT added.';
        echo 'mysqli_error($connect)';
    }
}
    ?>
</body>

</html>