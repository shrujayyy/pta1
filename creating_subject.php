<?php
require('partials/_top.php');

if (!isset($_SESSION['adminLoggedIn']) || $_SESSION['adminLoggedIn'] != true) {
    header("location: login.php");
    exit;
}

$odd = false;
$even = false;
$tableInserted = false;
$tableError = false;
if (isset($_GET['type']) && $_GET['type'] != '') {
    $type = get_safe_value_pta($conn, $_GET['type']);
    if ($type == 'insertSuccess') {
        $tableInserted = true;
    }
    if ($type == 'insertError') {
        $tableError = true;
    }
    if ($type == 'delete') {
        $operation = get_safe_value_pta($conn, $_GET['operation']);
        if ($operation == 'delete_sub') {
            $subjectName = get_safe_value_pta($conn, $_GET['sub']);
            $sqldel = "DELETE FROM `bcasub` WHERE `subjectName`='$subjectName'";
            $resdel = mysqli_query($conn, $sqldel);
        }
    }
}

$update = false;
$error = false;
if (isset($_POST['updateSubject'])) {
    $updateSemDisplay = get_safe_value_pta($conn, $_POST["updateSemDisplay"]);
    $subjectName = get_safe_value_pta($conn, $_POST["subjectName"]);
    $sqlup = "UPDATE `bcasub` SET `subjectName`='$subjectName' WHERE `sem`='$updateSemDisplay'";
    $result = mysqli_query($conn, $sqlup);
}

if (isset($_POST['addSubject'])) {
    $sem = get_safe_value_pta($conn, $_POST["sem"]);
    $subjectName = get_safe_value_pta($conn, $_POST["subjectName"]);
    $sql = "INSERT INTO `bcasub`(`subjectName`, `sem`) VALUES ('$subjectName','$sem')";
    $result = mysqli_query($conn, $sql);
}

if ($tableInserted) {
    echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
    <strong>Attendance Table was sucesssfully created!</strong>.
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
  </div>';
}
if ($tableError) {
    echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
    <strong>Attendance Table was not created!</strong>.Please try again
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
  </div>';
}
?>

<div class="modal fade" id="addSubModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Add Subject</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="container mb-3">
                    <form class="row g-3 m-2" id="updateSubject" action="creating_subject.php" method="post">
                        <div class="col-md-2 w-100">
                            <label for="sem" class="form-label">Semester</label>
                            <select id="sem" class="form-select" name="sem">
                                <option selected>Choose...</option>
                                <?php
                                $sqlsem = "SELECT * FROM `bcasem` WHERE `status`='1'";
                                $ressem = mysqli_query($conn, $sqlsem);
                                while ($rowSem = mysqli_fetch_assoc($ressem)) {
                                    echo "<option value=" . $rowSem['sem'] . ">" . $rowSem['sem'] . "</option>";
                                }
                                ?>
                            </select>
                        </div>
                        <div class="col-md-2 w-100">
                            <label for="subjectName" class="form-label">Subject</label>
                            <input type="text" maxlength="30" class="form-control" id="subjectName" name="subjectName">
                        </div>
                        <div id="inputContainer" class="col-md-2 w-100">

                        </div>
                        <div class="col-md-12">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <input type="submit" class="btn btn-primary" name="addSubject" value="add">
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="updateSubModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-sm">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Subject Update</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="container mb-3">
                    <form class="row g-3 m-2" id="updateSubject" action="creating_subject.php" method="post">
                        <div class="col-md-2 w-100">
                            <label for="updateSemDisplay" class="form-label">Semester</label>
                            <input type="text" maxlength="3" class="form-control" id="updateSemDisplay" name="updateSemDisplay" disabled>
                        </div>
                        <div class="col-md-2 w-100">
                            <label for="updateSubjectName" class="form-label">Subject</label>
                            <input type="text" maxlength="30" class="form-control" id="updateSubjectName" name="updateSubjectName">
                        </div>
                        <div class="col-md-12">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <input type="submit" class="btn btn-primary" name="updateSubject" value="Update">
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="container table-responsive w-50 mt-3 mb-3">
    <table class="table table-striped table-hover table-bordered">
        <thead class="table-dark">
            <tr>
                <th scope="col">SI. No</th>
                <th scope="col">Semester</th>
                <th scope="col">Subject</th>
                <th scope="col">Action</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $sqlSub = "SELECT * FROM `bcasub`";
            $resSub = mysqli_query($conn, $sqlSub);
            $i = 0;
            while ($rowSub = mysqli_fetch_assoc($resSub)) {
                $i = $i + 1;
                echo '<tr>
                <td scope="row">' . $i . '</td>
                <td scope="row">' . $rowSub['sem'] . '</td>
                <td scope="row">' . $rowSub['subjectName'] . '</td>
                <td scope="row">
                    <button type="button" class="update_sub btn btn-primary" id="">Update</button> ';
                $sqlCheck = "SELECT table_name FROM information_schema.tables WHERE table_schema = '$database' AND table_name = '{$rowSub['subjectName']}'";
                $resCheck = mysqli_query($conn, $sqlCheck);
                if ($resCheck) {
                    if (mysqli_num_rows($resCheck) > 0) {
                        $alreadyExists = true;
                    }
                }
                if ($alreadyExists) {
                    echo '<a class="btn btn-primary disabled" aria-disabled="true">Create Attendance Table</a> ';
                } else {
                    echo '<a class="btn btn-primary" href="creating_attendance_table.php?type=create_table&sub=' . $rowSub['subjectName'] . '&sem=' . $rowSub['sem'] . '">Create Attendance Table</a> ';
                }
                echo '<a class="btn btn-danger" href="?type=delete&operation=delete_sub&sub=' . $rowSub['subjectName'] . '">Delete</a>
                </td>
            </tr>';
            }
            ?>
            <tr>
                <td colspan="4">
                    <div class="center">
                        <button type="button" class="add_sub btn btn-primary">Add Subject</button>
                    </div>
                </td>
            </tr>

        </tbody>
    </table>
</div>

<?php
require('partials/_footer.php');
?>