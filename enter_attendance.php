<?php
require('partials/_top.php');

if (!isset($_SESSION['adminLoggedIn']) || $_SESSION['adminLoggedIn'] != true) {
    if (!isset($_SESSION['teacherLoggedIn']) || $_SESSION['teacherLoggedIn'] != true) { ?>
        <script>
            window.location.href = "login.php";
        </script>
    <?php
    }
}

$teacherID = $_SESSION['teacherID'];
// $today = date("Md");
$today = 'Oct25';

if (isset($_GET['sub']) && $_GET['sub'] != '') {
    $sem = get_safe_value_pta($conn, $_GET["sem"]);
    $sec = get_safe_value_pta($conn, $_GET["sec"]);
    $subject = get_safe_value_pta($conn, $_GET["sub"]);
}

if (isset($_POST['enterAttendance'])) {
    $subject = get_safe_value_pta($conn, $_GET["subject"]);
    $sem = get_safe_value_pta($conn, $_GET["sem"]);
    $sec = get_safe_value_pta($conn, $_GET["sec"]);
    $studentID = get_safe_array_values_pta($conn, $_POST["studentID"]);
    $attendance = get_safe_array_values_pta($conn, $_POST["attendance"]);

    for ($i = 0; $i < count($studentID); $i++) {
        if ($attendance[$i] == 1) {
            $value = 'Present';
        } else {
            $value = 'Absent';
        }
        $sqlup = "UPDATE `$subject` SET `$today`='$value' WHERE `studentID`='$studentID[$i]'";
        $resup = mysqli_query($conn, $sqlup);
        if ($resup) {
            $insertSuccess = true;
        } else {
            $insertSuccess = false;
        }
    }
    if ($insertSuccess) {
    ?><br>
        <script>
            window.location.href = "view_attendance.php?type=view_attendace&sem=<?php echo $sem; ?>&sec=<?php echo $sec; ?>&sub=<?php echo $subject; ?>";
        </script>
<?php
    } else {
        $showError = true;
    }
}

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
                                <form class="row g-3 m-1" id="enterAttendance" action="enter_attendance.php?subject=<?php echo $subject; ?>&sem=<?php echo $sem; ?>&sec=<?php echo $sec; ?>" method="post">
                                    <table class="table table-striped table-hover table-bordered">
                                        <thead class="table-dark">
                                            <tr>
                                                <th scope="col">SI. No</th>
                                                <th scope="col">Register No</th>
                                                <th scope="col">Name</th>
                                                <th scope="col">Semester</th>
                                                <th scope="col">Section</th>
                                                <th scope="col"><?php echo $today ?></th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            $sqltt = "SELECT * FROM `$subject` WHERE `sem`='$sem' AND `section`='$sec'";
                                            $restt = mysqli_query($conn, $sqltt);
                                            $i = 0;
                                            while ($row = mysqli_fetch_assoc($restt)) {
                                                $i = $i + 1;
                                                echo '<tr>
                                                    <td scope="row">' . $i . '</td>
                                                    <td scope="row"><input type="text" id="studentID" class="form-control" name="studentID[]" value="' . $row['studentID'] . '"></td>
                                                    <td scope="row">' . $row['studentName'] . '</td>
                                                    <td scope="row">' . $row['sem'] . '</td>
                                                    <td scope="row">' . $row['section'] . '</td>
                                                    <td scope="row">
                                                        <input type="text" id="sec" class="form-control" maxlength="2" name="attendance[]" value="1"></input>
                                                    </td>
                                                </tr>';
                                            }
                                            ?>
                                        </tbody>
                                    </table>
                                    <div class="col-md-6 left-390">
                                        <input type="submit" class="btn btn-primary" name="enterAttendance" value="Submit">
                                    </div>
                                </form>
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