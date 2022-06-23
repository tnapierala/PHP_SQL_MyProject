<?php

function isBlank($value) {
    return !isset($value) || trim($value) === '';
}

function val_str($str) {
    global $errors;
    $pattern = "/^[A-z]*$/";

    if (isBlank($str)) {
        $errors[] = "Input Name is empty. ";
        return false;
    } else {
        if (!preg_match ($pattern, $str) ) {
            $errors[] = "Only alphabets without whitespace are allowed.";
            return false;
        } else {
            return $str;
        }
    }
}
function val_int($int) {
    global $errors;
    $pattern = "/^[0-9]+(\.[0-9][0-9]?)?$/"; // dwie po przecinku

    if ( isBlank($int)) {
        $errors[] = "Input integer is empty.";
        return false;
    } else {
        if( !is_numeric($int) ){
            $errors[] = "This is not a number!";
            return false;
        } elseif (!preg_match($pattern, $int) || $int < 8 || $int > 15) {
            $errors[] = "Only number are allowed and have 8-15(h).";
            return false;
        } else {
            return $int;
        }
    }
}

function val_uname($str) {
    global $errors;
    $pattern = "/^[A-z0-9]*$/"; // "/^[A-z0-9-' ]*$/" --> whitespace

    if (isBlank($str)) {
        $errors[] = "Input username is empty. ";
        return false;
    } else {
        if (!preg_match ($pattern, $str) ) {
            $errors[] = "Only alphabets and numbers are allowed.";
            return false;
        } else {
            return $str;
        }
    }
}
function val_strNr($str) {
    global $errors;
    $pattern = "/^[A-z0-9-' ]*$/"; // --> whitespace

    if (isBlank($str)) {
        $errors[] = "Input string is empty. ";
        return false;
    } else {
        if (!preg_match ($pattern, $str) ) {
            $errors[] = "Only alphabets and numbers are allowed.";
            return false;
        } else {
            return $str;
        }
    }
}

function val_email($email) {
    global $errors;
    $pattern = "^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,3})$^";

    if (!preg_match ($pattern, $email) ){
        $errors[] = "Email is not valid.";
        return false;
    } else {
        return $email;
    }
}

function val_pass($password) {
    global $errors;
    $number = preg_match('@[0-9]@', $password);
    $uppercase = preg_match('@[A-Z]@', $password);
    $lowercase = preg_match('@[a-z]@', $password);
    $specialChars = preg_match('@[^\w]@', $password);

    if (!isBlank($password)) {
        if (strlen($password) < 10 || strlen($password) > 16 || !$number || !$uppercase || !$lowercase || !$specialChars) {
            $errors[] = "Password must be stronger and have 10-16 chars.";
            return false;
        } else {
            return $password;
        }
    } else {
        $errors[] = "Input password is empty. ";
        return false;
    }
}