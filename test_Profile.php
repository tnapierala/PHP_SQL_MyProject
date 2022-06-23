<?php
    include "SQL/query_functions.php";
    include "SQL/functions.php";
    include "SQL/validation.php";
    include "SQL/hashed_pass.php";
    include "SQL/uploaded_file.php";

    session_start();
    global $id, $profile;
    $errors = [];
    $goodNews = [];
    $f_name = $_SESSION["first_name"] ?? '';
    $u_name = $_SESSION["username"] ?? '';

    if (!isset($_SESSION["id"])) {
        $errors[] = "Errors with get id from session!";
    } else {
        $id = $_SESSION["id"];
        $profile = find_user_by_id($id);
        //$_SERVER['REQUEST_METHOD'] = "POST";
    }

    $fName= $_POST['fName'] ?? '';
    $lName = $_POST['lName'] ?? '';
    $email = $_POST['email'] ?? '';
    $name = $_POST['name'] ?? '';
    $password = $_POST['password'] ?? '';

    $sUpdate = $_POST['sendUpdate'] ?? '';

    if ( !empty($sUpdate) ) {
        if (is_post_request()) {
            $fN = val_str($fName);
            $lN = val_str($lName);
            $e = val_email($email);
            $n = val_uname($name);
            $p = val_pass($password);
            $hash_p = set_hashed_password($p);

            if ($fN && $lN && $e && $n && $p != false) {
                update_profile($id, $fN, $lN, $e, $n, $hash_p);
                $goodNews[] = "Your update executed successfully";
            } else {
                $errors[] = "Query SQL not executed!";
                $errors[] = "Repair it all errors!";
            }
        }

        function update_profile($admin, $fN, $lN, $e, $n, $hash_p)
        {
            global $db;
            $sql = "UPDATE admins SET first_name = '" . db_escape($db, $fN) . "', last_name = '" . db_escape($db, $lN) . "', email = '" . db_escape($db, $e) . "', username = '" . db_escape($db, $n) . "', hashed_password = '" . db_escape($db, $hash_p) . "' WHERE  id = '" . db_escape($db, $admin) . "' ";
            $sql .= "LIMIT 1";
            $result = mysqli_query($db, $sql);

            if ($result) {
                return true;
            } else {
                //Del failed;
                echo mysqli_error($db);
                db_disconnect($db);
                exit;
            }
        }
    }

    $uploadFile = $_POST['uploadImg'] ?? '';

    if ( !empty($uploadFile) ) {
        move_upload($u_name, $uploadFile);
    } 
?>

<!DOCTYPE html>
<html lang="HTML5">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title> Logged </title>
    <meta name="description" content=""/>
    <meta name="keywords" content=""/>
    <link href="style.css" rel="stylesheet" type="text/css">
    <script src="https://kit.fontawesome.com/a076d05399.js" crossorigin="anonymous"></script>
</head>
<body>
    <div class="flexRow">
        <div class="ul">
            <div class="li"><a href="test_Logged.php">Home</a></div>
            <div class="li"><a href="test_DataBase.php">DataBase</a></div>
            <div class="li"><a class="active1" href="test_Profile.php">Profile</a></div>
            <div class="li right"><a href="SQL/logout.php">Logout</a></div>
        </div>
    </div>
    <div class="flexRow c">
        <h2 id="LoggedH2">Logged In</h2>
        <div class="flexRow2">
            <h2 id="LoggedH2-nu"><?php echo $f_name;?></h2>
            <h2 id="LoggedH2-nu"><?php echo $u_name;?></h2>
        </div>
        <h3 id="LoggedH3">My Profile</h3>
    </div>
    <div class="bgcProfile">
        <div class="imgInpProfile">
            <div class="imgProfile">
                <?php view_image_file($u_name); ?>
            </div>
            <div class="inputProfile">
                <form action="" method="post" enctype="multipart/form-data">
                    <label class="textFile"> Select image to upload: </label>
                    <div class="choseFileRow">
                        <input  type="file" id="fileToUpload" name="fileToUpload" hidden>
                        <label class="cuBtn choseFile_btn" for="fileToUpload">Choose File</label>
                        <span class="file-chosen" id="fileChosen">No file chosen</span>
                    </div>

                    <input class="cuBtn uploadImg_btn" type="submit" value="Upload File" name="uploadImg" id="uploadImg">
                </form>

                <script>
                    const actualBtn = document.getElementById('fileToUpload');
                    const fileChosen = document.getElementById('fileChosen');
                    actualBtn.addEventListener('change', function(){
                        fileChosen.textContent = this.files[0].name
                    })
                </script>

            </div>
        </div>
        <div class="formProfile">
            <div class="divForm Profile">
                <form name="frmregister" action="" method="post" >
                    <div class="form">
                        <div class="formCol">
                            <div class="formTR">
                                <div class="fromTH">
                                    <label for="name"><strong>First Name:</strong></label>
                                </div>
                                <div class="fromTD">
                                    <input class="inp-text" name="fName" i d="fName" type="text" size="30" value="<?php echo $profile['first_name']?>" />
                                </div>
                            </div>
                            <div class="formTR">
                                <div class="fromTH">
                                    <label for="name"><strong>Last Name:</strong></label>
                                </div>
                                <div class="fromTD">
                                    <input class="inp-text" name="lName" id="lName" type="text" size="30" value="<?php echo $profile['last_name']?>" />
                                </div>
                            </div>
                            <div class="formTR">
                                <div class="fromTH">
                                    <label for="name"><strong>Email:</strong></label>
                                </div>
                                <div class="fromTD">
                                    <input class="inp-text" name="email" id="email" type="text" size="30" value="<?php echo $profile['email']?>" />
                                </div>
                            </div>
                            <div class="formTR">
                                <div class="fromTH">
                                    <label for="name"><strong>Username:</strong></label>
                                </div>
                                <div class="fromTD">
                                    <input class="inp-text" name="name" id="name" type="text" size="30" value="<?php echo $profile['username']?>" />
                                </div>
                            </div>
                            <div class="formTR">
                                <div class="fromTH">
                                    <label for="name"><strong>Password:</strong></label>
                                </div>
                                <div class="fromTD">
                                    <input class="inp-text" name="password" id="password" type="password" size="30" value="<?php echo $profile['hashed_password']?>" />
                                </div>
                            </div>
                        </div>
                        <div class="formCol">
                            <div class="formTR btnLogin">
                                <div class="submit-button-right">
                                    <input class="send_btn" type="submit" value="Submit" alt="Submit" name="sendUpdate" id="sendUpdate" />
                                    <input class="send_btn" type="reset" value="Reset" alt="Reset" />
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <div class="errMsg">
        <?php display_errors($errors); ?>
    </div>
    <div class="passInfo">
        <?php display_info($goodNews); ?>
    </div>
</body>
</html>