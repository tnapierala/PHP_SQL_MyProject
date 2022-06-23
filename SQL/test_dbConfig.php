<?php

    define("DB_SERVER", "tomek-pc3");
    define("DB_USER", "root");
    define("DB_PASS", "4rfvbgt%");
    define("DB_NAME", "test");

    //require_once('db_credentials.php');

    function db_connect() {
        $connection = mysqli_connect(DB_SERVER, DB_USER, DB_PASS, DB_NAME);
        // Check connection
        if (!$connection) {
            die("Connection failed: " . mysqli_connect_error());
        }

        if (!mysqli_set_charset($connection, "utf8")) {
            printf("Error loading character set utf:8 %s \n", mysqli_error($connection));
        } else {
            //print"("kodowanie ustawione na: %s\n", mysqli_character_set_name($connection))
        }
        return $connection;
    }

    function db_disconnect($connection) {
        if(isset($connection)) {
            mysqli_close($connection);
        }
    }

    function db_escape($connection, $string): string
    {
        return mysqli_real_escape_string($connection, $string);
    }

    function confirm_db_connect() {
        if(mysqli_connect_errno()){
            $msg = "Database connection failed: ";
            $msg .= mysqli_connect_error();
            $msg .= "(" . mysqli_connect_errno() . ")";
            exit($msg);
        }
    }

    function confirm_result_set($result_set) {
        if (!$result_set) {
            exit("Database query failed.");
        }
    }