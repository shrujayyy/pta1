<?php
include('partials/_top.php');

if (!isset($_SESSION['adminLoggedIn']) || $_SESSION['adminLoggedIn'] != true) {
    header("location: login.php");
    exit;
}

$tableName = '';
$insertSuccess = false;
$sem = get_safe_value_pta($conn, $_GET["sem"]);
$sec = get_safe_value_pta($conn, $_GET["sec"]);
if ($sem == 1) {
    $tableName = "firstBca";
}
if ($sem == 3) {
    $tableName = "thirdBca";
}
if ($sem == 5) {
    $tableName = "fifthBca";
}
$tableName = $tableName . $sec;

if (isset($_POST['createTimeTable'])) {
    // $week = get_safe_value_pta($conn, $_POST["week"]);
    $week = $_POST["week"];
    $time9to10 = $_POST["9-10"];
    $time10to11 = $_POST["10-11"];
    $time11to12 = $_POST["11-12"];
    $time12to13 = $_POST["12-13"];
    $time13to14 = $_POST["13-14"];
    $time14to15 = $_POST["14-15"];
    $time15to16 = $_POST["15-16"];
    $time16to17 = $_POST["16-17"];

    // Loop through the values and display them
    for ($i = 0; $i < count($week); $i++) {
        $sqlInsert = "INSERT INTO `$tableName`(`week`, `9.00-9.55`, `10.00-10.55`, `11.00-11.55`, `12.00-12.55`, `13.00-13.55`, `14.00-14.55`, `15.00-15.55`, `16.00-16.55`) VALUES ('$week[$i]','$time9to10[$i]','$time10to11[$i]','$time11to12[$i]','$time12to13[$i]','$time13to14[$i]','$time14to15[$i]','$time15to16[$i]','$time16to17[$i]')";
        $resInsert = mysqli_query($conn, $sqlInsert);
        if ($resInsert) {
            $insertSuccess = true;
        } else {
            $insertError = true;
        }
    }
}

//CREATE TABLE `ptadb`.`firstbcaa` (`week` VARCHAR(50) NOT NULL , `9.00-9.55` VARCHAR(100) NOT NULL , `10.00-10.55` VARCHAR(100) NOT NULL , `11.00-11.55` VARCHAR(100) NOT NULL , `12.00-12.55` VARCHAR(100) NOT NULL , `14.00-14.55` VARCHAR(100) NOT NULL , `15.00-15.55` VARCHAR(100) NOT NULL , `16.00-16.55` VARCHAR(100) NOT NULL );

if (isset($_GET['type']) && $_GET['type'] != '') {
    $type = get_safe_value_pta($conn, $_GET['type']);
    if ($type == 'create_timetable') {
        $sem = get_safe_value_pta($conn, $_GET["sem"]);
        $sec = get_safe_value_pta($conn, $_GET["sec"]);
        if ($sem == 1) {
            $tableName = "firstBca";
        }
        if ($sem == 3) {
            $tableName = "thirdBca";
        }
        if ($sem == 5) {
            $tableName = "fifthBca";
        }
        $tableName = $tableName . $sec;
        $sqltt = "CREATE TABLE `$tableName` (`id` INT NOT NULL AUTO_INCREMENT , `week` VARCHAR(50) NOT NULL , `9.00-9.55` VARCHAR(100) NOT NULL , `10.00-10.55` VARCHAR(100) NOT NULL , `11.00-11.55` VARCHAR(100) NOT NULL , `12.00-12.55` VARCHAR(100) NOT NULL , `13.00-13.55` VARCHAR(100) NOT NULL, `14.00-14.55` VARCHAR(100) NOT NULL , `15.00-15.55` VARCHAR(100) NOT NULL , `16.00-16.55` VARCHAR(100) NOT NULL, UNIQUE KEY (`week`))";
        $restt = mysqli_query($conn, $sqltt);
        if ($restt) {
            $successInsert = true;
        }
    }
}

if ($insertSuccess) {
    echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
    <strong>Successfully created TimeTable</strong>.
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
  </div>';
}

?>

