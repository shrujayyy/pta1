<?php
require('partials/connection.inc.php');
require('partials/function.inc.php');

session_start();

if (!isset($_POST['login'])) {
    $logout = get_safe_value_pta($conn, $_POST['logout']);

    if ($logout === 'adminLogout') {
        unset($_SESSION['login']);
        unset($_SESSION['adminLoggedIn']);
        unset($_SESSION['adminID']);
    } elseif ($logout === 'teacherLogout') {
        unset($_SESSION['login']);
        unset($_SESSION['teacherLoggedIn']);
        unset($_SESSION['teacherID']);
    } elseif ($logout === 'studentLogout') {
        unset($_SESSION['login']);
        unset($_SESSION['studentLoggedIn']);
        unset($_SESSION['studentID']);
    }
}

// Redirect back to the login page or any other page as needed
header("Location: login.php");
exit();
?>
