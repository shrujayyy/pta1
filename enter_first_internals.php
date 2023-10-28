<?php
require('partials/top.inc.php');

if (!isset($_SESSION['adminLoggedIn']) || $_SESSION['adminLoggedIn'] != true) {
    if (!isset($_SESSION['teacherLoggedIn']) || $_SESSION['teacherLoggedIn'] != true) { ?>
        <script>
            window.location.href = "login.php";
        </script>
<?php
    }
}

$teacherID = $_SESSION['teacherID'];

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

                            <div class="container table-responsive w-50 m-auto mt-2 mb-3">
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
                                        $sqlA = "SELECT DISTINCT `bcasem`.`status`,`bcasection`.`status`, `bcasection`.`sem`, `bcasection`.`section`, `assigned_teacher`.`sem`, `assigned_teacher`.`section`, `assigned_teacher`.`subjectName` FROM `bcasection`,`bcasem`,`assigned_teacher` WHERE `assigned_teacher`.`teacherID`='$teacherID' AND `bcasection`.`sem`=`assigned_teacher`.`sem` AND `bcasection`.`section`=`assigned_teacher`.`section` AND `bcasection`.`sem` = `bcasem`.`sem` AND `bcasem`.`status`='1' AND `bcasection`.`status`='1'";

                                        // echo "SELECT DISTINCT `bcasem`.`status`,`bcasection`.`status`, `bcasection`.`sem`, `bcasection`.`section`, `assigned_teacher`.`sem`, `assigned_teacher`.`section` FROM `bcasection`,`bcasem`,`assigned_teacher` WHERE `assigned_teacher`.`teacherID`='$teacherID' AND `bcasection`.`sem`=`assigned_teacher`.`sem` AND `bcasection`.`section`=`assigned_teacher`.`section` AND `bcasection`.`sem` = `bcasem`.`sem` AND `bcasem`.`status`='1' AND `bcasection`.`status`='1' order by `sem`, `section`";
                                        $resA = mysqli_query($conn, $sqlA);
                                        $i = 0;
                                        while ($row = mysqli_fetch_assoc($resA)) {
                                            $i = $i + 1;
                                            echo '<tr>
                                                    <td scope="row">' . $i . '</td>
                                                    <td scope="row">' . $row['sem'] . '</td>
                                                    <td scope="row">' . $row['section'] . '</td>
                                                    <td scope="row">' . $row['subjectName'] . '</td>
                                                    <td scope="row">';
                                            $sqltt = "SELECT `studentdetails`.`registerNo`, `studentdetails`.`name`, `studentdetails`.`sem`, `studentdetails`.`section`, `firstinternalmarks`.`marks`, `firstinternalmarks`.`studentID` FROM `studentdetails`, `firstinternalmarks` WHERE `firstinternalmarks`.`studentID` = `studentdetails`.`registerNo` AND `studentdetails`.`sem`='{$row['sem']}' AND `studentdetails`.`section`='{$row['section']}' AND `firstinternalmarks`.`subject`='{$row['subjectName']}'";
                                            $restt = mysqli_query($conn, $sqltt);
                                            if ($restt) {
                                                if (mysqli_num_rows($restt) > 0) {
                                                    echo '<a class="btn btn-primary mr-2" href="view_internals_marks.php?operation=firstInternals&sem=' . $row['sem'] . '&sec=' . $row['section'] . '&subject=' . $row['subjectName'] . '">View Marks</a>';
                                                } else {
                                                    echo '<a class="btn btn-primary mr-2" href="enter_internals_marks.php?type=enter_marks&operation=firstInternals&sem=' . $row['sem'] . '&sec=' . $row['section'] . '&subject=' . $row['subjectName'] . '">Enter Marks</a>';
                                                }
                                            }
                                            echo '</td>
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
<script>
    <?php
    if (isset($_GET)) {
    ?>
        get_bca_sec('<?php echo $sub_categories_id ?>');
    <?php } ?>
</script>