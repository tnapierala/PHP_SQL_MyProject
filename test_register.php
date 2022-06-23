<?php

    include "SQL/query_functions.php";
    include "SQL/functions.php";
    include "SQL/validation.php";
    include "SQL/hashed_pass.php";

    session_start();
    $db = db_connect();
    $errors = [];
    $goodNews = [];

    $fName= $_POST['fName'] ?? '';
    $lName = $_POST['lName'] ?? '';
    $email = $_POST['email'] ?? '';
    $name = $_POST['name'] ?? '';
    $password = $_POST['password'] ?? '';

    if (is_post_request()) {
        $fN = val_str($fName);
        $lN = val_str($lName);
        $e = val_email($email);
        $n = val_uname($name);
        $p = val_pass($password);
        $hash_p = set_hashed_password($p);

        if ($fN && $lN && $e && $n && $p!= false ){
            insert_user($fN,$lN,$e,$n,$hash_p);
        } else {
            $errors[] = "Query SQL not executed!";
            $errors[] = "Repair it all errors!";
        }
    }

?>

<!DOCTYPE html>
<html lang="HTML5">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title> Register </title>
    <meta name="description" content=""/>
    <meta name="keywords" content=""/>
    <link href="style.css" rel="stylesheet" type="text/css">
</head>
<body>
    <div class="logH">
        <div class="logH1">Register</div>
        <a href="test_login.php" class="logH2 active2"><div>Sing In</div></a>
    </div>
    <div class="divForm ">
        <form name="frmregister" action="" method="post" >
            <div class="form">
                <div class="formCol">
                    <div class="formTR">
                        <div class="fromTH">
                            <label for="name"><strong>First Name:</strong></label>
                        </div>
                        <div class="fromTD">
                            <input class="inp-text" name="fName" id="fName" type="text" size="30" />
                        </div>
                    </div>
                    <div class="formTR">
                        <div class="fromTH">
                            <label for="name"><strong>Last Name:</strong></label>
                        </div>
                        <div class="fromTD">
                            <input class="inp-text" name="lName" id="lName" type="text" size="30" />
                        </div>
                    </div>
                    <div class="formTR">
                        <div class="fromTH">
                            <label for="name"><strong>Email:</strong></label>
                        </div>
                        <div class="fromTD">
                            <input class="inp-text" name="email" id="email" type="text" size="30" />
                        </div>
                    </div>
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
                echo "Date: " . date("d.m.Y") . ".<br>";
                echo "Today is " . date("l") . ".";
            ?>
    </div>
</body>
</html>
