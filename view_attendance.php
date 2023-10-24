<?php
include('partials/_top.php');

if (!isset($_SESSION['adminLoggedIn']) || $_SESSION['adminLoggedIn'] != true) {
    if (!isset($_SESSION['teacherLoggedIn']) || $_SESSION['teacherLoggedIn'] != true) { ?>
<script>
window.location.href = "login.php";
</script>
<?php
    }
}

$today = date("Md");
$sem = '';
$section = '';
$editShow = false;

if (isset($_GET['type']) && $_GET['type'] != '') {
    $type = get_safe_value_pta($conn, $_GET['type']);
    if ($type === 'view_attendace') {
        $sem = get_safe_value_pta($conn, $_GET['sem']);
        $section = get_safe_value_pta($conn, $_GET['sec']);
        $subject = get_safe_value_pta($conn, $_GET['sub']);
    }
    if ($type === 'view_attend') {
        $sem = get_safe_value_pta($conn, $_GET['sem']);
        $section = get_safe_value_pta($conn, $_GET['sec']);
        $subject = get_safe_value_pta($conn, $_GET['sub']);
        $editShow = true;
    }
}

if ($sem == '' || $section == '') {
    header("location: student_attendance.php");
}

?>


<div class="container-fluid m-auto p-0">
    <div class="content">
        <div class="animated fadeIn">
            <div class="row m-0">
                <div class="col-lg-12 p-0">
                    <div class="container-fluid mt-3 mb-3">

                        <div class="card shadow m-auto">
                            <div class="card-header">
                                <h3><strong>View Student Details</strong><small></small></h3>
                            </div>

                            <div class="container-fluid table-responsive m-0 mt-2 mb-3">
                                <table class="table display table-bordered" style="width:100%;" id="myTable">
                                    <thead>
                                        <?php
                                        $sql = "SELECT * FROM `$subject` WHERE `sem`='$sem' and `section`='$section' order by `studentID`";
                                        $res = mysqli_query($conn, $sql);
                                        while ($columnInfo = mysqli_fetch_field($res)) {
                                            echo '<th>' . $columnInfo->name . '</th>';
                                        }
                                        ?>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $sql = "SELECT * FROM `$subject` WHERE `sem`='$sem' and `section`='$section' order by `id`";
                                        $res = mysqli_query($conn, $sql);
                                        while ($row = mysqli_fetch_assoc($res)) {
                                            echo '<tr>';
                                            foreach ($row as $key => $value) {
                                                echo '
                                     <td>' . $value . '</td>';
                                            }
                                            echo '</tr>';
                                        }
                                        if($editShow){
                                            echo '<button type="button" class="btn btn-primary m-2">Edit</button>';
                                        }
                                        if (mysqli_num_rows($res) < 1) {
                                            echo '<div class="center"><h5>No Data to Display</h5></div>';
                                        }
                                        ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php include("partials/_footer.php"); ?>