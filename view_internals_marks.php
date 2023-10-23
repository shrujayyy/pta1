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

$update = false;
$error = false;
$teacherID = $_SESSION['teacherID'];

if (isset($_GET['operation']) && $_GET['operation'] != '') {
    $operation = get_safe_value_pta($conn, $_GET['operation']);
    if ($operation == 'firstInternals') {
        $sem = get_safe_value_pta($conn, $_GET['sem']);
        $sec = get_safe_value_pta($conn, $_GET['sec']);
        $subject = get_safe_value_pta($conn, $_GET['subject']);
        $totalMarks = 25;
    }
    if ($operation == 'secondInternals') {
        $sem = get_safe_value_pta($conn, $_GET['sem']);
        $sec = get_safe_value_pta($conn, $_GET['sec']);
        $subject = get_safe_value_pta($conn, $_GET['subject']);
        $totalMarks = 50;
    }
}


if (isset($_POST['updateSecondMarks'])) {
    $operation = 'secondInternals';
    $totalMarks = 50;
    $sem = get_safe_value_pta($conn, $_GET['sem']);
    $sec = get_safe_value_pta($conn, $_GET['sec']);
    $studentID = get_safe_value_pta($conn, $_POST["studentID"]); 
    $subject = get_safe_value_pta($conn, $_POST["subjectName"]);
    $marks = get_safe_value_pta($conn, $_POST["updatedMarks"]);
    $sqlup = "UPDATE `secondinternalmarks` SET `marks`='$marks' WHERE `studentID`='$studentID' AND `subject`='$subject'";
    $resup = mysqli_query($conn,$sqlup);
    if ($resup) {
        $update = true;
    } else {
        $error = true;
    }
}

if (isset($_POST['updateFirstMarks'])) {
    $operation = 'firstInternals';
    $totalMarks = 25;
    $sem = get_safe_value_pta($conn, $_GET['sem']);
    $sec = get_safe_value_pta($conn, $_GET['sec']);
    $studentID = get_safe_value_pta($conn, $_POST["studentID"]); 
    $subject = get_safe_value_pta($conn, $_POST["subjectName"]);
    $marks = get_safe_value_pta($conn, $_POST["updatedMarks"]);
    $sqlup = "UPDATE `firstinternalmarks` SET `marks`='$marks' WHERE `studentID`='$studentID' AND `subject`='$subject'";
    $resup = mysqli_query($conn,$sqlup);
    if ($resup) {
        $update = true;
    } else {
        $error = true;
    }
}

if ($update) {
    echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
    <strong>Update was sucesssfull!</strong>.
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
  </div>';
}
if ($error) {
    echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
    <strong>Update was Unsucesssfull!</strong>.
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
  </div>';
}
?>

