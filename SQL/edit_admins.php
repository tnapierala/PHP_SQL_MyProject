<?php

    include "query_functions.php";
    include "functions.php";
    include "validation.php";
    include "hashed_pass.php";


    session_start();
    $f_name = $_SESSION["first_name"] ?? '';
    $u_name = $_SESSION["username"] ?? '';
    $errors = [];
    $goodNews = [];
    $id = '';

        if (!isset($_GET['id'])) {
            redirect_to('../test_Logged.php');
        } else {
            $id = $_GET['id'];
            $user = find_user_by_id($id);
            //$_SERVER['REQUEST_METHOD'] = "POST";
        }

    $fName= $_POST['fName'] ?? '';
    $lName = $_POST['lName'] ?? '';
    $email = $_POST['email'] ?? '';
    $name = $_POST['name'] ?? '';
    $password = $_POST['password'] ?? '';

    if (is_post_request()) {
        global $id;
        $fN = val_str($fName);
        $lN = val_str($lName);
        $e = val_email($email);
        $n = val_uname($name);
        $p = val_pass($password);
        $hash_p = set_hashed_password($p);

        if ($fN && $lN && $e && $n && $p!= false ){
            edit_admin($id,$fN,$lN,$e,$n,$hash_p);
            redirect_to('../test_Logged.php');
        } else {
            $errors[] = "Query SQL not executed!";
            $errors[] = "Repair it all errors!";
        }
    }

    function edit_admin($admin,$fN,$lN,$e,$n,$hash_p) {
        global $db;
        $sql = "UPDATE admins SET first_name = '".db_escape($db,$fN)."', last_name = '".db_escape($db,$lN)."', email = '".db_escape($db,$e)."', username = '" .db_escape($db,$n)."', hashed_password = '" .db_escape($db,$hash_p) . "' WHERE  id = '".db_escape($db,$admin)."' ";
        $sql .= "LIMIT 1";
        $result = mysqli_query($db, $sql);

        if ( $result ) {
            return true;
        } else {
            //Del failed;
            echo mysqli_error($db);
            db_disconnect($db);
            exit;
        }
    }

?>



<!DOCTYPE html>
<html lang="HTML5">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <title>Edit Admins</title>
        <meta name="description" content=""/>
        <meta name="keywords" content=""/>
        <link href="../style.css" rel="stylesheet" type="text/css">
    </head>
    <body>
        <div class="flexRow">
            <div class="ul edit">
                <div class="li left-edit"><a>Editing Admins</a></div>
                <div class="li right-edit"><a href="../test_Logged.php">Back</a></div>
            </div>
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
                                <input class="inp-text" name="fName" id="fName" type="text" size="30" value="<?php echo $user['first_name']?>" />
                            </div>
                        </div>
                        <div class="formTR">
                            <div class="fromTH">
                                <label for="name"><strong>Last Name:</strong></label>
                            </div>
                            <div class="fromTD">
                                <input class="inp-text" name="lName" id="lName" type="text" size="30" value="<?php echo $user['last_name']?>" />
                            </div>
                        </div>
                        <div class="formTR">
                            <div class="fromTH">
                                <label for="name"><strong>Email:</strong></label>
                            </div>
                            <div class="fromTD">
                                <input class="inp-text" name="email" id="email" type="text" size="30" value="<?php echo $user['email']?>" />
                            </div>
                        </div>
                        <div class="formTR">
                            <div class="fromTH">
                                <label for="name"><strong>Username:</strong></label>
                            </div>
                            <div class="fromTD">
                                <input class="inp-text" name="name" id="name" type="text" size="30" value="<?php echo $user['username']?>" />
                            </div>
                        </div>
                        <div class="formTR">
                            <div class="fromTH">
                                <label for="name"><strong>Password:</strong></label>
                            </div>
                            <div class="fromTD">
                                <input class="inp-text" name="password" id="password" type="password" size="30" value="<?php echo $user['hashed_password']?>" />
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