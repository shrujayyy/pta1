<?php
require('partials/_top.php');

$update = false;
$error = false;
if (isset($_POST['updateRegisterForm'])) {
    $registerNo = get_safe_value_pta($conn, $_POST["registerNo"]);
    $name = get_safe_value_pta($conn, $_POST["firstName"]) . " " . get_safe_value_pta($conn, $_POST["lastName"]);
    $fatherName = get_safe_value_pta($conn, $_POST["fatherName"]);
    $motherName = get_safe_value_pta($conn, $_POST["motherName"]);
    $course = get_safe_value_pta($conn, $_POST["course"]);
    $sem = get_safe_value_pta($conn, $_POST["sem"]);
    $section = get_safe_value_pta($conn, $_POST["section"]);
    $email = get_safe_value_pta($conn, $_POST["email"]);
    $phoneNo = get_safe_value_pta($conn, $_POST["phoneNo"]);
    $feeAmount = get_safe_value_pta($conn, $_POST["feeAmount"]);
    $paidFeeAmount = get_safe_value_pta($conn, $_POST["paidFeeAmount"]);

    $sql = "UPDATE `studentdetails` SET `registerNo`='$registerNo',`name`='$name',`fathersName`='$fatherName',`mothersName`='$motherName',`course`='$course',`sem`='$sem',`section`='$section',`phoneNo`='$phoneNo',`email`='$email',`feeAmount`='$feeAmount',`paidFeeAmount`='$paidFeeAmount' WHERE `registerNo`='$registerNo'";
    $result = mysqli_query($conn, $sql);
    if ($result) {
        $update = true;
    } else {
        $error = true;
    }
}


$delete = false;
if (isset($_GET['delete'])) {
    $registerNo = get_safe_value_pta($conn, $_GET["delete"]);
    $delete = true;
    $sql = "DELETE FROM `studentdetails` WHERE `registerNo` = '$registerNo'";
    $result = mysqli_query($conn, $sql);
}
?>

<?php
if ($delete) {
    echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
    <strong>Deleation was sucesssfull!</strong>.
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
  </div>';
}
if ($update) {
    echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
    <strong>Update was sucesssfull!</strong>.
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
  </div>';
} 
if($error){
    echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
    <strong>Update was Unsucesssfull!</strong>.
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
  </div>';
}
?>

<!-- Modal -->
<div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-xl modal-lg modal-sm">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Student Details Update</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="container mb-3">
                    <form class="row g-3 m-2" id="updateRegisterForm" action="view_student_details.php" method="post">
                        <div class="col-md-2">
                            <label for="registerNo" class="form-label">Register No</label>
                            <input type="text" maxlength="7" class="form-control" id="registerNo" name="registerNo">
                        </div>
                        <div class="col-md-5">
                            <label for="firstName" class="form-label">Frist Name</label>
                            <input type="text" class="form-control" id="firstName" name="firstName">
                        </div>
                        <div class="col-md-5">
                            <label for="lastName" class="form-label">Last Name</label>
                            <input type="text" class="form-control" id="lastName" name="lastName">
                        </div>
                        <div class="col-md-6">
                            <label for="fatherName" class="form-label">Father Name</label>
                            <input type="text" class="form-control" id="fatherName" name="fatherName">
                        </div>
                        <div class="col-md-6">
                            <label for="motherName" class="form-label">Mother Name</label>
                            <input type="text" class="form-control" id="motherName" name="motherName">
                        </div>
                        <div class="col-md-3">
                            <label for="course" class="form-label">Course</label>
                            <input type="text" class="form-control" id="course" name="course" value="BCA">
                        </div>
                        <div class="col-md-3">
                            <label for="sem" class="form-label">Semester</label>
                            <select id="sem" class="form-select" name="sem">
                                <option selected>Choose...</option>
                                <option>1</option>
                                <option>2</option>
                                <option>3</option>
                                <option>4</option>
                                <option>5</option>
                                <option>6</option>
                            </select>
                        </div>
                        <div class="col-md-3">
                            <label for="section" class="form-label">Section</label>
                            <select id="section" class="form-select" name="section">
                                <option selected>Choose...</option>
                                <option>A</option>
                            </select>
                        </div>
                        <div class="col-md-3">
                            <label for="dob" class="form-label">Date of Birth</label>
                            <input type="text" class="form-control" id="dob" name="dob" pattern="^\d{2}-\d{2}-\d{4}$">
                            <small class="form-text text-muted">Please enter the date DD-MM-YYYY.</small>
                        </div>
                        <div class="col-md-4">
                            <label for="email" class="form-label">Email</label>
                            <input type="email" class="form-control" id="email" name="email">
                        </div>
                        <div class="col-md-4">
                            <label for="phoneNo" class="form-label">Phone No</label>
                            <input type="tel" class="form-control" id="phoneNo" name="phoneNo">
                        </div>
                        <div class="col-md-2">
                            <label for="feeAmount" class="form-label">Fee Amount</label>
                            <input type="number" class="form-control" id="feeAmount" name="feeAmount">
                        </div>
                        <div class="col-md-2">
                            <label for="paidFeeAmount" class="form-label">Paid Fee Amount</label>
                            <input type="number" class="form-control" id="paidFeeAmount" name="paidFeeAmount">
                        </div>
                        <div class="col-md-12">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <input type="submit" class="btn btn-primary" name="updateRegisterForm" value="Update">
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="container-fluid m-auto p-0">
    <div class="content">
        <div class="animated fadeIn">
            <div class="row m-0">
                <div class="col-lg-12 p-0">
                    <div class="container-fluid mt-3 mb-3">

                        <div class="card shadow m-auto">
                            <div class="card-header">
                                <h3><strong>View Student Details</strong><small></small></h3>
                            </div>

                            <div class="container-fluid table-responsive m-0 mt-2 mb-3">
                                <table class="table display table-bordered" style="width:100%;" id="myTable">
                                    <thead>
                                        <tr>
                                            <th scope="col">Register No</th>
                                            <th scope="col">Name</th>
                                            <th scope="col">Father Name</th>
                                            <th scope="col">Mother Name</th>
                                            <th scope="col">Course</th>
                                            <th scope="col">Semester</th>
                                            <th scope="col">Section</th>
                                            <th scope="col">Email</th>
                                            <th scope="col">Phone No</th>
                                            <th scope="col">Fee Amount</th>
                                            <th scope="col">Paid Amount</th>
                                            <th scope="col">Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $sql = "SELECT * FROM `studentdetails`";
                                        $res = mysqli_query($conn, $sql);
                                        while ($row = mysqli_fetch_assoc($res)) {
                                            echo '<tr>
                                                <td scope="row">' . $row['registerNo'] . '</td>
                                                <td>' . $row['name'] . '</td>
                                                <td>' . $row['fathersName'] . '</td>
                                                <td>' . $row['mothersName'] . '</td>
                                                <td>' . $row['course'] . '</td>
                                                <td>' . $row['sem'] . '</td>
                                                <td>' . $row['section'] . '</td>
                                                <td>' . $row['email'] . '</td>
                                                <td>' . $row['phoneNo'] . '</td>
                                                <td>' . $row['feeAmount'] . '</td>
                                                <td>' . $row['paidFeeAmount'] . '</td>
                                                <td class="grid"><button type="button" class="edit btn btn-primary mb-1" id=' . $row['registerNo'] . '>Edit</button>   <button type="button" class="delete btn btn-danger" id=' . $row['registerNo'] . '>Delete</button></td>
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