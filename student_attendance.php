<?php
include('partials/_top.php');

if (!isset($_SESSION['adminLoggedIn']) || $_SESSION['adminLoggedIn'] != true) {
    header("location: login.php");
    exit;
}

$week = date("D");
// $today = date("Md");
$today = 'Oct23';
$successInsert = false;
$alreadyExists = false;
$tablelist = ['hii'];

if (isset($_GET['type']) && $_GET['type'] != '') {
    $type = get_safe_value_pta($conn, $_GET['type']);
    if ($type == 'add_date_col') {
        $dateValue = get_safe_value_pta($conn, $_GET["date"]);
        $tablelist = get_safe_array_values_pta($conn, $_GET['tablename']);
        $loopExecuted = false;
        for ($i = 1; $i <= count($tablelist); $i++) { 
            $subject = [];
            $loopExecuted = false;
            $sqlsub = "SELECT `$tablelist[$i]`.* FROM `$tablelist[$i]` WHERE `week` = '$week'";
            // echo $sqlsub;
            $ressub = mysqli_query($conn, $sqlsub);
            while ($rowsub = mysqli_fetch_assoc($ressub)) {
                if ($loopExecuted) {
                    break;
                }
                if ($rowsub['9.00-9.55'] != 'Free'&& $rowsub['9.00-9.55'] != 'Same') {
                    $subject[] = $rowsub['9.00-9.55'];
                }
                if ($rowsub['10.00-10.55'] != 'Free'&& $rowsub['10.00-10.55'] != 'Same') {
                    $subject[] = $rowsub['10.00-10.55'];
                }
                if ($rowsub['11.00-11.55'] != 'Free'&& $rowsub['11.00-11.55'] != 'Same') {
                    $subject[] = $rowsub['11.00-11.55'];
                }
                if ($rowsub['12.00-12.55'] != 'Free'&& $rowsub['12.00-12.55'] != 'Same') {
                    $subject[] = $rowsub['12.00-12.55'];
                }
                if ($rowsub['14.00-14.55'] != 'Free'&& $rowsub['14.00-14.55'] != 'Same') {
                    $subject[] = $rowsub['14.00-14.55'];
                }
                if ($rowsub['15.00-15.55'] != 'Free'&& $rowsub['15.00-15.55'] != 'Same') {
                    $subject[] = $rowsub['15.00-15.55'];
                }
                if ($rowsub['16.00-16.55'] != 'Free'&& $rowsub['16.00-16.55'] != 'Same') {
                    $subject[] = $rowsub['16.00-16.55'];
                }
                $loopExecuted = true;
            }
            for ($j = 0; $j < count($subject); $j++) {
                $sqlDate = "ALTER TABLE `$subject[$j]` ADD `{$dateValue}` VARCHAR(10) NOT NULL DEFAULT 'Empty'";
                echo'<br>'. $sqlDate;
                // $resDate = mysqli_query($conn, $sqlDate);
            }
            // if ($resDate) {
            //     $successInsert = true;
            // }
        }
    }    
}



if ($successInsert) {
    echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
    <strong>Date column was sucesssfully added.</strong>.
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
  </div>';
}
?>

<div class="container table-responsive w-50 mt-3 mb-3">
    <table class="table table-striped table-hover table-bordered">
        <thead class="table-dark">
            <tr>
                <th scope="col">SI. No</th>
                <th scope="col">Semester</th>
                <th scope="col">Section</th>
                <th scope="col">Action</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $sqlA = "SELECT DISTINCT `bcasem`.`status`,`bcasection`.`status`, `bcasection`.`sem`, `bcasection`.`section` FROM `bcasection`,`bcasem` where `bcasection`.`sem` = `bcasem`.`sem` AND `bcasem`.`status`='1' AND `bcasection`.`status`='1' order by `sem`, `section`";
            $resA = mysqli_query($conn, $sqlA);
            $i = 0;
            while ($row = mysqli_fetch_assoc($resA)) {
                $i = $i + 1;
                echo '<tr>
                <td scope="row">' . $i . '</td>
                <td scope="row">' . $row['sem'] . '</td>
                <td scope="row">' . $row['section'] . '</td>
                <td scope="row">
                    <a class="btn btn-primary mr-2" href="student_subject.php?type=view_sub&sem=' . $row['sem'] . '&sec=' . $row['section'] . '">View Subject</a>' . '    ';
                if ($row['sem'] == 1) {
                    $tableName = "firstBca";
                } else if ($row['sem'] == 3) {
                    $tableName = "thirdBca";
                } else if ($row['sem'] == 5) {
                    $tableName = "fifthBca";
                } else if ($row['sem'] == 2) {
                    $tableName = "secondBca";
                } else if ($row['sem'] == 4) {
                    $tableName = "fourthBca";
                } else if ($row['sem'] == 6) {
                    $tableName = "sixthBca";
                }
                $sec = $row['section'];
                $tableName = $tableName . $sec;
                $tablelist[] = $tableName;
                $sqlfind = "SHOW TABLES LIKE '$tableName'";
                $resfind =  mysqli_query($conn, $sqlfind);
                if ($resfind) {
                    if (mysqli_num_rows($resfind) > 0) {
                        echo '<a class="btn btn-primary" href="creating_timetable.php?sem=' . $row['sem'] . '&sec=' . $row['section'] . '">View TimeTable</a>';
                    } else {
                        echo '<a class="btn btn-primary" href="creating_timetable.php?type=create_timetable&sem=' . $row['sem'] . '&sec=' . $row['section'] . '">Create TimeTable</a>';
                    }
                }
                echo ' <a class="btn btn-primary" href="assign_subject_teacher.php?type=assign&sem=' . $row['sem'] . '&sec=' . $row['section'] . '">Assign Subject</a></td>
                </tr>';
            }
            ?>
            <tr>
                <td colspan="4">
                    <?php
                    $queryString = http_build_query(array('tablename' => $tablelist));
                    $sqlSub = "SELECT * FROM `bcasub`";
                    $resSub = mysqli_query($conn, $sqlSub);
                    while ($row = mysqli_fetch_assoc($resSub)) {
                        $sqlDate = "SELECT COLUMN_NAME FROM INFORMATION_SCHEMA.COLUMNS WHERE TABLE_NAME =  '{$row['subjectName']}' AND COLUMN_NAME = '$today'";
                        $resDate = mysqli_query($conn, $sqlDate);
                        if (mysqli_num_rows($resDate) > 0) {
                            $alreadyExists = true;
                        }
                    }
                    if ($alreadyExists) {
                    ?>
                        <a class="btn btn-primary disabled" aria-disabled="true">Add Date</a>
                    <?php } else { ?>
                        <a class="btn btn-primary" href="student_attendance.php?type=add_date_col&date=<?php echo $today; ?>&table=<?php echo $queryString; ?>">Add Date</a>
                    <?php } ?>
                </td>
            </tr>
        </tbody>
    </table>
</div>

<?php include("partials/_footer.php"); ?>