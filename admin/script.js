function signout() {
  var r = new XMLHttpRequest();

  r.onreadystatechange = function () {
    if (r.readyState == 4) {
      var t = r.responseText;

      if (t == "1") {
        location.reload();
      }
    }
  };

  r.open("GET", "../signout.php", true);
  r.send();
}

function add_manager() {
  var fname = document.getElementById("fname");
  var lname = document.getElementById("lname");
  var mobile = document.getElementById("mobile");
  var email = document.getElementById("email");
  var password = document.getElementById("password");

  var f = new FormData();
  f.append("fname", fname.value);
  f.append("lname", lname.value);
  f.append("mobile", mobile.value);
  f.append("email", email.value);
  f.append("password", password.value);

  var r = new XMLHttpRequest();

  r.onreadystatechange = function () {
    if (r.readyState == 4 && r.status == 200) {
      var t = r.responseText;
      if (t == "1") {
        Swal.fire({
          title: "Success!",
          text: "Manager Registered Successfully!",
          icon: "success",
        }).then((result) => {
          location.reload();
        });
      } else {
        Swal.fire({
          icon: "error",
          title: "Error...",
          text: t,
        });
      }
    }
  };

  r.open("POST", "backend/addManagersProcess.php", true);
  r.send(f);
}

function add_coordinator() {
  var fname = document.getElementById("fname");
  var lname = document.getElementById("lname");
  var mobile = document.getElementById("mobile");
  var email = document.getElementById("email");
  var password = document.getElementById("password");

  var f = new FormData();
  f.append("fname", fname.value);
  f.append("lname", lname.value);
  f.append("mobile", mobile.value);
  f.append("email", email.value);
  f.append("password", password.value);

  var r = new XMLHttpRequest();

  r.onreadystatechange = function () {
    if (r.readyState == 4 && r.status == 200) {
      var t = r.responseText;
      if (t == "1") {
        Swal.fire({
          title: "Success!",
          text: "Coordinator Registered Successfully!",
          icon: "success",
        }).then((result) => {
          location.reload();
        });
      } else {
        Swal.fire({
          icon: "error",
          title: "Error...",
          text: t,
        });
      }
    }
  };

  r.open("POST", "backend/addCoordinatorsProcess.php", true);
  r.send(f);
}

function remove_managers(id) {
  var f = new FormData();
  f.append("manager", id);

  var r = new XMLHttpRequest();
  r.onreadystatechange = function () {
    if (r.status == 200 && r.readyState == 4) {
      var t = r.responseText;
      if (t == "1") {
        alert("Deactivated Successfully.");
        location.reload();
      } else {
        alert(t);
      }
    }
  };

  r.open("POST", "backend/managersDeactivate_process.php", true);
  r.send(f);
}

function active_managers(id) {
  var f = new FormData();
  f.append("manager", id);

  var r = new XMLHttpRequest();
  r.onreadystatechange = function () {
    if (r.status == 200 && r.readyState == 4) {
      var t = r.responseText;
      if (t == "1") {
        alert("Activated Successfully.");
        location.reload();
      } else {
        alert(t);
      }
    }
  };

  r.open("POST", "backend/managerActive_process.php", true);
  r.send(f);
}

function remove_coordinator(id) {
  var f = new FormData();
  f.append("coordinator", id);

  var r = new XMLHttpRequest();
  r.onreadystatechange = function () {
    if (r.status == 200 && r.readyState == 4) {
      var t = r.responseText;
      if (t == "1") {
        alert("Deactivated Successfully.");
        location.reload();
      } else {
        alert(t);
      }
    }
  };

  r.open("POST", "backend/coordinatorDeactivate_process.php", true);
  r.send(f);
}

function active_coordinator(id) {
  var f = new FormData();
  f.append("coordinator", id);

  var r = new XMLHttpRequest();
  r.onreadystatechange = function () {
    if (r.status == 200 && r.readyState == 4) {
      var t = r.responseText;
      if (t == "1") {
        alert("Activated Successfully.");
        location.reload();
      } else {
        alert(t);
      }
    }
  };

  r.open("POST", "backend/coordinatorActive_process.php", true);
  r.send(f);
}

function add_utillity() {
  var name = document.getElementById("name");
  var amount = document.getElementById("amount");
  var type = document.getElementById("type");
  var date = document.getElementById("date");
  var img = document.getElementById("imageuploader");

  var f = new FormData();
  f.append("name", name.value);
  f.append("amount", amount.value);
  f.append("type", type.value);
  f.append("date", date.value);
  f.append("img", img.files[0]);

  var r = new XMLHttpRequest();

  r.onreadystatechange = function () {
    if (r.readyState == 4 && r.status == 200) {
      var t = r.responseText;
      if (t == "1") {
        Swal.fire({
          title: "Success!",
          text: "Paymnet Saved Successfully!",
          icon: "success",
        }).then((result) => {
          location.reload();
        });
      } else {
        Swal.fire({
          icon: "error",
          title: "Error...",
          text: t,
        });
      }
    }
  };

  r.open("POST", "backend/addUtillityProcess.php", true);
  r.send(f);
}

