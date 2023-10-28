<?php
require('partials/top.inc.php');

if (!isset($_SESSION['adminLoggedIn']) || $_SESSION['adminLoggedIn'] != true) {
    header("location: login.php");
    exit;
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
            $sqlA = "SELECT `id`, `studentID` FROM `studentlogin`";

            $resA = mysqli_query($conn, $sqlA);
            $secAa = [];
            $semA = '';
            $i = 0;
            while ($row = mysqli_fetch_assoc($resA)) {
                $i = $i + 1;
                echo '<tr>
                <td scope="row">'. $i .'</td>
                <td scope="row">'. $row['studentID'] .'</td>
                <td scope="row">
                    <button type="button" class="delete_studentID btn btn-danger" id="'. $row['studentID'] .'">Delete</button>
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