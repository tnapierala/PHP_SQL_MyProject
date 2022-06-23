<?php
include "query_functions.php";
include "functions.php";
$id = '';

    if (!isset($_GET['id'])) {
        redirect_to('../test_DataBase.php');
    } else {
        $id = $_GET['id'];
        $_SERVER['REQUEST_METHOD'] = "POST";
    }

    if(is_post_request()) {
        delete_admin($id);
        $goodNews[] = "Deleting record from DataBase successfully";
        redirect_to('../test_DataBase.php');
    } else {
       $admin = find_job_by_id($id);
    }

    function delete_admin($job) {
        global $db;
        $sql = "DELETE FROM jobtime WHERE ID = '".db_escape($db,$job)."' ";
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
