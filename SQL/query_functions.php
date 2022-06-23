<?php

include "test_dbConfig.php";
$db = db_connect();

    function s_name($name) {
        global $db;
        $sql = "SELECT * FROM admins ";
        $sql .= "WHERE username = '".db_escape($db, $name)."'";
        $sql .= "LIMIT 1";
        $query = mysqli_query($db, $sql);
        $row  = mysqli_fetch_array($query);

        if(is_array($row)) {
            $_SESSION["id"] = $row['id'];
            $_SESSION["username"] = $row['username'];
            $_SESSION["first_name"] = $row['first_name'];
        }
    }
    /* =============== Find All ============== */
    function find_all_admin() {
        global $db;
        $sql = "SELECT * FROM admins ORDER BY id ASC";
        //echo $sql;
        //$sql .= "LIMIT 1";
        $result = mysqli_query($db, $sql);
        confirm_result_set($result);
        return $result;
    }

    function find_all_jobTime() {
        global $db;
        $sql = "SELECT * FROM jobtime ORDER BY id ASC";
        //echo $sql;
        //$sql .= "LIMIT 1";
        $result = mysqli_query($db, $sql);
        confirm_result_set($result);
        return $result;
    }
    /* =============== Find by ID ============== */
    function find_user_by_id($id) {
        global $db;
        $sql = "SELECT * FROM admins ";
        $sql .= "WHERE id = '".db_escape($db, $id)."' ORDER BY id ASC ";
        $sql .= "LIMIT 1";
        $result = mysqli_query($db, $sql);
        confirm_result_set($result);
        $admin = mysqli_fetch_assoc($result);
        mysqli_free_result($result);
        return $admin;
    }

    function find_job_by_id($id) {
        global $db;
        $sql = "SELECT * FROM jobtime ";
        $sql .= "WHERE id = '".db_escape($db, $id)."' ORDER BY id ASC ";
        $sql .= "LIMIT 1";
        $result = mysqli_query($db, $sql);
        confirm_result_set($result);
        $admin = mysqli_fetch_assoc($result);
        mysqli_free_result($result);
        return $admin;
    }
    /* =============== Find Name ============== */
    function find_user_name($name) {
        global $db;
        $sql = "SELECT * FROM admins ";
        $sql .= "WHERE username = '".db_escape($db, $name)."' ";
        $sql .= "LIMIT 1";
        $result = mysqli_query($db, $sql);
        confirm_result_set($result);
        $admin = mysqli_fetch_assoc($result);
        if ( !is_null($admin) ) {
                return true;
        }
        mysqli_free_result($result);
        return false;
    }
    /* =============== Find Pass ============== */
    function find_user_pass($name, $pass) {
        global $db;
        $sql = "SELECT * FROM admins ";
        $sql .= "WHERE username = '".db_escape($db, $name)."' ";
        $sql .= "LIMIT 1";
        $result = mysqli_query($db, $sql);
        confirm_result_set($result);
        $admin = mysqli_fetch_assoc($result);
        if ( !is_null($admin) ) {
            $value = $admin["hashed_password"];
            if (verify_passwd($pass, $value) == true) {
                return true;
            } elseif ( $value == $pass) { // chwilowo, ponieważ posiadam user's bez "hashed" password
                return true;
            }
            return false;
        }
        mysqli_free_result($result);
    }
    /* =============== Insert ============== */
    function insert_user($fN, $lN, $email, $name, $password) {
        global $db;
        global $errors;
        global $goodNews;
        $sql = "INSERT INTO admins (id, first_name, last_name, email, username, hashed_password)
                VALUES ('','".db_escape($db, $fN)."','".db_escape($db, $lN)."','".db_escape($db, $email)."','".db_escape($db, $name)."','".db_escape($db, $password)."');";

        if (mysqli_multi_query($db, $sql)) {
            $goodNews[] = "New records created successfully";
        } else {
            $errors[] = "Error! Incompatible data! ";
        }
    }
    function insert_jobTime($name, $hours, $address, $city) {
        global $db;
        global $errors;
        global $goodNews;
        $sql = "INSERT INTO jobtime (ID, Name, Hours, Address, City)
                VALUES ('','".db_escape($db, $name)."','".db_escape($db, $hours)."','".db_escape($db, $address)."','".db_escape($db, $city)."');";

        if (mysqli_multi_query($db, $sql)) {
            $goodNews[] = "New records created successfully";
        } else {
            $errors[] = "Error! Incompatible data!";
        }
    }
    /* =============== ??? ============== */



/*    function query_string_admins() {
        global $db;
        $sql = "select * from admins";
        $result = $db->query($sql);

        if ($result->num_rows > 0) {
            foreach ($result as $data) {
                echo "<tr class='qTr'><td class = 'qTd'>"; print_r($data["id"]); echo "</td>";
                echo "<td class = 'qTd'>"; print_r($data["first_name"]); echo "</td>";
                echo "<td class = 'qTd'>"; print_r($data["last_name"]); echo "</td>";
                echo "<td class = 'qTd'><div class='pass'>"; print_r($data["email"]); echo "</div></td>";
                echo "<td class = 'qTd'>"; print_r($data["username"]); echo "</td>";
                echo "<td class = 'qTd'><div class='pass'>"; print_r($data["hashed_password"]); echo "</div></td></tr>";
            }
        } else {
            echo "0 results";
        }
    }*/
