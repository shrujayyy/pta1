<?php
require('partials/connection.inc.php');
require('partials/function.inc.php');

if (!isset($_SESSION['adminLoggedIn']) || $_SESSION['adminLoggedIn'] != true) {
    header("location: login.php");
    exit;
}

if (isset($_GET['type']) && $_GET['type'] != '') {
    $type = get_safe_value_pta($conn, $_GET['type']);
    if ($type == 'create_table') {
        $subject = get_safe_value_pta($conn, $_GET['sub']);
        $sqlSub = "SELECT * FROM `bcasub` WHERE `subjectName`='$subject'";
        $resSub = mysqli_query($conn, $sqlSub);
        if (mysqli_num_rows($resSub) > 0) {
            $sem = get_safe_value_pta($conn, $_GET['sem']);
            $sqlTable = "CREATE TABLE `$subject` (`id` INT NOT NULL AUTO_INCREMENT , `studentID` VARCHAR(7) NOT NULL , `studentName` VARCHAR(255) NOT NULL , `sem` INT(1) NOT NULL , `section` VARCHAR(3) NOT NULL , PRIMARY KEY (`id`), UNIQUE (`studentID`))";
            $resTable = mysqli_query($conn, $sqlTable);
            // $resTable = true;
            if ($resTable) {
                $sqlStudent = "SELECT `registerNo`, `name`, `sem`, `section` FROM `studentdetails` WHERE `sem`='$sem'";
                $resStudent = mysqli_query($conn, $sqlStudent);
                if (mysqli_num_rows($resStudent) > 0) {
                    while ($rowStudent = mysqli_fetch_assoc($resStudent)) {
                        $sqlInsert = "INSERT INTO `$subject`(`studentID`, `studentName`, `sem`, `section`) VALUES ('" . $rowStudent['registerNo'] . "','" . $rowStudent['name'] . "','" . $rowStudent['sem'] . "','" . $rowStudent['section'] . "')";
                        $resInsert = mysqli_query($conn, $sqlInsert);
                        // $resInsert = true;
                        if ($resInsert) { ?>
                            <script>
                                window.location.href = "creating_subject.php?type=insertSuccess";
                            </script>
                        <?php } else { ?>
                            <script>
                                window.location.href = "creating_subject.php?type=insertError";
                            </script>
                    <?php }
                    }
                } else { ?>
                    <script>
                        window.location.href = "creating_subject.php?type=insertError";
                    </script>
            <?php }
            } ?>
            <script>
                window.location.href = "creating_subject.php?type=insertError";
            </script>
<?php
        }
    }
}
?>