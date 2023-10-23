<?php
include('partials/_top.php');

if (!isset($_SESSION['teacherLoggedIn']) || $_SESSION['teacherLoggedIn'] != true) {
  header("location: login.php");
  exit;
}
?>

<h1>Welcom to Teacher login</h1>
<div class="container w-50 ml-2">
  <h2>Teacher Section</h2>
  <ul>
    <li>Profile.<a href="register_teacher_details.php" class="href">Click here.</a></li>
    <li>View Teacher details.<a href="view_teacher_details.php" class="href">Click here.</a></li>
    <li>Creating Subject.<a href="creating_subject.php" class="href">Click here.</a></li>
    <li>Assign Subject to Teacher.<a href="assign_subject_teacher.php" class="href">Click here.</a></li>
    <li>Teacher Login ID .<a href="teacher_login_id.php" class="href">Click here.</a></li>
  </ul>
</div>

<?php include("partials/_footer.php"); ?>