/*
    function query_string_p_admins() {
        global $db;
        $sql = "select * from admins";
        $result = $db->query($sql);

        $name_tab = array("ID", "fName", "lName", "email", "uName", "Pass" );
        $name_tab2 = array("id", "first_name", "last_name", "email", "username", "hashed_password" );

        for ($i = 0; $i < 6; $i++) {
            echo "<tr class='qTr'><th class = 'qTh'> $name_tab[$i] </th>";
            foreach ($result as $data) {
                if( $name_tab2[$i] == "email" || $name_tab2[$i] == "hashed_password") {
                    echo "<td class = 'qTd'><div class='pass'>"; print_r($data[$name_tab2[$i]]); echo "</div></td>";
                } else {
                    echo "<td class = 'qTd'>"; print_r($data[$name_tab2[$i]]); echo "</td>";
                }
            }
            echo "</tr>";
        }
    }*/


/*



CREATE TABLE `test_cleoni`.`admins` ( `id` INT(10) NOT NULL PRIMARY KEY AUTO_INCREMENT, `first_name` VARCHAR(255) NOT NULL , `last_name` VARCHAR(255) NOT NULL ,
 `email` VARCHAR(255) NOT NULL , `username` VARCHAR(255) NOT NULL , `hashed_password` VARCHAR(255) NOT NULL , `filename` VARCHAR(255) NOT NULL , `type` VARCHAR(100) NOT NULL, `size` int(100) NOT NULL)


    INSERT INTO admins (`id`, `first_name`, `last_name`, `email`,`username`, `hashed_password`) VALUES ('', 'admin', 'admin', 'admin@mail.com', 'admin','admin');
    INSERT INTO admins (`id`, `first_name`, `last_name`, `email`,`username`, `hashed_password`) VALUES ('', 'admin2', 'admin2', 'admin2@mail.com', 'admin2','admin2');
    INSERT INTO admins (`id`, `first_name`, `last_name`, `email`,`username`, `hashed_password`) VALUES ('', 'Tomek', 'Napierala', 'tnap@mail.com', 'admin3','admin3');
    INSERT INTO admins (`id`, `first_name`, `last_name`, `email`,`username`, `hashed_password`) VALUES ('', 'test', 'test', 'test@mail.com', 'test','test');
    INSERT INTO admins (`id`, `first_name`, `last_name`, `email`,`username`, `hashed_password`) VALUES ('', 'test1', 'test1', 'test@mail.com', 'test1','test1');
        SELECT * FROM `admins`;

    INSERT INTO admins (`id`, `first_name`, `last_name`, `email`,`username`, `hashed_password`, `filename`, `type`, `size`) VALUES ('', 'admin', 'admin', 'admin@mail.com', 'admin','admin','','','');
    INSERT INTO admins (`id`, `first_name`, `last_name`, `email`,`username`, `hashed_password`, `filename`, `type`, `size`) VALUES ('', 'admin2', 'admin2', 'admin2@mail.com', 'admin2','admin2','','','');
    INSERT INTO admins (`id`, `first_name`, `last_name`, `email`,`username`, `hashed_password`, `filename`, `type`, `size`) VALUES ('', 'Tomek', 'Napierala', 'tnap@mail.com', 'admin3','admin3','','','');
    INSERT INTO admins (`id`, `first_name`, `last_name`, `email`,`username`, `hashed_password`, `filename`, `type`, `size`) VALUES ('', 'test', 'test', 'test@mail.com', 'test','test','','','');
    INSERT INTO admins (`id`, `first_name`, `last_name`, `email`,`username`, `hashed_password`, `filename`, `type`, `size`) VALUES ('', 'test1', 'test1', 'test@mail.com', 'test1','test1','','','');

    
CREATE TABLE `test_cleoni`.`jobTime` ( `ID` INT(10) AUTO_INCREMENT PRIMARY KEY , `Name` VARCHAR(255) NOT NULL , `Hours` VARCHAR(255) NOT NULL , `Address` VARCHAR(255) NOT NULL , `City` VARCHAR(255) NOT NULL);

    INSERT INTO jobtime (ID, Name, Hours, Address,City) VALUES ('', 'Tomek', 10.2, 'Lechicka 3', 'Poznan');
    INSERT INTO jobtime (ID, Name, Hours, Address,City) VALUES ('', 'Wiktor', 8.55, 'Drużbickiego 2', 'Poznan');
    INSERT INTO jobtime (ID, Name, Hours, Address,City) VALUES ('', 'Jan', 10.2, 'Vobornik 3', 'Poznan');
    INSERT INTO jobtime (ID, Name, Hours, Address,City) VALUES ('', 'Karol', 8.55, 'SuchyLas 2', 'Las');
        SELECT * FROM `jobtime`;


https://www.olx.pl/d/oferta/audi-a4-b8-android-radio-dotykowe-nawigacja-aplikacje-CID5-IDNn23S.html?isPreviewActive=0&sliderIndex=7
*/
