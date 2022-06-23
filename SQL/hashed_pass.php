<?php
    function set_hashed_password($password): string {
        return password_hash($password, PASSWORD_DEFAULT);
    }

    function verify_passwd($table, $pass) {
        $matches = password_verify($table, $pass);
        if ($matches == true ) {
            return true;
        } else {
            return false;
        }
    }
