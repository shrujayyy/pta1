<?php
include('partials/_top.php');

if (!isset($_SESSION['adminLoggedIn']) || $_SESSION['adminLoggedIn'] != true) {
  header("location: login.php");
  exit;
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
                                <h3><strong>View Student Marks Details</strong><small></small></h3>
                            </div>

                            <div class="container table-responsive m-0 mt-2 mb-3">
                                <table class="table display table-bordered" style="width:100%;" id="myTable">
                                    <thead>
                                        
                                    </thead>
                                    <tbody>
                                        
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