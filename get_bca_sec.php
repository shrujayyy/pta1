<?php
require('partials/connection.inc.php');
require('partials/function.inc.php');

if (isset($_POST['sem'])) {
    $sem = get_safe_value_pta($conn, $_POST['sem']);
    // $sectionList = get_safe_value_pta($con, $_POST['sub_cat_id']);
    $sql = "Select * from `bcasection` WHERE `sem`='$sem' and `status`='1'";
    $res = mysqli_query($conn, $sql);

    $html = '';
    if (mysqli_num_rows($res) > 0) {
        while ($row = mysqli_fetch_assoc($res)) {
            $html .= "<option value='" . $row['section'] . "'>" . $row['section'] . "</option>";
        }
        echo $html;
    } else {
        echo "<option value=''>No selection was found</option>";
    }
}
