<?php
include('partials/top.inc.php');

if (!isset($_SESSION['adminLoggedIn']) || $_SESSION['adminLoggedIn'] != true) {
    header("location: login.php");
    exit;
}

$odd = false;
$even = false;
if (isset($_GET['type']) && $_GET['type'] != '') {
    $type = get_safe_value_pta($conn, $_GET['type']);
    $semOne = '';
    $semTwo = '';
    $semThree = '';
    $semFour = '';
    $semFive = '';
    $semSix = '';
    if ($type == 'status') {
        $operation = get_safe_value_pta($conn, $_GET['operation']);
        if ($operation == 'odd_sem') {
            $semOne = '2';
            $semTwo = '1';
            $semThree = '4';
            $semFour = '3';
            $semFive = '6';
            $semSix = '5';
            $odd = true;
        }
        if ($operation == 'even_sem') {
            $semOne = '1';
            $semTwo = '2';
            $semThree = '3';
            $semFour = '4';
            $semFive = '5';
            $semSix = '6';
            $even = true;
        }
        $update_status_sql1 = "update `bcasem` set status='0' where `sem` IN ('$semOne','$semThree','$semFive')";
        $update_status_sql2 = "update `bcasem` set status='1' where `sem` IN ('$semTwo','$semFour','$semSix')";
        mysqli_query($conn, $update_status_sql1);
        mysqli_query($conn, $update_status_sql2);
    }
}

$update = false;
$error = false;
if (isset($_POST['activeSection'])) {
    $semDisplay = get_safe_value_pta($conn, $_POST["semDisplay"]);
    $sectionList = get_safe_value_pta($conn, $_POST["sectionList"]);
    $sectionArray = explode(", ", $sectionList);
    foreach ($sectionArray as $section) {
        $sqlup = "UPDATE `bcasection` SET `status`='1' WHERE `sem`='$semDisplay' AND `section`='$section'";
        $result = mysqli_query($conn, $sqlup);
    }
}
if (isset($_POST['deactiveSection'])) {
    $semDisplay = get_safe_value_pta($conn, $_POST["deactiveSemDisplay"]);
    $sectionList = get_safe_value_pta($conn, $_POST["sectionList"]);
    $sectionArray = explode(", ", $sectionList);
    foreach ($sectionArray as $section) {
        $sqlup = "UPDATE `bcasection` SET `status`='0' WHERE `sem`='$semDisplay' AND `section`='$section'";
        $result = mysqli_query($conn, $sqlup);
    }
}


?>

<div class="modal fade" id="activeSecModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-sm">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Section Update</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="container mb-3">
                    <form class="row g-3 m-2" id="activeSection" action="creating_section.php" method="post">
                        <div class="col-md-2 w-100">
                            <label for="semDisplay" class="form-label">Semester</label>
                            <input type="text" maxlength="3" class="form-control" id="semDisplay" name="semDisplay">
                        </div>
                        <div class="col-md-2 w-100">
                            <label for="sectionList" class="form-label">Section</label>
                            <input type="text" maxlength="30" class="form-control" id="sectionList" name="sectionList">
                        </div>
                        <div class="col-md-12">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <input type="submit" class="btn btn-primary" name="activeSection" value="Update">
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="deactiveSecModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-sm">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Section Update</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="container mb-3">
                    <form class="row g-3 m-2" id="deactiveSection" action="creating_section.php" method="post">
                        <div class="col-md-2 w-100">
                            <label for="semDisplay" class="form-label">Semester</label>
                            <input type="text" maxlength="3" class="form-control" id="deactiveSemDisplay" name="deactiveSemDisplay">
                        </div>
                        <div class="col-md-2 w-100">
                            <label for="sectionList" class="form-label">Section</label>
                            <input type="text" maxlength="30" class="form-control" id="sectionList" name="sectionList">
                        </div>
                        <div class="col-md-12">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <input type="submit" class="btn btn-primary" name="deactiveSection" value="Update">
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="container table-responsive w-50 mt-3 mb-3">
    <table class="table table-striped table-hover table-bordered">
        <thead class="table-dark">
            <tr>
                <th scope="col">SI. No</th>
                <th scope="col">Semester</th>
                <th scope="col">Section</th>
                <th scope="col">Action</th>
            </tr>
        </thead>
        <tbody>
            <?php
            // echo "SELECT DISTINCT `bcasem`.`status`,`bcasection`.`status`, `bcasection`.`sem`, `bcasection`.`section` FROM `bcasection`,`bcasem` where `bcasection`.`sem` = `bcasem`.`sem` AND `bcasem`.`status`='1' AND `bcasection`.`status`='1'";
            // die();
            $sqlA = "SELECT DISTINCT `bcasem`.`status`,`bcasection`.`status`, `bcasection`.`sem`, `bcasection`.`section` FROM `bcasection`,`bcasem` where `bcasection`.`sem` = `bcasem`.`sem` AND `bcasem`.`status`='1' AND `bcasection`.`status`='1'";

            $resA = mysqli_query($conn, $sqlA);
            $secAa = [];
            $secBb = [];
            $secCc = [];
            $semA = '';
            $semB = '';
            $semC = '';
            $status = '';

            while ($row = mysqli_fetch_assoc($resA)) {
                if ($row['sem'] == '1' || $row['sem'] == '2') {
                    $secAa[] = $row['section'];
                    $semA = $row['sem'];
                } else if ($row['sem'] == '3' || $row['sem'] == '4') {
                    $secBb[] = $row['section'];
                    $semB = $row['sem'];
                } else if ($row['sem'] == '5' || $row['sem'] == '6') {
                    $secCc[] = $row['section'];
                    $semC = $row['sem'];
                }
                $status = $row['status'];
            }
            $secA = implode(", ", $secAa);
            $secB = implode(", ", $secBb);
            $secC = implode(", ", $secCc);
            ?>

            <tr>
                <td scope="row">1</td>
                <td scope="row"><?php echo $semA; ?></td>
                <td scope="row"><?php echo $secA; ?></td>
                <td scope="row">
                    <button type="button" class="active_sec btn btn-primary" id="<?php echo $semA; ?>">Active</button>
                    <button type="button" class="deactive_sec btn btn-danger" id="<?php echo $semA; ?>">Deactive</button>
                </td>
            </tr>
            <tr>
                <td scope="row">2</td>
                <td scope="row"><?php echo $semB; ?></td>
                <td scope="row"><?php echo $secB; ?></td>
                <td scope="row">
                    <button type="button" class="active_sec btn btn-primary" id="<?php echo $semB; ?>">Active</button>
                    <button type="button" class="deactive_sec btn btn-danger" id="<?php echo $semB; ?>">Deactive</button>
                </td>
            </tr>
            <tr>
                <td scope="row">3</td>
                <td scope="row"><?php echo $semC; ?></td>
                <td scope="row"><?php echo $secC; ?></td>
                <td scope="row">
                    <button type="button" class="active_sec btn btn-primary" id="<?php echo $semC; ?>">Active</button>
                    <button type="button" class="deactive_sec btn btn-danger" id="<?php echo $semC; ?>">Deactive</button>
                </td>
            </tr>
            <tr>
                <td colspan="4">
                    <?php
                    if ($semA == 1) { ?>
                        <a class="btn btn-primary" href="?type=status&operation=even_sem">Even Semester</a>
                    <?php } else { ?>
                        <a class="btn btn-primary" href="?type=status&operation=odd_sem">Odd Semester</a>
                    <?php } ?>
                </td>
            </tr>

        </tbody>
    </table>
</div>

<?php
require('partials/_footer.php');
?>