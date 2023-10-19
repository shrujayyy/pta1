<?php
require('partials/_top.php');
$showError = false;

if (isset($_POST['teacherRegisterForm'])) {
    $postValues = [
        "teacherID", "firstName", "lastName", "email", "phoneNo"
    ];

    $error = false;

    foreach ($postValues as $field) {
        if (!isset($_POST[$field]) || $_POST[$field] === "") {
            $error = true;
            break;
        }
    }
    if ($error) {
        $showError = true;
    } else {

        $teacherID = get_safe_value_pta($conn, $_POST["teacherID"]);
        $teacherName = get_safe_value_pta($conn, $_POST["firstName"]) . " " . get_safe_value_pta($conn, $_POST["lastName"]);
        $email = get_safe_value_pta($conn, $_POST["email"]);
        $phoneNo = get_safe_value_pta($conn, $_POST["phoneNo"]);

        $sql1 = "INSERT INTO `teacherdetails`(`teacherID`, `name`, `phoneNo`, `email`) VALUES ('$teacherID','$teacherName','$phoneNo','$email')";
        $result1 = mysqli_query($conn, $sql1);

        $password = get_safe_value_pta($conn, $_POST["phoneNo"]);
        $hash = password_hash($password, PASSWORD_DEFAULT);
        $sql2 = "INSERT INTO `teacherlogin` (`teacherID`, `teacherPassword`) VALUES ('$teacherID','$hash')";
        $result2 = mysqli_query($conn, $sql2);
        if ($result2) {
            $showAlert = true;
        }

        if ($result1) {
            header("location: admin.php");
        } else {
            $showError = true;
        }
    }
}

if ($showError) {
    echo '<div class="alert alert-warning alert-dismissible fade show" role="alert">
    <strong>Insertion was not sucesssfull!</strong> Please check the form.
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
  </div>';
}
?>
<div class="container w-75 m-auto p-0">
    <div class="content">
        <div class="animated fadeIn">
            <div class="row">
                <div class="col-lg-12">
                    <div class="container m-3">

                        <div class="card shadow m-auto">
                            <div class="card-header">
                                <h3><strong>Teacher Register</strong><small> Form</small></h3>
                            </div>

                            <div class="container mb-3">
                                <form class="row g-3 m-2" id="teacherRegisterForm" action="register_teacher_details.php" method="post">
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
                                    <div class="col-6">
                                        <a class="btn btn-primary left-390" href="admin.php">Back</a>
                                    </div>
                                    <div class="col-6">
                                        <input type="submit" class="btn btn-primary" name="teacherRegisterForm" value="Register">
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