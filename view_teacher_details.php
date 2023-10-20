<?php
require('partials/_top.php');

if (!isset($_SESSION['adminLoggedIn']) || $_SESSION['adminLoggedIn'] != true) {
    header("location: login.php");
    exit;
}

$update = false;
$error = false;
if (isset($_POST['updateTeacherRegisterForm'])) {
    $teacherID = get_safe_value_pta($conn, $_POST["teacherID"]);
    $teacherName = get_safe_value_pta($conn, $_POST["firstName"]) . " " . get_safe_value_pta($conn, $_POST["lastName"]);
    $email = get_safe_value_pta($conn, $_POST["email"]);
    $phoneNo = get_safe_value_pta($conn, $_POST["phoneNo"]);

    $sql1 = "UPDATE `teacherdetails` SET `teacherID`='$teacherID',  `name`= '$teacherName', `phoneNo`= '$phoneNo',`email`='$email' WHERE `teacherID`='$teacherID'";
    $result1 = mysqli_query($conn, $sql1);
    if ($result1) {
        $update = true;
    } else {
        $error = true;
    }
}


$delete = false;
if (isset($_GET['delete_teacher'])) {
    $teacherID = get_safe_value_pta($conn, $_GET["delete_teacher"]);
    $delete = true;
    $sql = "DELETE FROM `teacherdetails` WHERE `teacherID`='$teacherID'";
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
if ($error) {
    echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
    <strong>Update was Unsucesssfull!</strong>.
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
  </div>';
}
?>



<!-- Modal -->
<div class="modal fade" id="editTeacherModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-xl modal-lg modal-sm">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Teacher Details Update</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="container mb-3">
                    <form class="row g-3 m-2" id="updateTeacherRegisterForm" action="view_teacher_details.php" method="post">
                        <div class="col-md-2">
                            <label for="teacherID" class="form-label">TeacherID</label>
                            <input type="text" maxlength="10" class="form-control" id="teacherID" name="teacherID">
                        </div>
                        <div class="col-md-5">
                            <label for="firstName" class="form-label">First Name</label>
                            <input type="text" class="form-control" id="firstName" name="firstName">
                        </div>
                        <div class="col-md-5">
                            <label for="lastName" class="form-label">Last Name</label>
                            <input type="text" class="form-control" id="lastName" name="lastName">
                        </div>
                        <div class="col-md-6">
                            <label for="email" class="form-label">Email</label>
                            <input type="email" class="form-control" id="email" name="email">
                        </div>
                        <div class="col-md-6">
                            <label for="phoneNo" class="form-label">Phone No</label>
                            <input type="tel" class="form-control" id="phoneNo" name="phoneNo">
                        </div>
                        <div class="col-md-12">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <input type="submit" class="btn btn-primary" name="updateTeacherRegisterForm" value="Update">
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
                    <div class="container mt-3 mb-3">

                        <div class="card shadow m-auto">
                            <div class="card-header">
                                <h3><strong>View Student Details</strong><small></small></h3>
                            </div>

                            <div class="container table-responsive m-0 mt-2 mb-3">
                                <table class="table display table-bordered" style="width:100%;" id="myTable">
                                    <thead>
                                        <tr>
                                            <th scope="col">SL NO</th>
                                            <th scope="col">TeacherID</th>
                                            <th scope="col">Name</th>
                                            <th scope="col">Email</th>
                                            <th scope="col">Phone No</th>
                                            <th scope="col">Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $sql = "SELECT * FROM `teacherdetails`";
                                        $res = mysqli_query($conn, $sql);
                                        $i = 0;
                                        while ($row = mysqli_fetch_assoc($res)) {
                                            $i = $i + 1;
                                            echo '<tr>
                                                <td>' . $i . '</td>
                                                <td>' . $row['teacherID'] . '</td>
                                                <td>' . $row['name'] . '</td>
                                                <td>' . $row['email'] . '</td>
                                                <td>' . $row['phoneNo'] . '</td>
                                                <td class="grid"><button type="button" class="edit_teacher btn btn-primary mb-1" id=' . $row['teacherID'] . '>Edit</button>   <button type="button" class="delete_teacher btn btn-danger" id=' . $row['teacherID'] . '>Delete</button></td>
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