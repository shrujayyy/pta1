<?php
require('partials/connection.inc.php');
require('partials/function.inc.php');
session_start();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="css/stylebs.css">
    <link rel="stylesheet" href="/pta/css/custom.css">
    <link rel="stylesheet" href="//cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css">
    <link href="https://cdn.datatables.net/v/bs5/jq-3.7.0/dt-1.13.6/b-2.4.2/datatables.min.css" rel="stylesheet">
</head>

<body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-primary">
        <div class="container-fluid">
            <a class="navbar-brand" href="#">PTA</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link" aria-current="page" href="#">Home</a>
                    </li>
                    <li class="nav-item">
                        <?php if (isset($_SESSION['login'])) {
                            if (isset($_SESSION['adminLoggedIn'])) { ?>
                    <li class="nav-item">
                        <a class="nav-link dark" aria-current="page" href="admin.php">Admin</a>
                    </li>
                    <form action="logout.php" method="post">
                        <input type="hidden" name="logout" value="adminLogout" value="adminLogout">
                        <input type="submit" class="nav-link dark" aria-current="page" value="Logout">
                    </form>
                <?php } elseif (isset($_SESSION['teacherLoggedIn'])) { ?>
                    <li class="nav-item">
                        <a class="nav-link dark" aria-current="page" href="teacher.php">Teacher</a>
                    </li>
                    <form action="logout.php" method="post">
                        <input type="hidden" name="logout" value="teacherLogout" value="teacherLogout">
                        <input type="submit" class="nav-link dark" aria-current="page" value="Logout">
                    </form>
                <?php } elseif (isset($_SESSION['studentLoggedIn'])) { ?>
                    <form action="logout.php" method="post">
                        <input type="hidden" name="logout" value="studentLogout" value="studentLogout">
                        <input type="submit" class="nav-link dark" aria-current="page" value="Logout">
                    </form>
                <?php }
                        } else { ?>
                <a class="nav-link dark" aria-current="page" href="login.php">Login</a>
            <?php } ?>
                </ul>
            </div>
        </div>
    </nav>