function add_salary(id) {
  var b = document.getElementById("b" + id);
  var a = document.getElementById("a" + id);
  var i = document.getElementById("i" + id);

  var f = new FormData();
  f.append("b", b.value);
  f.append("a", a.value);
  f.append("i", i.value);
  f.append("id", id);

  var r = new XMLHttpRequest();

  r.onreadystatechange = function () {
    if (r.readyState == 4 && r.status == 200) {
      var t = r.responseText;
      if (t == "1") {
        Swal.fire({
          title: "Success!",
          text: "Salary Updated Successfully!",
          icon: "success",
        }).then((result) => {
          location.reload();
        });
      } else {
        Swal.fire({
          icon: "error",
          title: "Error...",
          text: t,
        });
      }
    }
  };

  r.open("POST", "backend/addSalaryPro.php", true);
  r.send(f);
}

function pay_salary(id, staff) {
  var month = document.getElementById("month" + id);
  var img = document.getElementById("imageuploader" + id);
  var date = document.getElementById("date");

  var f = new FormData();
  f.append("month", month.value);
  f.append("img", img.files[0]);
  f.append("id", id);
  f.append("date", date.value);
  f.append("staff", staff);

  var r = new XMLHttpRequest();

  r.onreadystatechange = function () {
    if (r.readyState == 4 && r.status == 200) {
      var t = r.responseText;
      if (t == "1") {
        Swal.fire({
          title: "Success!",
          text: "Salary Paid Successfully!",
          icon: "success",
        }).then((result) => {
          location.reload();
        });
      } else {
        Swal.fire({
          icon: "error",
          title: "Error...",
          text: t,
        });
      }
    }
  };

  r.open("POST", "backend/paySalaryPro.php", true);
  r.send(f);
}

function generate() {
  var m1 = document.getElementById("m1").value;
  var m2 = document.getElementById("m2").value;

  if (!m1) {
    alert("Please select from Date");
    document.getElementById("report").className = "card shadow mb-4 d-none";
  } else if (!m2) {
    alert("Please select to Date");
    document.getElementById("report").className = "card shadow mb-4 d-none";
  } else {
    var f = new FormData();
    f.append("m1", m1);
    f.append("m2", m2);

    var r = new XMLHttpRequest();

    r.onreadystatechange = function () {
      if (r.readyState == 4 && r.status == 200) {
        var response = JSON.parse(r.responseText);
        document.getElementById("cus").innerHTML = response.a;
        document.getElementById("emp").innerHTML = response.b;
        document.getElementById("ven").innerHTML = response.c;
        document.getElementById("ut").innerHTML = response.d;
        document.getElementById("tot").innerHTML = response.total;
        document.getElementById("net").innerHTML = response.profit;
        document.getElementById("from").innerHTML = m1;
        document.getElementById("to").innerHTML = m2;
        document.getElementById("report").className = "card shadow mb-4 d-block";
        document.getElementById("printbtn").className = "btn btn-sm btn-primary d-block";
      }
    };

    r.open("POST", "backend/generatePro.php", true);
    r.send(f);
  }
}

function update_profile(id){
  var fname = document.getElementById("fname");
  var lname = document.getElementById("lname");
  var email = document.getElementById("email");
  var mobile = document.getElementById("mobile");
  var cpw = document.getElementById("cpw");
  var npw = document.getElementById("npw");

  var f = new FormData();
  f.append("fname", fname.value);
  f.append("lname", lname.value);
  f.append("email", email.value);
  f.append("mobile", mobile.value);
  f.append("cpw", cpw.value);
  f.append("npw", npw.value);
  f.append("id", id);

  var r = new XMLHttpRequest();
  r.onreadystatechange = function () {
    if (r.status == 200 && r.readyState == 4) {
      var t = r.responseText;
      if (t == "1") {
        alert("Updated Successfully.");
        location.reload();
      } else {
        alert(t);
      }
    }
  };

  r.open("POST", "backend/updateProfileProcess.php", true);
  r.send(f);
}

function delete_uslip(id){

  var f = new FormData();
  f.append("id", id);

  var r = new XMLHttpRequest();
  r.onreadystatechange = function () {
    if (r.status == 200 && r.readyState == 4) {
      var t = r.responseText;
      if (t == "1") {
        alert("Deleted Successfully.");
        location.reload();
      } else {
        alert(t);
      }
    }
  };

  r.open("POST", "backend/deleteUSlipProcess.php", true);
  r.send(f);

}