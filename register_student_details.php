<?php
require('partials/_top.php');

if (!isset($_SESSION['adminLoggedIn']) || $_SESSION['adminLoggedIn'] != true) {
    header("location: login.php");
    exit;
}

$showError = false;

if (isset($_POST['registerForm'])) {
    $postValues = [
        "registerNo", "firstName", "lastName", "fatherName", "motherName", "course", "sem", "section", "email", "phoneNo", "feeAmount", "paidFeeAmount"
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

        $sql1 = "INSERT INTO `studentdetails` (`registerNo`, `name`, `fathersName`, `mothersName`, `course`, `sem`, `section`, `phoneNo`, `email`, `feeAmount`, `paidFeeAmount`) VALUES ('$registerNo', '$name', '$fatherName', '$motherName', '$course', '$sem', '$section', '$phoneNo', '$email', '$feeAmount', '$paidFeeAmount')";
        $result1 = mysqli_query($conn, $sql1);

        $password = get_safe_value_pta($conn, $_POST["phoneNo"]);
        $hash = password_hash($password, PASSWORD_DEFAULT);
        $sql2 = "INSERT INTO `studentlogin` (`studentID`, `studentPassword`) VALUES ('$registerNo','$hash')";
        $result2 = mysqli_query($conn, $sql2);
        if ($result2) {
            $showAlert = true;
        }

        if ($result1) {
            echo "success";
            header("location: admin.php");
            exit;
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
                                <h3><strong>Student Register</strong><small> Form</small></h3>
                            </div>

                            <div class="container mb-3">
                                <form class="row g-3 m-2" id="registerForm" action="register_student_details.php" method="post">
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
                                        <select id="sem" class="form-select" name="sem" onchange="get_bca_sec()">
                                            <option selected>Choose...</option>
                                            <?php
                                                $sqltt = "SELECT * FROM `bcasem` WHERE `status`='1'";
                                                $restt = mysqli_query($conn, $sqltt);
                                                while ($rowtt = mysqli_fetch_assoc($restt)) {
                                                    echo "<option value=" . $rowtt['sem'] . ">" . $rowtt['sem'] . "</option>";
                                                }
                                            ?>
                                        </select>
                                    </div>
                                    <div class="col-md-3">
                                        <label for="section" class="form-label">Section</label>
                                        <select id="section" class="form-select" name="section">
                                            <option selected>Choose...</option>
                                        </select>
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
                                    <div class="col-6">
                                        <a class="btn btn-primary left-390" href="admin.php">Back</a>
                                    </div>
                                    <div class="col-6">
                                        <input type="submit" class="btn btn-primary" name="registerForm" value="Register">
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

<script>
    function get_bca_sec(sem) {
        var sem = jQuery("#sem").val();
        console.log(sem);
        jQuery.ajax({
            url: "get_bca_sec.php",
            type: "post",
            data: {
                "sem": sem
            },
            success: function(result) {
                jQuery("#section").html(result);
            },
        });
    }
</script>

