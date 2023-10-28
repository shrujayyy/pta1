<?php
require('partials/top.inc.php');

if (!isset($_SESSION['teacherLoggedIn']) || $_SESSION['teacherLoggedIn'] != true) { ?>
   <script>
      window.location.href = "login.php";
   </script>
<?php
   exit;
}

$teacherID = $_SESSION['teacherID'];


?>

<div class="container w-75 m-auto p-0">
   <div class="content">
      <div class="animated fadeIn">
         <div class="row m-0">
            <div class="col-lg-12 p-0">
               <div class="container mt-3 mb-3">

                  <div class="card shadow m-auto">
                     <div class="card-header">
                        <h3><strong>Assigned Subject</strong><small></small></h3>
                     </div>

                     <div class="container table-responsive m-0 mt-2 mb-3">

                        <table class="table display table-bordered" style="width:100%;">
                           <thead>
                              <tr>
                                 <th scope="col">SL No</th>
                                 <th scope="col">Semester</th>
                                 <th scope="col">Section</th>
                                 <th scope="col">Subject</th>
                              </tr>
                           </thead>
                           <tbody id="tableTeacher">
                              <?php
                              $sqltt = "SELECT * FROM `assigned_teacher` WHERE `teacherID`='$teacherID'";
                              $restt = mysqli_query($conn, $sqltt);
                              $i = 0;
                              if ($restt) {
                                 while ($row = mysqli_fetch_assoc($restt)) {
                                    $i = $i + 1;
                                    echo '<tr>
                                             <th scope="col">' . $i . '</th>
                                             <td scope="row">' . $row['sem'] . '</td>
                                             <td scope="row">' . $row['section'] . '</td>
                                             <td scope="row">' . $row['subjectName'] . '</td>
                                          </tr>';
                                 }
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