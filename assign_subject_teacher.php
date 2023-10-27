<?php
include('partials/_top.php');

if (!isset($_SESSION['adminLoggedIn']) || $_SESSION['adminLoggedIn'] != true) {
   header("location: login.php");
   exit;
}

$sem = "";
$sec = "";
$insertSuccess = false;
$sem = get_safe_value_pta($conn, $_GET["sem"]);
$sec = get_safe_value_pta($conn, $_GET["sec"]);

if (isset($_GET['type']) && $_GET['type'] != '') {
   $type = get_safe_value_pta($conn, $_GET['type']);
   if ($type == 'assign') {
      $sem = get_safe_value_pta($conn, $_GET["sem"]);
      $sec = get_safe_value_pta($conn, $_GET["sec"]);
   }
   if($type == 'delete'){
      $sub = get_safe_value_pta($conn, $_GET['sub']);
      $sqlDel = "DELETE FROM `assigned_teacher` WHERE `sem`='$sem' AND `section`='$sec' AND `subjectName`='$sub'";
      $resDel = mysqli_query($conn,$sqlDel);
      if($resDel){
         $deleteSuccess = true;
      }
   }
}

if (isset($_POST['assignSubject'])) {
   // $week = get_safe_value_pta($conn, $_POST["week"]);
   $subjectPost = $_POST["subject"];
   $teacherID = $_POST["teacherID"];

   // Loop through the values and display them
   for ($i = 0; $i < count($teacherID); $i++) {
      $sqlInsert = "INSERT INTO `assigned_teacher`(`teacherID`, `sem`, `section`, `subjectName`) VALUES ('$teacherID[$i]','$sem','$sec','$subjectPost[$i]')";
      $resInsert = mysqli_query($conn, $sqlInsert);
      if ($resInsert) {
         $insertSuccess = true;
      } else {
         $insertError = true;
      }
   }
}

if ($insertSuccess) {
   echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
   <strong>Successfully inserted</strong>.
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
                        <h3><strong>Assigning Subject to Teacher</strong><small></small></h3>
                     </div>

                     <div class="container table-responsive m-0 mt-2 mb-3">
                        <form class="row g-3 m-1" id="assignSubject" action="assign_subject_teacher.php?sem=<?php echo $sem; ?>&sec=<?php echo $sec; ?>" method="post">

                           <table class="table display table-bordered" style="width:100%;">
                              <thead>
                                 <tr>
                                    <th scope="col">SL No</th>
                                    <th scope="col">TeacherID</th>
                                    <th scope="col">Semester</th>
                                    <th scope="col">Section</th>
                                    <th scope="col">Subject</th>
                                    <th scope="col">Action</th>
                                 </tr>
                              </thead>
                              <tbody id="tableTeacher">
                                 <?php
                                 $sqltt = "SELECT * FROM `assigned_teacher` WHERE `sem`='$sem' AND `section`='$sec'";
                                 $restt = mysqli_query($conn, $sqltt);
                                 $i = 0;
                                 if ($restt) {
                                    while ($row = mysqli_fetch_assoc($restt)) {
                                       $i = $i + 1;
                                       echo '<tr>
                                             <th scope="col">' . $i . '</th>
                                             <td scope="row">' . $row['teacherID'] . '</td>
                                             <td scope="row">' . $row['sem'] . '</td>
                                             <td scope="row">' . $row['section'] . '</td>
                                             <td scope="row">' . $row['subjectName'] . '</td>
                                             <td scope="row">
                                                <a class="btn btn-danger" href="?type=delete&sem=1&sec=A&sub=' . $row['subjectName'] . '">Delete</a>
                                             </td>
                                          </tr>';
                                    }
                                 }
                                 ?>
                                 <tr>
                                    <td>
                                    </td>
                                    <td>
                                       <select id="teacherID" class="form-select" name="teacherID[]">
                                          <option selected>Choose...</option>
                                          <?php
                                          $sqlTeacher = "SELECT * FROM `teacherdetails`";
                                          $resTeacher = mysqli_query($conn, $sqlTeacher);
                                          while ($rowTeacher = mysqli_fetch_assoc($resTeacher)) {
                                             echo "<option value=" . $rowTeacher['teacherID'] . ">" . $rowTeacher['teacherID'] . "</option>";
                                          }
                                          ?>
                                       </select>
                                    </td>
                                    <td>
                                       <input type="text" id="sem" class="form-control disabled" disabled name="sem[]" value="<?php echo $sem; ?>"></input>
                                    </td>
                                    <td>
                                       <input type="text" id="sec" class="form-control disabled" disabled name="sec[]" value="<?php echo $sec; ?>"></input>
                                    </td>
                                    <td>
                                       <select id="subject" class="form-select" name="subject[]">
                                          <option selected>Choose...</option>
                                          <?php
                                          $sqlSub = "SELECT * FROM `bcasub` WHERE `sem`='$sem'";
                                          $resSub = mysqli_query($conn, $sqlSub);
                                          while ($rowSub = mysqli_fetch_assoc($resSub)) {
                                             echo "<option value=" . $rowSub['subjectName'] . ">" . $rowSub['subjectName'] . "</option>";
                                          }
                                          ?>
                                       </select>
                                    </td>
                                    <td>
                                    </td>
                                 </tr>
                              </tbody>
                           </table>
                           <div class="col-md-6 left-390">
                              <input type="submit" class="btn btn-primary" name="assignSubject" value="Submit">
                           </div>
                        </form>
                        <div class="col-md-6 ">
                           <button class="btn btn-primary" id="addRowTeacher">Add Row</button>
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
      $("#addRowTeacher").click(function() {
         // Create the input element
         var input = $(`<tr><?php $i = $i + 1; ?>
                           <td>
                              <?php echo $i; ?>
                           </td>
                           <td>
                              <select id="teacherID" class="form-select" name="teacherID[]">
                                 <option selected>Choose...</option>
                                 <?php
                                 $sqlTeacher = "SELECT * FROM `teacherdetails`";
                                 $resTeacher = mysqli_query($conn, $sqlTeacher);
                                 while ($rowTeacher = mysqli_fetch_assoc($resTeacher)) {
                                    echo "<option value=" . $rowTeacher['teacherID'] . ">" . $rowTeacher['teacherID'] . "</option>";
                                 }
                                 ?>
                              </select>
                           </td>
                           <td>
                              <input type="text" id="sem" class="form-control disabled" disabled name="sem[]" value="<?php echo $sem; ?>"></input>
                           </td>
                           <td>
                              <input type="text" id="sec" class="form-control disabled" disabled name="sec[]" value="<?php echo $sec; ?>"></input>
                           </td>
                           <td>
                              <select id="subject" class="form-select" name="subject[]">
                                 <option selected>Choose...</option>
                                 <?php
                                 $sqlSub = "SELECT * FROM `bcasub` WHERE `sem`='$sem'";
                                 $resSub = mysqli_query($conn, $sqlSub);
                                 while ($rowSub = mysqli_fetch_assoc($resSub)) {
                                    echo "<option value=" . $rowSub['subjectName'] . ">" . $rowSub['subjectName'] . "</option>";
                                 }
                                 ?>
                              </select>
                           </td>
                           <td>
                           </td>
                        </tr>`);

         // Append the input element to the container
         $("#tableTeacher").append(input);
      });
   });
</script>