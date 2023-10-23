<?php
include('partials/_top.php');

$showAdminError = false;
$showTeacherError = false;
$showStudentError = false;
if (isset($_POST['adminID']) && isset($_POST['adminPassword'])) {
    $adminID = get_safe_value_pta($conn, $_POST["adminID"]);
    $adminPassword = get_safe_value_pta($conn, $_POST["adminPassword"]);

    $sql = "Select * from adminlogin where adminID='$adminID' AND password='$adminPassword'";
    $result = mysqli_query($conn, $sql);
    $num = mysqli_num_rows($result);
    if ($num == 1) {
        $_SESSION['login'] = true;
        $_SESSION['adminLoggedIn'] = true;
        $_SESSION['adminID'] = $adminID;
        header("location: admin.php");
    } else {
        $showAdminError = true;
    }
} elseif (isset($_POST['teacherID']) && isset($_POST['teacherPassword'])) {
    $teacherID = get_safe_value_pta($conn, $_POST["teacherID"]);
    $teacherPassword = get_safe_value_pta($conn, $_POST["teacherPassword"]);

    $sql = "Select * from teacherlogin where teacherID='$teacherID'";
    $result = mysqli_query($conn, $sql);
    if ($row = mysqli_fetch_assoc($result)) {
        if (password_verify($teacherPassword, $row['teacherPassword'])) {
            $_SESSION['login'] = true;
            $_SESSION['teacherLoggedIn'] = true;
            $_SESSION['teacherID'] = $teacherID;
            header("location: teacher.php");
        } 
    } else {
        $showTeacherError = true;
    }
} elseif (isset($_POST['studentID']) && isset($_POST['studentPassword'])) {
    $studentID = get_safe_value_pta($conn, $_POST["studentID"]);
    $studentPassword = get_safe_value_pta($conn, $_POST["studentPassword"]);

    $sql = "Select * from studentlogin where studentID='$studentID'";
    $result = mysqli_query($conn, $sql);
    if ($row = mysqli_fetch_assoc($result)) {
        if (password_verify($studentPassword, $row['studentPassword'])) {
            $_SESSION['login'] = true;
            $_SESSION['studentLoggedIn'] = true;
            $_SESSION['studentID'] = $studentID;
            header("location:parent.php");
        }
    } else {
        $showStudentError = true;
    }
}

if ($showAdminError) {
    echo '<div class="alert alert-warning alert-dismissible fade show" role="alert">
        <strong>Error occured!!</strong> Please check your AdminID or Password. <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
      </div>';
}

if ($showTeacherError) {
    echo '<div class="alert alert-warning alert-dismissible fade show" role="alert">
        <strong>Error occured!!</strong> Please check your TeacherID or Password. <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
      </div>';
}

if ($showStudentError) {
    echo '<div class="alert alert-warning alert-dismissible fade show" role="alert">
        <strong>Error occured!!</strong> Please check your StudentID or Password. <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
      </div>';
}

?>

<style>
    .containerlg {
        width: 50%;
        padding: 16px;
        background-color: #fff;
        margin: 0 auto;
        margin-top: 100px;
        border: 1px solid #ddd;
        border-radius: 5px;
        box-shadow: 0px 0px 10px 0px rgba(0, 0, 0, 0.2);
        transition: transform 0.3s ease, box-shadow 0.3s ease;
    }

    .containerlg.active {
        display: block;
        /* Display when active */
    }

    .containerlg h1 {
        text-align: center;
        margin-bottom: 20px;
        color: #333;
    }

    .containerlg label {
        display: block;
        margin-bottom: 5px;
        color: #666;
    }

    .containerlg input[type="text"],
    .containerlg input[type="email"],
    .containerlg input[type="password"] {
        width: 100%;
        padding: 10px;
        margin-bottom: 20px;
        border: 1px solid #ddd;
        border-radius: 3px;
    }

    .containerlg input[type="submit"] {
        background-color: #4caf50;
        color: white;
        cursor: pointer;
        width: 100%;
        padding: 10px;
        border: none;
        border-radius: 3px;
        transition: background-color 0.3s ease;
    }

    .containerlg input[type="submit"]:hover {
        background-color: #45a049;
    }
</style>
<div class="row px-xl-5 m-0 p-0">
    <div class="col">
        <div class="container w-75 border border-dark p-0 pb-5 mt-5 m-auto">
            <ul class="nav nav-tabs border justify-content-center" id="myTab" role="tablist">
                <li class="nav-item" role="presentation">
                    <button class="nav-link <?php if(($showTeacherError === false)&&($showStudentError === false)){ echo 'active';} ?>" id="admin-tab" data-bs-toggle="tab" data-bs-target="#admin" type="button" role="tab" aria-controls="admin" aria-selected="true">Admin login</button>
                </li>
                <li class="nav-item " role="presentation">
                    <button class="nav-link <?php if($showTeacherError){ echo 'active';} ?>" id="teacher-tab" data-bs-toggle="tab" data-bs-target="#teacher" type="button" role="tab" aria-controls="teacher" aria-selected="false">Teacher Login</button>
                </li>
                <li class="nav-item" role="presentation">
                    <button class="nav-link <?php if($showStudentError){ echo 'active';} ?>" id="parent-tab" data-bs-toggle="tab" data-bs-target="#parent" type="button" role="tab" aria-controls="parent" aria-selected="false">Parent Login</button>
                </li>
            </ul>
            <div class="tab-content" id="myTabContent">
                <div class="tab-pane fade <?php if(($showTeacherError === false)&&($showStudentError === false)){ echo 'show active';} ?>" id="admin" role="tabpanel" aria-labelledby="admin-tab">
                    <div class="containerlg" id="adminLogin">
                        <h1>Admin Login</h1>
                        <form id="adminLogin-form" action="login.php" method="post">
                            <label for="adminID">AdminID:</label>
                            <input type="text" id="adminID" name="adminID" maxlength="10" required />

                            <label for="password">Password:</label>
                            <input type="password" id="adminPassword" name="adminPassword" required />
                            <input type="submit" value="Login" />
                        </form>
                        <p>Forgot your <a href="#">Password?</a></p>
                    </div>
                </div>
                <div class="tab-pane fade <?php if($showTeacherError){ echo 'show active';} ?>" id="teacher" role="tabpanel" aria-labelledby="teacher-tab">
                    <div class="containerlg" id="teacherLogin">
                        <h1>Teacher Login</h1>
                        <form id="teacherLogin-form" action="login.php" method="post">
                            <label for="teacherID">TeacherID:</label>
                            <input type="text" id="teacherID" name="teacherID" maxlength="15" required />

                            <label for="password">Password:</label>
                            <input type="password" id="teacherPassword" name="teacherPassword" required />

                            <input type="submit" value="Login" />
                        </form>
                        <p>Forgot your <a href="#">Password?</a></p>
                    </div>
                </div>
                <div class="tab-pane fade <?php if($showStudentError){ echo 'show active';} ?>" id="parent" role="tabpanel" aria-labelledby="parentteacherEtab">
                    <div class="containerlg" id="parentLogin">
                        <h1>Parent Login</h1>
                        <form id="parentLogin-form" action="login.php" method="post">
                            <label for="studentID">StudentID:</label>
                            <input type="text" id="studentID" name="studentID" maxlength="7" required />

                            <label for="password">Password:</label>
                            <input type="password" id="studentPassword" name="studentPassword" required />

                            <input type="submit" value="Login" />
                        </form>
                        <p>Forgot your <a href="#">Password?</a></p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php include("partials/_footer.php"); ?>