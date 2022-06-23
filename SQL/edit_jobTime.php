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
    global $id, $job;

    if (!isset($_GET['id'])) {
        redirect_to('../test_DataBase.php');
    } else {
        $id = $_GET['id'];
        $job = find_job_by_id($id);
        //$_SERVER['REQUEST_METHOD'] = "POST";
    }

    $name= $_POST['name'] ?? '';
    $hours = $_POST['hours'] ?? '';
    $address = $_POST['Address'] ?? '';
    $city = $_POST['City'] ?? '';

    if (is_post_request()) {
        global $id;
        $n = val_str($name);
        $h = val_int($hours);
        $a = val_str($address);
        $c = val_str($city);

        if ($n && $h && $a && $c != false ){
            edit_jobTime($id,$n,$h,$a,$c);
            redirect_to('../test_DataBase.php');
        } else {
            $errors[] = "Query SQL not executed!";
            $errors[] = "Repair it all errors!";
        }
    }

    function edit_jobTime($admin,$n,$h,$a,$c) {
        global $db;
        $sql = "UPDATE jobTime SET Name = '".db_escape($db,$n)."', Hours = '".db_escape($db,$h)."', Address = '".db_escape($db,$a)."', City = '" .db_escape($db,$c)."' WHERE  ID = '".db_escape($db,$admin)."' ";
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
        <title> Edit </title>
        <meta name="description" content=""/>
        <meta name="keywords" content=""/>
        <link href="../style.css" rel="stylesheet" type="text/css">
    </head>
    <body>
        <div class="flexRow">
            <div class="ul edit">
                <div class="li left-edit"><a>Editing JobTime</a></div>
                <div class="li right-edit"><a href="../test_DataBase.php">Back</a></div>
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
                                <input class="inp-text" name="fName" id="fName" type="text" size="30" value="<?php echo $job['Name']?>" />
                            </div>
                        </div>
                        <div class="formTR">
                            <div class="fromTH">
                                <label for="name"><strong>Last Name:</strong></label>
                            </div>
                            <div class="fromTD">
                                <input class="inp-text" name="lName" id="lName" type="text" size="30" value="<?php echo $job['Hours']?>" />
                            </div>
                        </div>
                        <div class="formTR">
                            <div class="fromTH">
                                <label for="name"><strong>Email:</strong></label>
                            </div>
                            <div class="fromTD">
                                <input class="inp-text" name="email" id="email" type="text" size="30" value="<?php echo $job['Address']?>" />
                            </div>
                        </div>
                        <div class="formTR">
                            <div class="fromTH">
                                <label for="name"><strong>Username:</strong></label>
                            </div>
                            <div class="fromTD">
                                <input class="inp-text" name="name" id="name" type="text" size="30" value="<?php echo $job['City']?>" />
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