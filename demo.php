<?php if (isset($_SESSION['login'])) {
    if (isset($_SESSION['adminLoggedIn'])) { echo 'admin.php' } elseif (isset($_SESSION['teacherLoggedIn'])) { echo 'teacher.php'; } elseif (isset($_SESSION['studentLoggedIn'])) { echo 'student.php'; }
}
