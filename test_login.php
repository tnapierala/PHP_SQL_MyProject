<?php

include "SQL/query_functions.php";
include "SQL/functions.php";
include "SQL/validation.php";
include "SQL/hashed_pass.php";

/*
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name = $_POST["name"] ?? '';
    $pass = $_POST["password"] ?? '';
    if ($name == '' || $pass == '') {
        $msg = "You must enter all fields";
    } else {
        $sql = "SELECT * FROM admins WHERE username = '$name' AND hashed_password = '$pass'";
        $query = mysqli_query($db, $sql);

        $row  = mysqli_fetch_array($query);
        if(is_array($row)) {
            $i = $_SESSION["id"] = $row['id'];
            $s = $_SESSION["username"] = $row['username'];
            $n = $_SESSION["first_name"] = $row['first_name'];
        } else {
            $msg = "Invalid Username or Password!";
        }
        if ($query === false) {
            echo "Could not successfully run query ($sql) from DB: " . mysqli_error();
            exit;
        }
        if(isset($_SESSION["id"])) {
            header("Location:test_Logged.php");
            exit;
        }
    }
}
*/

?>

<?php
    session_start();
    $db = db_connect();
    $errors = [];
    $goodNews = [];
    $name = $_POST['name'] ?? '';
    $password = $_POST['password'] ?? '';

    if (is_post_request()) {
        global $fuN, $fuP;

        if (isBlank($name)) {
            $errors[] = "Input Username not may be empty!";
        } else {
            $fuN= find_user_name($name);
            if ($fuN == false) {
                $errors[] = "Nieprawidłowa nazwa! <br/>";
            }
        } s_name($name);

        if (isBlank($password)) {
            $errors[] = "Input Password not may be empty!";
        } else {
            $fuP = find_user_pass($name,$password);
            if ($fuP == false) {
                $errors[] = "Nieprawidłowe hasło! <br/>";
            }
        }

        if( $fuN == true && $fuP == true ) {
            redirect_to('test_Logged.php');
            exit;
        }
    }
//echo "<br/>";
?>

<!DOCTYPE html>
<html lang="HTML5">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <title>Login</title>
        <meta name="description" content=""/>
        <meta name="keywords" content=""/>
        <link href="style.css" rel="stylesheet" type="text/css">
    </head>
    <body>
        <div class="logH">
            <div class="logH1">Sing In</div>
            <a href="test_register.php" class="logH2 active2" ><div>Register</div></a>
        </div>
        <div class="divForm">
            <form name="frmregister" action="" method="post" >
                <div class="form">
                    <div class="formCol">
                        <div class="formTR">
                            <div class="fromTH">
                                <label for="name"><strong>Username:</strong></label>
                            </div>
                            <div class="fromTD">
                                <input class="inp-text" name="name" id="name" type="text" size="30" />
                            </div>
                        </div>
                        <div class="formTR">
                            <div class="fromTH">
                                <label for="name"><strong>Password:</strong></label>
                            </div>
                            <div class="fromTD">
                                <input class="inp-text" name="password" id="password" type="password" size="30" />
                            </div>
                        </div>
                    </div>
                    <div class="formCol">
                        <div class="formTR btnLogin">
                            <div class="submit-button-right">
                                <input class="send_btn" type="submit" value="Submit" alt="Submit" title="Submit" />
                                <input class="send_btn" type="reset" value="Reset" alt="Reset" title="Reset" />
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
        <div class="errMsg">
            <?php display_errors($errors); ?>
        </div>
        <div class="passInfo">
            <?php display_info($goodNews); ?>
        </div>
        <div class="footer">
            <?php
                echo "Today is " . date("d.m.Y") . "<br>";
                echo "Today is " . date("l");
            ?>
        </div>
    </body>
</html>
