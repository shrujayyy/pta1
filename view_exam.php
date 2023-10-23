<?php
include('partials/_top.php');

if (!isset($_SESSION['teacherLoggedIn']) || $_SESSION['teacherLoggedIn'] != true) {
  header("location: login.php");
  exit;
}
?>

<div class="container w-50 ml-2">
  <h2>Exam List</h2>
  <ul>
    <li>First Internals.<a href="enter_first_internals.php" class="href">Click here.</a></li>
    <li>Second Internals.<a href="enter_second_internals.php" class="href">Click here.</a></li>
  </ul>
</div>

<?php include("partials/_footer.php"); ?>