<div class="modal fade" id="updateFirstMarksModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-sm">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Marks Update</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="container mb-3">
                    <form class="row g-3 m-2" id="updateFirstMarks" action="view_internals_marks.php?sem=<?php echo $sem; ?>&sec=<?php echo $sec; ?>" method="post">
                        <div class="col-md-2 mt-0 w-100">
                            <label for="studentID" class="form-label">student ID</label>
                            <input type="text" class="form-control" id="studentID" name="studentID">
                        </div>
                        <div class="col-md-2 w-100">
                            <label for="subjectName" class="form-label">Subject</label>
                            <input type="text" class="form-control" id="subjectName" name="subjectName">
                        </div>
                        <div class="col-md-2 w-100">
                            <label for="updatedMarks" class="form-label">Marks</label>
                            <input type="text" maxlength="30" class="form-control" id="updatedMarks" name="updatedMarks">
                        </div>
                        <div class="col-md-12">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <input type="submit" class="btn btn-primary" name="updateFirstMarks" value="Update">
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="updateSecondMarksModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-sm">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Marks Update</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="container mb-3">
                    <form class="row g-3 m-2" id="updateSecondMarks" action="view_internals_marks.php?sem=<?php echo $sem; ?>&sec=<?php echo $sec; ?>" method="post">
                        <div class="col-md-2 mt-0 w-100">
                            <label for="studentID" class="form-label">student ID</label>
                            <input type="text" class="form-control" id="studentID" name="studentID">
                        </div>
                        <div class="col-md-2 w-100">
                            <label for="subjectName" class="form-label">Subject</label>
                            <input type="text" class="form-control" id="subjectName" name="subjectName">
                        </div>
                        <div class="col-md-2 w-100">
                            <label for="updatedMarks" class="form-label">Marks</label>
                            <input type="text" maxlength="30" class="form-control" id="updatedMarks" name="updatedMarks">
                        </div>
                        <div class="col-md-12">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <input type="submit" class="btn btn-primary" name="updateSecondMarks" value="Update">
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="container m-auto p-0">
    <div class="content">
        <div class="animated fadeIn">
            <div class="row m-0">
                <div class="col-lg-12 p-0">
                    <div class="container mt-3 mb-3 p-0">

                        <div class="card shadow">
                            <div class="card-header">
                                <h3 id="h3"><strong>View Student Marks in </strong><small><?php echo $subject; ?></small></h3>
                            </div>
                            <div class="container table-responsive m-auto mt-2 mb-3">

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
                                            <th scope="col">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php if ($operation == 'firstInternals') {
                                            $sqltt = "SELECT `studentdetails`.`registerNo`, `studentdetails`.`name`, `studentdetails`.`sem`, `studentdetails`.`section`, `firstinternalmarks`.`marks`, `firstinternalmarks`.`studentID` FROM `studentdetails`, `firstinternalmarks` WHERE `firstinternalmarks`.`studentID` = `studentdetails`.`registerNo` AND `studentdetails`.`sem`='$sem' AND `studentdetails`.`section`='$sec' AND `firstinternalmarks`.`subject`='$subject';";
                                            $restt = mysqli_query($conn, $sqltt);
                                            $i = 0;
                                            while ($row = mysqli_fetch_assoc($restt)) {
                                                $i = $i + 1;
                                                echo '<tr>
                                                    <td scope="row">' . $i . '</td>
                                                    <td scope="row">' . $row['registerNo'] . '</td>
                                                    <td scope="row">' . $row['name'] . '</td>
                                                    <td scope="row">' . $row['sem'] . '</td>
                                                    <td scope="row">' . $row['section'] . '</td>
                                                    <td scope="row">' . $row['marks'] . '</td>
                                                    <td scope="row">' . $totalMarks . '</td>
                                                    <td scope="row">
                                                        <button class="btn btn-primary update_first mr-2">Edit</button>
                                                    </td>
                                                </tr>';
                                            }
                                        } else {
                                            $sqltt = "SELECT `studentdetails`.`registerNo`, `studentdetails`.`name`, `studentdetails`.`sem`, `studentdetails`.`section`, `secondinternalmarks`.`marks`, `secondinternalmarks`.`studentID` FROM `studentdetails`, `secondinternalmarks` WHERE `secondinternalmarks`.`studentID` = `studentdetails`.`registerNo` AND `studentdetails`.`sem`='$sem' AND `studentdetails`.`section`='$sec' AND `secondinternalmarks`.`subject`='$subject';";
                                            $restt = mysqli_query($conn, $sqltt);
                                            $i = 0;
                                            while ($row = mysqli_fetch_assoc($restt)) {
                                                $i = $i + 1;
                                                echo '<tr>
                                                    <td scope="row">' . $i . '</td>
                                                    <td scope="row">' . $row['registerNo'] . '</td>
                                                    <td scope="row">' . $row['name'] . '</td>
                                                    <td scope="row">' . $row['sem'] . '</td>
                                                    <td scope="row">' . $row['section'] . '</td>
                                                    <td scope="row">' . $row['marks'] . '</td>
                                                    <td scope="row">' . $totalMarks . '</td>
                                                    <td scope="row">
                                                        <button class="btn btn-primary update_second mr-2">Edit</button>
                                                    </td>
                                                </tr>';
                                            }
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