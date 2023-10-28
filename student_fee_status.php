<?php
require('partials/top.inc.php');

if (!isset($_SESSION['adminLoggedIn']) || $_SESSION['adminLoggedIn'] != true) {
    header("location: login.php");
    exit;
}

if (isset($_GET['type']) && $_GET['type'] != '') {
    $type = get_safe_value_pta($conn, $_GET['type']);
    if ($type == 'view_fee') {
        $sem = get_safe_value_pta($conn, $_GET['sem']);
        $section = get_safe_value_pta($conn, $_GET['sec']);
    }
}

if (isset($_POST['updatePaidFee'])) {
    $sem = get_safe_value_pta($conn, $_GET['sem']);
    $section = get_safe_value_pta($conn, $_GET['sec']);
    $registerNo = get_safe_value_pta($conn, $_POST["registerNo"]);
    $paidFeeAmount = get_safe_value_pta($conn, $_POST["updatepaidFeeAmount"]);
    $sqltt = "SELECT * FROM `studentdetails` WHERE `registerNo`='$registerNo'";
    $restt = mysqli_query($conn, $sqltt);
    while ($rowtt = mysqli_fetch_assoc($restt)) {
        $paidFeeAmount = $paidFeeAmount + $rowtt['paidFeeAmount'];
    }
    $sql = "UPDATE `studentdetails` SET `paidFeeAmount`='$paidFeeAmount' WHERE `registerNo`='$registerNo'";
    $result = mysqli_query($conn, $sql);
    if ($result) {
        $update = true;
    } else {
        $error = true;
    }
}

?>

<div class="modal fade" id="feeUpdate" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-sm">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Student Details Update</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="container mb-3">
                    <form class="row g-3 m-2" id="updatePaidFee"
                        action="student_fee_status.php?sem=<?php echo $sem; ?>&sec=<?php echo $section; ?>" method="post">
                        <div class="col-md-12">
                            <label for="registerNo" class="form-label">Register No</label>
                            <input type="text" maxlength="7" class="form-control" id="registerNo" name="registerNo">
                        </div>
                        <div class="col-md-12">
                            <label for="updatepaidFeeAmount" class="form-label">Paid Fee Amount</label>
                            <input type="number" class="form-control" id="updatepaidFeeAmount" name="updatepaidFeeAmount">
                        </div>
                        <div class="col-md-12">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <input type="submit" class="btn btn-primary" name="updatePaidFee" value="Update">
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="container m-auto p-0">
    <div class="content">
        <div class="animated fadeIn">
            <div class="row m-0">
                <div class="col-lg-12 p-0">
                    <div class="container mt-3 mb-3">

                        <div class="card shadow m-auto">
                            <div class="card-header">
                                <h3><strong>View Student Fee Details</strong><small></small></h3>
                            </div>

                            <div class="container table-responsive m-0 mt-2 mb-3">
                                <table class="table display table-bordered" style="width:100%;" id="myTable">
                                    <thead>
                                        <tr>
                                            <th scope="col">Student ID</th>
                                            <th scope="col">Student Name</th>
                                            <th scope="col">Semester</th>
                                            <th scope="col">Section</th>
                                            <th scope="col">Fee Amount</th>
                                            <th scope="col">Paid Amount</th>
                                            <th scope="col">Balance Amount</th>
                                            <th scope="col">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $sql = "SELECT * FROM `studentdetails` WHERE `sem`='$sem' AND `section`='$section'";
                                        $res = mysqli_query($conn, $sql);
                                        while ($row = mysqli_fetch_assoc($res)) {
                                            echo '<tr>
                                                <td scope="row">' . $row['registerNo'] . '</td>
                                                <td>' . $row['name'] . '</td>
                                                <td>' . $row['sem'] . '</td>
                                                <td>' . $row['section'] . '</td>
                                                <td>' . $row['feeAmount'] . '</td>
                                                <td>' . $row['paidFeeAmount'] . '</td>';
                                            $balance = $row['feeAmount'] - $row['paidFeeAmount'];
                                            echo '<td>' . $balance . '</td>
                                                <td class="grid"><button type="button" class="update_fee btn btn-primary mb-1" id=' . $row['registerNo'] . '>Edit</button>
                                            </tr>';
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