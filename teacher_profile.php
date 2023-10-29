<?php
require('partials/top.inc.php');

if (!isset($_SESSION['teacherLoggedIn']) || $_SESSION['teacherLoggedIn'] != true) { ?>
    <script>
        window.location.href = "login.php";
    </script>
<?php
    exit;
}

$updateSuccess = false;
$matchError = '';
$currentError = '';
$teacherID = $_SESSION['teacherID'];
$teacherName = '';
$firstName = '';
$lastName = '';
$email = '';
$phoneNo = '';
$sql = "SELECT * FROM `teacherdetails` WHERE `teacherID`='$teacherID'";
$res = mysqli_query($conn, $sql);
while ($row = mysqli_fetch_assoc($res)) {
    $teacherName = $row['name'];
    $nameParts = explode(" ", $teacherName);
    $firstName = $nameParts[0];
    $lastName = $nameParts[1];
    $email = $row['email'];
    $phoneNo = $row['phoneNo'];
}
if (isset($_POST['updatePassword'])) {
    $currentPassword = get_safe_value_pta($conn, $_POST['currentPassword']);
    $newPassword = get_safe_value_pta($conn, $_POST['newPassword']);
    $confirmPassword = get_safe_value_pta($conn, $_POST['confirmPassword']);
    $sqlUp = "SELECT `teacherPassword` FROM `teacherlogin` WHERE `teacherID`='$teacherID'";
    $resUp = mysqli_query($conn, $sqlUp);

    if ($resUp) {
        while ($rowUp = mysqli_fetch_assoc($resUp)) {
            $storedPassword = $rowUp['teacherPassword'];
        }

        if (password_verify($currentPassword, $storedPassword)) {
            if ($newPassword === $confirmPassword) {
                // Hash the new password before storing it
                $hashedNewPassword = password_hash($newPassword, PASSWORD_DEFAULT);

                // Update the user's password in the database
                $updateSql = "UPDATE `teacherlogin` SET `teacherPassword` = '$hashedNewPassword' WHERE `teacherID`='$teacherID'";
                $updateResult = mysqli_query($conn, $updateSql);

                if ($updateResult) {
                    $updateSuccess = true;
                } else {
                    $updateSuccess = false;
                }
            } else {
                $matchError = "New password and confirm password do not match.";
            }
        } else {
            $currentError = "Current password is incorrect.";
        }
    } else {
        $updateSuccess = false;;
    }
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
                                <h3><strong>Your Profile</strong></h3>
                            </div>

                            <div class="container mb-3">
                                <form class="row g-3 m-2">
                                    <div class="col-md-2">
                                        <label for="teacherID" class="form-label">TeacherID</label>
                                        <input type="text" maxlength="10" class="form-control" id="teacherID" name="teacherID" value="<?php echo $teacherID; ?>">
                                    </div>
                                    <div class="col-md-5">
                                        <label for="firstName" class="form-label">First Name</label>
                                        <input type="text" class="form-control" id="firstName" name="firstName" value="<?php echo $firstName; ?>">
                                    </div>
                                    <div class="col-md-5">
                                        <label for="lastName" class="form-label">Last Name</label>
                                        <input type="text" class="form-control" id="lastName" name="lastName" value="<?php echo $lastName; ?>">
                                    </div>
                                    <div class="col-md-6">
                                        <label for="email" class="form-label">Email</label>
                                        <input type="email" class="form-control" id="email" name="email" value="<?php echo $email; ?>">
                                    </div>
                                    <div class="col-md-6">
                                        <label for="phoneNo" class="form-label">Phone No</label>
                                        <input type="tel" class="form-control" id="phoneNo" name="phoneNo" value="<?php echo $phoneNo; ?>">
                                    </div>
                                    <div class="col-12 center">
                                        <a class="btn btn-primary" href="teacher.php">Back</a>
                                    </div>
                                </form>
                                <div class="col-12">
                                    <hr>
                                </div>
                            </div>
                        </div>
                        <div class="card shadow m-auto">
                            <div class="card-header">
                                <h3><small>Change Password</small></h3>
                            </div>
                            <div class="container mb-3">
                                <form class="row g-3 m-2" action="teacher_profile.php" method="post">
                                    <div class="col-md-12 mt-2">
                                        <label for="currentPassword" class="form-label">Current Password :
                                        </label>
                                        <input type="password" class="form-control w-50" id="currentPassword" name="currentPassword">
                                        <p class="error"><?php echo $currentError; ?></p>
                                    </div>
                                    <div class="col-md-12 ">
                                        <label for="newpassword" class="form-label">Password : </label>
                                        <input type="password" class="form-control w-50" id="newPassword" name="newPassword">
                                    </div>
                                    <div class="col-md-12">
                                        <label for="confirmPassword" class="form-label">Confirm Password :
                                        </label>
                                        <input type="password" class="form-control w-50" id="confirmPassword" name="confirmPassword">
                                        <p class="error"><?php echo $matchError; ?></p>
                                    </div>
                                    <div class="col-6">
                                        <input type="submit" class="btn btn-primary" name="updatePassword" value="Update">
                                    </div>
                            </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php include("partials/_footer.php"); ?>