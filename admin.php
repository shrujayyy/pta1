<?php
include('partials/_top.php');

if (!isset($_SESSION['adminLoggedIn']) || $_SESSION['adminLoggedIn'] != true) { ?>
  <script>
  window.location.href = "login.php";
  </script>
<?php
  exit;
}

?>

<h1>Welcome to Admin login</h1>
<div class="container w-50 ml-2">
  <h2>Student Section</h2>
  <ul>
    <li>Register Student details.<a href="register_student_details.php" class="href">Click here.</a></li>
    <li>View Student details.<a href="view_student_class.php" class="href">Click here.</a></li>
    <li>Creating Section.<a href="creating_section.php" class="href">Click here.</a></li>
    <li>View Student Attendance.<a href="student_attendance.php" class="href">Click here.</a></li>
    <li>View Student Marks<a href="student_marks.php" class="href">Click here.</a></li>
    <li>View Student Fee status.<a href="student_fee_status.php" class="href">Click here.</a></li>
    <li>Student Login ID .<a href="student_login_id.php" class="href">Click here.</a></li>
  </ul>
</div>
<div class="container w-50 ml-2">
  <h2>Teacher Section</h2>
  <ul>
    <li>Register Teacher details.<a href="register_teacher_details.php" class="href">Click here.</a></li>
    <li>View Teacher details.<a href="view_teacher_details.php" class="href">Click here.</a></li>
    <li>Creating Subject.<a href="creating_subject.php" class="href">Click here.</a></li>
    <li>Teacher Login ID .<a href="teacher_login_id.php" class="href">Click here.</a></li>
  </ul>
</div>

<?php include("partials/_footer.php"); ?>