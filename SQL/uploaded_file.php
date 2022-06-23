<?php

    function move_upload($name, $btn) {
        global $errors;
        global $goodNews;
        global $uploadOk, $db;
        $target_dir = "JPG/";
        $target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
        $uploadOk = 1;
        $nameFile = basename($_FILES["fileToUpload"]["name"]);
        $sizeFile = $_FILES["fileToUpload"]["size"];
        $typeFile = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
        $sql = "UPDATE admins SET filename = '".db_escape($db,$nameFile)."', type = '".db_escape($db,$typeFile)."', size = '".db_escape($db,$sizeFile)."' WHERE  username = '".db_escape($db,$name)."' ";

        echo $nameFile;
        $pattern2 = "/([^A-z0-9_\-\.]|[\.]{3})/";
        $pattern = "/^[0-9\w-' ]/";
        $specialChars = preg_match($pattern, $nameFile);
        if ($specialChars) {
            $errors[] = "Photo filename are not allowed a Special Chars.";
            $uploadOk = 0;
            return $uploadOk;
        }

        // Check if image file is an actual image or fake image
        if (isset($btn)) {

            $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
            if ($check !== false) {
                $goodNews[] = "File is an image - " . $check["mime"] . ".";
                /*$result = mysqli_query($db, $sql);
                confirm_result_set($result);*/
                $uploadOk = 1;
            } else {
                $errors[] = "File is not an image.";
                $uploadOk = 0; //return $uploadOk;
            }
        }

        // Check if file already exists
        if (file_exists($target_file)) {
            $goodNews[] = "Change profile photo from DataBase.";
            $result = mysqli_query($db, $sql);
            confirm_result_set($result);
            $uploadOk = 0;
            return $uploadOk;
        }

        // Check file size
        if ($sizeFile > 1024000) {
            $errors[] = "Sorry, your file is too large.";
            $uploadOk = 0;
            return $uploadOk;
        }

        // Allow certain file formats
        if ($typeFile != "jpg" && $typeFile != "png" && $typeFile != "jpeg" ) {
            $errors[] = "Sorry, only JPG, JPEG & PNG files are allowed.";
            $uploadOk = 0;
            return $uploadOk;
        }

        if ($nameFile != "jpg" && $typeFile != "png" && $typeFile != "jpeg" ) {
            $errors[] = "Sorry, only JPG, JPEG & PNG files are allowed.";
            $uploadOk = 0;
            return $uploadOk;
        }

        // Check if $uploadOk is set to 0 by an error
        if ($uploadOk == 0) {
            $errors[] = "Sorry, your file was not uploaded.";
        // if everything is ok, try to upload file
        } else {
            if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
                $goodNews[] = "The file " . htmlspecialchars(basename($_FILES["fileToUpload"]["name"])) . " has been uploaded.";
                $result = mysqli_query($db, $sql);
                confirm_result_set($result);
            } else {
                $errors[] = "Sorry, there was an error uploading your file.";
            }
        }
    }

    function view_image_file($user) {
        global $db;
        $sql = "SELECT filename FROM admins ";
        $sql .= "WHERE username = '".db_escape($db, $user)."' ";
        $sql .= "LIMIT 1";
        $result = mysqli_query($db, $sql);
        confirm_result_set($result);
        $avatar = mysqli_fetch_assoc($result);
        mysqli_free_result($result);
        $img = $avatar['filename'];

        if (isset($avatar)) {
            echo "<img src='/PHP-SQL/JPG/$img' alt='PhotoProfile'>";
        } else {
            echo "<img src='/PHP-SQL/JPG/profile.png' alt='PhotoProfile'>";
        }
    }