<div class="container m-auto p-0">
    <div class="content">
        <div class="animated fadeIn">
            <div class="row m-0">
                <div class="col-lg-12 p-0">
                    <div class="container mt-3 mb-3">

                        <div class="card shadow m-auto">
                            <div class="card-header">
                                <h3><strong>Creating Time Table</strong><small></small></h3>
                            </div>

                            <div class="container table-responsive m-0 mt-2 mb-3">
                                <form class="row g-3 m-1" id="timeTable" action="creating_timetable.php?sem=<?php echo $sem; ?>&sec=<?php echo $sec; ?>" method="post">

                                    <table class="table display table-bordered" style="width:100%;" id="timeTable">
                                        <thead>
                                            <tr>
                                                <th scope="col">Week</th>
                                                <th scope="col">9.00 - 9.55</th>
                                                <th scope="col">10.00 - 10.55</th>
                                                <th scope="col">11.00 - 11.55</th>
                                                <th scope="col">12.00 - 12.55</th>
                                                <th scope="col">13.00 - 13.55</th>
                                                <th scope="col">14.00 - 14.55</th>
                                                <th scope="col">15.00 - 15.55</th>
                                                <th scope="col">16.00 - 16.55</th>
                                            </tr>
                                        </thead>
                                        <tbody id="inputContainer">
                                            <?php
                                            $sqltt = "SELECT * FROM `$tableName` ORDER BY `id`";
                                            $restt = mysqli_query($conn, $sqltt);
                                            if ($restt) {
                                                while ($row = mysqli_fetch_assoc($restt)) {
                                                    echo '<tr>
                                                <th scope="col">' . $row['week'] . '</th>
                                                <td scope="row">' . $row['9.00-9.55'] . '</td>
                                                <td scope="row">' . $row['10.00-10.55'] . '</td>
                                                <td scope="row">' . $row['11.00-11.55'] . '</td>
                                                <td scope="row">' . $row['12.00-12.55'] . '</td>
                                                <td scope="row">' . $row['13.00-13.55'] . '</td>
                                                <td scope="row">' . $row['14.00-14.55'] . '</td>
                                                <td scope="row">' . $row['15.00-15.55'] . '</td>
                                                <td scope="row">' . $row['16.00-16.55'] . '</td>
                                            </tr>';
                                                }
                                            } else {
                                            ?>
                                                <tr>
                                                    <td>
                                                        <select id="week" class="form-select" name="week[]">
                                                            <option selected>Choose...</option>
                                                            <option id="Mon">Mon</option>
                                                            <option id="Tue">Tue</option>
                                                            <option id="Wed">Wed</option>
                                                            <option id="Thur">Thu</option>
                                                            <option id="Fri">Fri</option>
                                                            <option id="Sat">Sat</option>
                                                        </select>
                                                    </td>
                                                    <td>
                                                        <select id="9-10" class="form-select" name="9-10[]">
                                                            <option selected>Choose...</option>
                                                            <option>Free</option>
                                                            <?php
                                                            $sqltt = "SELECT * FROM `bcasub` WHERE `sem`='$sem'";
                                                            $restt = mysqli_query($conn, $sqltt);
                                                            while ($rowtt = mysqli_fetch_assoc($restt)) {
                                                                echo "<option value=" . $rowtt['subjectName'] . ">" . $rowtt['subjectName'] . "</option>";
                                                            }
                                                            ?>
                                                        </select>
                                                    </td>
                                                    <td>
                                                        <select id="10-11" class="form-select" name="10-11[]">
                                                            <option selected>Choose...</option>
                                                            <option>Free</option>
                                                            <?php
                                                            $sqltt = "SELECT * FROM `bcasub` WHERE `sem`='$sem'";
                                                            $restt = mysqli_query($conn, $sqltt);
                                                            while ($rowtt = mysqli_fetch_assoc($restt)) {
                                                                echo "<option value=" . $rowtt['subjectName'] . ">" . $rowtt['subjectName'] . "</option>";
                                                            }
                                                            ?>
                                                        </select>
                                                    </td>
                                                    <td>
                                                        <select id="11-12" class="form-select" name="11-12[]">
                                                            <option selected>Choose...</option>
                                                            <option>Free</option>
                                                            <?php
                                                            $sqltt = "SELECT * FROM `bcasub` WHERE `sem`='$sem'";
                                                            $restt = mysqli_query($conn, $sqltt);
                                                            while ($rowtt = mysqli_fetch_assoc($restt)) {
                                                                echo "<option value=" . $rowtt['subjectName'] . ">" . $rowtt['subjectName'] . "</option>";
                                                            }
                                                            ?>
                                                        </select>
                                                    </td>
                                                    <td>
                                                        <select id="12-13" class="form-select" name="12-13[]">
                                                            <option selected>Choose...</option>
                                                            <option>Free</option>
                                                            <?php
                                                            $sqltt = "SELECT * FROM `bcasub` WHERE `sem`='$sem'";
                                                            $restt = mysqli_query($conn, $sqltt);
                                                            while ($rowtt = mysqli_fetch_assoc($restt)) {
                                                                echo "<option value=" . $rowtt['subjectName'] . ">" . $rowtt['subjectName'] . "</option>";
                                                            }
                                                            ?>
                                                        </select>
                                                    </td>
                                                    <td>
                                                        <select id="13-14" class="form-select" name="13-14[]">
                                                            <option selected>Lunch</option>
                                                        </select>
                                                    </td>
                                                    <td>
                                                        <select id="14-15" class="form-select" name="14-15[]">
                                                            <option selected>Choose...</option>
                                                            <option>Free</option>
                                                            <?php
                                                            $sqltt = "SELECT * FROM `bcasub` WHERE `sem`='$sem'";
                                                            $restt = mysqli_query($conn, $sqltt);
                                                            while ($rowtt = mysqli_fetch_assoc($restt)) {
                                                                echo "<option value=" . $rowtt['subjectName'] . ">" . $rowtt['subjectName'] . "</option>";
                                                            }
                                                            ?>
                                                        </select>
                                                    </td>
                                                    <td>
                                                        <select id="15-16" class="form-select" name="15-16[]">
                                                            <option selected>Choose...</option>
                                                            <option>Free</option>
                                                            <?php
                                                            $sqltt = "SELECT * FROM `bcasub` WHERE `sem`='$sem'";
                                                            $restt = mysqli_query($conn, $sqltt);
                                                            while ($rowtt = mysqli_fetch_assoc($restt)) {
                                                                echo "<option value=" . $rowtt['subjectName'] . ">" . $rowtt['subjectName'] . "</option>";
                                                            }
                                                            ?>
                                                        </select>
                                                    </td>
                                                    <td>
                                                        <select id="16-17" class="form-select" name="16-17[]">
                                                            <option selected>Choose...</option>
                                                            <option>Free</option>
                                                        <?php
                                                        $sqltt = "SELECT * FROM `bcasub` WHERE `sem`='$sem'";
                                                        $restt = mysqli_query($conn, $sqltt);
                                                        while ($rowtt = mysqli_fetch_assoc($restt)) {
                                                            echo "<option value=" . $rowtt['subjectName'] . ">" . $rowtt['subjectName'] . "</option>";
                                                        }
                                                    } ?>
                                                        </select>
                                                    </td>
                                                </tr>
                                        </tbody>
                                    </table>
                                    <div class="col-md-6">
                                    </div>
                                    <div class="col-md-6 left-390">
                                        <input type="submit" class="btn btn-primary" name="createTimeTable" value="Submit">
                                    </div>
                                </form>

                                <div class="col-md-6 top">
                                    <button class="btn btn-primary" id="addRow">Add Row</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>



