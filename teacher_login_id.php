<?php
require('partials/top.inc.php');

if (!isset($_SESSION['adminLoggedIn']) || $_SESSION['adminLoggedIn'] != true) {
    header("location: login.php");
    exit;
}

if (isset($_GET['type']) && $_GET['type'] != '') {
    $type = get_safe_value_pta($conn, $_GET['type']);
    if ($type == 'delete') {
        $operation = get_safe_value_pta($conn, $_GET['operation']);
        if ($operation == 'delete_teacherID') {
            $teacherID = get_safe_value_pta($conn, $_GET['teacherID']);
            $sqldel = "DELETE FROM `teacherlogin` WHERE `teacherID`='$teacherID'";
            $resdel = mysqli_query($conn, $sqldel);
        }
    }
}

?>

<div class="container table-responsive w-50 mt-3 mb-3">
    <table class="table table-striped table-hover table-bordered">
        <thead class="table-dark">
            <tr>
                <th scope="col">SI. No</th>
                <th scope="col">Login Id</th>
                <th scope="col">Action</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $sql = "SELECT `id`, `teacherID` FROM `teacherlogin`";

            $res = mysqli_query($conn, $sql);
            $i = 0;
            while ($row = mysqli_fetch_assoc($res)) {
                $i = $i + 1;
                echo '<tr>
                <td scope="row">' . $i . '</td>
                <td scope="row">' . $row['teacherID'] . '</td>
                <td scope="row">
                    <a class="btn btn-danger" href="?type=delete&operation=delete_teacherID&teacherID=' . $row['teacherID'] . '">Delete</a>
                </td>
            </tr>';
            }
            ?>

        </tbody>
    </table>
</div>

<?php
require('partials/_footer.php');
?>