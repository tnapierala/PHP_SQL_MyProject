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

    $name= $_POST['name'] ?? '';
    $hours = $_POST['hours'] ?? '';
    $address = $_POST['address'] ?? '';
    $city = $_POST['city'] ?? '';

    if (is_post_request()) {
        global $id;
        $n = val_str($name);
        $h = val_int($hours);
        $a = val_strNr($address);
        $c = val_str($city);

        if ($n && $h && $a && $c != false ){
            insert_jobTime($n,$h,$a,$c);
            redirect_to('../test_DataBase.php');
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
        <title>Edit</title>
        <meta name="description" content=""/>
        <meta name="keywords" content=""/>
        <link href="../style.css" rel="stylesheet" type="text/css">
    </head>
    <body>
        <div class="flexRow">
            <div class="ul edit">
                <div class="li left-edit"><a>Editing</a></div>
                <div class="li right-edit"> <a href="../test_DataBase.php">Back</a></div>
            </div>
        </div>
        <div class="divForm ">
            <form name="frmregister" action="" method="post" >
                <div class="form">
                    <div class="formCol">
                        <div class="formTR">
                            <div class="fromTH">
                                <label for="name"><strong>Name:</strong></label>
                            </div>
                            <div class="fromTD">
                                <input class="inp-text" name="name" id="name" type="text" size="30" />
                            </div>
                        </div>
                        <div class="formTR">
                            <div class="fromTH">
                                <label for="name"><strong>Hours:</strong></label>
                            </div>
                            <div class="fromTD">
                                <input class="inp-text" name="hours" id="hours" type="text" size="30" />
                            </div>
                        </div>
                        <div class="formTR">
                            <div class="fromTH">
                                <label for="name"><strong>Address:</strong></label>
                            </div>
                            <div class="fromTD">
                                <input class="inp-text" name="address" id="address" type="text" size="30" />
                            </div>
                        </div>
                        <div class="formTR">
                            <div class="fromTH">
                                <label for="name"><strong>City:</strong></label>
                            </div>
                            <div class="fromTD">
                                <input class="inp-text" name="city" id="city" type="text" size="30" />
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
    </body>
</html>