<?php include("partials/_footer.php"); ?>

<script>
    $(document).ready(function() {
        $("#addRow").click(function() {
            // Create the input element
            var input = $(`<tr>
            <td>
                <select id="week" class="form-select" name="week[]">
                    <option selected>Choose...</option>
                    <option id="Mon">Mon</option>
                    <option id="Tue">Tue</option>
                    <option id="Wed">Wed</option>
                    <option id="Thur">Thur</option>
                    <option id="Fri">Fri</option>
                    <option id="Sat">Sat</option>
                </select>
            </td>
            <td>
                <select id="9-10" class="form-select" name="9-10[]">
                    <option selected>Choose...</option>
                    <option>Free</option>
                    <?php
                    $sqltt = "SELECT * FROM `bcasub` WHERE `sem`='$sem'";
                    $restt = mysqli_query($conn, $sqltt);
                    while ($rowtt = mysqli_fetch_assoc($restt)) {
                        echo "<option value=" . $rowtt["subjectName"] . ">" . $rowtt["subjectName"] . "</option>";
                    }
                    ?>
                </select>
            </td>
            <td>
                <select id="10-11" class="form-select" name="10-11[]">
                    <option selected>Choose...</option>
                    <option>Free</option>
                    <?php
                    $sqltt = "SELECT * FROM `bcasub` WHERE `sem`='$sem'";
                    $restt = mysqli_query($conn, $sqltt);
                    while ($rowtt = mysqli_fetch_assoc($restt)) {
                        echo "<option value=" . $rowtt["subjectName"] . ">" . $rowtt["subjectName"] . "</option>";
                    }
                    ?>
                </select>
            </td>
            <td>
                <select id="11-12" class="form-select" name="11-12[]">
                    <option selected>Choose...</option>
                    <option>Free</option>
                    <?php
                    $sqltt = "SELECT * FROM `bcasub` WHERE `sem`='$sem'";
                    $restt = mysqli_query($conn, $sqltt);
                    while ($rowtt = mysqli_fetch_assoc($restt)) {
                        echo "<option value=" . $rowtt["subjectName"] . ">" . $rowtt["subjectName"] . "</option>";
                    }
                    ?>
                </select>
            </td>
            <td>
                <select id="12-13" class="form-select" name="12-13[]">
                    <option selected>Choose...</option>
                    <option>Free</option>
                    <?php
                    $sqltt = "SELECT * FROM `bcasub` WHERE `sem`='$sem'";
                    $restt = mysqli_query($conn, $sqltt);
                    while ($rowtt = mysqli_fetch_assoc($restt)) {
                        echo "<option value=" . $rowtt["subjectName"] . ">" . $rowtt["subjectName"] . "</option>";
                    }
                    ?>
                </select>
            </td>
            <td>
                <select id="13-14" class="form-select" name="13-14[]">
                    <option selected>Lunch</option>
                </select>
            </td>
            <td>
                <select id="14-15" class="form-select" name="14-15[]">
                    <option selected>Choose...</option>
                    <option>Free</option>
                    <?php
                    $sqltt = "SELECT * FROM `bcasub` WHERE `sem`='$sem'";
                    $restt = mysqli_query($conn, $sqltt);
                    while ($rowtt = mysqli_fetch_assoc($restt)) {
                        echo "<option value=" . $rowtt["subjectName"] . ">" . $rowtt["subjectName"] . "</option>";
                    }
                    ?>
                </select>
            </td>
            <td>
                <select id="15-16" class="form-select" name="15-16[]">
                    <option selected>Choose...</option>
                    <option>Free</option>
                    <?php
                    $sqltt = "SELECT * FROM `bcasub` WHERE `sem`='$sem'";
                    $restt = mysqli_query($conn, $sqltt);
                    while ($rowtt = mysqli_fetch_assoc($restt)) {
                        echo "<option value=" . $rowtt["subjectName"] . ">" . $rowtt["subjectName"] . "</option>";
                    }
                    ?>
                </select>
            </td>
            <td>
                <select id="16-17" class="form-select" name="16-17[]">
                    <option selected>Choose...</option>
                    <option>Free</option>
                    <?php
                    $sqltt = "SELECT * FROM `bcasub` WHERE `sem`='$sem'";
                    $restt = mysqli_query($conn, $sqltt);
                    while ($rowtt = mysqli_fetch_assoc($restt)) {
                        echo "<option value=" . $rowtt["subjectName"] . ">" . $rowtt["subjectName"] . "</option>";
                    }
                    ?>
                </select>
            </td>
    </tr>`);

            // Append the input element to the container
            $("#inputContainer").append(input);
        });
    });
</script>