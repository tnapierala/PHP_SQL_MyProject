
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
    <title> Logged </title>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <link href="style.css" rel="stylesheet" type="text/css">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <script src="https://kit.fontawesome.com/a076d05399.js" crossorigin="anonymous"></script>
</head>
    <body>
        <div class="flexRow">
            <div class="ul">
                <div class="li"><a href="test_Logged.php">Home</a></div>
                <div class="li"><a class="active1" href="test_DataBase.php">DataBase</a></div>
                <div class="li"><a href="test_Profile.php">Profile</a></div>
                <div class="li right"><a href="SQL/logout.php">Logout</a></div>
            </div>
        </div>
        <div class="flexRow c">
            <h2 id="LoggedH2">Logged In</h2>
            <div class="flexRow2">
                <h2 id="LoggedH2-nu"><?php echo $f_name;?></h2>
                <h2 id="LoggedH2-nu"><?php echo $u_name;?></h2>
            </div>
            <h3 id="LoggedH3">Table jobTime</h3>
        </div>
        <div class="flexRow fst">
            <pre class="tablePre">
                <table class="qT">
                    <tr class="qTr">
                        <th class="qTh">ID</th>
                        <th class="qTh">Name</th>
                        <th class="qTh">Hours</th>
                        <th class="qTh">Address</th>
                        <th class="qTh">City</th>
                        <th class="qTh btnAdd"> <a href="SQL/AddJobTime.php"><i class="far fa-plus-square i-btnAdd"></i></a> </th>
                    </tr>
                    <?php
                    //query_string_admins();
                    $jobTime_set = find_all_jobTime();
                    while ($jobTime = mysqli_fetch_assoc($jobTime_set)) { ?>
                        <tr class="qTr">
                        <td class = "qTd"><?php echo h($jobTime["ID"]) ?></td>
                        <td class = "qTd"><?php echo h($jobTime["Name"]) ?></td>
                        <td class = "qTd"><?php echo h($jobTime["Hours"]) ?></td>
                        <td class = "qTd"><div class="pass"><?php echo h($jobTime["Address"]) ?></div></td>
                        <td class = "qTd"><?php echo h($jobTime["City"]) ?></td>
                        <td class = "qTd btnDE">
                            <a class='trashBtn' href="<?php echo 'SQL/delete_jobTime.php?id='.h(u($jobTime['ID'])); ?>"> <i class='far fa-trash-alt'></i> </a>
                            <a class='editBtn' href="<?php echo 'SQL/edit_jobTime.php?id='.h(u($jobTime['ID'])); ?>"> <i class='far fa-edit'></i> </a>
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
                    $name_tab1 = array("ID", "Name", "Hours", "Address", "City");
                    for ($i = 0; $i < count($name_tab1); $i++) {
                        echo "<th class = 'qTh'> $name_tab1[$i] </th>";}
                        echo "<th class='qTh btnAdd'><a href='SQL/AddJobTime.php'><i class='far fa-plus-square i-btnAdd'></i></a></th>";
                        $jobTime_set2 = find_all_jobTime();
                        while ($jobTime2 = mysqli_fetch_assoc($jobTime_set2)) {
                    ?>
                            <td class = "qTd"><?php echo h($jobTime2["ID"]) ?></td>
                            <td class = "qTd"><?php echo h($jobTime2["Name"]) ?></td>
                            <td class = "qTd"><?php echo h($jobTime2["Hours"]) ?></td>
                            <td class = "qTd"><div class="pass"><?php echo h($jobTime2["Address"]) ?></div></td>
                            <td class = "qTd"><?php echo h($jobTime2["City"]) ?></td>
                            <td class = "qTd btnDE">
                                <a class='trashBtn' href="<?php echo 'SQL/delete.php?id='.h(u($jobTime2['ID'])); ?>"> <i class='far fa-trash-alt'></i> </a>
                                <a class='editBtn' href="<?php echo 'SQL/edit_jobTime.php?id='.h(u($jobTime2['ID'])); ?>"> <i class='far fa-edit'></i> </a>
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