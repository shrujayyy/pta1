<?php
require('partials/connection.inc.php');
require('partials/function.inc.php');

$sem = get_safe_value_pta($conn, $_POST['sem']);
// $sectionList = get_safe_value_pta($con, $_POST['sub_cat_id']);
$res = mysqli_query($conn, "Select * from `bcasection` WHERE `sem`='$sem' and `status`='1'");

if (mysqli_num_rows($res) > 0) {
    $html = '';
    while ($row = mysqli_fetch_assoc($res)) {
        $html .= "<option value=" . $row['section'] . ">" . $row['section'] . "</option>";
    }
    echo $html;
} else {
    echo "<option value=''>No selection was found</option>";
}
