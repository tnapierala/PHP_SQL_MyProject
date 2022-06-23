<?php

    function is_post_request(): bool {
        return $_SERVER['REQUEST_METHOD'] == "POST";
    }

    function redirect_to($url) {
        header('Location: ' . $url);
        exit();
    }

    function display_errors($errors = array()) {
        $output = "";
        if(!empty($errors)) {
            $output .= "<h4> Napraw następujące błędy: </h4>";
            $output .= "<ul>";
                foreach($errors as $error) {
                    $output .= "<pre><li>". $error ."</li></pre>";
                }
            $output .= "</ul>";
        }
        echo $output;
    }

    function display_info($goodNews = array()) {
        $output = "";
        if(!empty($goodNews)) {
            $output .= "<ul>";
                foreach($goodNews as $goodNew) {
                    $output .= "<pre><li>". $goodNew ."</li></pre>";
                }
            $output .= "</ul>";
        }
        echo $output;
    }




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


