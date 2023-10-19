var triggerTabList = [].slice.call(document.querySelectorAll("#myTab button"));
triggerTabList.forEach(function (triggerEl) {
  var tabTrigger = new bootstrap.Tab(triggerEl);

  triggerEl.addEventListener("click", function (event) {
    event.preventDefault();
    tabTrigger.show();
  });
});

$(document).ready(function () {
  $("#myTable").DataTable();
  responsive: true;
});

$(document).ready(function () {
  $(".delete").click(function (e) {
    e.preventDefault();
    console.log("Delete");
    var registerNo = this.id.substring(0);
    console.log(registerNo);
    if (confirm("Are you sure you want to delete this note?")) {
      console.log("yes");
      window.location.href = `/pta/view_student_details.php?delete=${registerNo}`;
    } else {
      console.log("no");
    }
  });
});

$(document).ready(function () {
  $(".delete_teacher").click(function (e) {
    e.preventDefault();
    var teacherID = this.id.substring(0);
    if (confirm("Are you sure you want to delete this note?")) {
      console.log("yes");
      window.location.href = `/pta/view_teacher_details.php?delete_teacher=${teacherID}`;
    } else {
      console.log("no");
    }
  });
});

$(document).ready(function () {
  $(".edit").click(function (e) {
    e.preventDefault(); // Prevent any default link behavior

    var tr = $(this).closest("tr");
    var registerNo = tr.find("td:eq(0)").text();
    var fatherName = tr.find("td:eq(2)").text();
    var motherName = tr.find("td:eq(3)").text();
    var course = tr.find("td:eq(4)").text();
    var sem = tr.find("td:eq(5)").text();
    var section = tr.find("td:eq(6)").text();
    var email = tr.find("td:eq(7)").text();
    var phoneNo = tr.find("td:eq(8)").text();
    var feeAmount = tr.find("td:eq(9)").text();
    var paidFeeAmount = tr.find("td:eq(10)").text();

    var name = tr.find("td:eq(1)").text();
    var separator = " ";

    var arrayOfWords = name.split(separator);
    var firstName = arrayOfWords[0];
    var lastName = arrayOfWords[1];

    $("#registerNo").val(registerNo);
    $("#firstName").val(firstName);
    $("#lastName").val(lastName);
    $("#fatherName").val(fatherName);
    $("#motherName").val(motherName);
    $("#course").val(course);
    $("#sem").val(sem);
    $("#section").val(section);
    $("#email").val(email);
    $("#phoneNo").val(phoneNo);
    $("#feeAmount").val(feeAmount);
    $("#paidFeeAmount").val(paidFeeAmount);
    $("#editModal").modal("toggle");
  });
});

$(document).ready(function () {
  $(".edit_teacher").click(function (e) {
    e.preventDefault(); // Prevent any default link behavior

    var tr = $(this).closest("tr");
    var teacherID = tr.find("td:eq(1)").text();
    var email = tr.find("td:eq(3)").text();
    var phoneNo = tr.find("td:eq(4)").text();
    var name = tr.find("td:eq(2)").text();
    var separator = " ";

    var arrayOfWords = name.split(separator);
    var firstName = arrayOfWords[0];
    var lastName = arrayOfWords[1];

    $("#teacherID").val(teacherID);
    $("#firstName").val(firstName);
    $("#lastName").val(lastName);
    $("#email").val(email);
    $("#phoneNo").val(phoneNo);
    $("#editTeacherModal").modal("toggle");
  });
});

$(document).ready(function () {
  $(".active_sec").click(function (e) {
    e.preventDefault();
    var sem = $(this).attr("ID");
    
    tr = $(this).closest("tr");
    var sem = tr.find("td:eq(1)").text();
    var sectionList = tr.find("td:eq(2)").text();
    $("#semDisplay").val(sem);
    $("#sectionList").val(sectionList);
    
    $("#activeSecModal").modal("toggle");
  });
});

$(document).ready(function () {
  $(".deactive_sec").click(function (e) {
    e.preventDefault();
    var sem = $(this).attr("ID");
    
    tr = $(this).closest("tr");
    var sem = tr.find("td:eq(1)").text();
    $("#deactiveSemDisplay").val(sem);
    
    $("#deactiveSecModal").modal("toggle");
  });
});

$(document).ready(function () {
  $(".update_sub").click(function (e) {
    e.preventDefault();
    
    tr = $(this).closest("tr");
    var sem = tr.find("td:eq(1)").text();
    var subject = tr.find("td:eq(2)").text();
    $("#updateSemDisplay").val(sem);
    $("#updateSubjectName").val(subject);
    
    $("#updateSubModal").modal("toggle");
  });
});

$(document).ready(function () {
  $(".add_sub").click(function (e) {
    e.preventDefault();
    $("#addSubModal").modal("toggle");
  });
});

$(document).ready(function () {
  $(".add_date").click(function (e) {
    e.preventDefault();
    $("#addDateModal").modal("toggle");
  });
});

$(document).ready(function() {
  // Get references to the table, the count button, and the add row button
  var table = $("#timeTable");
  var countButton = $("#countRowsButton");
  var addRow = $("#addRow");

  // Function to count the rows and disable the add row button
  function countRowsAndDisableButton() {
      var rowCount = table.find("tbody tr").length;
      if (rowCount >= 5) {
          addRow.prop("disabled", true);
      }
  }
  // Attach a click event to the count button
  addRow.click(countRowsAndDisableButton);

});

