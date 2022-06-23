<?php
include "SQL/query_functions.php";
include "SQL/functions.php";

session_start();

$errors = [];
$goodNews = [];
$f_name = $_SESSION["first_name"] ?? '';
$u_name = $_SESSION["username"] ?? '';

function h($string) {
    return htmlspecialchars($string);
}
function u($string) {
    return urldecode($string);
}
?>

<!DOCTYPE html>
<html lang="HTML5">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <title> Logged </title>
        <link href="style.css" rel="stylesheet" type="text/css">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <script src="https://kit.fontawesome.com/a076d05399.js" crossorigin="anonymous"></script>
    </head>
    <body>
        <div class="flexRow">
            <div class="ul">
                <div class="li"><a class="active1" href="test_Logged.php">Home</a></div>
                <div class="li"><a href="test_DataBase.php">DataBase</a></div>
                <div class="li"><a href="test_Profile.php">Profile</a></div>
                <div class="li right"><a href="SQL/logout.php">Logout</a></div>
            </div>
        </div>
        <div class="flexRow c">
            <h2 id="LoggedH2">Logged In</h2>
            <div class="flexRow2">
                <h2 id="LoggedH2-nu"><?php echo $f_name; ?></h2>
                <h2 id="LoggedH2-nu"><?php echo $u_name; ?></h2>
            </div>
            <h3 id="LoggedH3">Table Admins</h3>
        </div>
        <div class="flexRow fst">
            <pre class="tablePre">
                <table class="qT">
                    <tr class="qTr">
                        <th class="qTh">ID</th>
                        <th class="qTh">fName</th>
                        <th class="qTh">lName</th>
                        <th class="qTh">e-mail</th>
                        <th class="qTh">uName</th>
                        <th class="qTh">Pass</th>
                        <th class="qTh">&nbsp</th>
                    </tr>
                    <?php
                        //query_string_admins();
                    $admin_set = find_all_admin();
                    while ($admin = mysqli_fetch_assoc($admin_set)) { ?>
                    <tr class="qTr">
                        <td class = "qTd"><?php echo h($admin["id"]) ?></td>
                        <td class = "qTd"><?php echo h($admin["first_name"]) ?></td>
                        <td class = "qTd"><?php echo h($admin["last_name"]) ?></td>
                        <td class = "qTd"><div class="pass"><?php echo h($admin["email"]) ?></div></td>
                        <td class = "qTd"><?php echo h($admin["username"]) ?></td>
                        <td class = "qTd"><div class="pass"><?php echo h($admin["hashed_password"]) ?></div</td>
                        <td class = "qTd btnDE">
                            <a class='trashBtn' href="<?php echo 'SQL/delete_admins.php?id='.h(u($admin['id'])); ?>"><i class='far fa-trash-alt'></i></a>
                            <a class='editBtn' href="<?php echo 'SQL/edit_admins.php?id='.h(u($admin['id'])); ?>"><i class='far fa-edit'></i></a>
                        </td>
                    </tr>
                  <?php } ?>
                </table>
            </pre>
        </div>
        <div class="flexRow sec">
            <pre>
                <table class="qT">
                    <tr class='qTr'>
                    <?php
                    $name_tab1 = array("ID", "first_name", "last_name", "email", "username", "hashed_password" );
                    for ($i = 0; $i < 5; $i++) {
                        echo "<th class = 'qTh'> $name_tab1[$i] </th>";}
                        $admin_set1 = find_all_admin();
                        while ($admin2 = mysqli_fetch_assoc($admin_set1)) {
                    ?>
                        <td class = "qTd"><?php echo h($admin2["id"]) ?></td>
                        <td class = "qTd"><?php echo h($admin2["first_name"]) ?></td>
                        <td class = "qTd"><?php echo h($admin2["last_name"]) ?></td>
                        <td class = "qTd"><div class="pass"><?php echo h($admin2["email"]) ?></div></td>
                        <td class = "qTd"><?php echo h($admin2["username"]) ?></td>
                        <td class = "qTd"><div class="pass"><?php echo h($admin2["hashed_password"]) ?></div</td>
                        <td class = "qTd btnDE">
                            <a class='trashBtn' href="<?php echo 'SQL/delete.php?id='.h(u($admin2['id'])); ?>"><i class='far fa-trash-alt'></i></a>
                            <a class='editBtn' href="<?php echo 'SQL/edit_admins.php?id='.h(u($admin2['id'])); ?>"><i class='far fa-edit'></i></a>
                        </td>
                    <?php } ?>
                    </tr>
               </table>
            </pre>
        </div>
        <div class="errMsg">
            <?php display_errors($errors); ?>
        </div>
        <div class="passInfo">
            <?php display_info($goodNews); ?>
        </div>
    </body>
</html>