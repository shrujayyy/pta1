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
    <li>Profile.<a href="teacher_profile.php" class="href">Click here.</a></li>
    <li>Enter Marks.<a href="view_exam.php" class="href">Click here.</a></li>
    <li>Enter Attendance.<a href="view_classes.php" class="href">Click here.</a></li>
    <li>View student Details.<a href="view_student_class.php" class="href">Click here.</a></li>
    <li>Assigned Subject.<a href="view_assigned_subject.php" class="href">Click here.</a></li>
  </ul>
</div>

<?php include("partials/_footer.php"); ?>