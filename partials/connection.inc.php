<?php
$database = "ptadb";
$conn = mysqli_connect("localhost", "root", "", "ptadb");
if (!$conn) {
    die("Error" . mysqli_connect_error());
}
