<?php
    include "query_functions.php";
    include "functions.php";
    global $id, $name;

    if (!isset($_GET['id'])) {
        redirect_to('../test_Logged.php');
    } else {
        $id = $_GET['id'];
        $_SERVER['REQUEST_METHOD'] = "POST";
    }

    if(is_post_request()) {

        delete_admin($id);
        redirect_to('../test_Logged.php');

    } else {
       $admin = find_user_by_id($id);
    }

    function delete_admin($admin) {
        global $db;
        $sql = "DELETE FROM admins WHERE ID = '".db_escape($db,$admin)."' ";
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
