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

if (isset($_GET['type']) && $_GET['type'] != '') {
    $type = get_safe_value_pta($conn, $_GET['type']);
    if ($type == 'enter_marks') {
        $operation = get_safe_value_pta($conn, $_GET['operation']);
        if ($operation == 'firstInternals') {
            $sem = get_safe_value_pta($conn, $_GET["sem"]);
            $sec = get_safe_value_pta($conn, $_GET["sec"]);
            $subject = get_safe_value_pta($conn, $_GET["subject"]);
            $totalMarks = 25;
        }
    }
    if ($type == 'enter_marks') {
        $operation = get_safe_value_pta($conn, $_GET['operation']);
        if ($operation == 'secondInternals') {
            $sem = get_safe_value_pta($conn, $_GET["sem"]);
            $sec = get_safe_value_pta($conn, $_GET["sec"]);
            $subject = get_safe_value_pta($conn, $_GET["subject"]);
            $totalMarks = 50;
        }
    }
}


if (isset($_POST['firstInternals'])) {
    $subject = get_safe_value_pta($conn, $_GET["subject"]);

    $error = false;

    $id = $_POST['id'];
    $studentID = $_POST["studentID"];
    $semArr = $_POST["sem"];
    $secArr = $_POST["sec"];
    $obtainedMarksArr = $_POST["obtainedMarks"];

    for ($i = 0; $i < count($id); $i++) {
        $sqlInsert = "INSERT INTO `firstinternalmarks`(`studentID`, `subject`, `sem`, `sec`, `marks`) VALUES ('$studentID[$i]','$subject','$semArr[$i]','$secArr[$i]','$obtainedMarksArr[$i]')";
        $resInsert = mysqli_query($conn, $sqlInsert);
        if ($resInsert) {
            $insertSuccess = true;
        } else {
            $insertSuccess = false;
        }
    }
    if ($insertSuccess) {
    ?><br>
        <script>
            window.location.href = "view_internals_marks.php?operation=firstInternals&sem=<?php echo $semArr[0]; ?>&sec=<?php echo $secArr[0]; ?>&subject=<?php echo $subject; ?>";
        </script>
    <?php
    } else {
        $showError = true;
    }
}

if (isset($_POST['secondInternals'])) {
    $subject = get_safe_value_pta($conn, $_GET["subject"]);

    $error = false;

    $id = $_POST['id'];
    $studentID = $_POST["studentID"];
    $semArr = $_POST["sem"];
    $secArr = $_POST["sec"];
    $obtainedMarksArr = $_POST["obtainedMarks"];

    for ($i = 0; $i < count($id); $i++) {
        $sqlInsert = "INSERT INTO `secondinternalmarks`(`studentID`, `subject`, `sem`, `sec`, `marks`) VALUES ('$studentID[$i]','$subject','$semArr[$i]','$secArr[$i]','$obtainedMarksArr[$i]')";
        $resInsert = mysqli_query($conn, $sqlInsert);
        if ($resInsert) {
            $insertSuccess = true;
        } else {
            $insertSuccess = false;
        }
    }
    if ($insertSuccess) {
    ?><br>
        <script>
            window.location.href = "view_internals_marks.php?operation=secondInternals&sem=<?php echo $semArr[0]; ?>&sec=<?php echo $secArr[0]; ?>&subject=<?php echo $subject; ?>";
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

                            <div class="container table-responsive m-auto mt-2 mb-3">
                                <form class="row g-3 m-1" id="<?php echo $operation; ?>" action="enter_internals_marks.php?subject=<?php echo $subject; ?>" method="post">
                                    <table class="table table-striped table-hover table-bordered">
                                        <thead class="table-dark">
                                            <tr>
                                                <th scope="col">SI. No</th>
                                                <th scope="col">Register No</th>
                                                <th scope="col">Name</th>
                                                <th scope="col">Semester</th>
                                                <th scope="col">Section</th>
                                                <th scope="col">Obtained Marks</th>
                                                <th scope="col">Total Marks</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            $sqltt = "SELECT * FROM `studentdetails` WHERE `sem`='$sem' AND `section`='$sec'";
                                            $restt = mysqli_query($conn, $sqltt);
                                            $i = 0;
                                            while ($row = mysqli_fetch_assoc($restt)) {
                                                $i = $i + 1;
                                                echo '<tr>
                                                    <td scope="row"><input type="text" id="sec" class="form-control disabled" name="id[]" value="' . $i . '"></td>
                                                    <td scope="row"><input type="text" id="sec" class="form-control disabled" name="studentID[]" value="' . $row['registerNo'] . '"></td>
                                                    <td scope="row"><input type="text" id="sec" class="form-control disabled" name="name[]" value="' . $row['name'] . '"></td>
                                                    <td scope="row"><input type="text" id="sec" class="form-control disabled" name="sem[]" value="' . $row['sem'] . '"></td>
                                                    <td scope="row"><input type="text" id="sec" class="form-control disabled" name="sec[]" value="' . $row['section'] . '"></td>
                                                    <td scope="row">
                                                        <input type="text" id="sec" class="form-control disabled" maxlength="2" name="obtainedMarks[]"></input>
                                                    </td>
                                                    <td scope="row"><input type="text" id="sec" class="form-control disabled" name="totalMarks[]" value="' . $totalMarks . '"></td>
                                                </tr>';
                                            }
                                            ?>
                                        </tbody>
                                    </table>
                                    <div class="col-md-6 left-390">
                                        <input type="submit" class="btn btn-primary" name="<?php echo $operation; ?>" value="Submit">
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