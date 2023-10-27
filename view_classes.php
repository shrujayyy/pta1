<?php
require('partials/_top.php');

if (!isset($_SESSION['teacherLoggedIn']) || $_SESSION['teacherLoggedIn'] != true) { ?>
    <script>
        window.location.href = "login.php";
    </script>
<?php
}

if (isset($_GET['type']) && $_GET['type'] != '') {
    // $type = get_safe_value_pta($conn, $_GET['type']);
    if ($type == 'view_details') {
    }
}

$teacherID = $_SESSION['teacherID'];
$today = date("Md");
$week  = date("D");
$columnExists = false;
$sem = '';
// echo $week;

// echo "SELECT `firstbcaa`.`week`, `assigned_teacher`.`teacherID`, `assigned_teacher`.`section`, `assigned_teacher`.`subjectName` FROM `firstbcaa`, `assigned_teacher` WHERE `firstbcaa`.`week` = 'Mon' AND `assigned_teacher`.`teacherID` = 'TACA20301' AND `assigned_teacher`.`section` = 'A'";
?>



<div class="container m-auto p-0">
    <div class="content">
        <div class="animated fadeIn">
            <div class="row m-0">
                <div class="col-lg-12 p-0">
                    <div class="container mt-3 mb-3">

                        <div class="card shadow m-auto">
                            <div class="card-header">
                                <h3><strong>View Student Details</strong><small></small></h3>
                            </div>

                            <div class="container table-responsive w-75 m-auto mt-2 mb-3">
                                <table class="table table-striped table-hover table-bordered">
                                    <thead class="table-dark">
                                        <tr>
                                            <th scope="col">SI. No</th>
                                            <th scope="col">Semester</th>
                                            <th scope="col">Section</th>
                                            <th scope="col">Subject</th>
                                            <th scope="col">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $sqlA = "SELECT * FROM `assigned_teacher` WHERE `teacherID`='$teacherID'";

                                        $resA = mysqli_query($conn, $sqlA);
                                        $i = 0;
                                        while ($row = mysqli_fetch_assoc($resA)) {
                                            $i = $i + 1;
                                            echo '<tr>
                                                    <td scope="row">' . $i . '</td>
                                                    <td scope="row">' . $row['sem'] . '</td>
                                                    <td scope="row">' . $row['section'] . '</td>
                                                    <td scope="row">' . $row['subjectName'] . '</td>
                                                    ';
                                            $subjectName = $row['subjectName'];
                                            $sem = $row['sem'];
                                            $section = $row['section'];
                                            $sqlCheck = "DESCRIBE `$subjectName`";
                                            $resCheck = mysqli_query($conn, $sqlCheck);

                                            while ($row = mysqli_fetch_assoc($resCheck)) {
                                                // echo pr($resCheck);
                                                if ($row['Field'] === $today) {
                                                    $columnExists = true;
                                                    break;
                                                } else {
                                                    $columnExists = false;
                                                }
                                            }
                                            if ($sem == 1) {
                                                $tableName = "firstBca";
                                            } else if ($sem == 3) {
                                                $tableName = "thirdBca";
                                            } else if ($sem == 5) {
                                                $tableName = "fifthBca";
                                            } else if ($sem == 2) {
                                                $tableName = "secondBca";
                                            } else if ($sem == 4) {
                                                $tableName = "fourthBca";
                                            } else if ($sem == 6) {
                                                $tableName = "sixthBca";
                                            }
                                            $tableName = $tableName . $section;
                                            $sqlfind = "SHOW TABLES LIKE '$tableName'";
                                            $resfind =  mysqli_query($conn, $sqlfind);
                                            if ($resfind) {
                                                if (mysqli_num_rows($resfind) > 0) {
                                                    $sqlsub = "SELECT `$tableName`.* FROM `$tableName` WHERE `week` = '$week'";
                                                    $ressub = mysqli_query($conn, $sqlsub);
                                                    if ($ressub) {
                                                        $classExists = true;
                                                    } else {
                                                        $classExists = false;
                                                    }
                                                } else {
                                                    $classExists = false;
                                                }
                                            }
                                            if ($columnExists && $classExists) {
                                                echo '<td scope="row">
                                                        <a class="btn btn-primary mr-2" href="enter_attendance.php?sub=' . $subjectName . '&sem=' . $sem . '&sec=' . $section . '">Enter Attendance</a> ';
                                            } else {
                                                echo '<td>
                                                <a class="btn btn-primary mr-2 disabled" aria-disabled="true">Enter Attendance</a> ';
                                            }
                                            echo '<a class="btn btn-primary" href="view_attendance.php?type=view_attend&sem=' . $sem . '&sec=' . $section . '&sub='.$subjectName.'">View Attendance</a>
                                            </td>
                                            </tr>';
                                        }
                                        ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php
require('partials/_footer.php');
?>